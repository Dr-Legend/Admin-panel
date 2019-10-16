<?php 

include("../../lib/config.inc.php");

if($tbl)
{
	  if($flag=='modelorder')
	  {
		    //print_r($_POST);
			$or=($start)?$start+1:1;
			for($i=0;$i< count($recordsArray);$i++)
	        {
				
				 $PDO->db_query("update #_".$tbl." set modelorder = '".$or."' where ".$field." ='".$recordsArray[$i]."'"); 
				 $or++;  
	        }	  
		  
	  }else {
	  
	
	
	  for($i=0,$or=count($recordsArray);$i< count($recordsArray);$i++)
	  {
		// echo "update #_".$tbl." set shortorder = '".$or."' where ".$field." ='".$recordsArray[$i]."'";
		 $PDO->db_query("update #_".$tbl." set shortorder = '".$or."' where ".$field." ='".$recordsArray[$i]."'"); 
		 $or--;  
	  }
	  
	  }
}

