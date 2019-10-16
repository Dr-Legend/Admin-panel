<?php 
  
  include(FS_ADMIN._MODS."/".basename(__DIR__)."/pagesfunc.inc.php");
  
  $PAGS = new Pages();
  
  if($RW->is_post_back())
  
  {
  
  $path = UP_FILES_FS_PATH."/".basename(__DIR__);
  
  $resize = UP_FILES_FS_PATH."/".basename(__DIR__)."/thumb";
  $resizeSmall = UP_FILES_FS_PATH."/".basename(__DIR__)."/small";
  
  if($_FILES['image'][name])
  
  {
  
  $_POST['image'] = $RW->uploadFile2($path,$_FILES['image']['name'],'image');
  
  $RW->make_thumb_gd($path."/".$_POST['image'], $resize."/".$_POST['image'],'1580', '450', 'width');
  $RW->make_thumb_gd($path."/".$_POST['image'], $resizeSmall."/".$_POST['image'],'200', '200', 'crop');	
  
  if($uid>0)
  
  {
  
  $delete_image=$PDO->getSingleresult("select image from #_".tblName." where pid='".$uid."'");
  
  if($delete_image!='')
  
  {
  
  @unlink($path.'/'.$delete_image);
  @unlink($resize.'/'.$delete_image);
  @unlink($resizeSmall.'/'.$delete_image);
  
  
  }
  
  }
  
  }
  
  $_POST['url'] =$ADMIN->baseurl($name);
  
  if($uid && $saveas=='saveas')
  
  {
  
  $flag = $PAGS->add($_POST);
  
  }else if($uid)
  
  {
  
  $_POST['updateid']=$uid;
  
  $flag = $PAGS->update($_POST);
  
  }else {
  
  $flag = $PAGS->add($_POST);
  
  }
  
  if($flag==1)
  
  {
  
  $RW->redir($ADMIN->iurl($comp.(($start)?'&start='.$start:'').(($subpage_id)?'&subpage_id='.$subpage_id:'').(($catid)?'&catid='.$catid:'')), true);
  
  }
  
  }
  
  if($uid)
  
  {
  
  $query =$PDO->db_query("select * from #_".tblName." where pid ='".$uid."' "); 
  
  $row = $PDO->db_fetch_array($query,PDO::FETCH_ASSOC);
  
  @extract($row);	
  
  }
 
 if($comp=='leads'){
	 	if(!$openstatus){
	 		$PDO->db_query("UPDATE #_".tblName." SET openstatus='1' WHERE pid='".$pid."'");
	 	}
	 }
  ?>
<input type="hidden" name="subpage_id" value="<?=$subpage_id?>" />
<div class="card mb-3">
  <div class="card-header">
    <h3><i class="fa fa-hand-pointer-o"></i>Add -
      <?=$ADMIN->compname($comp)?>
    </h3>
    <?=$ADMIN->alert()?>
  </div>
  <div class="card-body">
  <h3>View data</h3>
  <table class="table table-bordered table-striped manage-table"  cellpadding="0" cellspacing="0">
  <tr>
  <?php
  $i=0;
  foreach($row as $key=>$val){
		$i++;
	  if($key!='alldata'){
	  ?>
	<th><?=$key?></th><td <?=($i+1)==count($row)?' colspan="100%"':""?>><?=$val?></td>  
	<?php
	if($i%4==0){echo '</tr><tr>';}
	  }}
  ?>
  </tr>
  <tr><th>Form All data</th><td colspan="100%">
  <?php
  $ald=json_decode($row['alldata']);
  foreach($ald as $keys=>$vals){
	 echo '<b>'.ucwords($keys).': </b>'.$vals.', '; 
	  }
  ?>
</td></tr>
  </table>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12  col-md-3">Name<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="name" data-parsley-trigger="change" value="<?=$name?>" required class="form-control" data-parsley-required-message="Please insert your URL Alise">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="heading">Email<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="email" data-parsley-trigger="change" value="<?=$email?>" required class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Phone<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="phone" data-parsley-trigger="change" value="<?=$phone?>"  class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Service<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="service" data-parsley-trigger="change" value="<?=$service?>"  class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Source<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="source" data-parsley-trigger="change" value="<?=$source?>"  class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Comments</label>
      <div class="col-12 col-md-9">
      <textarea name="body" class="form-control" ><?=stripcslashes($comments)?></textarea>
      </div>
    </div>
    
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Status<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <select name="status"  class="form-control" data-parsley-trigger="change" data-parsley-required-message="Status is required!" required>
  
  <option  value="">-------Select Status------</option>
  
  <option value="1" <?=($status==1)?'selected="selected"':''?>  >Active</option>
  
  <option value="0" <?=(isset($status) && $status==0)?'selected="selected"':''?>>Inactive</option>
  
  </select>
      </div>
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
  $('.iconpicker').iconpicker({hideOnSelect: true});
  $('#imageupload').filer({
        limit: 1,
        maxSize: 1,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
        changeInput: true,
        showThumbs: true,
       // addMore: true
	   <?php 
	   $filepathss=basename(__DIR__)."/thumb/".$image;
	   if($image!='' && file_exists(UP_FILES_FS_PATH."/".$filepathss) ) {?>
	   files: [
			{
				name: "<?=$image?>",
				size: 145,
				type: "image/jpg",
				file: "<?=SITE_PATH."uploaded_files/".$filepathss?>"
			}
		],
	   <?php }?>
	  templates: {
                box: '<div class="image-items"></div>',
                item: '<div class="image-item">{{fi-image}}</div>',
                itemAppend: '<div class="image-item"><a data-fancybox="gallery" href="<?=SITE_PATH."uploaded_files/".$filepathss?>"><i class="fa fa-eye"></i>{{fi-image}}</a></div>',
                _selectors: {
                    list: '.image-items',
                    item: '.image-item',
                }
            }, 
    });
  });
  
  </script>