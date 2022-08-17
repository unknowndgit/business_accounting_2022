<?php

$bank_account=$db->get_all('accounts',array('account_type'=>'bank', 'visibility_status'=>'active'));

if (isset($_POST['submit'])){
	$rule=$_POST['rule'];
	$applies_to=$_POST['applies_to'];
	$description_has=$_POST['description_has'];
	$description_has_other=$_POST['description_has_other'];
	$refrence_has=$_POST['refrence_has'];
	$refrence_has_other=$_POST['refrence_has_other'];
	$transaction_day=$_POST['transaction_day'];
	$transaction_day_other=$_POST['transaction_day_other'];
	$type_has=$_POST['type_has'];
	$type_has_other=$_POST['type_has_other'];
	$amount_is=$_POST['amount_is'];
	$amount_is_other=$_POST['amount_is_other'];
	$do_following=$_POST['do_following'];
	$description=$_POST['description'];
	$contact_to=$_POST['contact_to'];
	$create_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];


	$empt_fields = $fv->emptyfields(array('Rule name'=>$rule,
	    'Contact'=>$contact_to,
	    'Description is set to'=>$description,
	   
	));
	if ($empt_fields)
	{
	    $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
	}
	else{
	$insert=$db->insert('transaction_rule',array('rule'=>$rule,
									'applies_to'=>$applies_to,
			'description_has'=>$description_has,
			'description_has_other'=>$description_has_other,
			'refrence_has'=>$refrence_has,
			'refrence_has_other'=>$refrence_has_other,
			'transaction_day'=>$transaction_day,
			'transaction_day_other'=>$transaction_day_other,
			'type_has'=>$type_has,
			'type_has_other'=>$type_has_other,
			'amount_is'=>$amount_is,
			'amount_is_other'=>$amount_is_other,
			'do_following'=>$do_following,
			'description'=>$description,
			'contact_to'=>$contact_to,
			'create_date'=>$create_date,
			'ip_address'=>$ip_address,
	));
	if ($insert){
		$display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Transaction rule saved Successfully.</div>';
		echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("transaction_rules",user)."'
        	                },3000);</script>";
	}
}
}
?>


<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
			<h3>BANKING</h3>
		</div>
		<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        		<form action="" class="form-horizontal" method="post">
        		 <a href="<?php echo $link->link('transaction_rules',user);?>" class="btn btn-default pull-right">Back to List</a>
        			<a class="btn btn-default pull-right" href="<?php echo $link->link('add_transaction_rules',user);?>">Cancel</a>
        			<button class="btn btn-primary pull-right" type="submit" name="submit">Save</button>

					<h3>Add matching rule</h3>

					<div class="form-group">
			            <label class="control-label col-md-2">Rule name <apan style="color:red;">*</apan></label>
			            <div class="col-md-5">
			              <input class="form-control" type="text" name="rule" >
			            </div>
			       </div>

			       <div class="form-group">
			            <label class="control-label col-md-2">Applies to</label>
			            <div class="col-md-5">
			              <label class="radio-inline"><input name="applies_to" checked="" type="radio" value="money in"><span>Money in</span></label>
			              <label class="radio-inline"><input name="applies_to" type="radio" value="money out"><span>Money out</span></label>
			            </div>
			       </div>

			       <h3>DEFINE THE RULE</h3>

			       <div class="form-group">
			            <label class="control-label col-md-2">Description has</label>
			            <div class="col-md-8">
							<div class="col-md-4">
								<select class="form-control" name="description_has">
									<option>All of these words</option>
									<option>Any of these words</option>
									<option>This exact working</option>
									<option>Anything</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="description_has_other">
							</div>
			            </div>
			       </div>

			       <div class="form-group">
			            <label class="control-label col-md-2">Refrence has</label>
			            <div class="col-md-8">
							<div class="col-md-4">
								<select class="form-control" name="refrence_has">
									<option>All of these words</option>
									<option>Any of these words</option>
									<option>This exact working</option>
									<option>Anything</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="refrence_has_other">
							</div>
			            </div>
			       </div>

			       <div class="form-group">
			            <label class="control-label col-md-2">Transaction day is
			            </label>
			            <div class="col-md-8">
							<div class="col-md-4">
								<select class="form-control" name="transaction_day">
									<option>The following day of the month</option>
									<option>The first day of the month</option>
									<option>Any date</option>
									<option>The last day of the month</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="transaction_day_other">
							</div>
			            </div>
			       </div>

			       <div class="form-group">
			            <label class="control-label col-md-2">Type has</label>
			            <div class="col-md-8">
							<div class="col-md-4">
								<select class="form-control" name="type_has">
									<option>All of these words</option>
									<option>Any of these words</option>
									<option>This exact working</option>
									<option>Anything</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="type_has_other">
							</div>
			            </div>
			       </div>

			       <div class="form-group">
			            <label class="control-label col-md-2">Amount is</label>
			            <div class="col-md-8">
							<div class="col-md-4">
								<select class="form-control" name="amount_is">
									<option>Equal to</option>
									<option>More then</option>
									<option>Equal to or more then</option>
									<option>Less then</option>
									<option>Less then or equal to</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="amount_is_other">
							</div>
			            </div>
			       </div>

			       <h3>THE RULE WILL</h3>
                
			       <div class="form-group">
			            <label class="control-label col-md-2">Do the following</label>
							<div class="col-md-4">
								<select class="form-control" name="do_following">
									<option>Create a payment</option>
									<option>Create a receipt</option>
									<option>Create a transfer</option>
									<option>Ignore this transaction</option>
								</select>
							</div>
			       </div>
                     <div class="form-group">
			            <label class="control-label col-md-2">Contact<span style="color:red;">*</span></label>
							<div class="col-md-4">
								<select class="form-control" name="contact_to" >
								 <option value="">select</option>
								 <?php
											$all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
											if (is_array($all_customer)){
												foreach ($all_customer as $customer){ ?>
													<option value="<?php echo $customer['id'];?>"><?php echo $customer['display_name'];?></option>
										<?php }
											}
										?>
								</select>
							</div>
			       </div>
			       <div class="form-group">
			            <label class="control-label col-md-2">Description is set to <span style="color:red;">*</span></label>
							<div class="col-md-4">
								<input class="form-control" type="text" name="description" >
							</div>
			       </div>

			      


				</form>

			</div>
		</div>
	</div>
</div>