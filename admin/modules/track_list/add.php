<?php 
  
  include(FS_ADMIN._MODS."/".basename(__DIR__)."/pagesfunc.inc.php");
  
  $PAGS = new Pages();
  
  if($RW->is_post_back())
  
  {
  
  $path = UP_FILES_FS_PATH."/".basename(__DIR__);
  if($_FILES['image'][name])
  
  {
  
  $_POST['image'] = $RW->uploadFile3($path,$_FILES['image']['name'],'image',$ADMIN->baseurl($name));
  
  	
  
  if($uid>0)
  
  {
  
  $delete_image=$PDO->getSingleresult("select image from #_".tblName." where pid='".$uid."'");
  
  if($delete_image!='')
  
  {
  
  @unlink($path.'/'.$delete_image);

  
  }
  
  }
  
  }
  
    $imgpath = UP_FILES_FS_PATH."/".basename(__DIR__);
  
  $imgresize = UP_FILES_FS_PATH."/".basename(__DIR__)."/thumb";
  
  if($_FILES['poster'][name])
  
  {
  
  $_POST['poster'] = $RW->uploadFile2($imgpath,$_FILES['poster']['name'],'poster');
  
  $RW->make_thumb_gd($imgpath."/".$_POST['poster'], $imgresize."/".$_POST['poster'],'200', '200', 'width');	
  
  if($uid>0)
  
  {
  
  $delete_img=$PDO->getSingleresult("select poster from #_".tblName." where pid='".$uid."'");
  
  if($delete_img!='')
  
  {
  
  @unlink($imgpath.'/'.$delete_img);
  
  @unlink($imgresize.'/'.$delete_img);
  
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
      <label for="emailAddress" class="col-12  col-md-3">Track Title<span class="text-danger">*</span></label>
      <div class="col-12 col-md-9">
      <input type="text" name="name" data-parsley-trigger="change" value="<?=$name?>" required class="form-control" data-parsley-required-message="Please insert Track Title">
      </div>
    </div>
    
   <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Poster</label>
      <div class="col-12 col-md-9">
      <input type="file" name="poster" id="imageupload">
      </div>
    </div>
    <div class="form-group row border-bottom pb-3">
      <label class="col-12 col-md-3" for="emailAddress">Track</label>
      <div class="col-12 col-md-9">
      <input type="file" name="image" id="mp3upload">
      </div>
    </div>
    <?php if($image){ ?>
    <div class="form-group row border-bottom pb-3">
    <label class="col-12 col-md-3" for="emailAddress"></label>
      <div class="col-12 col-md-9">
      <audio controls="" class="play_pause">
                                            <source src="<?=SITE_PATH."uploaded_files/track_list/".$image?>" type="audio/mpeg">
                                        </audio>
      </div>
    </div>
    <?php } ?>
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
  $('#mp3upload').filer({
        limit: 1,
        maxSize: 500,
        extensions: ['mp3'],
        changeInput: true,
        showThumbs: false,
       // addMore: true
	   <?php 
	   $filepathss=basename(__DIR__)."/".$image;
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
	$('#imageupload').filer({
        limit: 1,
        maxSize: 1,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
        changeInput: true,
        showThumbs: true,
       // addMore: true
	   <?php 
	   $filepathss=basename(__DIR__)."/thumb/".$poster;
	   if($poster!='' && file_exists(UP_FILES_FS_PATH."/".$filepathss) ) {?>
	   files: [
			{
				name: "<?=$poster?>",
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