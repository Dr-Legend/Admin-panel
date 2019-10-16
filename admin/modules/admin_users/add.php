<?php 
include(FS_ADMIN._MODS."/admin_users/admin_user.inc.php");
$ADU = new AdminUsers();
if($RW->is_post_back())
{
   if($uid)
   {
	   $_POST['updateid']=$uid;
       $flag = $ADU->update($_POST);
   }else {
	   $flag = $ADU->add($_POST);
   }
   if($flag==1)
   {
     $RW->redir($ADMIN->iurl($comp.(($start)?'&start='.$start:'').(($subpage_id)?'&subpage_id='.$subpage_id:'').(($alumniid)?'&alumniid='.$alumniid:'').(($galleryid)?'&galleryid='.$galleryid:'')).$dlr, true);
   }
}
if($uid)
{
    $query =$PDO->db_query("select * from ".tb_Prefix."admin_users where user_id ='".$uid."' "); 
	$row = $PDO->db_fetch_array($query);
	@extract($row);	
}
?>
<div class="card mb-3">
  <div class="card-header">
    <h3><i class="fa fa-hand-pointer-o"></i>Add -
      <?=$ADMIN->compname($comp)?>
    </h3>
    <?=$ADMIN->alert()?>
  </div>
  <div class="card-body">
      <div class="form-group row border-bottom pb-3">
        <label class="col-12 col-md-3"> Name <span class="text-danger">*</span></label>
        <div class="col-12 col-md-9">
          <input type="text" class="form-control" name="name" value="<?=$name?>" required data-parsley-trigger="change" data-parsley-required-message="Please insert your Name"></div>
      </div>
      <div class="form-group row border-bottom pb-3">
         <label class="col-12 col-md-3"> Email <span class="text-danger">*</span></label>
        <div class="col-12 col-md-9">
          <input type="text" class="form-control" name="email" value="<?=$email?>" required data-parsley-trigger="change" data-parsley-required-message="Please insert your Email"></div>
      </div>
      <?php if($uid==0){?>
      <div class="form-group row border-bottom pb-3">
         <label class="col-12 col-md-3"> Password <span class="text-danger">*</span></label>
        <div class="col-12 col-md-9">
          <input type="password" class="form-control" name="password" value="<?=$password?>" required data-parsley-trigger="change" data-parsley-required-message="Password is required!">
        </div>
      </div>
      <?php } ?>
      <div class="form-group row border-bottom pb-3">
         <label class="col-12 col-md-3"> User Type<span class="text-danger">*</span></label>
        <div class="col-12 col-md-9">
          <div class="funkyradio">
            <div class="funkyradio-success">
              <input value="1" <?=(($user_type=='1')?'checked="checked"':'')?> type="radio" name="user_type" id="radio1" />
              <label for="radio1">Admin</label>
            </div>
            <div class="funkyradio-success">
              <input value="2" <?=(($user_type=='2' or !$user_type)?'checked="checked"':'')?> type="radio" name="user_type" id="radio2"/>
              <label for="radio2">Editor</label>
            </div>
            <div class="funkyradio-success">
              <input value="3" <?=(($user_type=='3')?'checked="checked"':'')?> type="radio" name="user_type" id="radio3"/>
              <label for="radio3">Sales</label>
            </div>
            <div class="funkyradio-success">
              <input value="4" <?=(($user_type=='4')?'checked="checked"':'')?> type="radio" name="user_type" id="radio4"/>
              <label for="radio4">Warehouse</label>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group row border-bottom pb-3">
         <label class="col-12 col-md-3"> status<span class="text-danger">*</span></label>
        <div class="col-12 col-md-9">
          <select name="status"  class="form-control txt   select-txt" required data-parsley-trigger="change" data-parsley-required-message="Password is required!">
            <option  value="">-------Select Status------</option>
            <option value="1" <?=($status==1)?'selected="selected"':''?>  >Active</option>
            <option value="0" <?=(isset($status) && $status==0)?'selected="selected"':''?>>Inactive</option>
          </select></div>
      </div>
      <div class="form-group text-right m-b-0">
      <button class="btn btn-primary" type="submit"> Submit </button>
      <button type="reset" class="btn btn-secondary m-l-5" onclick="location.reload();"> Cancel </button>
    </div>
    </div>
  </div>
<script>
  
  jQuery(document).ready(function(){
  $('#formID').parsley();
  $('#filer_example2').filer({
        limit: 1,
        maxSize: 1,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
        changeInput: true,
        showThumbs: true,
       // addMore: true
    });
  });
  
  </script>