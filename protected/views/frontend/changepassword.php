<div class="container-fluid main-content">
<div class="page-title">

        <h1>Change Password</h1>
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
 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
 <label class="control-label col-md-3">Old Password</label>
            <div class="col-md-6">
              <input class="form-control"  name="oldpassword" type="password" value="">
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">New Password</label>
            <div class="col-md-6">
              <input class="form-control"  name="newpassword" type="password" value="">
            </div>
          </div>
 <div class="form-group">
 <label class="control-label col-md-3">Confirm Password</label>
            <div class="col-md-6">
              <input class="form-control"  name="confirmpassword" type="password" value="">
            </div>
          </div>
  <div class="form-group">
   <div class="col-md-12">  
   <div class="col-md-3"></div>  
   <div class="col-md-6">             
    <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_changepassword"><i class="lnr lnr-chevron-up-circle"></i> Update</button>  
    </div>       
   <div class="col-md-3"></div>
   </div>
 </div>
 </div></div>
 </form>
</div>
</div>
</div>
</div></div>