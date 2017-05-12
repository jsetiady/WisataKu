<?php
namespace WisataKu\WisataKuAPI;
require_once "DB.php";

class LocationModel {
    
    var $db;
    
    public function __construct() {
        $this->db = new DB();
    }
    
    public function getLocations() {
        $this->db->connect();
        
        $query = "SELECT loc_id, loc_name from ws_location";

        if ($stmt = mysqli_prepare($this->db->link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $locId, $locName);
            $data = array();
            while (mysqli_stmt_fetch($stmt)) {
                array_push($data,
                    array(
                        "id" => $locId,
                        "name" => $locName
                    )
                );
            }
            mysqli_stmt_close($stmt);
        }
        
        $this->db->closeConnection();
        return $data;
    }
}