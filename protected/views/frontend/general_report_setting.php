<?php
$all =$db->get_row('daytoday_report_settings',array('id'=>1));
if (isset($_POST['general_report_submit']))
{
	//print_r($_POST);
    $report_basis=$_POST['report_basis'];
    $ageing_report=$_POST['ageing_report'];
   
   
    $update=$db->update('daytoday_report_settings',array('report_basis'=>$report_basis,
                                        'ageing_report'=>$ageing_report),array('id'=>1));
  //$db->debug();
    if ($update){
        $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
        				<button class="close" data-dismiss="alert" type="button">×</button>
        				Save successfully. </div>';

       echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("general_report_setting",user)."'
        	                },3000);</script>";

    }
}

?>
<div class="row">
	<div class="col-lg-12">
	<?php echo $display_msg;?>
	<div class=" padded" >
					<h3>GENERAL SETTINGS</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

					<div class="col-lg-12">
						<!--  <a href="<?php echo $link->link('book_prefrences',user)?>" class="btn <?php if ($query1ans=="book_prefrences"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Book Settings</strong></a>
						<a href="<?php echo $link->link('general_email_setting',user)?>" class="btn <?php if ($query1ans=="general_email_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Email settings</strong></a>-->	
						<a href="<?php echo $link->link('sale_purchase_prefrence',user)?>" class="btn <?php if ($query1ans=="sale_purchase_prefrence"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Day to day</strong></a>
						 	<?php if(in_array('view',$adm_report_settings)){?>
						<a href="<?php echo $link->link('general_report_setting',user)?>" class="btn <?php if ($query1ans=="general_report_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Report settings</strong></a>
						<?php }?>

						<!-- <a class="pull-right"> View history </a> -->

						<h4><strong>Report settings</strong></h4>
					</div>
				</div>
 <form action="#" class="form-horizontal" method="post">
        	<a href="" class="btn btn-default pull-right">Cancel</a>
        	          	<?php if(in_array('edit',$adm_report_settings)){?> 
							<button href="#" class="btn btn-primary pull-right" type="submit" name="general_report_submit">Save</button>
							<?php }?>
							<br>
							<br>
			         <div class="form-group">
						       <label class="control-label col-md-4">Report basis</label>
						       <div class="col-md-7">
						           <label class="radio-inline">
						           <input name="report_basis" type="radio" value="accrual_basis" <?php if($all['report_basis']=='accrual_basis')echo 'checked';?>><span> Accrual basis</span></label>
						           <label class="radio-inline">
						           <input name="report_basis" type="radio" value="cash_basis" <?php if($all['report_basis']=='cash_basis')echo 'checked';?>><span> Cash basis</span></label>
						       </div>
						    </div>
						       <div class="form-group">
						       <label class="control-label col-md-4">Ageing reports are based on</label>
						       <div class="col-md-7">
						           <label class="radio-inline">
						           <input name="ageing_report" type="radio" value="transaction_date" <?php if($all['ageing_report']=='transaction_date')echo 'checked';?>><span>Transaction date</span></label>
						           <label class="radio-inline">
						           <input name="ageing_report" type="radio" value="due_date" <?php if($all['ageing_report']=='due_date')echo 'checked';?>><span>Due Date</span></label><br><br>
						           <span>Transactions that have no due date set will be sorted using the transaction date.</span>
						       </div>
						    </div>
						    <br>
						    <br>
						    <br>
						    <br>
					</form>
  </div>
        </div>
    </div>








