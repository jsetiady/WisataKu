<?php
namespace WisataKu\WisataKuAPI;
include_once("User.php");
include_once("Location.php");
include_once("TourItineraryModel.php");
include_once("TourPackage.php");

class TourPackageModel {
	private $tourItineraryModel;
	
	public function __construct()
	{
		$this->tourItineraryModel = new TourItineraryModel();
	}
	
	public function getAllTourPackages($args)
    {
        $allTourPackages = array();

        $sql = "SELECT tour_id,tour_name,tour_desc,tour_min_person,tour_max_person,tour_start_date,tour_end_date,
                    tour_duration,tour_type,tour_tc,tour_price,tour_points,tour_created_date,
                    tour_loc_id,tour_user_admin_id,tour_image_filename,loc_name,user_username,user_name
                from ws_tour,ws_user,ws_location
                where tour_loc_id = loc_id
                and tour_user_admin_id = user_id";
        
        if(!is_null($args)) {
            foreach($args as $arg):
                if($_GET['type']) {
                    switch(strtolower($_GET['type'])) {
                        case "personal": $sql .= " and tour_type='p'"; break;
                        case "group": $sql .= " and tour_type='g'"; break;
                        default: break;
                    }
                }

                /*
                * not implemented
                if($_GET['isActive']) {
                    echo $_GET['isActive'];
                }
                */

                if($_GET['startDate']) {
                    $sql .= " and tour_start_date>='".$_GET['startDate']."'";
                } else {
                    $sql .= " and tour_start_date>=CURDATE()";
                }

                if($_GET['endDate']) {
                    $sql .= " and tour_end_date<='".$_GET['endDate']."'";
                }
                if($_GET['location']) {
                    $sql .= " and LCASE(loc_name)='".strtolower($_GET['location'])."'";
                }
            endforeach;
        }
        //echo $sql;
        
        $resSql = mysqli_query(Connection::getCon(),$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
            array_push($allTourPackages, 
            		TourPackage::create()
            		->setTourId($row['tour_id'])
            		->setTourName($row['tour_name'])
            		->setTourDesc($row['tour_desc'])
            		->setTourMaxPerson($row['tour_max_person'])
            		->setTourMinPerson($row['tour_min_person'])
            		->setTourStartDate($row['tour_start_date'])
            		->setTourEndDate($row['tour_end_date'])
            		->setTourDuration($row['tour_duration'])
            		->setTourType($row['tour_type'])
            		->setTourTc($row['tour_tc'])
            		->setTourPrice($row['tour_price'])
            		->setTourPoints($row['tour_points'])
            		->setTourCreatedDate($row['tour_created_date'])
            		->setTourLoc(new Location($row['tour_loc_id'],$row['loc_name']))
            		->setTourUserAdmin(User::create()
            				->setUserId($row['tour_user_admin_id'])
            				->setUsername($row['user_username'])
            				->setName($row['user_name']))
            		->setTourImageFilename($row['tour_image_filename'])
            		->setTourItinerary($this->tourItineraryModel->getAllTourItineraryByTourId($row['tour_id']))
            		);
        }
        return $allTourPackages;
    }

    public function getTourPackageByTourId($tourId)
    {
        $tourPackage = null;

        $sql = "SELECT tour_id,tour_name,tour_desc,tour_min_person,tour_max_person,tour_start_date,tour_end_date,
                    tour_duration,tour_type,tour_tc,tour_price,tour_points,tour_created_date,
                    tour_loc_id,tour_user_admin_id,tour_image_filename,loc_name,user_username,user_name
                from ws_tour,ws_user,ws_location
                where tour_loc_id = loc_id
                and tour_user_admin_id = user_id
                and tour_id = ".$tourId;
        
        $resSql = mysqli_query(Connection::getCon(),$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
        	$tourPackage = TourPackage::create()
        	->setTourId($row['tour_id'])
        	->setTourName($row['tour_name'])
        	->setTourDesc($row['tour_desc'])
        	->setTourMaxPerson($row['tour_max_person'])
        	->setTourMinPerson($row['tour_min_person'])
        	->setTourStartDate($row['tour_start_date'])
        	->setTourEndDate($row['tour_end_date'])
        	->setTourDuration($row['tour_duration'])
        	->setTourType($row['tour_type'])
        	->setTourTc($row['tour_tc'])
        	->setTourPrice($row['tour_price'])
        	->setTourPoints($row['tour_points'])
        	->setTourCreatedDate($row['tour_created_date'])
        	->setTourLoc(new Location($row['tour_loc_id'],$row['loc_name']))
        	->setTourUserAdmin(User::create()
        			->setUserId($row['tour_user_admin_id'])
        			->setUsername($row['user_username'])
        			->setName($row['user_name']))
        	->setTourImageFilename($row['tour_image_filename'])
        	->setTourItinerary($this->tourItineraryModel->getAllTourItineraryByTourId($row['tour_id']));
        }
        
        return $tourPackage;
    }
}

?>