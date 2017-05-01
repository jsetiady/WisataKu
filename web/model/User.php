<?php

class User {
	public $userid;
	public $username;
	public $password;
	public $isAdmin;
	public $name;
	
	public function __construct($userid, $username, $password,$isAdmin,$name)  
    {  
        $this->userid = $userid;
	    $this->username = $username;
	    $this->password = $password;
	    $this->isAdmin = $isAdmin;
	    $this->name = $isAdmin;
    }

    public function __construct($userid, $username,$name)  
    {  
        $this->userid = $userid;
	    $this->username = $username;
	    $this->name = $isAdmin;
    }
}

?>