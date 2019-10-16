<?php

include '../lib/config.inc.php';

$ry=$PDO->db_query("select * from #_bible where status='1' ORDER BY pid DESC");

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

	$array = array('totalRecord'=>$count,'status'=>'success','id'=>$rows['pid'],'name'=>$rows['name']);

			print(json_encode($array)).$coms;

		$num++;} print ']';

}



?>