<?php

include '../lib/config.inc.php';


if(isset($_GET['year'])){
	$ry=$PDO->db_query("select * from #_discussions where status='1' and YEAR(discussionDate)='".$_GET['year']."'  ORDER BY pid DESC");
if(isset($_GET['month'])){	
$ry=$PDO->db_query("select * from #_discussions where status='1' and YEAR(discussionDate)='".$_GET['year']."' and MONTH(discussionDate)='".$_GET['month']."'  ORDER BY pid DESC");
 }

}else{
$ry=$PDO->db_query("select * from #_discussions where status='1' ORDER BY pid DESC");
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

	$array = array('totalRecord'=>$count,'status'=>'success','id'=>$rows['pid'],'name'=>$rows['name'],'image'=>$rows['image'],'discussionDate'=>$rows['discussionDate'],'content'=>trim(strip_tags($rows['body'])));

			print(json_encode($array)).$coms;

		$num++;} print ']';

}



?>