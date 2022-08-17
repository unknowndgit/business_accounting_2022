<?php

$current_tab=$_COOKIE['current_tab'];

if ($current_tab!="all" && $current_tab!="not_reconciled" && $current_tab!="reconciled")
{	$current_tab="all"; }

if ($current_tab=="all")
{
    $db->order_by = "`id` DESC";
   $all_make_payment=$db->get_all('make_payment',array('visibility_status'=>'active'));
}
elseif ($current_tab=="not_reconciled")
{
    $db->order_by = "`id` DESC";
    $all_make_payment=$db->get_all('make_payment',array('visibility_status'=>'active','reconcile'=>'no'));

}
elseif ($current_tab=="reconciled")
{
    $db->order_by = "`id` DESC";
    $all_make_payment=$db->get_all('make_payment',array('visibility_status'=>'active','reconcile'=>'yes'));
}
else{
   // $db->order_by = "`id` DESC";
    $all_make_payment=$db->get_all('make_payment',array('visibility_status'=>'active'));
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
        $delete=$db->delete('make_payment',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("buying_mk",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('buying_mk',user);
    }

}?>
	  <div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>BUYING</h3>
					<?php echo $display_msg;?></div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">

	<div class="col-lg-12">

	<a href="<?php echo $link->link('buying_bills',user);?>" class="btn <?php if ($query1ans=="buying_bills"){echo "btn-primary";}else{echo "btn-default";}?> ">Bills</a>
	<a href="<?php echo $link->link('buying_san',user);?>" class="btn <?php if ($query1ans=="buying_san"){echo "btn-primary";}else{echo "btn-default";}?>">Supplier adjustment notes</a>
	<a href="<?php echo $link->link('buying_mk',user);?>" class="btn <?php if ($query1ans=="buying_mk"){echo "btn-primary";}else{echo "btn-default";}?>">Make payment</a>
   <!-- <a href="<?php echo $link->link('add_buying_mk',user);?>" class="btn btn-default pull-right"> Add </a> -->

                         <br>
                         <br>


	 </div>
	           <!--  <div class="col-md-6">
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
					                  if (is_array($all_make_payment)){
					                      $sn=1;
					                      foreach ($all_make_payment as $allmp){?>


					                    <tr>
					                      <td><?php echo $sn;?></td>
					                      <td><?php echo date(DATE_FORMAT,strtotime($allmp['date']));?></td>

                                          <td><?php echo $contact_name=$db->get_var('contacts',array('id'=>$allmp['contact_id']),'display_name');?></td>
					                      <td><?php echo substr($allmp['details'], 0,50);?></td>
					                      <td><?php echo $allmp['reference']?></td>
					                      <td><?php echo $allmp['payment_method']?></td>
					                      <td><?php if ($allmp['transaction_amount']!=""){ echo CURRENCY ." ".number_format($allmp['transaction_amount'],2,'.',',');}?></td>
					                       <td>
					                        <div class="btn-group">
                                                 <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                <?php if(in_array('delete',$dtd_payment)){?>
                                                <li>
                                                   <a href="<?php echo $link->link('buying_mk',user,'&action_delete='.$allmp['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                                </li>
                                                <?php }?>
                                                 </ul>
                                                </div>
                                          </td>
                                       </tr>
					                 <?php $sn++; }
					                  }?>
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