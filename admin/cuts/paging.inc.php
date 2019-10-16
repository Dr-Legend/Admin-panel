<?php 
if($reccnt>$pagesize){
	$num_pages=$reccnt/$pagesize;
	$qry_str=$_SERVER['argv'][0];
	
	$m=$_GET;
	unset($m['start']);
	
	$qry_str = $RW->qry_str($m);
	
	$qry_str .=($search_data)?'&search_data='.$search_data:'';
	
	$j=$start/$pagesize-5;

	if($j<0) {
		$j=0;
	}
	$k=$j+10;
	if($k>$num_pages){
		$k=$num_pages;
	}
	$j=intval($j);
?>
<div class="paginations">
<div class="row p-2 bg-dark text-white mt-5">
<div class="total col-sm-3 col-6"><span class="nav-link">Showing <?=(($start)?$start:'1')?> of <?=$reccnt?></span></div>
<div class="col-sm-3 col-6">
<select class="select-txt form-control" name="" onchange="location.href='<?=SITE_PATH_ADM."components/index.php?compp=".$comp."&qtag=pgn&totpaging="?>'+this.value+'';">
<option value="25" <?=(($_SESSION["totpaging"]==25)?' selected="selected"':'')?>>25</option>
<option value="50" <?=(($_SESSION["totpaging"]==50)?' selected="selected"':'')?>>50</option>
<option value="100" <?=(($_SESSION["totpaging"]==100)?' selected="selected"':'')?>>100</option>
<option value="All">All</option>
</select>
</div>
<div class="col-sm-6 col-xs-12">
<ul class="pagination justify-content-end mb-0">
	<?php if($start!=0){ ?>
	<li class="page-item"><a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>" class="page-link">&laquo; Previous</a></li>
    <?php  } for($i=$j;$i<$k;$i++) {if(($pagesize*($i))!=$start){?>
    <li class="page-item"><a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$pagesize*($i)?>" class="page-link"><?=$i+1?></a></li>
    <?php  }  else {  ?>
  	<li class="page-item disabled"><a href="javascript:void(0);" class="page-link disabled"><?=$i+1?></a></li>
	<?php   } }?>
    <?php if($start+$pagesize < $reccnt){ ?>
    <li class="page-item"><a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>" class="page-link">Next&raquo; </a> </li>
    <?php } ?>
    </ul>
</div>
</div></div>
<?php }?>