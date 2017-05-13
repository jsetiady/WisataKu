<?php
namespace WisataKu\WisataKuAPI;

class AccessToken {
	
	public function generateAccessToken($base64Value) 
    {
    	return "1234";
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
        
        if($token==null) {
            //check username and password
            
            
            
            //if valid, generate token
            
        }
        
    	return $token;
    }
    
	
}

?>