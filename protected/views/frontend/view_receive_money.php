<?php
$rec_money_id=$_REQUEST['action_view'];
if (isset($rec_money_id) && $rec_money_id!=''){
	$money_row=$db->get_row('receive_money',array('id'=>$rec_money_id));
	$contact=$db->get_var('contacts',array('id'=>$money_row['contact_id']),'business_name');
}
/*else {
	$session->reditect('receive_money',user);
}*/
?>
<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
			<h3>BANKING</h3>
		</div>

 		<div class="widget-container fluid-height" id="div1-wrapper">
        	<div class="widget-content padded" id="div1">

        		<form action="" class="form-horizontal" method="post">
        		  <a href="<?php echo $link->link('receive_money',user);?>" class="btn btn-default pull-right">Back to List</a>
        			<a href="<?php echo $link->link('receive_money',user);?>" class="btn btn-default pull-right">Cancel</a>
        			<!-- <button class="btn btn-primary pull-right" name="submit" type="submit">Submit</button> -->
					<h2>View Receive Money</h2><br>
        			<div class="form-group">
			            <label class="control-label col-md-2">Date</label>
			            <div class="col-md-3">
			            	<div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                               <input class="form-control" type="text" value="<?php echo $money_row['date'];?>" disabled><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                            </div>
			            </div>
			        </div>
        			<div class="form-group">
			            <label class="control-label col-md-2">Contact</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" value="<?php echo $contact;?>" readonly>
			            </div>
			        </div>
			        <div class="form-group">
			            <label class="control-label col-md-2">Details</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" value="<?php echo $money_row['details'];?>" readonly>
			            </div>
			        </div>
			        <div class="form-group">
			            <label class="control-label col-md-2">Refrence</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" value="<?php echo $money_row['refrence'];?>" readonly>
			            </div>
			        </div>
			        <div class="form-group">
			            <label class="control-label col-md-2">Receive money for</label>
			            <div class="col-md-3">
			              <?php echo $money_row['receive_money_for']; ?>
			            </div>
			        </div>
			         <div class="form-group">
			            <label class="control-label col-md-2">Payment Method</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" value="<?php echo $money_row['payment_method'];?>" readonly>
			            </div>
			        </div>
			         <div class="form-group">
			            <label class="control-label col-md-2">Amount</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" value="<?php echo $money_row['amount'];?>" readonly>
			            </div>
			        </div>

        		</form>

			</div>
		</div>
	</div>
</div>

