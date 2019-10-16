<?php

include '../lib/config.inc.php';

if(isset($_GET['year'])){
	$ry=$PDO->db_query("select * from #_youtube_video where status='1' and YEAR(videoDate)='".$_GET['year']."' and category_id='".$_GET['category_id']."'  ORDER BY pid DESC");
if(isset($_GET['month'])){	
$ry=$PDO->db_query("select * from #_youtube_video where status='1' and YEAR(videoDate)='".$_GET['year']."' and MONTH(videoDate)='".$_GET['month']."' and category_id='".$_GET['category_id']."'  ORDER BY pid DESC");
 }

}else{
$ry=$PDO->db_query("select * from #_youtube_video where status='1' and category_id='".$_GET['category_id']."' ORDER BY pid DESC");
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
$categoryName=$PDO->getSingleresult("select name from #_category where pid='".$rows['category_id']."'");
	$array = array('totalRecord'=>$count,'status'=>'success','id'=>$rows['pid'],'name'=>$rows['name'],'youtubevideoid'=>$rows['youtubevideoid'],'thumbnail'=>$rows['image'],'videoDate'=>$rows['videoDate'],'categoryName'=>$categoryName);

			print(json_encode($array)).$coms;

		$num++;} print ']';

}



?>