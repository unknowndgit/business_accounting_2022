<?php

$current_tab=$_COOKIE['current_tab'];

if ($current_tab!="all" && $current_tab!="not_reconciled" && $current_tab!="reconciled")
{	$current_tab="all"; }

if ($current_tab=="all")
{ $db->order_by = "`id` DESC";
   $all_receive_payment=$db->get_all('receive_money',array('visibility_status'=>'active'));
}
elseif ($current_tab=="not_reconciled")
{
    $db->order_by = "`id` DESC";
    $all_receive_payment=$db->get_all('receive_money',array('visibility_status'=>'active','reconcile'=>'no'));

}
elseif ($current_tab=="reconciled")
{
    $db->order_by = "`id` DESC";
    $all_receive_payment=$db->get_all('receive_money',array('visibility_status'=>'active','reconcile'=>'yes'));
}
else{
    $db->order_by = "`id` DESC";
    $all_receive_payment=$db->get_all('receive_money',array('visibility_status'=>'active'));
}


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
        $event="Delete entry no ( " . $_POST['del_id'] . " ) from Receive money";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('receive_money',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("receive_money",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('receive_money',user);
    }

}?>
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
		<h3>BANKING</h3>
		<?php echo $display_msg;?>
		<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">
<div class="col-lg-12">

	<a href="<?php echo $link->link('banking_bank_account',user);?>" class="btn btn-default ">Bank accounts</a>
	<a href="<?php echo $link->link('transfer_money',user);?>" class="btn btn-default">Transfer money</a>
<!-- 	<a href="<?php echo $link->link('transaction_rules',user);?>" class="btn btn-default">Transaction rules</a> -->
	<a href="<?php echo $link->link('receive_money',user);?>" class="btn btn-primary">Receive money </a>
   <!-- <a href="<?php echo $link->link('add_selling_receive_money',user);?>" class="btn btn-default pull-right"> Add </a> -->

<br>
<br>
 </div>
	         <!--    <div class="col-md-6">
	                       <div class="form-group">
				 			<label class="control-label col-md-5">Bank account<font color="red">*</font>
				 			</label><br>
				            <div class="col-md-5">
				            <select class="form-control" name="payment_term">
				            <option value="1"selected="selected">All Accounts</option>
				               <option value="2">ANZ</option>
				           <option value="3">Cash</option>
				           </select>
				            </div>
				          </div>
				          </div>-->
				          <br>
	        </div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                       <li tab="all"  class="set_cookie <?php if ($current_tab=="all" || $current_tab==""){echo"active";}?>">
	                        <a  href="#"><i class="icon-comments"></i><span>All</span></a>
	                      </li>
	                      <li tab="not_reconciled"  class="set_cookie <?php if ($current_tab=="not_reconciled"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Not reconciled</span></a>
	                      </li>
	                      <li tab="reconciled"  class="set_cookie <?php if ($current_tab=="reconciled"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Reconciled</span></a>
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
					                    <th>S.no</th>
					                    <th>Date</th>

					                    <th>Contact</th>
					                    <th>Details</th>
					                    <th>Reference</th>
					                    <th>Payment method</th>
					                    <th>Amount</th>
					                    <th>Action</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  <?php
					                  if (is_array($all_receive_payment)){
					                      $sn=1;
					                      foreach ($all_receive_payment as $allrp){?>


					                    <tr>
					                      <td><?php echo $sn;?></td>
					                      <td><?php echo date(DATE_FORMAT,strtotime($allrp['date']));?></td>

                                          <td><?php echo $contact_name=$db->get_var('contacts',array('id'=>$allrp['contact_id']),'display_name');?></td>
					                      <td><?php echo substr($allrp['details'], 0,50);?></td>
					                      <td><?php echo $allrp['reference']?></td>
					                      <td><?php echo $allrp['payment_method']?></td>
					                      <td><?php if ($allrp['transaction_amount']!=""){ echo CURRENCY ." ".number_format($allrp['transaction_amount'],2,'.',',');}?></td>
					                       <td>
					                       <?php if (!empty($dtd_receipt)){?>
					                        <div class="btn-group">
                                                 <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                <?php if(in_array('view',$dtd_receipt)){?>
                                                <li>
                                                   <a href="<?php echo $link->link('view_receive_money',user,'&action_view='.$allrp['id']);?>"><i class="fa fa-edit"></i>View</a>
                                                </li>
                                               <?php }if(in_array('delete',$dtd_receipt)){?>
                                                <li>
                                                   <a href="<?php echo $link->link('receive_money',user,'&action_delete='.$allrp['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                                </li>
                                                <?php }?>
                                                 </ul>
                                                </div>
                                           <?php } ?>
                                                  <?php if ($allrp['reconcile']=="no"){?>
                                                <span class="label label-success" >Reconcile</span>
                                                <?php }else{?>
                                                <span class="label label-warning">Unreconcile</span>
                                                <?php }?>
                                          </td>
                                       </tr>
					                 <?php $sn++; }
					                  }?>
					                 </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>   </div>
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