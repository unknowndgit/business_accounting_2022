<?php
if (isset($_REQUEST['action_active']))
	{
	    $action_id=$_REQUEST['action_active'];
	    $update=$db->update('tax',array('visibility_status'=>'active'),array('id'=>$action_id));
	    if ($update)
	    {
	        $tax_name=$db->get_var('tax',array('id'=>$action_id),'tax_name');
	        $event="Status Change to active of tax " .$tax_name ;
	        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	            'event'=>$event,
	            'created_date'=>date('Y-m-d'),
	            'ip_address'=>$_SERVER['REMOTE_ADDR']

	        ));
	        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Active Successfully.
                		</div>';
	        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("tax_setting_view_tax_code",user)."'
        	                },3000);</script>";
	    }
	}
	elseif (isset($_REQUEST['action_inactive']))
	{
	    $action_id=$_REQUEST['action_inactive'];
	    $update=$db->update('tax',array('visibility_status'=>'inactive'),array('id'=>$action_id));
	    if ($update)
	    {
	        $tax_name=$db->get_var('tax',array('id'=>$action_id),'tax_name');
	        $event="Status Change to inactive of tax " .$tax_name ;
	        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	            'event'=>$event,
	            'created_date'=>date('Y-m-d'),
	            'ip_address'=>$_SERVER['REMOTE_ADDR']

	        ));
	        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Inactive Successfully.
                		</div>';
	        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("tax_setting_view_tax_code",user)."'
        	                },3000);</script>";
	    }
	}
?>

<?php
if (isset($_REQUEST['make_tax_default']))
{
    $actionid=$_REQUEST['make_tax_default'];
    $db->run("update `tax` set `default_tax_code` = case when `id` != '$actionid' then '0' when `id`= '$actionid' then '1' end");

    $tax_name=$db->get_var('tax',array('id'=>$actionid),'tax_name');
    $event="Tax " . $tax_name . " Set as default tax";
    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
        'event'=>$event,
        'created_date'=>date('Y-m-d'),
        'ip_address'=>$_SERVER['REMOTE_ADDR']

    ));
    $session->redirect('tax_setting_view_tax_code',user);

}
if (isset($_REQUEST['tab']) && $_REQUEST['tab']=="inactive")
{
    $alltax=$db->get_all('tax',array('visibility_status'=>'inactive'));
}
else
{
    $alltax=$db->get_all('tax',array('visibility_status'=>'active'));
}

