<?php

include_once("model/User.php");
include_once("model/Location.php");
include_once("model/TourItineraryModel.php");
include_once("model/TourPackage.php");

class TourPackageModel {
	private $tourItineraryModel;
	
	public function __construct()
	{
		$this->tourItineraryModel = new TourItineraryModel();
	}
	
	public function getAllTourPackages($tourId = null, $filter = null)
    {
        $allTourPackages = array();

        $sql = "SELECT tour_id,tour_name,tour_desc,tour_min_person,tour_max_person,tour_start_date,tour_end_date,
                    tour_duration,tour_type,tour_tc,tour_price,tour_points,tour_created_date,
                    tour_loc_id,tour_user_admin_id,tour_image_filename,loc_name,user_username,user_name
                from ws_tour,ws_user,ws_location
                where tour_loc_id = loc_id
                and tour_user_admin_id = user_id";
        if($tourId != null)
        {
        	$sql .= " and tour_id = ".$tourId;
        }
        
        
        if(!empty($filter)) {
            
            if($filter['keyword']!="") {
                $keywords = explode(" ", $filter['keyword']);
                $i = 1;
                foreach($keywords as $k):
                    $sql .= " and LCASE(tour_name) LIKE '%".strtolower($k)."%'";
                    if($i < count($keywords)) {
                        $sql .= " OR";
                    }
                    $i++;
                endforeach;
                
            }
                        
            if($filter['tourType']!="") {
                switch($filter['tourType']) {
                    case "p" : 
                        $sql .= " and tour_type= 'p'";
                        break;
                    case "g" : 
                        $sql .= "  and tour_type= 'g'";
                        break;
                }
            }
            
            if($filter['location']!="") {
                $sql .= "  and tour_loc_id=".$filter['location'];
            }
            
            if($filter['month']!="") {
                $sql .= "  and MONTH(tour_start_date)=".$filter['month'];
                
            }
                        
            if($filter['year']!="") {
                $sql .= "  and YEAR(tour_start_date)=".$filter['year'];
            }
                            
            //all
            switch($filter['duration']) {
                case 0: break;
                case 1: 
                    //1-2
                    $sql .= "  and tour_duration >= 1 and tour_duration <= 2";
                    break;
                case 2:
                    //3-5
                    $sql .= "  and tour_duration >= 3 and tour_duration <= 5";
                    break;
                case 3:
                    //7-10
                    $sql .= "  and tour_duration >= 7 and tour_duration <= 10";
                    break;
                case 4:
                    //>10
                    $sql .= "  and tour_duration > 10";
                    break;
            }
            
            switch($filter['participant']) {
                case 0: break;
                case 1: 
                    $sql .= "  and tour_min_person=1 and tour_max_person=2";
                    break; 
                case 2: 
                    $sql .= "  and tour_min_person=1 and tour_max_person=5";
                    break; 
                case 3: 
                    $sql .= "  and tour_min_person=5 and tour_max_person=10";
                    break; 
                case 4: 
                    $sql .= "  and tour_min_person=10 and tour_max_person=20";
                    break; 
                case 5: 
                    $sql .= "  and tour_min_person>20";
                    break; 
            }
                        
                                    
                                    
            switch($filter['price']) {
                case 0: break;
                case 1: 
                    $sql .= "  and tour_price >= 50000 and tour_price <= 100000";
                    break; 
                case 2: 
                    $sql .= "  and tour_price >= 100000 and tour_price <= 300000";
                    break; 
                case 3: 
                    $sql .= "  and tour_price >= 300000 and tour_price <= 500000";
                    break; 
                case 4: 
                    $sql .= "  and tour_price >= 500000 and tour_price <= 1000000";
                    break; 
                case 5: 
                    $sql .= "  and tour_price > 1000000";
                    break; 
            }
            
            switch($filter['point']) {
                case 0: break;
                case 1: 
                    $sql .= "  and tour_points >= 0 and tour_points <= 100";
                    break; 
                case 2: 
                    $sql .= "  and tour_points >= 100 and tour_points <= 500";
                    break; 
                case 3: 
                    $sql .= "  and tour_points >= 500 and tour_points <= 1000";
                    break; 
                case 4: 
                    $sql .= "  and tour_points >= 1000 and tour_points <= 5000";
                    break; 
                case 5: 
                    $sql .= "  and tour_points > 5000";
                    break; 
            }
            
        }
        
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
}

?>