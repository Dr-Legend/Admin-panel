<?php
class Pages extends dbc

{

	

	 public function  add($data)

	 {

		    @extract($data);

	        $query=parent::db_query("select * from #_".tblName." where pid ='".$pid."' and subpage_id='".$subpage_id."' "); 

	        if($query->rowCount()==0)

	        {

			

				$data['created_on']=date('Y-m-d H:i:s');

				$data['create_by']=$_SESSION["AMD"][0];

				$data['shortorder']=parent::getSingleresult("select max(shortorder) as shortorder from #_".tblName." where 1=1 ")+1;

				parent::sqlquery("rs",tblName,$data);
				$ry=parent::db_query("select * from #_device_details where 1");
	while($rows=parent::db_fetch_array($ry)){
		//$names=parent::getSingleresult("select name  from #_".tblName." where pid='".$data['subpage_id']."' ");
		
		parent::pushnoti($rows['fcmid'],$data['name'], 'New Track Added!');
	}

		        parent::sessset('Record has been added', 's');

	            $flag =1;

		    }else {

			    parent::sessset('Record has already added', 'e');

				$flag =0;

			}

			

			return $flag; 

	 }

	 

	 public function  update($data)

	 {
		   @extract($data);
	     
				 $data['modified_on']=date('Y-m-d H:i:s');
			     parent::sqlquery("rs",tblName,$data,'pid',$updateid);
		         parent::sessset('Record has been updated', 's');
	             $flag =1;
			
			return $flag;  
		 
	 }

	 

	 public function  delete($updateid)

	 {

		   if(is_array($updateid))

		   {

			   $updateid=implode(',',$updateid);

		   }

		   

		   $delete_mp3=parent::getSingleresult("select image from #_".tblName." where pid='".$updateid."'");

		   if($delete_mp3!='')

		   {
				 @unlink(UP_FILES_FS_PATH."/track_list/".$delete_mp3);
		   }
 $delete_img=parent::getSingleresult("select poster from #_".tblName." where pid='".$updateid."'");

		   if($delete_img!='')
		   {
				 @unlink(UP_FILES_FS_PATH."/track_list/".$delete_img);

				 @unlink(UP_FILES_FS_PATH."/track_list/thumb/".$delete_img);
		   }

		   

		    parent::db_query("delete from #_".tblName." where pid in ($updateid)");

		   

		   

	 }

	 

	 public function status($updateid,$status)

	 {

		   if(is_array($updateid))

		   {

			   $updateid=implode(',',$updateid);

		   }

		   

		   parent::db_query("update  #_".tblName." set status='".$status."' where pid in ($updateid)");

		   

	 }

	 

	  

	 

	 public function  display($start,$pagesize,$fld,$otype,$search_data,$zone,$mtype,$extra,$extra1,$extra2)

	 {

		$start = intval($start); 

	   	$columns = "select * "; 

		

		if(trim($search_data)!='')

		{

		   $wh=" and (name like '%".$search_data."%' or pid like '%".$search_data."%') ";	

		}

		

		$sql = " from #_".tblName." where 1 ".$zone.$mtype.$extra.$extra1.$extra2.$wh;

		$order_by == '' ? $order_by = (($ord)?'orders':(($fld)?$fld:'shortorder')) : true;

        $order_by2 == '' ? $order_by2 = (($otype)?$otype:'DESC') : true;

		$sql_count = "select count(*) ".$sql; 

		$sql .= "order by $order_by $order_by2 ";

		$sql .= "limit $start, $pagesize ";

		$sql = $columns.$sql;

		$result = parent::db_query($sql);

		$reccnt = parent::db_scalar($sql_count);

		return array($result,$reccnt);

	 }

	  

	 

	

}

















?>