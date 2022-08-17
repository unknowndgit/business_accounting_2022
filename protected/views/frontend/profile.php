
<div class="container-fluid main-content">
<div class="page-title">
        <h1>Your Profile</h1>
        <?php if($display_msg!=''){?>
    <div class="col-md-12">
      <?php echo $display_msg;?>
     </div><?php }?>
</div>
<div class="row">
 <div class="col-md-12">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
 <input type="hidden" name="profilesize" id="profilesize" >
 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
 <label class="control-label col-md-3">Email</label>
            <div class="col-md-6">
              <input class="form-control"  name="username" disabled type="text" value="<?php echo $_SESSION['email'];?>">
              <br>
              <label>Your email is for logging in and cannot be changed.</label>
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">First Name<?php //echo $_SESSION['user_id'];?></label>
            <div class="col-md-6">
              <input class="form-control"  name="f_name" type="text" value="<?php echo $user_details['firstname'];?>">
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">Last Name</label>
            <div class="col-md-6">
              <input class="form-control"  name="l_name" type="text" value="<?php echo $user_details['lastname'];?>">
            </div>
          </div>

          <div class="form-group">
 <label class="control-label col-md-3">Address</label>
            <div class="col-md-6">
              <textarea class="form-control" name="address"><?php echo $user_details['address'];?></textarea>
            </div>
          </div>
          <div class="form-group">
 <label class="control-label col-md-3">Zipcode</label>
            <div class="col-md-6">
              <input class="form-control"  name="zipcode" type="text" id="zipcode" value="<?php echo $user_details['zipcode'];?>">
            </div>
          </div>
<div class="form-group">
 <label class="control-label col-md-3">Country</label>
            <div class="col-md-6">
              <input class="form-control"  name="country" type="text" id="country" value="<?php echo $user_details['country'];?>">
            </div>
          </div>
<div class="form-group">
 <label class="control-label col-md-3">State</label>
            <div class="col-md-6">
              <input class="form-control"  name="state" type="text" id="state" value="<?php echo $user_details['state'];?>">
            </div>
          </div>
<div class="form-group">
 <label class="control-label col-md-3">City</label>
            <div class="col-md-6">
              <input class="form-control"  name="city" type="text" id="city" value="<?php echo $user_details['city'];?>">
            </div>
          </div>

<div class="form-group">
            <label class="control-label col-md-3">Profile Pic</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
              <input type="hidden" value="" name="">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                	<?php
                	 if(file_exists(SERVER_ROOT.'/uploads/users/'.$_SESSION['user_id'].'/'.$user_details['user_photo_file']) && (($user_details['user_photo_file'])!=''))
                {?>
                	<img src="<?php echo SITE_URL.'/uploads/users/'.$_SESSION['user_id'].'/'.$user_details['user_photo_file'];?>" width="100%">
     <?php } else{?>
      <img src="<?php echo SITE_URL.'/assets/frontend/images/-text.png';?>"  width="100%">
                <?php }?>
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file">
                  <span class="fileupload-new">Select image</span>
                  <span class="fileupload-exists">Change</span>
                  <input type="file" name="profilepic" id="profilepic"></span>
                  <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                  <br> <small>Only jpeg, png & jpeg (Max : <?php echo $upload_max_size;?>)</small>
                </div>
              </div>
            </div>
          </div>
  <div class="form-group">
   <div class="col-md-12">
   <div class="col-md-3"></div>
   <div class="col-md-6">
    <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_profile"><i class="lnr lnr-chevron-up-circle"></i> Update</button>
    </div>
   <div class="col-md-3"></div>
   </div>
 </div>
 </div></div>
 </form>
</div>
</div>
</div>
</div>
</div>
<script>
  $('#profilepic').bind('change', function() {
  $('#profilesize').val(this.files[0].size);
  var a = this.files[0].size;
  var b= <?php echo ($upload_max_size*1024*1024);?>;
if(a>b)
  alert("File size must be less than <?php echo $upload_max_size;?>");
});
  </script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#zipcode').keyup(function () {
            
            var url = "<?php echo $link->link('ajax',frontend);?>";
            var data = {get_base_on_zip : 'city_state',zip: $('#zipcode').val()}

            $.ajax({
                url:url,
                data:data,
                type:'POST', 
                dataType:'json',               
                success:function(response){                    
                    city = response.city;
                    state = response.state;
                    country = response.country;
                    
                    $('#city').val(city);
                    $('#state').val(state);          
                    $('#country').val(country);          
                }});
                
            }); 
  });
</script>