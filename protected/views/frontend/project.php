<?php
$current_tab=$_COOKIE['current_tab'];

if ($current_tab!="active" && $current_tab!="inactive" && $current_tab!="all")
{
    $current_tab="";
}

if ($current_tab=="active" || $current_tab==""){
    $db->order_by="id DESC";
$all_project=$db->get_all('projects',array('visibility_status'=>'active'));
}
elseif ($current_tab=="inactive")
{
    $db->order_by="id DESC";
    $all_project=$db->get_all('projects',array('visibility_status'=>'inactive'));

}elseif($current_tab=="all"){
    $db->order_by="id DESC";
        $all_project=$db->get_all('projects');
}
?>
<?php
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
        $project_name=$db->get_var('projects',array('id'=>$_POST['del_id']),'project_name');
        $event="Delete Project (" . $project_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete_project=$db->delete('projects',array('id'=>$delete_id));

        if ($db->exists('assign_customer_project',array('project_id'=>$delete_id))){

    	     $delete_customer_project=$db->delete('assign_customer_project',array('project_id'=>$delete_id));
         }
         if ($db->exists('assign_supplier_project',array('project_id'=>$delete_id))){

             $delete_supplier_project=$db->delete('assign_supplier_project',array('project_id'=>$delete_id));
         }
         if ($db->exists('assign_item_project',array('project_id'=>$delete_id))){

             $delete_item_project=$db->delete('assign_item_project',array('project_id'=>$delete_id));
         }
       //$db->debug();
        if($delete_project)
        {

            $display_msg='<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('project',user);
    }

}
elseif (isset($_REQUEST['action_active']))
{
    $action_id=$_REQUEST['action_active'];
    $update=$db->update('projects',array('visibility_status'=>'active'),array('id'=>$action_id));

    $update_assign_customer_project=$db->update('assign_customer_project',array('visibility_status'=>'active'),array('project_id'=>$action_id));
    $update_assign_supplier_project=$db->update('assign_supplier_project',array('visibility_status'=>'active'),array('project_id'=>$action_id));

    if ($update)
    {
        $project_name=$db->get_var('projects',array('id'=>$action_id),'project_name');
        $event="Status change to active of project  (" . $project_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Active Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_inactive']))
{
    $action_id=$_REQUEST['action_inactive'];
    $update=$db->update('projects',array('visibility_status'=>'inactive'),array('id'=>$action_id));

    $update_assign_customer_project=$db->update('assign_customer_project',array('visibility_status'=>'inactive'),array('project_id'=>$action_id));
    $update_assign_supplier_project=$db->update('assign_supplier_project',array('visibility_status'=>'inactive'),array('project_id'=>$action_id));

    if ($update)
    {
        $project_name=$db->get_var('projects',array('id'=>$action_id),'project_name');
        $event="Status change to inactive of project  (" . $project_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Inactive Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_running']))
{
    $action_id=$_REQUEST['action_running'];
    $update=$db->update('projects',array('project_status'=>'running'),array('id'=>$action_id));
    if ($update)
    {
        $project_name=$db->get_var('projects',array('id'=>$action_id),'project_name');
        $event="Status change to running of project  (" . $project_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Update Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_completed']))
{
    $action_id=$_REQUEST['action_completed'];
    $update=$db->update('projects',array('project_status'=>'completed'),array('id'=>$action_id));
    if ($update)
    {
        $project_name=$db->get_var('projects',array('id'=>$action_id),'project_name');
        $event="Status change to completed of project  (" . $project_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Update Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_cancelled']))
{
    $action_id=$_REQUEST['action_cancelled'];
    $update=$db->update('projects',array('project_status'=>'cancelled'),array('id'=>$action_id));
    if ($update)
    {
        $project_name=$db->get_var('projects',array('id'=>$action_id),'project_name');
        $event="Status change to cancelled of project  (" . $project_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Update Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
    }
}
?>
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>PROJECTS</h3>
				</div>
				<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">



               <div class="row">
<?php if(in_array('create_and_edit',$dtd_projects)){?>
   <a href="<?php echo $link->link('add_project',user);?>" class="btn btn-default pull-right"> Add Project</a>
   <?php }?>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li tab="active"  class="set_cookie <?php if ($current_tab=="active" || $current_tab==""){echo"active";}?>">
	                        <a  href="#"><i class="icon-comments"></i><span>Active</span></a>
	                      </li>

	                      <li tab="inactive"  class="set_cookie <?php if ($current_tab=="inactive"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Inactive</span></a>
	                      </li>
	                      <li tab="all"  class="set_cookie <?php if ($current_tab=="all"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>All</span></a>
	                      </li>
	                     </ul>
	                  </div>

					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">

					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
					                    <th width="5%">
					                      S.no
					                    </th>
					                    <th width="25%"> Name</th>
					                    <th width="15%">Start Date</th>
					                    <th width="15%">End Date</th>
					                    <th width="15%">Project Status</th>
					                    <th width="15%">Action</th>
					                  </tr>
					                  </thead>
					                  <tbody>
					                  <?php if (is_array($all_project)){
					                      $sn=1;
					                      foreach ($all_project as $allp){?>


					                    <tr>
					                      <td class="check hidden-xs">
					                       <?php echo $sn;?>
					                      </td>
					                      <td><?php echo $allp['project_name']; ?></td>
					                      <td><?php if ($allp['start_date']!="") {echo date(DATE_FORMAT,strtotime($allp['start_date'])); }?></td>
					                      <td><?php if ($allp['end_date']!="") {echo date(DATE_FORMAT,strtotime($allp['end_date'])); }?></td>

					                      <td>
					                       <?php if ($allp['project_status']=="running"){?>
                                                <span class="label label-info" ><?php echo  ucfirst($allp['project_status']);?></span>
                                                <?php }elseif ($allp['project_status']=="completed")
                                                {?>
                                                    <span class="label label-success" ><?php echo  ucfirst($allp['project_status']);?></span>
                                                <?php }elseif ($allp['project_status']=="cancelled")
                                                {?>
                                                    <span class="label label-danger" ><?php echo  ucfirst($allp['project_status']);?></span>
                                               <?php }?>
					                      </td>
					                       <td>  <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <?php if(in_array('delete',$dtd_projects)){?>
                                            <li>
                                            <a href="<?php echo $link->link('project',user,'&action_delete='.$allp['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>

                                              <li>
                                            <a href="<?php echo $link->link('edit_project',user,'&action_edit='.$allp['id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                              </li>

                                              <?php }?>
                                                <li>
                                                <?php if ($allp['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('project',user,'&action_active='.$allp['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('project',user,'&action_inactive='.$allp['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
                                              </li>
                                                <li>
                                                <a href="<?php echo $link->link('project',user,'&action_running='.$allp['id']);?>"><i class="fa fa-edit"></i>Running</a>
                                                 <a href="<?php echo $link->link('project',user,'&action_completed='.$allp['id']);?>"><i class="fa fa-edit"></i>Completed</a>
                                                 <a href="<?php echo $link->link('project',user,'&action_cancelled='.$allp['id']);?>"><i class="fa fa-edit"></i>Cancelled</a>
                                              </li>

                                            </ul>
                                          </div><?php echo $allp['visibility_status'];?>
                                          </td>
					                    </tr>
					                    <?php $sn++; }}?>

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
<script>
      $(".set_cookie").click(function(){
          var tab=$(this).attr('tab');
        //  alert(tab);

          var ct=document.cookie = "current_tab="+tab;
          window.location.href="";

          });</script>