<?php

include '../lib/config.inc.php';

$ry=$PDO->db_query("select * from #_chapters where status='1' and bible_id='".$_GET['bible_id']."' ORDER BY pid DESC");

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

	$array = array('status'=>'success','blibleName'=>$PDO->getSingleresult("select name from #_bible where pid='".$bible_id."'"),'chapter'=>$rows['name'],'paragraph'=>$rows['paragraph'],'content'=>trim(strip_tags($rows['body'])));

			print(json_encode($array,JSON_UNESCAPED_UNICODE)).$coms;

		$num++;} print ']';

}


?>