
<?php
	if ($_REQUEST['tab']=='active'){
	    $db->order_by="id DESC";
		$contact_detail=$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
	}
	elseif ($_REQUEST['tab']=='inactive'){
	    $db->order_by="id DESC";
		$contact_detail=$db->get_all('contacts',array('visibility_status'=>'inactive','is_supplier'=>'yes'));
	}
	else {
	    $db->order_by="id DESC";
		$contact_detail=$db->get_all('contacts',array('is_supplier'=>'yes'));
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
        $display_name=$db->get_var('contacts',array('id'=>$_POST['del_id']),'display_name');
        $event="Delete Contact  (" . $display_name . ") with id no " . $_POST['del_id'];
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('contacts',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Contact Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("suppliers",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('suppliers',user);
    }

}
elseif (isset($_REQUEST['action_active']))
{
    $action_id=$_REQUEST['action_active'];
    $update=$db->update('contacts',array('visibility_status'=>'active'),array('id'=>$action_id));
    if ($update)
    {
        $display_name=$db->get_var('contacts',array('id'=>$action_id),'display_name');
        $event="Status change to active of contact  (" . $display_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Contact Active Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("suppliers",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_inactive']))
{
    $action_id=$_REQUEST['action_inactive'];
    $update=$db->update('contacts',array('visibility_status'=>'inactive'),array('id'=>$action_id));
    if ($update)
    {
        $display_name=$db->get_var('contacts',array('id'=>$action_id),'display_name');
        $event="Status change to inactive of contact  (" . $display_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Contact Inactive Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("suppliers",user)."'
        	                },3000);</script>";
    }
}
?>


<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>CONTACTS</h3>
				</div>
				<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">


               <div class="row">
	<div class="col-lg-12">
	<?php  $tab_name=$_REQUEST['contact_type'];
	$current_tab=$_REQUEST['tab'];?>
	<a href="<?php echo $link->link('contacts',user);?>" class="btn btn-default"> Customers </a>
	<a href="<?php echo $link->link('suppliers',user);?>" class="btn btn-primary"> Suppliers </a>
	<!--<a href="<?php echo $link->link('contacts',user);?>" class="btn btn-default"> Super funds </a>
	 <a href="<?php echo $link->link('contacts',user,'&contact_type=employees');?>" class="btn btn-primary"> Employees </a> -->
<?php if(in_array('create_and_edit',$con_cintact)){?>
	<a href="<?php echo $link->link('add_contact',user);?>" class="btn btn-default pull-right"> Add Suppliers</a>
<?php }?>
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="<?php if ($current_tab=="active"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('suppliers',user,'&tab=active');?>"><i class="icon-comments"></i><span>Active</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="inactive"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('suppliers',user,'&tab=inactive');?>"><i class="icon-user"></i><span>Inactive</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="all" || $current_tab==""){echo"active";}?>">
	                        <a  href="<?php echo $link->link('suppliers',user,'&tab=all');?>"><i class="icon-user"></i><span>All</span></a>
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
					                    <th>
                                     Reference
					                    </th>
					                    <th class="hidden-xs">
					                    Company Name
					                    </th>
					                    <th>
					                    <?php
					                    echo ucfirst($tab_name) ." " ."Name";
					                      ?>
					                    </th>
					                    <th class="hidden-xs">
					                   First Name
					                    </th>
					                    <th class="hidden-xs">
					                   Last Name
					                    </th>
					                   <th class="hidden-xs">
					                    Email Address
					                    </th>
					                     </th>
					                     <th class="hidden-xs">
					                  Billing Address
					                    </th>
					                    <th class="hidden-xs">
					                  City
					                    </th>
					                    <th class="hidden-xs">
					                  State
					                    </th>
					                    <th class="hidden-xs">
					                  Zip
					                    </th>
					                    <th>Action</th></tr>
					                  </thead>
					                  <tbody>
					                   <?php
                                            if (is_array($contact_detail)){
                                                $sn=1;

                                            foreach ($contact_detail as $value){?>
					                    <tr>
					                      <td class="check hidden-xs">
					                        <?php echo $sn;?>
					                      </td>
					                      <td>
					                         <?php if($value['contact_is']==business){
					                    echo $value['business_name'];
					                  }
					                  else{
					                      echo $value['display_name'];
					                  }
					                  ?>
					                      </td>
					                        <td class="hidden-xs">
					                        <?php echo ucfirst($value['company_name']);?>
					                      </td>
					                      <td>
					                       <?php echo $value['display_name'];?>
					                      </td>
					                      <td class="hidden-xs">
					                        <?php echo $value['business_name'];?>
					                      </td>
					                      <td class="hidden-xs">
					                        <?php echo $value['display_name'];?>
					                      </td>
					                     <td>
					                       <?php echo $value['email'];?>
					                      </td>
					                           <td class="hidden-xs">
					                         <?php
					                         if($value['postal_address']!='')
					                         {
					                             echo $value['postal_address'];
					                         }?>
					                         </td>
					                       <td class="hidden-xs">
					                         <?php
					                          if($value['postal_address_town']!='')
					                         {
					                            echo $value['postal_address_town'];
					                         }?>
					                         </td>
					                       <td class="hidden-xs">
					                         <?php
					                        /*if($value['postal_address_suburb']!='')
					                         {
					                             echo "Suburb : " .$value['postal_address_suburb'];
					                         }*/
					                        if($value['postal_address_state']!='')
					                         {
					                              echo $value['postal_address_state'];
					                         }?>
					                         </td>
					                       <td class="hidden-xs">
					                         <?php
					                         if($value['postal_address_postcode']!='')
					                         {
					                              echo $value['postal_address_postcode'];
					                         }

					                        ?>
                               </td>


					                      <td>  <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                            	      <?php if(in_array('create_and_edit',$con_cintact)){?>
                                            	<li>
                                            <a href="<?php echo $link->link('edit_contact',user,'&contact_id='.$value['id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                              </li>
                                                <?php }if(in_array('delete',$con_cintact)){?>
                                            <li>
                                            <a href="<?php echo $link->link('suppliers',user,'&action_delete='.$value['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>
                                              <?php }?>
                                                <li>
                                                <?php if ($value['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('suppliers',user,'&action_active='.$value['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('suppliers',user,'&action_inactive='.$value['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
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