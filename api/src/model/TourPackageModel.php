<?php
namespace WisataKu\WisataKuAPI;
require_once "DB.php";

class TourPackageModel {
    
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    
    public function getTourPackages() {
        $this->db->connect();
        
        $query = "SELECT
                    tour_id,
                    tour_name,
                    tour_desc,
                    tour_min_person,
                    tour_max_person,
                    tour_start_date,
                    tour_end_date,
                    tour_duration,
                    tour_type,
                    tour_points,
                    tour_created_date,
                    tour_loc_id,
                    tour_image_filename
                FROM ws_tour";

        if ($stmt = mysqli_prepare($this->db->link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $tourId, $tourName, $tourDesc, $tourMinPerson, $tourMaxPerson, $tourStartDate, $tourEndDate, $tourDuration, $tourType, $tourPoints, $tourCreatedDate, $tourLocId, $tourImageFileName);
            $data = array();
            while (mysqli_stmt_fetch($stmt)) {
                array_push($data,
                    array(
                        "tourId" => $tourId,
                        "tourName" => $tourName,
                        "tour_desc" => $tourDesc,
                        "tour_min_person" => $tourMinPerson,
                        "tour_max_person" => $tourMaxPerson,
                        "tour_start_date" => $tourStartDate,
                        "tour_end_date" => $tourEndDate,
                        "tour_duration" => $tourDuration,
                        "tour_type" => $tourType,
                        "tour_points" => $tourPoints,
                        "tour_created_date" => $tourCreatedDate,
                        "tour_loc_id" => $tourLocId,
                        "tour_image_filename" => $tourImageFilename
                    )
                );
            }
            mysqli_stmt_close($stmt);
        }
        
        $this->db->closeConnection();
        return $data;
    }
}