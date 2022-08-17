<?php

if (isset($_POST['submit'])){
   // print_r($_POST);
	$account_name=$_POST['account_name'];
	$account_nature=$_POST['account_nature'];
	$account_opening_date=$_POST['account_opening_date'];
	//$opening_balance=$_POST['opening_balance'];
	$opening_balance=0;
	$visibility_status='active';
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
        $display_msg= '<div class="alert alert-danger"><i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button">×</button>
                        Bank account name already exist!.
    					</div>';
    }
else{

	if ($account_nature=="liabilities"){

	$insert=$db->insert('accounts',array('account_name'=>$account_name,
	                                     'nature'=>$account_nature,
	                                     'account_type'=>'bank',
	                                     'visibility_status'=>$visibility_status,
                                	    'account_opening_date'=>$account_opening_date,
                                    	    'opening_balance'=>$opening_balance,
                                    	    'current_balance'=>$opening_balance,
                                         'created_date'=>$created_date,
                                         'ip_address'=>$ip_address

	));
	}
	else
	{
	  //  $financial_institute=$_POST['financial_institute'];
	    $account_holder_name=$_POST['account_holder_name'];
	    $bsb=$_POST['bsb'];
	    $account_number=$_POST['account_number'];
	    $apca=$_POST['apca'];
	    $ibt=$_POST['ibt'];
	   	$insert=$db->insert('accounts',array('account_name'=>$account_name,
	                                         'nature'=>$account_nature,
	                                         'account_type'=>'bank',
                                	   	  //   'financial_institute'=>$financial_institute,
                                	   	     'account_holder_name'=>$account_holder_name,
                                	   	     'bsb'=>$bsb,
	   	                                    'ibt'=>$ibt,
                                	   	     'account_number'=>$account_number,
                                	   	     'apca'=>$apca,
                                	   	    'account_opening_date'=>$account_opening_date,
                                	   	    'opening_balance'=>$opening_balance,
	   	                                   'current_balance'=>$opening_balance,
	   	                                     'visibility_status'=>$visibility_status,
                                             'created_date'=>$created_date,
                                             'ip_address'=>$ip_address));
	}
	//$db->debug();
  if ($insert){

      $event="Create a new bank account  (" . $account_name . ")";
      $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
          'event'=>$event,
          'created_date'=>date('Y-m-d'),
          'ip_address'=>$_SERVER['REMOTE_ADDR']

      ));
		$display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Bank account added successfully.
					</div>';
		echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("banking_bank_account",user)."'
        	                },3000);</script>";
	}}
}

?>

<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>Add bank account</h3>
      </div>
      <div class="widget-container fluid-height">
      <form  action="" method="post" class="form-horizontal">
         <div class="widget-content padded">
           <a href="<?php echo $link->link('banking_bank_account',user);?>" class="btn btn-default pull-right">Back to List</a>
            <a href="<?php echo $link->link('add_banking_bank_account',user);?>" class="btn btn-default pull-right">Cancel</a>
            <button class="btn btn-primary pull-right" name="submit">Submit</button>


           <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="control-label col-md-5">Account display name <font color="red">*</font></label>
                        <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="account_name" value="<?php echo $_POST['account_name'];?>">
                              <span>The account display name must be unique within this book</span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-5">Account type</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input type="radio" name="account_nature" id="bank_account" value="assets" <?php if ($_POST['account_nature']=='assets' || $_POST['account_nature']==""){echo 'checked';}?>>
                              <span> Bank account (asset)</span>
                              </label>
                              <label class="radio-inline">
                              <input type="radio" name="account_nature" value="liabilities"  id="credit_account" <?php if ($_POST['account_nature']=='assets'){echo 'checked';}?>>
                              <span>Credit account (liability)</span>
                              </label>
                           </div>
                        </div>

                          <div class="form-group">
                                    <label class="control-label col-md-5">Date account opened
                                    </label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="account_opening_date" value="<?php echo date('d-m-Y'); ?>">
                                          <span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                       </div>
                                        <span>Leave blank if opened before 7 January 2012</span>
                                    </div>
                                 </div>
                        <!-- <div class="form-group">
                           <label class="control-label col-md-5">Opening balance</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="00.00" type="text" name="opening_balance" value="<?php echo $_POST['opening_balance'];?>">
                                <span>As at 7 January 2012</span>
                           </div>

                        </div> -->
                    <div id="credit_account_div">

                        <!-- <div class="form-group" >
                           <label class="control-label col-md-5">Financial institution</label>
                           <div class="col-md-7">
                                 <select class="form-control" name="financial_institute">
                                 <option value="1">ABS Building Society (a division of Greater Building Society Ltd)</option>
                                 <option value="2">Adelaide Bank (a division of Bendigo and Adelaide Bank Limited)</option>
                                  <option value="3">Advance Bank (a division of Westpac Banking Corporation)</option>
                                  <option value="4">AFG Securities Group</option>
                                   <option value="5">Airplus International</option>
                                   <option value="6">AMP Bank Limited</option>
                                   <option value="7">Anglican Community Fund Inc</option>
                                   <option value="8">Anglican Financial Services</option>
                                   <option value="9">Anglican Investment & Development Fund</option>
                                    <option value="10">ANZ (Australia and New Zealand Banking Group Limited)</option>
                                    <option value="11">APS Benefits (Australian Public Service Benevolent Society)</option>
                                     <option value="12">Arab Bank Australia Limited</option>
                                      <option value="13">Armidale Building Society Limited</option>
                                   <option value="14">ATM Global Pty Ltd</option>
                                    <option value="15">Australia Post</option>
                                 <option value="16">Australian Finance Direct Pty Ltd</option>
                                  <option value="17">Australian Military Bank</option>
                                  <option value="18">Australian Mutual LT2 Capital</option>
                                  <option value="19">Australian Mutual T1 Capital</option>
                                  <option value="20">Australian Settlements Limited</option>
                              </select>
                             </div>
                        </div> -->
                        <div class="form-group">
                           <label class="control-label col-md-5">Account name (name of account holder)</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="account_holder_name" <?php echo $_POST['account_holder_name'];?>>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">BSB</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="bsb" <?php echo $_POST['bsb'];?>>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">Account number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="account_number" <?php echo $_POST['account_number'];?>>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">Include balancing transaction</label>
                           <div class="col-md-7">
                               <label class="checkbox-inline" >
                              <input type="checkbox" name="ibt" value="ibt" <?php echo $_POST['ibt'];?>>

                              </label>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">APCA #</label>
                           <div class="col-md-7">
                                <input class="form-control" placeholder="" type="text" name="apca" <?php echo $_POST['apca'];?>>
                           </div>
                        </div>
                        </div>

                     </div>
                     <div class="col-md-6"></div>

               </div>

         </div>
         </form>
      </div>
   </div>
</div>

<script type="text/javascript">
$("#credit_account").click(function(){
	    $("#credit_account_div").hide();
	    });
$("#bank_account").click(function(){
    $("#credit_account_div").show();
    });
</script>



