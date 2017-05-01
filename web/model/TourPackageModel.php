<?php

require_once("config/Connection.php");
include_once("model/User.php");
include_once("model/Location.php");
include_once("model/TourItineraryModel.php");

class TourPackageModel {

	public function getAllTourPackages()
    {
        $allTourPackages = array();

        $sql = "SELECT tour_id,tour_name,tour_desc,tour_min_person,tour_max_person,tour_start_date,tour_end_date,
                    tour_duration,tour_type,tour_tc,tour_price,tour_points,tour_created_date,
                    tour_loc_id,tour_user_admin_id,tour_image_filename,loc_name,user_username,user_name
                from ws_tour,ws_user,ws_location
                where tour_loc_id = loc_id
                and tour_user_admin_id = user_id";
        $resSql = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
            array_push($allTourPackages, new TourPackage($row['tour_id'],
                $row['tour_name'],$row['tour_desc']),$row['tour_min_person'],$row['tour_max_person'],
                $row['tour_start_date'],$row['tour_end_date'],$row['tour_duration'],$row['tour_type'],
                $row['tour_tc'],$row['tour_price'],$row['tour_points'],$row['tour_created_date'],
                new Location($row['tour_loc_id'],$row['loc_name']),new User($row['tour_user_admin_id'],
                $row['user_username'],$row['user_name']),$row['tour_image_filename'],
                $this->getAllTourItineraryByTourId($row['tour_id']));
        }
        return $allTourPackages;
    }

    public function getTourPackageByTourId($tourId)
    {
        $tourPackage = nulll;

        $sql = "SELECT tour_id,tour_name,tour_desc,tour_min_person,tour_max_person,tour_start_date,tour_end_date,
                    tour_duration,tour_type,tour_tc,tour_price,tour_points,tour_created_date,
                    tour_loc_id,tour_user_admin_id,tour_image_filename,loc_name,user_username,user_name
                from ws_tour,ws_user,ws_location
                where tour_loc_id = loc_id
                and tour_user_admin_id = user_id
                and tour_id = ".$tourId;
        $resSql = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
            $tourPackage = new TourPackage($allTourPackages, new TourPackage($row['tour_id'],
                $row['tour_name'],$row['tour_desc']),$row['tour_min_person'],$row['tour_max_person'],
                $row['tour_start_date'],$row['tour_end_date'],$row['tour_duration'],$row['tour_type'],
                $row['tour_tc'],$row['tour_price'],$row['tour_points'],$row['tour_created_date'],
                new Location($row['tour_loc_id'],$row['loc_name']),new User($row['tour_user_admin_id'],
                $row['user_username'],$row['user_name']),$row['tour_image_filename'],
                $this->getAllTourItineraryByTourId($row['tour_id']));
        }

        return $tourPackage;
    }
}

?>