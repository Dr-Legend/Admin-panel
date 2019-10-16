<?php 
  include(FS_ADMIN._MODS."/".basename(__DIR__)."/pagesfunc.inc.php");
 
  $PAGS = new Pages();
  if($action)
  {
  if($uid >0  || !empty($arr_ids))
  {
  switch($action)
  {
  case "del":
  $PAGS->delete($uid);
  $ADMIN->sessset('Record has been deleted', 'e'); 
  break;
  case "Delete":
  
  $PAGS->delete($arr_ids);
  
  $ADMIN->sessset(count($arr_ids).' Item(s) Deleted', 'e');
  
  break;
  
  case "Active":
  
  $PAGS->status($arr_ids,1);
  
  $ADMIN->sessset(count($arr_ids).' Item(s) Active', 's');
  
  break;
  
  case "Inactive":
  
  $PAGS->status($arr_ids,0);
  
  $ADMIN->sessset(count($arr_ids).' Item(s) Inactive', 's');
  
  break;
  
  default:
  
  }
  
  $RW->redir($ADMIN->iurl($comp), true);
  
  }
  
  }
  
  $start = intval($start);
  
  $pagesize = intval($pagesize)==0?(($_SESSION["totpaging"])?$_SESSION["totpaging"]:DEF_PAGE_SIZE):$pagesize;
  
  list($result,$reccnt) = $PAGS->display($start,$pagesize,$fld,$otype,$search_data,$zone,$mtype,$extra,$extra1,$extra2);
  
  ?>

<div class="card mb-3">
  <div class="card-header">
 <?=$ADMIN->alert()?> 
 <span class="pull-right"><a href="<?=$ADMIN->iurl($comp,'add'.(($catid)?'&catid='.$catid:''))?>" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add new <?=$ADMIN->breadcrumb($comp)?></a></span>   
    <!--<h3><i class="fa fa-table"></i> Basic table</h3>-->
   </div>
  <div class="card-body" id="ordrz">
        <table width="100%" class="table table-bordered table-striped manage-table"  id="sort" cellpadding="0" cellspacing="0">
          <thead>
            <tr class="tbl-head">
              <th width="3%" class="select-td"><?=$ADMIN->check_all()?></th>
              <th width="3%">#</th>
              <th width="52%" class="noPad2"> <a href="<?=$ADMIN->iurl($comp)?>&fld=name<?=(($otype=='asc')?"&otype=desc":'&otype=asc')?>" <?=(($fld=='name')?'class="selectedTab"':'')?>><span <?=(($otype=='asc')?'class="des"':'class="asc"')?>>Faith Title</span></a> </th>
              
              <th width="10%" class="noPad2"> <a href="<?=$ADMIN->iurl($comp)?>&fld=status<?=(($otype=='asc')?"&otype=desc":'&otype=asc')?>" <?=(($fld=='status')?'class="selectedTab"':'')?>><span <?=(($otype=='asc')?'class="des"':'class="asc"')?>> Status</span></a> </th>
              <th width="10%" class="action-td">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if($reccnt)
  
  { 
  
  $nums = (($start)?$start+1:1); 
  
  while ($line = $PDO->db_fetch_array($result))
  
  {
  
  @extract($line);
  
  $css =($css=='odd')?'even':'odd';
  
  ?>
            <tr class="<?=$css?>" id="recordsArray_<?=$pid?>">
              <td><?=$ADMIN->check_input($pid)?></td>
              <td class="index"><?=$nums?></td>
              <td><?=$name?></td>
          
              <td><?=$ADMIN->displaystatus($status)?></td>
              <td class="action"><?=$ADMIN->action($comp.(($catid)?'&catid='.$catid:''), $pid)?></td>
            </tr>
            <?php $nums++; } ?>
          </tbody>
        
        <?php  }else { echo $ADMIN->rowerror('100%') ;} ?>
       </table>
      <?php include("cuts/paging.inc.php");?>

 </div>
</div>
<script language="javascript">
  
  $(document).ready(function(e) {
  
  $("[data-toggle=tooltip]").tooltip();
  
  });
  
  var fixHelperModified = function(e, tr) {
  
  var $originals = tr.children();
  
  var $helper = tr.clone();
  
  $helper.children().each(function(index) {
  
  $(this).width($originals.eq(index).width())
  
  });
  
  return $helper;
  
  },
  
  updateIndex = function(e, ui) {
  
  $('td.index', ui.item.parent()).each(function (i) {
  
  $(this).html(i + 1);
  
  });
  
  };
  
  $("#sort tbody").sortable({
  
  helper: fixHelperModified,
  
  opacity: 0.6, cursor: 'move',
  
  update: function() {
  
  var order = jQuery(this).sortable("serialize") + '&tbl=<?=tblName?>&field=pid'; 
  
 
  $.post("<?=SITE_PATH_ADM?>modules/orders.php", order, function(theResponse){ }); 															
  
  },
  
  stop: updateIndex
  
  }).disableSelection();
  
  </script>