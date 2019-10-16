<?php

include '../lib/config.inc.php';

$ry=$PDO->db_query("select * from #_gallery where status='1' and subpage_id='0' ORDER BY pid DESC");

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
$totalImages=$PDO->getSingleresult("select count(*) from #_gallery where status='1' and subpage_id='".$rows['pid']."'");
	$array = array('totalImages'=>$totalImages,'status'=>'success','id'=>$rows['pid'],'name'=>$rows['name'],'image'=>$rows['image']);

			print(json_encode($array)).$coms;

		$num++;} print ']';

}



?>