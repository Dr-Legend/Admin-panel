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
      <label class="col-12  col-md-3">Page Url<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="pagename" data-parsley-trigger="change" value="<?=$pagename?>" required class="form-control" data-parsley-required-message="Please insert your URL Alise">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="heading">Name<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="heading" data-parsley-trigger="change" value="<?=$heading?>" required class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Occupation<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="occupation" data-parsley-trigger="change" value="<?=$occupation?>"  class="form-control" data-parsley-required-message="Please insert your Heading">
      </div>
    </div>
    <!-- <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Meta Title</label>
      <div class="col-12 col-md-9">
      <textarea name="meta_title" class="form-control" ><?=stripcslashes($meta_title)?></textarea>
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Meta Description</label>
      <div class="col-12 col-md-9">
      <textarea name="meta_description" class="form-control" ><?=stripcslashes($meta_description)?></textarea>
      </div>
    </div> -->
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Facebook Link<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="facebook" value="<?=$facebook?>"  class="form-control">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Tritter Link<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="twitter" value="<?=$twitter?>"  class="form-control">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Google Plus Link<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="gplus" value="<?=$gplus?>"  class="form-control">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">LinkedIn Link<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="linkedin" value="<?=$linkedin?>"  class="form-control">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Skype User Name<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="text" name="skype" value="<?=$skype?>"  class="form-control">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">About</label>
      <div class="col-12 col-md-9">
      <textarea name="body" class="form-control" ><?=stripcslashes($body)?></textarea>
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3">Image<!-- <span class="text-danger">*</span> --></label>
      <div class="col-12 col-md-9">
      <input type="file" name="image" id="imageupload">
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