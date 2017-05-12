<?php
namespace WisataKu\WisataKuAPI;
class Connection {
	static $link;
	
	static function connect(){
		if(self::$link = mysqli_connect("localhost","root","root","jazzleme_wisataku")){
			return self::$link;
		} else {
			die('could not connect to db');
		}
	}
	
	static function getCon()
	{
		return isset(self::$link) ? self::$link : self::connect();
	}
	
	static function closeCon()
	{
		return mysqli_close(self::$link);
	}
}

?>