if(isset($_REQUEST['tax_delete']))
{
    $delete_id=$_REQUEST['tax_delete'];

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
        $delete=$db->delete('tax',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("tax_setting_view_tax_code",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('tax_setting_view_tax_code',user);
    }

}

?>


<div class="row">

	<div class="col-lg-12">
	<?php echo $display_msg;?>
	<div class=" padded" >
					<h3>TAX SETTINGS</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">



               <div class="row">
	<div class="col-lg-12">
		  <?php  $current_tab=$_REQUEST['tab'];?>

	    <!-- <a href="<?php echo $link->link('tax_setting_view_tax',user);?>" class="btn btn-primary"> Tax codes</a>
	    <a href="" class="btn btn-primary"> General </a>
           <a href="" class="btn btn-primary">BAS details</a>
       <a href="<?php echo $link->link('tax_setting_general',user);?>" class="btn <?php if ($query1ans=="buying_bills"){echo "btn-primary";}else{echo "btn-default";}?> ">General</a>
	<a href="<?php echo $link->link('tax_setting_view_tax_code',user);?>" class="btn <?php if ($query1ans=="tax_setting_view_tax_code"){echo "btn-primary";}else{echo "btn-default";}?>">Tax Codes</a>
       -->
       	<?php if(in_array('edit',$adm_tax_settings)){?>
       <a href="<?php echo $link->link('tax_setting_add_tax',user);?>" class="btn btn-default pull-right"> Add Tax </a>
         <?php }?>
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="<?php if ($current_tab=="active" || $current_tab==""){echo"active";}?>">
	                        <a  href="<?php echo $link->link('tax_setting_view_tax_code',user,'&tab=active');?>"><i class="icon-comments"></i><span>Active</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="inactive"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('tax_setting_view_tax_code',user,'&tab=inactive');?>"><i class="icon-user"></i><span>Inactive</span></a>
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
										<th>S.No</th>
					                    <th>Name</th>
					                   <th class="hidden-xs">
					                     Description
					                    </th>
					                       <th class="hidden-xs">
					                     Tax rate
					                    </th>
                               <th class="hidden-xs">

					                    </th>
                              </tr>
					                  </thead>
					                  <tbody>
					                  <?php if (is_array($alltax)){
					                  		$sn=1;
					                      foreach ($alltax as $allt){
					                  ?>
					                    <tr>
					                      <td class="check hidden-xs">
					                        <?php echo $sn; $sn++;?>
					                      </td>
                               <td class="hidden-xs"><?php echo $allt['tax_name'];?></td>
					                      <td class="hidden-xs"><?php echo $allt['tax_description'];?></td>
					                        <td class="hidden-xs"><?php echo $allt['tax_rate'];?>%</td>
                                             <td>
                                           <?php if ($allt['default_tax_code']==1){echo "<span class='label label-success'><i class='lnr lnr-checkmark-circle'></i> Default Tax</span>";}
                          else{?><a class="table-actions" href="<?php echo $link->link('tax_setting_view_tax_code',user,'&make_tax_default='.$allt['id']);?>"> Set Default</a>
                          <?php }?>

                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                            	<?php if(in_array('edit',$adm_tax_settings)){?>
                                            	 <li>
                                            <a href="<?php echo $link->link('tax_setting_edit_tax',user,'&tax_id='.$allt['id'].'&tax_type='.$allt['tax_type']);?>"><i class="fa fa-edit"></i>Edit</a>
                                              </li>
                                              <?php }?>
                                               <!-- <li>
                                                <a href="<?php echo $link->link('tax_setting_view_tax_code',user,'&tax_delete='.$allt['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                                  </li>-->
                                                <li>
                                                <?php if ($allt['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('tax_setting_view_tax_code',user,'&action_active='.$allt['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('tax_setting_view_tax_code',user,'&action_inactive='.$allt['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
                                              </li>

                                            </ul>
                                          </div></td>


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


<!-- ------------------ Modal Box To add activity-------------------- -->

                <div class="modal fade" id="add_advisor_activity" >
                  <div class="modal-dialog" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title"><strong>New activity statement</strong></h4>
                      </div>
                      <div class="modal-body">
                        <p>
                          <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
							 <div class="row">
							<div class="col-md-12">
							 <h4 class="modal-title"><strong>New activity statement</strong></h4>
							 <br>
							 <br>
							<h5>Please select the following options for this report:</h5>
                            <div class="form-group">
				 			<label class="control-label col-md-3">Reporting period:
				 			</label>
				            <div class="col-md-9">
				            <select class="form-control" name="payment_term">
				             <option value="0" selected="selected"></option>
				           <option value="1">Quarter 4 - April to June 2016</option>
				           <option value="2">Quarter 3 - 07 January to 31 March 2012</option>
				           <option value="3">Quarter 4 - April to June 2012</option>
				           <option value="4">Quarter 1 - July to September 2012</option>
				           <option value="5">Quarter 2 - October to December 2012</option>
				           <option value="6">Quarter 3 - January to March 2013</option>
				           <option value="7">Quarter 4 - April to June 2013</option>
				           <option value="8">Quarter 1 - July to September 2013</option>
				           <option value="9">Quarter 2 - October to December 2013</option>
				           <option value="10">Quarter 3 - January to March 2014</option>
				         </select>
				            </div>
				          </div>
				           <div class="form-group">
                                        <label class="control-label col-md-3">Is amendment:</label>
                                        <div class="col-md-9">
                                          <label class="radio-inline">
                                          <input   name="optionsRadios2" type="radio" value="option1">
                                          <span>Yes</span>
                                          </label>
                                          <label class="radio-inline">
                                          <input checked="" name="optionsRadios2" type="radio" value="option2">
                                          <span>No</span>
                                          </label>

                                        </div>
                                      </div>
                                       <div class="form-group">
                                        <label class="control-label col-md-3">Document ID:</label>
                                        <div class="col-md-9">
                                          <input class="form-control" placeholder="" type="text">
                                        </div>
                                      </div>
                                       <div class="form-group">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                          <textarea class="form-control" rows="5"></textarea>
                                        </div>
                                      </div>

                                             <div class="form-group">
                                        <label class="control-label col-md-7"></label>
                                        <div class="col-md-5">
                                          <button class="btn btn-success" type="submit">Submit</button>
                                          <button class="btn btn-default-outline">Cancel </button>
                                        </div>
                                      </div>

                                    </div>


                        					</div>
                        							 </form>
                                                </p>
                                              </div>

                                            </div>
                                          </div>
                                        </div>
