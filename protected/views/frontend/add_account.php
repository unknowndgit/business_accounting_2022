


<?php if (isset($_POST['account_add_submit']))
{

    $account_name=$_POST['account_name'];
    $account_type=$_POST['account_type'];
    $account_code=$_POST['account_code'];
    $export_code=$_POST['export_code'];
    $account_description=$_POST['account_description'];
   // $sub_account_of=$_POST['sub_account_of'];
   // $default_tax_code=$_POST['default_tax_code'];
    $visibility_status=$_POST['visibility_status'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];


    if ($fv->emptyfields(array('Account name'=>$account_name),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account name can not be Blank.
                		</div>';

    }
    elseif ($db->exists('accounts',array('account_name'=>$account_name)))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account name already exits.
                		</div>';

    }
    elseif ($fv->emptyfields(array('Account type'=>$account_type),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Select Account Type.
                		</div>';

    }
    elseif ($fv->emptyfields(array('Account Code'=>$account_code),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account code can not be Blank.
                		</div>';

    }
    elseif ($db->exists('accounts',array('account_code'=>$account_code)))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>This Account code already exits.
                		</div>';

    }

 else
    {
        if ($account_type!="")
        {
            //$nature=$db->get_var('accounts_type',array('id'=>$account_type),'account_nature');
            if ($account_type=='income' || $account_type=='other_income'){
            	$nature='income';
            }
            if ($account_type=='cost_of_good-sold'){
                $nature='cogs';
            }
            if ($account_type=='expense'|| $account_type=='other_expense' ){
            	$nature='expense';
            }
            if ($account_type=='current_asset' || $account_type=='non_current_asset'){
            	$nature='assets';
            }
            if ($account_type=='bank'){
            	$nature='assets';
            }
            if ($account_type=='fixed_asset'){
            	$nature='assets';
            }
            if ($account_type=='other_non-current_asset'){
            	$nature='assets';
            }
            if ($account_type=='credit_card'){
            	$nature='liabilities';
            }
            if ($account_type=='other_current_liability'){
            	$nature='liabilities';
            }
            if ($account_type=='equity'){
            	$nature='equity';
            }
            if ($account_type=='non-current_liability'){
            	$nature='liabilities';
            }
          /*  if ($account_type=='account_receivable'){
            	$nature='assets';
            }
            if ($account_type=='account_payble'){
            	$nature='liabilities';
            }*/

        }
        $insert=$db->insert("accounts",array('account_name'=>$account_name,
                                             'account_type'=>$account_type,
                                             'account_code'=>$account_code,
                                             'export_code'=>$export_code,
                                             'account_description'=>$account_description,
                                          //   'sub_account_of'=>$sub_account_of,
                                         //    'default_tax_code'=>$default_tax_code,
                                             'nature'=>$nature,
                                             'opening_balance'=>0,
                                             'current_balance'=>0,
                                             'visibility_status'=>$visibility_status,
                                             'created_date'=>$created_date,
                                             'ip_address'=>$ip_address));


//$db->debug();
      if ($insert){
          /*entry in activity log table*/
          $event="Add new Account (" . $account_name . ")";
          $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
              'event'=>$event,
              'created_date'=>date('Y-m-d'),
              'ip_address'=>$_SERVER['REMOTE_ADDR']

          ));
                $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Account added successfully.
                		</div>';
                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts",user)."'
        	                },3000);</script>";


      }

    }


}
?>

<div class="row">
	<div class="col-lg-12">
	<?php echo $display_msg;?>
	<div class=" padded" >
				<h3>CHART OF ACCOUNT</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<form action="#" class="form-horizontal" method="post">
        		<div class="row">
					<div class="col-lg-12">
					<a href="<?php echo $link->link('accounts',user);?>" class="btn btn-default pull-right"> <strong><- Back to list</strong></a>
						<button type="reset" class="btn btn-default pull-right"> Cancel </button>
						<button class="btn btn-primary pull-right" type="submit" name="account_add_submit"> Save </button>
						<h3>New Account</h3>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6">

							<div class="form-group">
					            <label class="control-label col-md-4">Account name <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_name">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Account type<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					            <select class="form-control" name="account_type">
					                <option value="">Select</option>
					                <option value="income">Income</option>
					                <option value="other_income">Other Income</option>
					                <option value="expense">Expense</option>
					                <option value="cost_of_good-sold">Cost of good sold</option>
					                <option value="other_expense">Other Expense</option>
					                <option value="current_asset">Current asset</option>
					                 <option value="non_current_asset">Non-Current asset</option>
					                <option value="fixed_asset">Fixed Assets</option>
					           <!--     <option value="bank">Bank</option> -->
					                <option value="other_non_current_asset">Other non-current asset</option>
					                <option value="credit_card">Credit card</option>
					                <option value="other_current_liability">Other current liability</option>
					                <option value="equity">Equity</option>
					                <option value="non-current_liability">Non-current liability</option>
					               <!--  <option value="account_receivable">Account Receivable</option>
					                <option value="account_payble">Account Payble</option> -->
								</select>
					              <!-- <select class="form-control" name="account_type">
					                <option value="">Select</option>
					                <?php $account_type=$db->get_all('accounts_type',array('visibility_status'=>'active'));
					                if (is_array($account_type)){
					                    foreach ($account_type as $at)
					                    {?>
                                      <option value="<?php echo $at['id']?>"><?php echo $at['account_type_name'];?></option>
					               <?php  }} ?>

								  </select> -->
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Account code <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_code">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Export code</label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="export_code">
					            </div>
					        </div>

						</div>
						<div class="col-lg-6">
							<div class="form-group">
					            <label class="control-label col-md-4">Description</label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_description">
					            </div>
					        </div>
					   <!--    <div class="form-group">
					            <label class="control-label col-md-4">Sub-account of</label>
					            <div class="col-md-7">
					              <select class="form-control" name="sub_account_of">
					              <?php $all_account_name=$db->get_all('accounts',array('visibility_status'=>'active'));
                         if (is_array($all_account_name)){
                    foreach ($all_account_name as $an){?>
					              <option  value="<?php echo $an['id']?>"><?php echo $an['account_name'];?></option>
					                 <?php }}?>

					              </select>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Default tax code</label>
					            <div class="col-md-7">
					              <select class="form-control" name="default_tax_code">
					              	<option value="1">None</option>
					              	 <?php $all_tax_name=$db->get_all('tax',array('visibility_status'=>'active'));

                         if (is_array($all_tax_name)){
                    foreach ($all_tax_name as $tn){?>
					              <option  value="<?php echo $tn['id']?>"><?php echo $tn['tax_name']." - ".$tn['tax_description']."(".$tn['tax_rate'].")";?></option>
					                 <?php }}?>
					               </select>
					            </div>
					        </div>-->
					        <div class="form-group">
					            <label class="control-label col-md-4">Status</label>
					            <div class="col-md-7">
					               <select class="form-control" name="visibility_status">
					              	<option value="active">Active</option>
					              	<option value="inactive">Inactive</option>
					              </select>
					            </div>
					            </div>
					        </div>
						</div>
					</div>
					</form>
				</div>


            </div>
        </div>
    </div>




