<?php
namespace WisataKu\WisataKuAPI;
include_once("User.php");

class UserModel {

	public function validateUser($username,$password)
    {
    	$user = null;

    	$sql = "SELECT user_id,user_username,user_name,user_isAdmin
                from ws_user
                where user_username = '".$username."'
                and user_password = '".md5($password)."'";
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		$user = User::create()
    				->setUserId($row['user_id'])
    				->setUsername($row['user_username'])
    				->setName($row['user_name']);
    	}

    	return $user;
    }

    public function validateUserAdmin($username,$password)
    {
        $user = null;

        $sql = "SELECT user_id,user_username,user_name,user_isAdmin
                from ws_user
                where user_username = '".$username."'
                and user_password = '".md5($password)."'
                and user_isAdmin = 'Y'";
        $resSql = mysqli_query(Connection::getCon(),$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
        	$user = User::create()
	        	->setUserId($row['user_id'])
	        	->setUsername($row['user_username'])
	        	->setName($row['user_name']);
        }

        return $user;
    }

    public function getUserByUserId($userId)
    {
    	$user = null;

        $sql = "SELECT user_id,user_username,user_name,user_isAdmin
                from ws_user
                where user_id = '".$userId."'";
        $resSql = mysqli_query(Connection::getCon(),$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
        	$user = User::create()
	        	->setUserId($row['user_id'])
	        	->setUsername($row['user_username'])
	        	->setName($row['user_name']);
        }

        return $user;
    }
    
    public function getUserByUserName($userName)
    {
    	$user = null;

        $sql = "SELECT user_id,user_username,user_name,user_isAdmin
                from ws_user
                where user_username = '".$userName."'";
        $resSql = mysqli_query(Connection::getCon(),$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
        	$user = User::create()
	        	->setUserId($row['user_id'])
	        	->setUsername($row['user_username'])
	        	->setName($row['user_name']);
        }

        return $user;
    }
	
}

?>