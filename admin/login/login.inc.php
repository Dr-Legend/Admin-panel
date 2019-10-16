<?php

class LoginUser extends dbc
{
	
	 public function  login($data)
	 {
		 //print_r($data);
		    @extract($data);
			//echo $data['password'];
			$password=$this->password($data['password']);
			
			if(str_replace('www.','',$_SERVER['HTTP_HOST']) =='formalfunky.com')
			{
			  $ww =" and live_user='1' ";	
			}
			
			$query=parent::db_query("select * from ".tb_Prefix."admin_users where email ='".$email."' and password ='".$password."' and status='1' ".$ww); 
			//echo $query->rowCount();
			//exit;
			if($query->rowCount()==1)
	        {
				$row = parent::db_fetch_array($query);
				$_SESSION["AMD"][0] =$row['user_id'];
				$_SESSION["AMD"][1] =$row['name'];
				$_SESSION["AMD"][2] =$row['email'];
				$_SESSION["AMD"][3] =$row['user_type'];
				$flag =1;
		    }else {
			    parent::sessset('Email and password is incorrect.', 'e');
				$flag =0;
			}
			
			return $flag; 
	 }
	 
	 public function password($password)
	 {
	        $password=md5($password); 
		    $password=base64_encode($password); 	
		    return $password;
	 }
}
?>