<?php include '../lib/config.inc.php';?>
<?php
$firstName=$_GET['firstName'];
$middleName=$_GET['middleName'];
$lastName=$_GET['lastName'];
$contact_no=$_GET['contact_no'];
$email=$_GET['email'];
$address=$_GET['address'];
$amount=$_GET['amount'];
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
	elseif(!$amount){
	print json_encode(array('status'=>'amount is requierd'));
	}
	elseif(!$country){
	print json_encode(array('status'=>'country is requierd'));
	}
	else{
		
$ry=$PDO->db_query("insert into #_fire_form set firstName='".$firstName."',middleName='".$middleName."',lastName='".$lastName."',contact_no='".$contact_no."',email='".$email."',address='".$address."',amount='".$amount."',country='".$country."'");

if($ry){
	print json_encode(array('status'=>'success'));
	
} else{
	print json_encode(array('status'=>'please try again'));
	}

}
?>