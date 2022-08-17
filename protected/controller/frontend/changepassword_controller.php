<?php
if(isset($_POST[submit_changepassword]))
{
	$oldpassword=$_POST['oldpassword'];
	$pass=$_POST['newpassword'];
	$confirmpassword=$_POST['confirmpassword'];
    $verify_pass=$password->verify($oldpassword,$user_details['password'],PASSWORD_DEFAULT);
   if(!$verify_pass)
    {
	$display_msg='<div class="alert alert-danger">
	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>Alert! Wrong OldPassword.
	</div>';
    }
   elseif($fv->emptyfields(array(password=>$oldpassword),NULL))
	{
		$display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>Oops! OldPassword Field Is Empty.
		</div>';
	}
	elseif($fv->emptyfields(array(password=>$pass),NULL))
	{
		$display_msg= '<div class="alert alert-danger ">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>Oops! NewPassword Field Is Empty.
		</div>';
	}
	elseif($pass!=$confirmpassword)
	{
		$display_msg= '<div class="alert alert-danger ">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>Oops! Password Not Match.
		</div>';
	}
	else
	{
		$encrypt_password = $password->hashBcrypt( $pass, '10', PASSWORD_DEFAULT) ;
		$update=$db->update('users',array('password'=>$encrypt_password),array('user_id'=>$_SESSION['user_id']));
		/*entry in activity log table*/
		$event="Change password";
		$db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
		    'event'=>$event,
		    'created_date'=>date('Y-m-d'),
		    'ip_address'=>$_SERVER['REMOTE_ADDR']

		));
	}
	if($update)
	{
		$display_msg='<div class="alert alert-success ">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button>Success! Password Has Changed.
		</div>';
	}
}
?>