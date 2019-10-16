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
  
  $RW->redir($ADMIN->iurl($comp.(($bible_id)?'&bible_id='.$bible_id:'')), true);
  
  }
  
  }
  
  $start = intval($start);
  
  $pagesize = intval($pagesize)==0?(($_SESSION["totpaging"])?$_SESSION["totpaging"]:DEF_PAGE_SIZE):$pagesize;
  
  list($result,$reccnt) = $PAGS->display($start,$pagesize,$fld,$otype,$search_data,$zone,$mtype,$extra,$extra1,$extra2);
  
  ?>

<div class="card mb-3">
  <div class="card-header">
 <?=$ADMIN->alert()?> 

   </div>
  <div class="card-body" id="ordrz">
        <table width="100%" class="table table-bordered table-striped manage-table"  id="sort" cellpadding="0" cellspacing="0">
          <thead>
            <tr class="tbl-head">
            
              <th width="7%">#</th>
              <th width="20%" class="noPad2"> <a href="<?=$ADMIN->iurl($comp)?>&fld=firstName<?=(($otype=='asc')?"&otype=desc":'&otype=asc')?>" <?=(($fld=='firstName')?'class="selectedTab"':'')?>><span <?=(($otype=='asc')?'class="des"':'class="asc"')?>> Name</span></a> </th>
              <th width="10%" class="noPad2"> <a href="<?=$ADMIN->iurl($comp)?>&fld=contact_no<?=(($otype=='asc')?"&otype=desc":'&otype=asc')?>" <?=(($fld=='contact_no')?'class="selectedTab"':'')?>><span <?=(($otype=='asc')?'class="des"':'class="asc"')?>> Phone</span></a> </th>
                <th width="20%" class="noPad2"> <a href="<?=$ADMIN->iurl($comp)?>&fld=email<?=(($otype=='asc')?"&otype=desc":'&otype=asc')?>" <?=(($fld=='email')?'class="selectedTab"':'')?>><span <?=(($otype=='asc')?'class="des"':'class="asc"')?>> Email</span></a> </th>
              
            
<th width="30%" class="noPad2"> <a href="<?=$ADMIN->iurl($comp)?>&fld=address<?=(($otype=='asc')?"&otype=desc":'&otype=asc')?>" <?=(($fld=='address')?'class="selectedTab"':'')?>><span <?=(($otype=='asc')?'class="des"':'class="asc"')?>> Address</span></a> </th>

         <th width="13%" class="action-td">Action</th>
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
            <tr class="<?=$css?>" id="">
            
              <td class="index"><?=$nums?></td>
              <td><?=$name?></td>
              <td><?=$contact_no?></td>
              <td><?=$email?></td>
              <td><?=$address?></td>
            
              <td class="action">
              <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?=$pid?>"><i class="fa fa-eye" title="View"></i></a>

<div class="modal" id="myModal<?=$pid?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <table width="100%" border="1">
  <tr>
    <th>Name</th><td><?=$name?></td>
  </tr>
   <tr>
    <th>Email</th><td><?=$email?></td>
  </tr>
   <tr>
    <th>Phone</th><td><?=$contact_no?></td>
  </tr>
   <tr>
    <th>Address</th><td><?=$address?></td>
  </tr>
   <tr>
    <th>Country</th><td><?=$PDO->getSingleresult("select name from #_country where pid='".$country."'")?></td>
  </tr>
   <tr>
    <th>State</th><td><?=$state?></td>
  </tr>
   <tr>
    <th>City</th><td><?=$city?></td>
  </tr>
   <tr>
    <th>Zip/Postal Code</th><td><?=$zipcode?></td>
  </tr>
   <tr>
    <th>Website</th><td><?=$website?></td>
  </tr>
   <tr>
    <th>Contact Person</th><td><?=$contactPerson?></td>
  </tr>
   <tr>
    <th>Contact Person Phone</th><td><?=$contactPersonphone?></td>
  </tr>
   <tr>
    <th>Pastor/Overseer</th><td><?=$overseer?></td>
  </tr>
   <tr>
    <th>Event Title</th><td><?=$eventTitle?></td>
  </tr>
   <tr>
    <th>Event Theme</th><td><?=$eventTheme?></td>
  </tr>
   <tr>
    <th>Event Date</th><td><?=$dateOfevent?></td>
  </tr>
   <tr>
    <th>Estimated Attendance</th><td><?=$estimatedAttendance?></td>
  </tr>
</table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
              
              
              
			  <?='<a  class="btn btn-danger btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&uid='.$pid.'&action=del" onclick="return confirm(\'Do you want delete this record?\');"><i class="fa fa-trash" title="Delete Record"></i></a>'?></td>
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