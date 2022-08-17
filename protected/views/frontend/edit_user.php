<?php

if(isset($_REQUEST['action_edit'])){
	$user_id=$_REQUEST['action_edit'];
	$user_detail=$db->get_row('users',array('user_id'=>$user_id));
	//print_r($user_detail);
}

/*if (isset($_POST['submit_image'])){

	$image = $_FILES['item'];
	$handle= new upload($_FILES['item']);
	$path=SERVER_ROOT.'/uploads/users/'.$user_id.'/';

	if(!is_dir($path))
	{
		if(!file_exists($path))
		{
			mkdir($path);
		}
	}
	$newfilename = $handle->file_new_name_body='user_'.time();
	//$ext = $handle->image_src_type;
	$ext= $image['type'];
	echo $itemname = $newfilename.'.'.$ext;



	if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'JPEG' || $handle->image_src_type == 'png' || $handle->image_src_type == 'JPG')
	{
		echo '=====================';
		if ($handle->uploaded)
		{
			$handle->Process($path);
			if ($handle->processed)
			{
				//$insert=$db->update('users',array('user_photo_file'=>$itemname),array('user_id'=>$user_id));
				//$db->debug();
				/*entry in activity log table*/
				/*$event="User Image Updated successfully !";
				$db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
						'event'=>$event,
						'created_date'=>date('Y-m-d'),
						'ip_address'=>$_SERVER['REMOTE_ADDR']

				));


				if ($insert)
				{
					$display_msg='<div class="alert alert-success ">
        			<button class="close" data-dismiss="alert" type="button">X</button>
        	<b><i class="fa fa-smile-o"></i>User details update successfully !</b>
        	</div>';
					echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("users",user)."'
	                },3000);</script>";
				}
			}
		}
	}

}*/

if(isset($_POST['submit']))
{

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    //$email=$_POST['email'];
    $address=$_POST['address'];
    $zipcode=$_POST['zipcode'];
    $country=$_POST['country'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $role_id=$_POST['role_id'];
    $mobile_number=$_POST['mobile_number'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];


     $empt_fields = $fv->emptyfields(array('First Name'=>$firstname,
                                          'Last Name' =>$lastname,
                                       'Role name should be selected'=>$role_id,
    ));
    if ($empt_fields)
    {
          $display_msg= '<div class="alert alert-danger">
    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
              Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }

    else
    { 
        
         if($role_id=='1'){
          $user_type_stu="admin";
        }
        else{
          $user_type_stu="user"; 
        }
        $update=$db->update('users',array('firstname'=>$firstname,
            'lastname'=>$lastname,
            //'email'=>$email,
        	'mobile'=>$mobile_number,
            'address'=>$address,
            'user_type'=>$user_type_stu,
            'role_id'=>$role_id,
            'ip_address'=>$ip_address,
            'zipcode'=>$zipcode,
            'city'=>$city,
            'country'=>$country,
            'state'=>$state,
         ),array('user_id'=>$user_id));

        if ($update)
        {

            $display_msg='<div class="alert alert-success ">
			<button class="close" data-dismiss="alert" type="button">X</button>
	<b><i class="fa fa-smile-o"></i>User details update successfully !</b>
	</div>';
            echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("users",user)."'
	                },3000);</script>";


        }
    }
}
?>



<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>Edit User </h3>
      </div>
      <div class="widget-container fluid-height">

         <div class="widget-content padded">
           <a href="<?php echo $link->link('users',user);?>" class="btn btn-default pull-right">Back to List</a>
            <a href="<?php echo $link->link('add_user',user);?>" class="btn btn-default pull-right">Cancel</a>


<br><br><br>
           <div class="row">

             <div class="col-lg-6">
             <form  action="" method="post" class="form-horizontal">
                 <div class="form-group" >
                           <label class="control-label col-md-3">First name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="firstname" value="<?php echo $user_detail['firstname'];?>">
                           </div>
                        </div>
                         <div class="form-group" >
                           <label class="control-label col-md-3">Email<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" value="<?php echo $user_detail['email'];?>" readonly>
                           </div>
                        </div>

                        <div class="form-group" >
                           <label class="control-label col-md-3">Last name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="lastname" value="<?php echo $user_detail['lastname'];?>">
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">Mobile Number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="mobile_number" value="<?php echo $user_detail['mobile'];?>">
                           </div>
                        </div>
                          <div class="form-group" >
                           <label class="control-label col-md-3">Address</label>
                           <div class="col-md-7">
                             <textarea class="form-control"  name="address"><?php echo $user_detail['address'];?></textarea>
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">Zipcode</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="zipcode" id="zipcode" value="<?php echo $user_detail['zipcode'];?>" >
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">Country</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="country" id="country" value="<?php echo $user_detail['country'];?>">
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">State</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control" name="state" id="state" value="<?php echo $user_detail['state'];?>">
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">City</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="city" id="city" value="<?php echo $user_detail['city'];?>">
                           </div>
                        </div>
                        <div class="row">
         <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
           <div class="widget-content padded clearfix">
              What role(s) apply ?<font color="red">*</font>
              <br>When roles have conflicting access rights the highest level of access will apply.
              <br><br>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                  </tr></thead>
                  <tbody>
                     <?php
                     $roles=$db->get_all('roles');
                    if (is_array($roles)){
                        $sn=1;
           foreach ($roles as $role){?>
                    <tr>
                      <td width="5%">
                       <label><input <?php  if ($user_detail['role_id']==$role['id']){echo 'checked';}?> type="radio" name="role_id" value="<?php echo $role['id'];?>"></label>
                      </td>
                   <td width="20%">
                  	<?php echo $role['role'];?>
                  </td>
                  <td width="55%">
                  	<?php echo $role['description'];?>
                  </td>
                      <td class="hidden-xs">
                      <a class="btn btn-xs btn-default" href="<?php echo $link->link('edit_role',user,'&action_edit='.$role['id']);?>">Show Details</a>
                     </td>
                    </tr>
                   <?php }}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <button class="btn btn-success btn-block" type="submit" name="submit">Submit</button>
</form>
                     </div>

                      <div class="col-lg-6">
                      <!-- <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                      <div class="form-group">
                        <label class="control-label col-md-3">User Image</label>
                        <div class="col-md-4">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                            <?php if(file_exists(SERVER_ROOT.'/uploads/users/'.$user_id.'/'.$user_detail['user_photo_file']) && ($user_detail['user_photo_file']!=''))
                			{?>
                              <img src="<?php echo SITE_URL.'/uploads/users/'.$user_id.'/'.$user_detail['user_photo_file'];?>">
                             <?php }else{?>
							   <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                             <?php }?>
                            </div>
                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                            <div>
                              <span class="btn btn-default btn-file">
                              <span class="fileupload-new">Select image</span>
                              <span class="fileupload-exists">Change</span><input type="file" name="item"></span>
                              <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                            </div>
                          </div>
                        </div>
                      </div>

						 <button class="btn btn-success btn-block" type="submit" name="submit_image">Update Image</button>
					</form> -->

                       </div>
          </div>

          </div>

      </div>
   </div>
</div>
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