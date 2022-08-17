<?php
$account_setting=$db->get_row('account_setting',array('id'=>'1'));
if (isset($_POST['submit'])){
	//print_r($_POST);
	$account_income=$_POST['account_income'];
	$account_expense=$_POST['account_expense'];

	
	$update=$db->update('account_setting',array('account_for_sale_income'=>$account_income, 'account_for_purchase_expense'=>$account_expense ),array('id'=>'1'));
	if ($update){
		$display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Default account saved successfully.</div>';
		echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts",user)."'
        	                },3000);</script>";
	}
}
?>

<div class="row">
	<div class="col-lg-12">
	<?php echo $display_msg;?>
	<div class=" padded" >
					<a href="<?php echo $link->link('accounts',user);?>" class="btn btn-default pull-right"> <strong>< Back to list</strong></a>
					<h3>Account setting</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<form action="" class="form-horizontal" method="post">
        		<div class="row">
					<div class="col-lg-12">
						<button class="btn btn-success pull-right" type="submit" name="submit"> Save </button>
						<button class="btn btn-default pull-right"> Cancel </button>
						<h3>Default Account Setting</h3>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6">

							<!-- <div class="form-group">
					            <label class="control-label col-md-4">Account for sale<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="">
					            </div>
					        </div>  -->
					        <div class="form-group">
					            <label class="control-label col-md-4">Account for sale (Income)<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control"  name="account_income">
									<?php $account_income=$db->get_all('accounts',array('account_type'=>'income'));
									if (is_array($account_income)){
											foreach ($account_income as $income){?>
												<option <?php if ($account_setting['account_for_sale_income']==$income['id']){echo 'selected';}?> value="<?php echo $income['id'];?>"><?php echo $income['account_name'];?></option>
									<?php 	}
										}
									?>
					              </select>
					            </div>
					        </div>
					        <!-- <div class="form-group">
					            <label class="control-label col-md-4">Account for purchase<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="">
					            </div>
					        </div> -->
					        <div class="form-group">
					            <label class="control-label col-md-4">Account for purchase (Expense)<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control"  name="account_expense">
									<?php $account_expense=$db->get_all('accounts',array('account_type'=>'expense'));
										if (is_array($account_expense)){
											foreach ($account_expense as $expense){?>
												<option <?php if ($account_setting['account_for_purchase_expense']==$expense['id']){echo 'selected';}?> value="<?php echo $expense['id'];?>"><?php echo $expense['account_name'];?></option>
									<?php 	}
										}
									?>
					              </select>
					            </div>
					        </div>

					        <!-- <div class="form-group">
					            <label class="control-label col-md-4">Status</label>
					            <div class="col-md-7">
					               <select class="form-control" name="visibility_status">
					              	<option value="active">Active</option>
					              	<option value="inactive">Inactive</option>
					              </select>
					            </div>
					            </div> -->

					        </div>
						</div>
					</div>
					</form>
				</div>


            </div>
        </div>
    </div>




