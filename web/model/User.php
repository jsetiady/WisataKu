<?php

class User {
	private $userId;
	private $username;
	private $password;
	private $isAdmin;
	private $name;
	
// 	public function __construct($userId, $username, $password,$isAdmin,$name)  
//     {  
//         $this->userId = $userId;
// 	    $this->username = $username;
// 	    $this->password = $password;
// 	    $this->isAdmin = $isAdmin;
// 	    $this->name = $isAdmin;
//     }

	public function __construct()
	{}

    public static function create()
    {
    	$instance = new self();
    	return $instance;
    }

    public function setUserId($userId)
    {
    	$this->userId = $userId;
    	return $this;
    }

    public function setUsername($username)
    {
    	$this->username = $username;
    	return $this;
    }

    public function setPassword($password)
    {
    	$this->password = $password;
    	return $this;
    }

    public function setIsAdmin($isAdmin)
    {
    	$this->isAdmin = $isAdmin;
    	return $this;
    }

    public function setName($name)
    {
    	$this->name = $name;
    	return $this;
    }

    public function getUserId() 
    {
    	return $this->userId;
    }

    public function getUserName()
    {
    	return $this->username;
    }

    public function getPassword()
    {
    	return $this->password;
    }

    public function getIsAdmin()
    {
    	return $this->isAdmin;
    }

    public function getName()
    {
    	return $this->name;
    }

}

?>