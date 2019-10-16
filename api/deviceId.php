<?php include '../lib/config.inc.php';?>
<?php
$deviceId=$_GET['deviceId'];
$fcmid=$_GET['fcmid'];

if(!$deviceId){
	print json_encode(array('status'=>'deviceId is requierd'));
	}
else if(!$fcmid){
	print json_encode(array('status'=>'fcmid is requierd'));
	}
	
	else{
$ry=$PDO->db_query("select * from #_device_details where deviceId='".$deviceId."'");	
 $count=$ry->rowCount();

//if(!$count){	
$rys=$PDO->db_query("insert into #_device_details set deviceId='".$deviceId."',fcmid='".$fcmid."'");
//}else{
	//$rys=$PDO->db_query("update #_device_details set deviceId='".$deviceId."',fcmid='".$fcmid."' where deviceId='".$deviceId."'");
	//}
if($rys){
	print json_encode(array('status'=>'success'));
	
} else{
	print json_encode(array('status'=>'please try again'));
	}

}
?>