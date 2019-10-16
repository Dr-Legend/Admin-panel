<div class="headerbar"> 
<style>
.headerbar .headerbar-left .logo img {
    max-width: 225px;
    max-height: 35px;
</style>
  <div class="headerbar-left"> <a href="<?=SITE_PATH_ADM?>" class="logo"><img alt="Logo" src="assets/images/logo.png" /></a> </div>
  <nav class="navbar-custom">
    <ul class="list-inline float-right mb-0">
    <?php
	$leadqry=$PDO->db_query("select * from #_bible where status='0' order by pid DESC limit 5");
	$ttllds=$PDO->getSingleresult("select count(*) from #_bible where status='0'");
	?>
      <li class="list-inline-item dropdown notif"> <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <i class="fa fa-fw fa-envelope-o"></i><?php if($ttllds>0){?><span class="notif-bullet"></span><?php }?> </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg"> 
          <!-- item-->
          <div class="dropdown-item noti-title">
            <h5><small><span class="label label-danger pull-xs-right"><?=$ttllds?></span>New bible</small></h5>
          </div>
          <?php
		  if($ttllds>0){
		  while($leadrw=$PDO->db_fetch_array($leadqry)){
		  ?>
          <!-- item--> 
          <a href="<?=$ADMIN->HrefAction($comp, $leadrw['pid'])?>" class="dropdown-item notify-item">
          <p class="notify-details ml-0"> <b><?=$leadrw['name']?></b> <span>New bible received</span> <small class="text-muted"><?=$RW->time_elapsed_string($leadrw['created_on'])?></small> </p>
          </a> 
          <?php }}?>
          <!-- All--> 
          <a href="<?=$ADMIN->iurl('bible')?>" class="dropdown-item notify-item notify-all"> View All </a> </div>
      </li>
      <li class="list-inline-item dropdown notif"> <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <img src="assets/images/avatars/admin.png" alt="Profile image" class="avatar-rounded"> </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown "> 
          <!-- item-->
          <div class="dropdown-item noti-title">
            <h5 class="text-overflow"><small>Hello, <?=$_SESSION["AMD"][1]?></small> </h5>
          </div>
          
          <!-- item--> 
          <a href="<?=SITE_PATH_ADM?>index.php?comp=admin_users&mode=update" class="dropdown-item notify-item"> <i class="fa fa-user"></i> <span>Profile</span> </a> 
          
          <!-- item--> 
          <a href="<?=SITE_PATH_ADM?>logout.php" class="dropdown-item notify-item"> <i class="fa fa-power-off"></i> <span>Logout</span> </a> 

           </div>
      </li>
    </ul>
    <ul class="list-inline menu-left mb-0">
      <li class="float-left">
        <button class="button-menu-mobile open-left"> <i class="fa fa-fw fa-bars"></i> </button>
      </li>
    </ul>
  </nav>
</div>
