<?php 
include("../../lib/config.inc.php");
include('excelwriter.inc.php');
if($_GET['stags']=="products")
{
	   
	    $filepath = $_GET['stags'].@date("Ymd").".xls";
       
	    $excel=new ExcelWriter($filepath);
        
		if($excel==false) {	echo $excel->error;	}
	   
	   
	    $wh =" 1=1 ";
        if($pp_id)
        {
           $wh .=" and  pp_id in(".$pp_id.") ";  	
        }

		if($brand)
		{
		  $wh .=" and  brand_id ='".$brand."' ";  	
		}
		
		if($series)
		{
		  $wh .=" and  series_id = '".$series."' ";  	
		}
		
		if($model)
		{
		  $wh .=" and  model_id = '".$model."' ";  	
		}
		
		if($designer)
		{
		  $wh .=" and  design_id = '".$designer."' ";  		
		}
		
		if($die_types)
		{
		  $wh .=" and  designtype = '".$die_types."' ";  		
		}
		
		$special_id=array();
		$detail_id=array();
		
		if($color)
		{
		   $color_query=$PDO->db_query("select DL.pid as pid  from #_dies as D INNER JOIN #_die_details as DL ON DL.die_id=D.die_id where DL.color='".$color."' and D.model_id='".$model."'");
		   
		   
		   while($color_rows  = $PDO->db_fetch_array($color_query))
		   {
			  $detail_id[].=$color_rows['pid'];
		   }
		   
		  
			
		}
		
		
		
		if($special_categorys)
		{
		   $color_query=$PDO->db_query("select DL.pid as pid  from #_dies as D INNER JOIN #_die_details as DL ON DL.die_id=D.die_id where DL.special_category='".$special_categorys."' and D.model_id='".$model."'");
		   
		   
		   while($color_rows  = $PDO->db_fetch_array($color_query))
		   {
			  $special_id[] =$color_rows['pid'];
		   }
		}
		
		$result = array_intersect($detail_id, $special_id);
		
		if(!empty($result))
		{
		  $wh .=" and detail_id in (". implode(',',$result) .")";	
		}
		
		
		
		
		//print_r($_POST);
		
		//echo "select * from #_products where ".$wh; exit;
		$prd_query=$PDO->db_query("select * from #_products where ".$wh);
        $i=0;
		
		$myArr=array("Product Name", "SKU Code", "Brand", "Series", "Model", "MRP", "OfferPrice", "QTY", "Color", "Spacial Category", "Die Type","Tag Line ", "Image description","product description", "Image Url", "Product name for market base");
$excel->writeLine($myArr);
$contents = "Product Name , SKU Code, Brand, Series, Model, MRP, OfferPrice, QTY, Color, Spacial Category, Die Type, Tag Line , Image description, product description, Image Url, Product name for market base\n";
		
		
		
        while($prd_rows  = $PDO->db_fetch_array($prd_query))
        {
			
			$brand_name =$PDO->getSingleresult("select name  from  #_brands  where brand_id ='".$prd_rows['brand_id']."' ");
		
		    $series_name =$PDO->getSingleresult("select series_name  from  #_series  where sid ='".$prd_rows['series_id']."' ");
		
		    $model_name =$PDO->getSingleresult("select model_name  from  #_models  where model_id ='".$prd_rows['model_id']."' ");
					
			$die_type_name =$PDO->getSingleresult("select type_name  from  #_die_types  where dt_id ='".$prd_rows['designtype']."' ");
			
			$die_query=$PDO->db_query("select * from #_dies where die_id='".$prd_rows['die_id']."' ");
			$die_rows  = $PDO->db_fetch_array($die_query);
			
			
			$quantity=$die_rows['quantity'];
			
			$color='';
			$speciel_category='';
			
			
			
			if($prd_rows['detail_id'])
			{
				
				$detail_query=$PDO->db_query("select * from #_die_details where die_id='".$prd_rows['die_id']."' and pid='".$prd_rows['detail_id']."' ");
			    $detail_rows  = $PDO->db_fetch_array($detail_query);
				$quantity=$detail_rows['quantity'];
				
				 $color=$PDO->getSingleresult("select color_name from #_colors where color_id='".$detail_rows['color']."' ");
				
				 $speciel_category=$PDO->getSingleresult("select category_name from #_special_categorys where spc_id='".$detail_rows['special_category']."' ");
			}
			
			
			$printimg_query = $PDO->db_query("select *  from  #_print_images  where img_id ='".$prd_rows['design_id']."' ");
		    $printimg_rows = $PDO->db_fetch_array($printimg_query);
			
			$printimg_rows['tag_line'];
			
			$image_description=$printimg_rows['description'];
			
			
			 $die_type_desc = $PDO->getSingleResult("select description from #_die_types where status ='1' and dt_id='".$die_rows['die_type']."' ");
			 $materials_desc = $PDO->getSingleResult("select description from #_categorys where status ='1' and cat_id='".$die_rows['category_id']."' ");
			 $sub_materials_desc = $PDO->getSingleResult("select description from #_categorys where status ='1' and cat_id='".$die_rows['sub_category_id']."' ");
			 $special_category_desc = $PDO->getSingleResult("select description from #_special_categorys where status ='1' and spc_id='".$detail_rows['special_category']."' ");
			 
			 
			$product_description =(($die_type_desc)?$die_type_desc.'<br>':'').(($materials_desc)?$materials_desc.' '.$prd_rows['product_name'].'<br>':'').(($sub_materials_desc)?$sub_materials_desc.'<br>':'').(($special_category_desc)?$special_category_desc.'<br>':'');
			
			
			$prd_arr =explode('.png',$prd_rows['image2']);
				
			
		    $excel->writeRow();	
			$excel->writeCol($PDO->parse_output($prd_rows['product_name']));
			$excel->writeCol($prd_rows['product_code']);
			$excel->writeCol($brand_name);
			$excel->writeCol($series_name);
			$excel->writeCol($model_name);
			$excel->writeCol($prd_rows['price']);
			$excel->writeCol($prd_rows['offer_price']);
			$excel->writeCol($quantity);
			$excel->writeCol($color);
			$excel->writeCol($speciel_category);
			$excel->writeCol($die_type_name);
			$excel->writeCol($printimg_rows['tag_line']);
			$excel->writeCol($PDO->parse_output($image_description));
			$excel->writeCol( $PDO->parse_output($product_description));
			$excel->writeCol(SITE_PATH.'uploaded_files/product/'.$prd_rows['image2']);
			$excel->writeCol($prd_arr[0]);
		}
		$excel->close();
   


/// Product Invantory
}else if($_GET['stags']=="products_inventory") {
	   
	    $filepath = $_GET['stags'].@date("Ymd").".xls";
       
	    $excel=new ExcelWriter($filepath);
        
		if($excel==false) {	echo $excel->error;	}
	   
	   
	    $wh =" 1=1 ";
        if($pp_id)
        {
           $wh .=" and  pp_id in(".$pp_id.") ";  	
        }

		if($brand)
		{
		  $wh .=" and  brand_id ='".$brand."' ";  	
		}
		
		if($series)
		{
		  $wh .=" and  series_id = '".$series."' ";  	
		}
		
		if($model)
		{
		  $wh .=" and  model_id = '".$model."' ";  	
		}
		
		if($designer)
		{
		  $wh .=" and  design_id = '".$designer."' ";  		
		}
		
		if($die_types)
		{
		  $wh .=" and  designtype = '".$die_types."' ";  		
		}
		
		$special_id=array();
		$detail_id=array();
		
		if($color)
		{
		   $color_query=$PDO->db_query("select DL.pid as pid  from #_dies as D INNER JOIN #_die_details as DL ON DL.die_id=D.die_id where DL.color='".$color."' and D.model_id='".$model."'");
		   
		   
		   while($color_rows  = $PDO->db_fetch_array($color_query))
		   {
			  $detail_id[].=$color_rows['pid'];
		   }
		   
		  
			
		}
		
		
		
		if($special_categorys)
		{
		   $color_query=$PDO->db_query("select DL.pid as pid  from #_dies as D INNER JOIN #_die_details as DL ON DL.die_id=D.die_id where DL.special_category='".$special_categorys."' and D.model_id='".$model."'");
		   
		   
		   while($color_rows  = $PDO->db_fetch_array($color_query))
		   {
			  $special_id[] =$color_rows['pid'];
		   }
		}
		
		$result = array_intersect($detail_id, $special_id);
		
		if(!empty($result))
		{
		  $wh .=" and detail_id in (". implode(',',$result) .")";	
		}
		
		
		
		
		//print_r($_POST);
		
		//echo "select * from #_products where ".$wh; exit;
		$prd_query=$PDO->db_query("select * from #_products where ".$wh);
        $i=0;
		
		$myArr=array("PRODUCT NAME", "SKU CODE", "BRAND", "SERIES", "MODEL",  "COLOR", "SPACIAL CATEGORY", "DIE TYPE", "MRP", "OFFER PRICE", "INVENTORY", "ADD NEW INVENTORY", "STATUS");
$excel->writeLine($myArr);
$contents = "PRODUCT NAME, SKU CODE, BRAND, SERIES, MODEL, COLOR, SPACIEL CATEGORY, DIE TYPE ,MRP, OFFER PRICE, INVENTORY, ADD NEW INVENTORY, STATUS\n";
		
		
		
        while($prd_rows  = $PDO->db_fetch_array($prd_query))
        {
			
			$brand_name =$PDO->getSingleresult("select name  from  #_brands  where brand_id ='".$prd_rows['brand_id']."' ");
		
		    $series_name =$PDO->getSingleresult("select series_name  from  #_series  where sid ='".$prd_rows['series_id']."' ");
		
		    $model_name =$PDO->getSingleresult("select model_name  from  #_models  where model_id ='".$prd_rows['model_id']."' ");
					
			$die_type_name =$PDO->getSingleresult("select type_name  from  #_die_types  where dt_id ='".$prd_rows['designtype']."' ");
			
			$die_query=$PDO->db_query("select * from #_dies where die_id='".$prd_rows['die_id']."' ");
			$die_rows  = $PDO->db_fetch_array($die_query);
			
			
			$quantity=$die_rows['quantity'];
			
			$color='';
			$speciel_category='';
			
			
			
			if($prd_rows['detail_id'])
			{
				
				$detail_query=$PDO->db_query("select * from #_die_details where die_id='".$prd_rows['die_id']."' and pid='".$prd_rows['detail_id']."' ");
			    $detail_rows  = $PDO->db_fetch_array($detail_query);
				$quantity=$detail_rows['quantity'];
				
				 $color=$PDO->getSingleresult("select color_name from #_colors where color_id='".$detail_rows['color']."' ");
				
				 $speciel_category=$PDO->getSingleresult("select category_name from #_special_categorys where spc_id='".$detail_rows['special_category']."' ");
			}
			
			
			$printimg_query = $PDO->db_query("select *  from  #_print_images  where img_id ='".$prd_rows['design_id']."' ");
		    $printimg_rows = $PDO->db_fetch_array($printimg_query);
			
			$printimg_rows['tag_line'];
			
			$image_description=$printimg_rows['description'];
			
			
			 $die_type_desc = $PDO->getSingleResult("select description from #_die_types where status ='1' and dt_id='".$die_rows['die_type']."' ");
			 $materials_desc = $PDO->getSingleResult("select description from #_categorys where status ='1' and cat_id='".$die_rows['category_id']."' ");
			 $sub_materials_desc = $PDO->getSingleResult("select description from #_categorys where status ='1' and cat_id='".$die_rows['sub_category_id']."' ");
			 $special_category_desc = $PDO->getSingleResult("select description from #_special_categorys where status ='1' and spc_id='".$detail_rows['special_category']."' ");
			 
			 
			$product_description =(($die_type_desc)?$die_type_desc.'<br>':'').(($materials_desc)?$materials_desc.' '.$prd_rows['product_name'].'<br>':'').(($sub_materials_desc)?$sub_materials_desc.'<br>':'').(($special_category_desc)?$special_category_desc.'<br>':'');
			
			
			$prd_arr =explode('.png',$prd_rows['image2']);
			
			$status =($prd_rows['status']==1)?'Active':'Inactive';
				
			
		    $excel->writeRow();	
			$excel->writeCol($PDO->parse_output($prd_rows['product_name']));
			$excel->writeCol($prd_rows['product_code']);
			$excel->writeCol($brand_name);
			$excel->writeCol($series_name);
			$excel->writeCol($model_name);
			$excel->writeCol($color);
			$excel->writeCol($speciel_category);
			$excel->writeCol($die_type_name);
			$excel->writeCol($prd_rows['price']);
			$excel->writeCol($prd_rows['offer_price']);
			$excel->writeCol($quantity);
			$excel->writeCol('');
			$excel->writeCol($status);
		}
		$excel->close();
   
 /// Product Invantory
}else if($_GET['stags']=="die_inventory") {
	
   $filepath = $_GET['stags'].@date("Ymd").".xls";
       
   $excel=new ExcelWriter($filepath);
        
   if($excel==false) {	echo $excel->error;	}
	
  
  $myArr=array("DIE NAME", 	 "BRAND", "SERIES", "MODEL",  "DIE TYPE",  "MATERIALS", "SUB  MATERIALS", "COLOR", "SPACIAL CATEGORY", "INVENTORY", "ADD NEW INVENTORY", "STATUS","DIE ID", "DETAIL ID");
$excel->writeLine($myArr);
  $contents = "PRODUCT NAME, SKU CODE, BRAND, SERIES, MODEL, DIE TYPE, MATERIALS, SUB  MATERIALS,COLOR, SPACIEL CATEGORY,  INVENTORY, ADD NEW INVENTORY, STATUS,DIE ID,DETAIL ID\n";
		
  
  
  $die_query=$PDO->db_query("select * from #_dies  where 1=1 ");
  while($die_rows = $PDO->db_fetch_array($die_query))
  {
	  
	    $brand_name =$PDO->getSingleresult("select name  from  #_brands  where brand_id ='".$die_rows['brand_id']."' ");
		
		$series_name =$PDO->getSingleresult("select series_name  from  #_series  where sid ='".$die_rows['series_id']."' ");
		
		$model_name =$PDO->getSingleresult("select model_name  from  #_models  where model_id ='".$die_rows['model_id']."' ");
		
		$die_type_name =$PDO->getSingleresult("select type_name  from  #_die_types  where dt_id ='".$die_rows['die_type']."' ");
		
		$materials = $PDO->getSingleResult("select name from #_categorys where status ='1' and cat_id='".$die_rows['category_id']."' ");
		$sub_materials = $PDO->getSingleResult("select name from #_categorys where status ='1' and cat_id='".$die_rows['sub_category_id']."' ");
		
		$status =($die_rows['status']==1)?'Active':'Inactive';
		
		
		if($die_rows['die_type']==1)
		{
		    $detail_query=$PDO->db_query("select * from #_die_details where die_id='".$die_rows['die_id']."'  ");
		   
		    while($detail_rows  = $PDO->db_fetch_array($detail_query))
			{
				$quantity=$detail_rows['quantity'];
					
				$color=$PDO->getSingleresult("select color_name from #_colors where color_id='".$detail_rows['color']."' ");
					
				$speciel_category=$PDO->getSingleresult("select category_name from #_special_categorys where spc_id='".$detail_rows['special_category']."' ");
				
				$excel->writeRow();
				$excel->writeCol($PDO->parse_output($die_rows['die_name']));
				$excel->writeCol($brand_name);
				$excel->writeCol($series_name);
				$excel->writeCol($model_name);
				$excel->writeCol($die_type_name);
				$excel->writeCol($materials);
				$excel->writeCol($sub_materials);
				$excel->writeCol($color);
				$excel->writeCol($speciel_category);
				$excel->writeCol($quantity);
				$excel->writeCol('');
				$excel->writeCol($status);
				$excel->writeCol($die_rows['die_id']);	
				$excel->writeCol($detail_rows['pid']);
			
			}
			
		}else {
		        $excel->writeRow();
				$excel->writeCol($PDO->parse_output($die_rows['die_name']));
				$excel->writeCol($brand_name);
				$excel->writeCol($series_name);
				$excel->writeCol($model_name);
				$excel->writeCol($die_type_name);
				$excel->writeCol($materials);
				$excel->writeCol($sub_materials);
				$excel->writeCol($color);
				$excel->writeCol($speciel_category);
				$excel->writeCol($quantity);
				$excel->writeCol('');
				$excel->writeCol($status);
				$excel->writeCol($die_rows['die_id']);
				$excel->writeCol('');	
			
		}
		
		 
		
		  
		}
		$excel->close();
	  
 
  
}else if($_GET['stags']=="revenue") {
	
   $filepath = $_GET['stags'].@date("Ymd").".xls";
       
   $excel=new ExcelWriter($filepath);
        
   if($excel==false) {	echo $excel->error;	}
	
  
   $myArr=array("ORDERID", 	 "TYPE", "AMOUNT", "TAX",  "TOTAL AMOUNT");
  
   $contents = "ORDERID, TYPE, BRAND, AMOUNT, TAX, TOTAL AMOUNT\n";
  
   $excel->writeLine($myArr);
 
 
		
  
  
  $order_query=$PDO->db_query("select * from  #_orders  where ostatus='approved' and status !='returned' and status !='canceled'  and status !='unapproved'  ");
  while($order_rows = $PDO->db_fetch_array($order_query))
  {
	       $flag=1;
				   
		   if($order_rows['type']=='cod' && $order_rows['status'] !='delivered' )
		   {
			  $flag=0;   
		   }
		  
		   $order_price = ($order_rows['amount']-$order_rows['discount']-$order_rows['shp']-$order_rows['codvalues']-$order_rows['coupon']-$order_rows['couponid']);
		  
		   //$tax =(5/100*$order_price);
		   
		    $tax = $PDO->getSingleresult("select SUM(tax)  from  #_orders_detail  where orderid='".$order_rows['orderid']."' ");
		   
		   if($flag==1)
		   {
				$excel->writeRow();
				$excel->writeCol($order_rows['orderid']);
				$excel->writeCol(($order_rows['type']=='cod')?'COD':'Credit/Debit');
				$excel->writeCol(number_format($order_price,2,'.',','));
				$excel->writeCol(number_format($tax,2,'.',','));
				$excel->writeCol(number_format($order_rows['amount'],2,'.',','));
				
		   }
	}
	$excel->close();
	  
 
  
   
}

header("Location:download.php?files=".$_GET['stags'].@date("Ymd").".xls");
exit;
?>