<?php
include('../../lib/config.inc.php');
include(FS_ADMIN."/login/login.inc.php");
if($_SESSION["AMD"][0])
{
	$RW->redir(SITE_PATH_ADM."index.php");



	exit;
}
$LOGU = new LoginUser();

if($RW->is_post_back())

{

if($_POST['email'] && (!empty($_POST['email'])) )

{

$flag = $LOGU->login($_POST);
		if($flag==1)

{

//unset($_SESSION['security_code']);

$RW->redir(SITE_PATH_ADM."index.php");

exit;

}
	 } else { 
	  //   $ADMIN->sessset('Please enter valid security code!', 'e');

	}
}
?>
<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>
<?=SITE_NAME?>
</title>
<link rel="shortcut icon" href="<?=SITE_PATH_ADM?>assets/images/favicon.ico">
<link href="<?=SITE_PATH_ADM?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=SITE_PATH_ADM?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?=SITE_PATH_ADM?>assets/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?=SITE_PATH_ADM?>assets/js/jquery.min.js"></script>
<script src="<?=SITE_PATH_ADM?>assets/plugins/parsleyjs/parsley.min.js"></script>
</head>

<body>
<div class="container">
<?=$ADMIN->alert()?>
<div class="row h-100 justify-content-center align-items-center mt-md-5">
<div class="col-12 col-md-6">
<div class="card mt-5">
  <h4 class="card-header">Login</h4>
  <div class="card-body">
    
    <form role="form" method="post" data-parsley-validate="">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Login Email</label>
            <div class="input-group">
              <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span> </div>
              <input type="email" class="form-control" name="email" data-error="Input valid email" required="" data-parsley-errors-container="#email">
            </div>
            <div class="help-block with-errors text-danger" id="email"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Password</label>
            <div class="input-group">
              <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock" aria-hidden="true"></i></span> </div>
              <input type="password" name="password" class="form-control" data-error="Password to short" required="" data-parsley-errors-container="#password">
            </div>
            <div class="help-block with-errors text-danger" id="password"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="checkbox checkbox-primary">
          <input id="checkbox_remember" type="checkbox" name="remember">
          <label for="checkbox_remember"> Remember me</label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <input type="hidden" name="redirect" value="">
          <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login" name="submit">
        </div>
      </div>
    </form>
    <div class="clear"></div>
    <!-- <i class="fa fa-user fa-fw"></i> No account yet? <a href="register.php">Register new account</a><br>
    <i class="fa fa-undo fa-fw"></i> Forgot password? <a href="reset-password.php">Reset password</a> --> </div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(e) {
    $('#formID').parsley();
});
</script>
</body>
</html>