<?php

$user_detail=$db->get_all('users');

if(isset($_POST['submit']))
{

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $role_id=$_POST['role_id'];
    $pass=$_POST['newpassword'];
    $zipcode=$_POST['zipcode'];
    $country=$_POST['country'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $encrypt=$password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
	  $confirmpassword=$_POST['confirmpassword'];
    $mobile_number=$_POST['mobile_number'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $image = $_FILES['item'];
    $handle= new upload($_FILES['item']);
     $empt_fields = $fv->emptyfields(array('First Name'=>$firstname,
                                          'Last Name' =>$lastname,
                                          'Email'=>$email,
                                       'Role name should be selected'=>$role_id,
         'Password'=>$pass,
         'Confirm Password'=>$confirmpassword,
    ));
    if ($empt_fields)
    {
          $display_msg= '<div class="alert alert-danger">
    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
              Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }
    elseif(!$fv->check_email($email))
    {
         $display_msg='<div class="alert alert-danger">
		    <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×
	        </button><strong>Wrong email format</strong></div>';
    }
   elseif ($db->exists('users',array('email'=>$email)))
    {
         $display_msg='<div class="alert alert-danger">
		    <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×
	        </button><strong>Email Already Exists</strong></div>';

    }
    elseif($pass!=$confirmpassword)
    {
        $display_msg= '<div class="alert alert-danger ">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>Oops! Password Not Match.
		</div>';
    }
    elseif(($image['name']) != '')
    {
           if($role_id=='1'){
          $user_type_stu="admin";
        }
        else{
          $user_type_stu="user"; 
        }
        $insert=$db->insert('users',array('firstname'=>$firstname,
            'lastname'=>$lastname,
            'email'=>$email,
        	  'mobile'=>$mobile_number,
            'address'=>$address,
            'user_type'=>$user_type_stu,
            'role_id'=>$role_id,
            'password'=>$encrypt,
            'create_date'=>$created_date,
            'ip_address'=>$ip_address,
            'zipcode'=>$zipcode,
            'country'=>$country,
            'city'=>$city,
            'state'=>$state,
         ));

        /*entry in activity log table*/
        $event="New user ('.$firstname.') added successfully !";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
        		'event'=>$event,
        		'created_date'=>date('Y-m-d'),
        		'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));

        $last_insert_id=$db->insert_id;
        if($insert){
          $path=SERVER_ROOT.'/uploads/users/'.$last_insert_id.'/';

           if(!is_dir($path))
           {
               if(!file_exists($path))
               {
                   mkdir($path);
               }
           }
        $newfilename = $handle->file_new_name_body='user_'.time();
        $ext = $handle->image_src_type;
        $itemname = $newfilename.'.'.$ext;


        if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'JPEG' || $handle->image_src_type == 'png' || $handle->image_src_type == 'JPG')
        {
            if ($handle->uploaded)
            {
                $handle->Process($path);
                if ($handle->processed)
                {
                   $insert=$db->update('users',array('user_photo_file'=>$itemname),array('user_id'=>$last_insert_id));
                   /*entry in activity log table*/
                   $event="New user ('.$firstname.') added successfully !";
                   $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                   		'event'=>$event,
                   		'created_date'=>date('Y-m-d'),
                   		'ip_address'=>$_SERVER['REMOTE_ADDR']

                   ));


                    if ($insert)
                    {
                  $display_msg='<div class="alert alert-success ">
        			<button class="close" data-dismiss="alert" type="button">X</button>
        	<b><i class="fa fa-smile-o"></i>User is added successfully !</b>
        	</div>';
                        echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("users",user)."'
	                },3000);</script>";
                    }
                }
            }
        }

    }

    }
    else
    {
         if($role_id=='1'){
          $user_type_stu="admin";
        }
        else{
          $user_type_stu="user"; 
        }
        $insert=$db->insert('users',array('firstname'=>$firstname,
            'lastname'=>$lastname,
            'email'=>$email,
        	'mobile'=>$mobile_number,
            'address'=>$address,
            'user_type'=>$user_type_stu,
            'role_id'=>$role_id,
            'password'=>$encrypt,
            'create_date'=>$created_date,
            'ip_address'=>$ip_address,
            'zipcode'=>$zipcode,
            'country'=>$country,
            'city'=>$city,
            'state'=>$state,
         ));

        if ($insert)
        {

            $display_msg='<div class="alert alert-success ">
			<button class="close" data-dismiss="alert" type="button">X</button>
	<b><i class="fa fa-smile-o"></i>User is added successfully !</b>
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
         <h3>Add User</h3>
      </div>
      <div class="widget-container fluid-height">
      <form  action="" method="post" class="form-horizontal">
         <div class="widget-content padded">
           <a href="<?php echo $link->link('users',user);?>" class="btn btn-default pull-right">Back to List</a>
            <a href="<?php echo $link->link('add_user',user);?>" class="btn btn-default pull-right">Cancel</a>
            <button class="btn btn-primary pull-right" type="submit" name="submit">Submit</button>

<br><br><br>
           <div class="row">

             <div class="col-lg-6">
                 <div class="form-group" >
                           <label class="control-label col-md-3">First name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="firstname" value="">
                           </div>
                        </div>
                         <div class="form-group" >
                           <label class="control-label col-md-3">Email<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="email" value="">
                           </div>
                        </div>
                       <div class="form-group">
                 <label class="control-label col-md-3">Password</label>
                            <div class="col-md-7">
                              <input class="form-control"  name="newpassword" type="password" value="">
                            </div>
                          </div>
                 <div class="form-group">
                 <label class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-7">
                              <input class="form-control"  name="confirmpassword" type="password" value="">
                            </div>
                          </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">User Image</label>
                        <div class="col-md-4">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
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
                     </div>

                      <div class="col-lg-6">

                      <div class="form-group" >
                           <label class="control-label col-md-3">Last name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="lastname" value="">
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">Mobile Number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="mobile_number" value="">
                           </div>
                        </div>
                          <div class="form-group" >
                           <label class="control-label col-md-3">Address</label>
                           <div class="col-md-7">
                             <textarea class="form-control"  name="address"></textarea>
                           </div>
                        </div>
                        <div class="form-group" >
                           <label class="control-label col-md-3">Zipcode</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="zipcode" id="zipcode"/>
                           </div>
                        </div><div class="form-group" >
                           <label class="control-label col-md-3">Country</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="country" id="country"/>
                           </div>
                        </div><div class="form-group" >
                           <label class="control-label col-md-3">State</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="state" id="state"/>
                           </div>
                        </div><div class="form-group" >
                           <label class="control-label col-md-3">City</label>
                           <div class="col-md-7">
                             <input type="text" class="form-control"  name="city" id="city"/>
                           </div>
                        </div>
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
                       <label><input type="radio" name="role_id" value="<?php echo $role['id'];?>"></label>
                      </td>
                   <td width="20%">
                  	<?php echo $role['role'];?>
                  </td>
                  <td width="55%">
                  	<?php echo $role['description'];?>
                  </td>
                      <td class="hidden-xs">
                      <a class="btn btn-xs btn-default" href="<?php echo $link->link('user_roles',user);?>">Show Details</a>
                     </td>
                    </tr>
                   <?php }}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
          </div>
         </form>
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