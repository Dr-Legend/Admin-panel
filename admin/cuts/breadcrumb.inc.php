<div class="content-page">
<div class="content">
<div class="container-fluid">
<!--Main page warp end--> 
<!--Breadcrumb Start-->
<?php
switch ($comp)
{
	    case $comp:
					if($comp)
					{
						if(is_dir(FS_ADMIN._MODS."/".$comp) === true)
						{
							if($mode=="my-profile" or $mode=="website-settings"){
								$breadcrumb = (($mode=="my-profile")?'My Profile':'Website Setting');
						    
							} else{
								$breadcrumb = $ADMIN->breadcrumb($comp);
							}
						} else{
							$breadcrumb = "Under Construction!";
							$notbc =true;
						}
					} else {
						 $breadcrumb = "Dashboard";	
					}
					break;					
	default:
		     $breadcrumb = "Dashboard";
}
?>
<div class="row">
  <div class="col-xl-12">
    <div class="breadcrumb-holder">
      <h1 class="main-title float-left"><?=$breadcrumb?></h1>
      <ol class="breadcrumb float-right">
       <?php if($mode!='add' && $mode!='website-settings' && $comp && $comp!='fire'&& $comp!='fire_form' && $comp!='clouds'  && $comp!='cloud_form' && $comp!='prayer' && $comp!='invite' && $comp!='letter_of_ceo' && $comp!='our_mission' && $comp!='our_vision' && $comp!='statement_of_faith' && $comp!='about_us') { ?>
      <li class="item"> <a href="<?=$ADMIN->iurl($comp,'add'.(($catid)?'&catid='.$catid:'').(($subpage_id)?'&subpage_id='.$subpage_id:''))?>" class="btn btn-success"><i class="fa fa-lg fa-plus"></i></a></li>
      <li class="ml-2"> <a href="javascript:void(0);" onclick="javascript:submitions('Active');" class="btn btn-primary"><i class="fa fa-lg fa-toggle-on"></i></a></li>
      <li class="ml-2"> <a href="javascript:void(0);" onclick="javascript:submitions('Inactive');" class="btn btn-warning"><i class="fa fa-lg fa-toggle-off"></i></a></li>
      <li class="ml-2"> <a href="javascript:void(0);" onclick="javascript:submitions('Delete');"class="btn btn-danger"><i class="fa fa-lg fa-trash"></i></a></li>
      <?php if($subpage_id){?>
      <li class="ml-2"> <a href="<?=$ADMIN->iurl($comp).(($catid)?'&catid='.$catid:'')?>" class="btn btn-primary"><i class="fa fa-lg fa-arrow-left"></i></a></li>
      <?php }?>
      <?php }else if($mode=='add'){?>
	  <li class="ml-2"> <a href="<?=$ADMIN->iurl($comp.(($catid)?'&catid='.$catid:''))?>" class="btn btn-danger"><i class="fa fa-lg fa-times"></i></a></li>
      <li class="ml-2"> <a href="<?=$ADMIN->iurl($comp).(($catid)?'&catid='.$catid:'')?>" class="btn btn-primary"><i class="fa fa-lg fa-arrow-left"></i></a></li>
	  <?php }?>
      </ol>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!--Breadcrumb end-->