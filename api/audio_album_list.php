<?php

include '../lib/config.inc.php';

if(isset($_GET['year'])){
	$ry=$PDO->db_query("select * from #_audio_album where status='1' and YEAR(albumDate)='".$_GET['year']."'  ORDER BY pid DESC");
if(isset($_GET['month'])){	
$ry=$PDO->db_query("select * from #_audio_album where status='1' and YEAR(albumDate)='".$_GET['year']."' and MONTH(albumDate)='".$_GET['month']."'  ORDER BY pid DESC");
 }

}else{
$ry=$PDO->db_query("select * from #_audio_album where status='1' ORDER BY pid DESC");
}
 $count=$ry->rowCount();

if(!$count){

	print json_encode(array('status'=>'no data found.'));

	

} else {
//echo '<pre>';
	$rows = array();


	 print'[';

	 $coms=',';

	 $num=1;

	

	

	while($rows=$PDO->db_fetch_array($ry)){

			 if($num==$count){$coms='';}
$totalRecord=$PDO->getSingleresult("select count(*) from #_track_list where status='1' and subpage_id='".$rows['pid']."'");
	$array = array('totalRecord'=>$totalRecord,'status'=>'success','id'=>$rows['pid'],'name'=>$rows['name'],'image'=>$rows['image'],'albumDate'=>$rows['albumDate']);

			print(json_encode($array)).$coms;

		$num++;} print ']';

}



?>