<?php
namespace WisataKu\WisataKuAPI;

class AccessToken {
	
	public function generateAccessToken($user, $base64Value) 
    {
        $token = hash(sha512, time().":".$base64Value);
        //insert to access token db
        
        $sql = "INSERT INTO ws_token
            (token_user, token_value, token_created_date, token_valid_until, valid) VALUES ('$user','$token',CURDATE(),CURDATE()+7,1)";
        
    	$resSql = mysqli_query(Connection::getCon(),$sql);
        
    	return $token;
    }
    
    public function checkAccessToken($base64Value)
    {
        $user = base64_decode($base64Value);
        $user = explode(":", $user);
        
        $token = null;

    	$sql = "SELECT token_user, token_value, token_created_date, token_valid_until, valid from ws_token where token_user = '". $user[0]."' and token_valid_until >= CURDATE() and valid=1";
        
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql))
    	{
    		$token = array(
                "user" => $user[0],
                "token" => $row['token_value'],
                "createdDate" => $row['token_created_date'],
                "validUntil" => $row['token_valid_until']
            );
    	}
                
        if(is_null($token))
        {
            //check username and password
            $userWisataku = null;
            $sql = "SELECT user_username from ws_user where user_username = '".$user[0]."' and user_password = '".md5($user[1])."'";
            $resSql = mysqli_query(Connection::getCon(),$sql);
            if($resSql->num_rows>0) {
                $userWisataku = array(
                    "user" => $user[0]
                );
            }
            
            if(!is_null($userWisataku)) {
                $token = array(
                    "user" => $user[0],
                    "token" => $this->generateAccessToken($user[0], $base64Value),
                    "createdDate" => date("Y-m-d"),
                    "validUntil" => date("Y-m-d", strtotime("+1 day"))
                );
            }
            
        }
        
    	return $token;
    }
    
    public function isValidToken($username, $token) {
                
        $sql = "SELECT token_user, token_value, token_created_date, token_valid_until, valid from ws_token where token_user = '".$username."' and token_value = '".$token."' and token_valid_until >= CURDATE() and valid = 1";
        
        $resSql = mysqli_query(Connection::getCon(),$sql);

        if($resSql->num_rows>0) {
            return true;
        }
                        
        return false;
    }
    
	
}

?>