<?php include '../lib/config.inc.php';?>
<?php
$firstName=$_GET['firstName'];
$state=$_GET['state'];
$city=$_GET['city'];
$contact_no=$_GET['contact_no'];
$email=$_GET['email'];
$time=$_GET['time'];
$message=$_GET['message'];
$country=$_GET['country'];




if(!$contact_no){
	print json_encode(array('status'=>'contact_no is requierd'));
	}
else if(!$firstName){
	print json_encode(array('status'=>'firstName is requierd'));
	}
	else if(!$email){
	print json_encode(array('status'=>'email is requierd'));
	}
	elseif(!$message){
	print json_encode(array('status'=>'message is requierd'));
	}
	elseif(!$time){
	print json_encode(array('status'=>'time is requierd'));
	}
	else{
		
$ry=$PDO->db_query("insert into #_prayer set firstName='".$firstName."',city='".$city."',state='".$state."',contact_no='".$contact_no."',email='".$email."',times='".$time."',message='".$message."',country='".$country."'");

if($ry){
	print json_encode(array('status'=>'success'));
	
} else{
	print json_encode(array('status'=>'please try again'));
	}

}
?>