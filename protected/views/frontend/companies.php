
<?php
	if ($_REQUEST['tab']=='active'){
	    $db->order_by="company_name ASC";
		$company_detail=$db->get_all('companies',array('visibility_status'=>'active'));
	}
	elseif ($_REQUEST['tab']=='inactive'){
	    $db->order_by="company_name ASC";
		$company_detail=$db->get_all('companies',array('visibility_status'=>'inactive'));
	}	
	else {
	    $db->order_by="company_name ASC";
		$company_detail=$db->get_all('companies');
	}
?>

<?php
if(isset($_REQUEST['action_delete']))
{
    $delete_id=$_REQUEST['action_delete'];

    $display_msg='<form method="POST" action="">
    <div class="alert alert-danger">
    <button class="close" data-dismiss="alert" type="button">�</button>
	Are you sure ? You want to delete this .
	<input type="hidden" name="del_id" value="'.$delete_id.'" >
	<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="lnr lnr-checkmark-circle"></i></button>
	<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="lnr lnr-cross-circle"></i></button>
	</div>
	</form>';
    if(isset($_POST['yes']))
    {
       $company_name=$db->get_var('companies',array('id'=>$_POST['del_id']),'company_name');
        $event="Delete Company  (" . $company_name . ") with id no " . $_POST['del_id'];
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                                          'event'=>$event,
                                          'created_date'=>date('Y-m-d'),
                                          'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('companies',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">�</button>
                    Company Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("companies",user)."'
        	                },1500);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('companies',user);
    }

}
elseif (isset($_REQUEST['action_active']))
{
    $action_id=$_REQUEST['action_active'];
    $update=$db->update('companies',array('visibility_status'=>'active'),array('id'=>$action_id));
    if ($update)
    {
        $display_name=$db->get_var('companies',array('id'=>$action_id),'display_name');
        $event="Status change to active of company  (" . $display_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">�</button>
                    Company Active Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("companies",user)."'
        	                },1500);</script>";
    }
}
elseif (isset($_REQUEST['action_inactive']))
{
    $action_id=$_REQUEST['action_inactive'];
    $update=$db->update('companies',array('visibility_status'=>'inactive'),array('id'=>$action_id));
    if ($update)
    {
        $display_name=$db->get_var('companies',array('id'=>$action_id),'display_name');
        $event="Status change to inactive of company  (" . $display_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">�</button>
                    Company Inactive Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("companies",user)."'
        	                },1500);</script>";
    }
}
?>


<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>COMPANIES</h3>
				</div>
				<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">


               <div class="row">
	<div class="col-lg-12">
	<?php  $tab_name=$_REQUEST['contact_type'];
	$current_tab=$_REQUEST['tab'];?>		
	<?php //if(in_array('create_and_edit',$con_cintact)){?>
	
	<a href="<?php echo $link->link('add_company',user);?>" class="btn btn-default pull-right"> Add Company</a>
 <?php //}?>
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="<?php if ($current_tab=="active"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('companies',user,'&tab=active');?>"><i class="icon-comments"></i><span>Active</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="inactive"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('companies',user,'&tab=inactive');?>"><i class="icon-user"></i><span>Inactive</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="all" || $current_tab==""){echo"active";}?>">
	                        <a  href="<?php echo $link->link('companies',user,'&tab=all');?>"><i class="icon-user"></i><span>All</span></a>
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
					                    <th class="check-header hidden-xs">
					                      S.no
					                    </th>
					                   	<th class="hidden-xs">
					                    Company Name
					                    </th>               
					                   	<th class="hidden-xs">
					                    Phone
					                    </th>               
					                   	<th class="hidden-xs">
					                    Address
					                    </th>               
					                   	<th class="hidden-xs">
					                    City
					                    </th>               
					                   	<th class="hidden-xs">
					                    State
					                    </th>               
					                   	               
					                    <th>Action</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                   <?php
                                            if (is_array($company_detail)){
                                                $sn=1;

                                            foreach ($company_detail as $value){?>
					                    <tr>
					                      <td class="check hidden-xs">
					                        <?php echo $sn;?>
					                      </td>

					                      <td class="hidden-xs">
					                        <?php echo ucfirst($value['company_name']);?>
					                      </td>
                                          
					                      <td class="hidden-xs">
					                        <?php echo $value['phone1'];?>
					                      </td>
                                          
					                      <td class="hidden-xs">
					                        <?php echo $value['address'];?>
					                      </td>
					                      <td class="hidden-xs">
					                        <?php echo $value['city'];?>
					                      </td>
					                      <td class="hidden-xs">
					                        <?php echo $value['state'];?>
					                      </td>
					                      					                       
					                      <td>  
					                      	<div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                            <?php //if(in_array('create_and_edit',$con_cintact)){?>
                                            	<li>
                                            <a href="<?php echo $link->link('edit_company',user,'&company_id='.$value['id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                              </li>
                                                <?php //}if(in_array('delete',$con_cintact)){?>
                                            <li>
                                            <a href="<?php echo $link->link('companies',user,'&action_delete='.$value['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>
                                              <?php //}?>
                                                <li>
                                                <?php if ($value['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('companies',user,'&action_active='.$value['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('companies',user,'&action_inactive='.$value['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
                                              </li>
                                            </ul>
                                          </div></td>

					                    </tr>
					                   <?php $sn++;}}?>
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