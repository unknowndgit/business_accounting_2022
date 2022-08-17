<?php
	$roles=$db->get_all('roles');
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
	        $role_name=$db->get_var('roles',array('id'=>$_POST['del_id']),'role');
	        $event="Delete user role (" .$role_name . ")";
	        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	            'event'=>$event,
	            'created_date'=>date('Y-m-d'),
	            'ip_address'=>$_SERVER['REMOTE_ADDR']

	        ));
	        $delete=$db->delete('roles',array('id'=>$_POST['del_id']));
	        if($delete)
	        {


	            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Role Delete Successfully.
                		</div>';
	            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("user_roles",user)."'
        	                },3000);</script>";
	        }
	    }
	    elseif(isset($_POST['no']))
	    {
	        $session->redirect('user_roles',user);
	    }

	}
?>
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>USERS AND ROLES</h3></div>
<?php echo $display_msg;?>
    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">

	<div class="col-lg-12">
    <?php  $current_tab=$_REQUEST['tab'];?>


	<a href="<?php echo $link->link('users',user);?>" class="btn <?php if ($query1ans=="users"){echo "btn-primary";}else{echo "btn-default";}?> ">Users</a>
	<a href="<?php echo $link->link('user_roles',user);?>" class="btn <?php if ($query1ans=="user_roles"){echo "btn-primary";}else{echo "btn-default";}?>">Roles</a>
	<?php if(in_array('create_and_edit',$adm_roles)){?>
	<a href="<?php echo $link->link('add_roles',user);?>" class="btn btn-default pull-right"> Add Role</a>
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
					                    <th class="check-header hidden-xs">
					                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
					                    </th>
					                    <th width="30%">Role</th>
					                    <th width="30%">Description</th>
					                    <th class="hidden-xs">Users</th>
					                   <th class="hidden-xs"></th>
					                  </tr>
					                  </thead>
					                  <tbody>
					        <?php
                    			if (is_array($roles)) {
                    				foreach ($roles as $role) { ?>
					                    <tr>
					                      <td class="check hidden-xs">
					                       <!-- <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label> -->
					                      </td>
					                      <td>
					                      	<?php echo $role['role'];?>
					                      </td>
					                      <td>
					                      	<?php echo $role['description'];?>
					                      		<br>
					                      		<?php
					                      			//if (is_array()) {

					                      			//}
					                      		?>
					                      </td>
					                      <td class="hidden-xs">1</td>
					                      <td>
					                      <?php if(in_array('create_and_edit',$adm_roles)){?>
					                      <a href="<?php echo $link->link('edit_role',user,'&action_edit='.$role['id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                           <?php }?>
                                           <?php /*if ($role['id']!='1'){?>
					                       <?php if(in_array('delete',$adm_roles)){?>
					                     &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo $link->link('user_roles',user,'&action_delete='.$role['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                           <?php }}*/?>

					                      </td>

					                     </tr>
					        <?php }
                    			}
                    		?>
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