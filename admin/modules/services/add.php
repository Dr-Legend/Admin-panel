<?php 
  
  include(FS_ADMIN._MODS."/".basename(__DIR__)."/pagesfunc.inc.php");
  
  $PAGS = new Pages();
  
  if($RW->is_post_back())
  
  {
  
  $path = UP_FILES_FS_PATH."/".basename(__DIR__);
  
  $resize = UP_FILES_FS_PATH."/".basename(__DIR__)."/thumb";
  
  if($_FILES['image'][name])
  
  {
  
  $_POST['image'] = $RW->uploadFile2($path,$_FILES['image']['name'],'image');
  
  $RW->make_thumb_gd($path."/".$_POST['image'], $resize."/".$_POST['image'],'1580', '183', 'width');	
  
  if($uid>0)
  
  {
  
  $delete_image=$PDO->getSingleresult("select image from #_".tblName." where pid='".$uid."'");
  
  if($delete_image!='')
  
  {
  
  @unlink($path.'/'.$delete_image);
  
  @unlink($resize.'/'.$delete_image);
  
  }
  
  }
  
  }
  
  $_POST['url'] =$ADMIN->baseurl($pagename);
  
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
  
  $row = $PDO->db_fetch_array($query);
  
  @extract($row);	
  
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
    <div class="form-group row border-bottom pb-3">
      <label for="emailAddress" class="col-12  col-md-3">Page Url<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="pagename" data-parsley-trigger="change" value="<?=$pagename?>" required class="form-control" data-parsley-required-message="Please insert your URL Alise">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Heading<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="heading" data-parsley-trigger="change" value="<?=$heading?>" required class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Sub Heading<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="subheading" data-parsley-trigger="change" value="<?=$subheading?>"  class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Select Icon<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="icon" data-placement="bottomLeft" value="<?=$icon?>"  class="form-control iconpicker" autocomplete="off">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Meta Title<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <textarea name="meta_title" class="form-control" ><?=stripcslashes($meta_title)?></textarea>
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Meta Description<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <textarea name="meta_description" class="form-control" ><?=stripcslashes($meta_description)?></textarea>
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Description<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <?=$ADMIN->get_editor('body', stripcslashes($body),'','100%')?>
      </div>
    </div>
    <?php if($subpage_id==0){?>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Image<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="file" name="image" id="imageupload">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Show on main Menu<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <select name="showhdr"  class="form-control" data-parsley-trigger="change" data-parsley-required-message="Menu is required!" required>
  
  <option  value="">-------Select Menu Status------</option>
  
  <option value="1" <?=($showhdr==1)?'selected="selected"':''?>  >Active</option>
  
  <option value="0" <?=(isset($showhdr) && $showhdr==0)?'selected="selected"':''?>>Inactive</option>
  
  </select>
      </div>
    </div>
    <?php }?>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Status<span class="text-danger">*</span></label>
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