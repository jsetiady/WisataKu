<?php
namespace WisataKu\WisataKuAPI;

class DB {
    var $link;
    
    function connect() {
        $this->link = mysqli_connect("localhost", "root", "root", "jazzleme_wisataku");
        
        if (!$this->link) {
            die('Could not connect: ' . mysql_error());
        }

    }
    
    function closeConnection() {
         mysqli_close($this->link);
    }
}