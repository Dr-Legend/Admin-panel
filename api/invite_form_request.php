<?php include '../lib/config.inc.php';?>
<?php
$name=$_GET['name'];
$email=$_GET['email'];
$address=$_GET['address'];
$contact_no=$_GET['contact_no'];
$country=$_GET['country'];
$state=$_GET['state'];
$city=$_GET['city'];
$zipcode=$_GET['zipcode'];
$website=$_GET['website'];
$contactPerson=$_GET['contactPerson'];
$contactPersonphone=$_GET['contactPersonphone'];
$overseer=$_GET['overseer'];
$eventTitle=$_GET['eventTitle'];
$eventTheme=$_GET['eventTheme'];
$dateOfevent=$_GET['dateOfevent'];
$estimatedAttendance=$_GET['estimatedAttendance'];

if(!$name){
	print json_encode(array('status'=>'name is requierd'));
	}
else if(!$email){
	print json_encode(array('status'=>'email is requierd'));
	}
	else if(!$address){
	print json_encode(array('status'=>'address is requierd'));
	}
	elseif(!$contact_no){
	print json_encode(array('status'=>'contact_no is requierd'));
	}
	elseif(!$country){
	print json_encode(array('status'=>'country is requierd'));
	}
	elseif(!$state){
	print json_encode(array('status'=>'state is requierd'));
	}
	elseif(!$city){
	print json_encode(array('status'=>'city is requierd'));
	}
	elseif(!$zipcode){
	print json_encode(array('status'=>'zipcode is requierd'));
	}
	elseif(!$website){
	print json_encode(array('status'=>'website is requierd'));
	}
	elseif(!$contactPerson){
	print json_encode(array('status'=>'contactPerson is requierd'));
	}
	elseif(!$contactPersonphone){
	print json_encode(array('status'=>'contactPersonphone is requierd'));
	}
	elseif(!$overseer){
	print json_encode(array('status'=>'overseer is requierd'));
	}
	elseif(!$eventTitle){
	print json_encode(array('status'=>'eventTitle is requierd'));
	}
	elseif(!$eventTheme){
	print json_encode(array('status'=>'eventTheme is requierd'));
	}
	elseif(!$dateOfevent){
	print json_encode(array('status'=>'dateOfevent is requierd'));
	}
	elseif(!$estimatedAttendance){
	print json_encode(array('status'=>'estimatedAttendance is requierd'));
	}
	else{
		
$ry=$PDO->db_query("insert into #_invite set name='".$name."',email='".$email."',address='".$address."',contact_no='".$contact_no."',country='".$country."',state='".$state."',city='".$city."',zipcode='".$zipcode."',website='".$website."',contactPerson='".$contactPerson."',contactPersonphone='".$contactPersonphone."',overseer='".$overseer."',eventTitle='".$eventTitle."',eventTheme='".$eventTheme."',dateOfevent='".$dateOfevent."',estimatedAttendance='".$estimatedAttendance."'");

if($ry){
	print json_encode(array('status'=>'success'));
	
} else{
	print json_encode(array('status'=>'please try again'));
	}

}
?>