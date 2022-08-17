<?php
if(isset($_POST['submit_profile']))
{
	$firstname=$_POST['f_name'];
	$lastname=$_POST['l_name'];

	$address=$_POST['address'];
	$country=$_POST['country'];
	$zipcode=$_POST['zipcode'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$profilepic=$_FILES['profilepic'];



	    if($profilepic['name']!=''){
	$handle= new upload($_FILES['profilepic']);
	$path = SERVER_ROOT.'/uploads/users/'.$_SESSION['user_id'].'/';
	if(!is_dir($path))
	{
		if(!file_exists($path)){
			mkdir($path);
		}
	}

	if(file_exists(SERVER_ROOT.'/uploads/users/'.$_SESSION['user_id'].'/'.$user_details['user_photo_file']) && (($user_details['user_photo_file'])!=''))
	{
		unlink(SERVER_ROOT.'/uploads/users/'.$_SESSION['user_id'].'/'.$user_details['user_photo_file']);
	}
	$newfilename = $handle->file_new_name_body= time();
	$ext = $handle->image_src_type;
	$filename = $newfilename.'.'.$ext;
	//$file_size = $_FILES ['file'] ['size'] / 1024;

	if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png' )
	{
		if ($handle->uploaded) {
			$handle->Process($path);
			if ($handle->processed)
			{
				$update=$db->update('users',array('firstname'=>$firstname,'lastname'=>$lastname,'user_photo_file'=>$filename,'address'=>$address,'zipcode'=>$zipcode,'country'=>$country,'city'=>$city,'state'=>$state),array('user_id'=>$_SESSION['user_id']));
				/*entry in activity log table*/
				$event="Update profile and Change profile image";
				$db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
				    'event'=>$event,
				    'created_date'=>date('Y-m-d'),
				    'ip_address'=>$_SERVER['REMOTE_ADDR']

				));
			}
		}
	}}
	else
	{
	    $update=$db->update('users',array('firstname'=>$firstname,'lastname'=>$lastname,'address'=>$address,'zipcode'=>$zipcode,'country'=>$country,'city'=>$city,'state'=>$state),array('user_id'=>$_SESSION['user_id']));
	    /*entry in activity log table*/
	    $event="Update profile";
	    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	        'event'=>$event,
	        'created_date'=>date('Y-m-d'),
	        'ip_address'=>$_SERVER['REMOTE_ADDR']

	    ));
	}

	if($update)
	{
		$display_msg='<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button>Success! Data Updated.
		</div>';

		echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("profile",user)."'
	                },3000);</script>";
}}
?>