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
        $estimate_number=$db->get_var('estimates',array('id'=>$_POST['del_id']),'estimate_number');
        $event="Delete Estimate  (" . $estimate_number . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('estimates',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Quotation Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("selling_estimates",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('selling_estimates',user);
    }

}
?>
	  <div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>SELLING</h3>
					<?php echo $display_msg;?>
					</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">
	<div class="col-lg-12">
	<?php  $tab_name=$_REQUEST['advisor_type'];?>
	<a href="<?php echo $link->link('selling_estimates',user);?>" class="btn <?php if ($query1ans=="selling_estimates"){echo "btn-primary";}else{echo "btn-default";}?> ">Quotations</a>
	<a href="<?php echo $link->link('selling_invoice',user);?>" class="btn <?php if ($query1ans=="selling_invoice"){echo "btn-primary";}else{echo "btn-default";}?>">Invoices</a>
	<a href="<?php echo $link->link('customer_adjustment_notes',user);?>" class="btn <?php if ($query1ans=="customer_adjustment_notes"){echo "btn-primary";}else{echo "btn-default";}?>">Customer adjustment notes </a>
  <?php if(in_array('create_and_edit',$dtd_estimate)){?>
  <?php if (IS_GST_REGISTERED=="yes"){?>
   <a href="<?php echo $link->link('add_selling_estimate',user);?>" class="btn btn-default pull-right"> Add Quotation</a>
   <?php }else{?>
   <a href="<?php echo $link->link('add_quotation_without_tax',user);?>" class="btn btn-default pull-right"> Add Quotation</a>



   <?php }?>
<?php }?>


	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="active">
	                        <a  href="<?php echo $link->link('selling_estimates',user,'&tab=All');?>"><i class="icon-comments"></i><span>All</span></a>
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
					                    <th>Date</th>
					                    <th>Quotation no </th>
					                    <th> Contact</th>
					                    <th>Reference</th>
					                    <th>Total amount</th>
					                    <th>Action</th>
					                    </tr></thead>
					                  <tbody>
					                  <?php
					                  $db->order_by = "`id` DESC";
					                  $all_estimates=$db->get_all('estimates',array('visibility_status'=>'active'));
					                  if (is_array($all_estimates)){
					                      $sn=1;
					                      foreach ($all_estimates as $alle)
					                      {?>

					                    <tr>
					                      <td class="check hidden-xs">
					                      <?php echo $sn;?>
					                      </td>
					                      <td><?php if ($alle['estimate_date']!=""){ echo date(DATE_FORMAT,strtotime($alle['estimate_date']));}?></td>
					                      <td><?php echo $alle['estimate_number'];?></td>
					                      <td><?php echo $contact_name=$db->get_var('contacts',array('id'=>$alle['customer_id']),'display_name');?></td>
					                      <td><?php echo $alle['reference_code'];?></td>
					                      <td><?php if ($alle['total_amount']!=""){ echo CURRENCY . " " .number_format($alle['total_amount'],2,'.',',');}?></td>
                                        <td>
                                          <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <?php if(in_array('view',$dtd_estimate)){?>
                                            <li>
                                            <a href="<?php echo $link->link('view_selling_estimates',user,'&action_view='.$alle['id']);?>"><i class="fa fa-edit"></i>View</a>
                                              </li>
                                              <?php }if(in_array('create_and_edit',$dtd_estimate)){?>
                                                <li>
                                                <?php if ($alle['gst_registered']=="yes" || $alle['gst_registered']==""){?>
                                               <a href="<?php echo $link->link('edit_selling_estimates',user,'&action_edit='.$alle['id'].'&id='.$alle['customer_id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                               <?php }else{?>
                                               <a href="<?php echo $link->link('edit_quotation_without_tax',user,'&action_edit='.$alle['id'].'&id='.$alle['customer_id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                               <?php }?>
                                              </li>
                                              <?php }if(in_array('delete',$dtd_estimate)){?>
                                            <li>
                                            <a href="<?php echo $link->link('selling_estimates',user,'&action_delete='.$alle['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>
                                              <?php }?>
                                            </ul>
                                          </div>
                                          </td>
					                    </tr>
					                    <?php $sn++; 	}}?>


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