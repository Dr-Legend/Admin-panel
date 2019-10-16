<?php 

if($RW->is_post_back())

{

	   $_POST['modified_on']=date('Y-m-d H:i:s');

	   $PDO->sqlquery("rs",tblName,$_POST,'pid',1);

	   $PDO->sessset('Record has been added', 's');

       $RW->redir($ADMIN->iurl($comp,'website-settings').$dlr, true);

     

}



$query =$PDO->db_query("select * from #_".tblName." where pid ='1' "); 

$row = $PDO->db_fetch_array($query);

@extract($row);	





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

            <label class="col-12 col-md-3"> COMPANY<small><span class="text-danger">* Required field

</span></small></label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="company" value="<?=$company?>" required data-parsley-trigger="change" data-parsley-required-message="Company Name is required!">

             </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3"> ADDRESS <small><span class="text-danger">* Required field

</span><br />(You can update Address, Email, Phone, Fax etc...)</small></label>

            <div class="col-12 col-md-9">

               <textarea name="address" class="form-control" cols="" rows="5" required data-parsley-trigger="change" data-parsley-required-message="Address is required!"><?=$address?></textarea>

             

             </div>

          </div>
		 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3"> EMAIL<small><span class="text-danger">* Required field

</span></small></label>

            <div class="col-12 col-md-9">

              <input type="email" class="form-control" name="email" value="<?=$email?>" required data-parsley-trigger="change" data-parsley-required-message="Email is required!">

            </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3"> CALL US<small><span class="text-danger">* Required field

</span></small></label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="phone" value="<?=$phone?>" required data-parsley-trigger="change" data-parsley-required-message="Phone is required!">

             </div>

          </div>  
		 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Bank Name</label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="bank" value="<?=$bank?>"  >

             </div>

          </div>
		 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Account Number </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="accno" value="<?=$accno?>"  >

             </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">IFSC Code</label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="ifsc" value="<?=$ifsc?>"  >

             </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Copyright</label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="copyright" value="<?=$copyright?>"  >

             </div>

          </div>
     	 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Facebook </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="facebook" value="<?=$facebook?>" >

             </div>

          </div>       
		 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Linkedin </label>

            <div class="col-12 col-md-9">

              <input type="text" class=" form-control" name="linkedin" value="<?=$linkedin?>" />

             </div>

          </div>
		 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3"> Twitter </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="twitter" value="<?=$twitter?>"  >

            </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Youtube </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="youtube" value="<?=$youtube?>"  >

            </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Google Plus </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="gplus" value="<?=$gplus?>"  >

            </div>

          </div>
		 <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Pinterest </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="pinterest" value="<?=$pinterest?>"  >

            </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Tumblr </label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="tumblr" value="<?=$tumblr?>"  >

            </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Instagram</label>

            <div class="col-12 col-md-9">

              <input type="text" class="form-control" name="instagram" value="<?=$instagram?>"  >

            </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Header script</label>

            <div class="col-12 col-md-9">

               <textarea name="headersec" class="form-control" cols="" rows="5" style="height:auto;" ><?=$headersec?></textarea>

             

             </div>

          </div>
         <div class="form-group row border-bottom pb-3">

            <label class="col-12 col-md-3">Footer script</label>

            <div class="col-12 col-md-9">

               <textarea name="footersec" class=" form-control" cols="" rows="5" style="height:auto;" ><?=$footersec?></textarea>

             

             </div>

          </div>  
		 <div class="form-group row border-bottom pb-3"><label class="col-12 col-md-3">Description</label>
        <div class="col-12 col-md-9">
             <div style="margin-left:0px; margin-top:10px;"><?=$ADMIN->get_editor_s('about', stripcslashes($about),'','100%')?></div>
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