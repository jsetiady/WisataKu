<?php

require_once("config/Connection.php");
include_once("model/User.php");

class UserModel {

	public function validateUser($username,$password)
    {
    	$user = null;

    	$sql = "SELECT user_id,user_username,user_name,user_isAdmin
                from ws_user
                where user_username = '".$username."'
                and user_password = '".md5($password)."'";
    	$resSql = mysqli_query($con,$sql);

    	while($row = mysqli_fetch_assoc($resSql)) {
    		$user = new User($row['user_id'],$row['user_username'],$row['user_name']);
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
        $resSql = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
            $user = new User($row['user_id'],$row['user_username'],$row['user_name']);
        }

        return $user;
    }

    public function getUserByUserId($userId)
    {
    	$user = null;

        $sql = "SELECT user_id,user_username,user_name,user_isAdmin
                from ws_user
                where user_id = '".$userId."'";
        $resSql = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($resSql)) {
            $user = new User($row['user_id'],$row['user_username'],$row['user_name']);
        }

        return $user;
    }
	
}

?>