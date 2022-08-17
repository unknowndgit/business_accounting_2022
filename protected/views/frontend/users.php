<?php

	$users=$db->get_all('users');
	if(isset($_REQUEST['action_delete']))
	{
	    $delete_id=$_REQUEST['action_delete'];

	    $display_msg='<form method="POST" action="">
    <div class="alert alert-danger">
    <button class="close" data-dismiss="alert" type="button">×</button>
	Are you sure ? You want to delete this .
	<input type="hidden" name="del_id" value="'.$delete_id.'" >
	<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="lnr lnr-checkmark-circle"></i></button>
	<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="lnr lnr-cross-circle"></i></button>
	</div>
	</form>';
	    if(isset($_POST['yes']))
	    {
	        $delete=$db->delete('users',array('user_id'=>$_POST['del_id']));
	        if($delete)
	        {

	            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Role Delete Successfully.
                		</div>';
	            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("users",user)."'
        	                },3000);</script>";
	        }
	    }
	    elseif(isset($_POST['no']))
	    {
	        $session->redirect('users',user);
	    }

	}
?>
	  <div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
	<?php echo $display_msg;?>
	<h3>USERS AND ROLES </h3></div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">

	<div class="col-lg-12">
    <?php  $current_tab=$_REQUEST['tab'];?>


	<a href="<?php echo $link->link('users',user);?>" class="btn <?php if ($query1ans=="users"){echo "btn-primary";}else{echo "btn-default";}?> ">Users</a>
	<a href="<?php echo $link->link('user_roles',user);?>" class="btn <?php if ($query1ans=="user_roles"){echo "btn-primary";}else{echo "btn-default";}?>">Roles</a>
	<?php if(in_array('create_and_edit',$adm_users)){?>
	<a href="<?php echo $link->link('add_user',user);?>" class="btn btn-default pull-right"> Add New Users</a>
	<?php }?>
   </div>
	</div>


					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">

					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
					                    <th>User Name</th>
					                    <th class="hidden-xs">Roles</th>
					                      <th>Email ID</th>
					                       <th>Address</th>
					                       <?php
					                      	if ($_SESSION['user_type']=='admin'){ ?><th></th><?php }?>
					                   </tr>
					                  </thead>
					                  <tbody>
					                     <?php
                    			if (is_array($users)) {
                    				foreach ($users as $user) {?>
					                    <tr>
					                      <td>
					                      	<?php echo $user['firstname'].''.$user['lastname'];?>
					                      </td>
					                      <td>
					                      	<?php
					                      $role=$db->get_var('roles',array('id'=>$user['role_id']),'role');

					                      	echo ucfirst($role);?>
					                      </td>
					                      <td>
					                      <?php echo $user['email'];?></td>
					                     <td>
					                      <?php echo $user['address'];?></td>
					                      <?php
					                      	if ($_SESSION['user_type']=='admin'){ ?>
					                      <td>
					                      <?php
					                      // if(in_array('create_and_edit',$adm_users) && $_SESSION['user_id']==$user['user_id']){?>
					                      <a href="<?php echo $link->link('edit_user',user,'&action_edit='.$user['user_id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                           <?php //}?>
					                       <?php //if(in_array('delete',$adm_users) && $_SESSION['user_id']==$user['user_id']){
					                       if ($user['user_id']!=1){?>
					                       &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $link->link('users',user,'&action_delete='.$user['user_id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                           <?php } ?>
					                      </td>
					                      <?php }?>
					                    </tr>
					                     <?php }}?>
					             </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>
					                    </div>
        </div>
    </div>
</div>