<?php

class Connection {
	public $link;

	public function __construct()  
    {  
       	$this->link = mysqli_connect("localhost","root","","jazzleme_wisataku") or die("Couldn't connect");
    }
}

?>