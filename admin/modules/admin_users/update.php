<?php 
include(FS_ADMIN._MODS."/admin_users/admin_user.inc.php");
$ADU = new AdminUsers();
if($RW->is_post_back())
{
   if($uid)
   {
	   $_POST['updateid']=$uid;
	   if($password!='' && $cpassword!='' && $cpassword==$password )
	   {
		   $_POST['password'] = $ADU->password($_POST['password']);
		   $flag = $ADU->update($_POST);   

	   }else {
		 $ADMIN->sessset('Confirm password is not match.', 'e');  

	   }
   }
}
$query =$PDO->db_query("select * from ".tb_Prefix."admin_users where user_id ='".$_SESSION["AMD"][0]."' "); 

$row = $PDO->db_fetch_array($query);

@extract($row);	
?>

<div class="card mb-3">
  <div class="card-header">
    <h3><i class="fa fa-hand-pointer-o"></i><?=str_replace('-',' ',ucwords($mode))?> -
      <?=$ADMIN->compname($comp)?>
    </h3>
    <?=$ADMIN->alert()?>
  </div>
  <div class="card-body">
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3"> Name <span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
        <input type="text" class="form-control" name="name" value="<?=$name?>"  required data-parsley-trigger="change" data-parsley-required-message="Name is required!">
        </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3"> Email <span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
        <input type="text" class="form-control" name="email" value="<?=$email?>"  required data-parsley-trigger="change" data-parsley-required-message="Email is required!">
        </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3"> Password <span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
        <input type="password" class="form-control" name="password" value=""  required data-parsley-trigger="change" data-parsley-required-message="Password is required!">
        </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Confirm Password <span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
        <input type="password" class="form-control" name="cpassword" value=""  required data-parsley-trigger="change" data-parsley-required-message="Password is required!">
        </div>
    </div>
    <div class="form-group text-right m-b-0">
    <input type="hidden" name="uid" value="<?=$_SESSION["AMD"][0]?>" />
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