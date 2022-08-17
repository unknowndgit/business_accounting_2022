<?php
if (isset($_REQUEST['edit_bank_account'])){
    $bank_account_id=$_REQUEST['edit_bank_account'];
    $accounts_detail=$db->get_row('accounts',array('id'=>$bank_account_id));
    //print_r($contact_detail);
}

if (isset($_POST['submit'])){
   // print_r($_POST);
	$account_name=$_POST['account_name'];
	//$account_nature=$_POST['account_nature'];
	$account_opening_date=$_POST['account_opening_date'];
	//$opening_balance=$_POST['opening_balance'];
	$visibility_status='active';
	$created_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];


	$sql=" SELECT account_name FROM `accounts` WHERE `account_name`='$account_name' AND `id`!='$bank_account_id'";
	$exist_bankaccount_name_check=$db->run($sql)->fetchAll();

	if ($exist_bankaccount_name_check){
	    $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account name already exits.
                		</div>';
	}else{



	if ($accounts_detail['nature']=="liabilities"){

	$update=$db->update('accounts',array('account_name'=>$account_name,
	                                     //'nature'=>$account_nature,
	                                     'account_type'=>'bank',
                                	    'account_opening_date'=>$account_opening_date,
                                	    //'opening_balance'=>$opening_balance,
	                                     'visibility_status'=>$visibility_status,
                                         'created_date'=>$created_date,
                                         'ip_address'=>$ip_address),array('id'=>$bank_account_id));
	//$db->debug();

	if ($update){
	    $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Bank account updated successfully.
					</div>';
	    echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("edit_banking_bank_account&edit_bank_account=".$bank_account_id,user)."'
        	                },3000);</script>";

	}
	 }
	else
	{
	   // $financial_institute=$_POST['financial_institute'];
	    $account_holder_name=$_POST['account_holder_name'];
	    $bsb=$_POST['bsb'];
	    $account_number=$_POST['account_number'];
	    $apca=$_POST['apca'];
	    $ibt=$_POST['ibt'];

	   	$update=$db->update('accounts',array('account_name'=>$account_name,
	                                         //'nature'=>$account_nature,
	                                         'account_type'=>'bank',
                                	   	    // 'financial_institute'=>$financial_institute,
                                	   	     'account_holder_name'=>$account_holder_name,
                                	   	     'bsb'=>$bsb,
	   	                                     'ibt'=>$ibt,
                                	   	     'account_number'=>$account_number,
                                    	   	 'account_opening_date'=>$account_opening_date,
                                    	   //'opening_balance'=>$opening_balance,
                                	   	     'apca'=>$apca,
	   	                                     'visibility_status'=>$visibility_status,
                                             'created_date'=>$created_date,
                                             'ip_address'=>$ip_address),array('id'=>$bank_account_id));
	   	if ($update){
	   	    $event="Edit Bank account  (" . $accounts_detail['account_name'] . ")";
	   	    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	   	        'event'=>$event,
	   	        'created_date'=>date('Y-m-d'),
	   	        'ip_address'=>$_SERVER['REMOTE_ADDR']

	   	    ));
	   	    $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Bank account updated successfully.
					</div>';
	   	    echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("edit_banking_bank_account&edit_bank_account=".$bank_account_id,user)."'
        	                },3000);</script>";

	   	}
    	}
	//$db->debug();

}
}


?>

<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>Edit bank account</h3>
      </div>
      <div class="widget-container fluid-height">
      <form  action="" method="post" class="form-horizontal">
         <div class="widget-content padded">
           <a href="<?php echo $link->link('banking_bank_account',user);?>" class="btn btn-default pull-right">Back to List</a>

            <button class="btn btn-primary pull-right" name="submit">Save</button>


           <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="control-label col-md-5">Account display name <font color="red">*</font></label>
                        <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="account_name" value="<?php echo $accounts_detail['account_name'];?>" >
                              <span>The account display name must be unique within this book</span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-5">Account type</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input type="radio" name="account_nature" id="bank_account" value="assets" <?php if ($accounts_detail['nature']=='assets'){echo 'checked';}?> readonly> 
                              <span> Bank account (asset)</span>
                              </label>
                              <label class="radio-inline">
                              <input  type="radio" name="account_nature" value="liabilities"  id="credit_account" <?php if ($accounts_detail['nature']=='liabilities'){echo 'checked';}?> readonly>
                              <span>Credit account (liability)</span>
                              </label>
                           </div>
                        </div>

                          <div class="form-group">
                                    <label class="control-label col-md-5">Date account opened
                                    </label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="account_opening_date" value="<?php echo $accounts_detail['account_opening_date'];?>">
                                          <span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                       </div>
                                        <span>Leave blank if opened before 7 January 2012</span>
                                    </div>
                                 </div>
                        <div class="form-group">
                           <label class="control-label col-md-5">Opening balance</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="00.00" type="text" name="opening_balance" value="<?php echo $accounts_detail['opening_balance'];?>" readonly>
                                <span>As at 7 January 2012</span>
                           </div>

                        </div>

                    <div id="credit_account_div">
                    <?php if($accounts_detail['nature']=='assets'){?>

                      <!--   <div class="form-group" >
                           <label class="control-label col-md-5">Financial institution</label>
                           <div class="col-md-7">
                                 <select class="form-control" name="financial_institute">
                                 <option <?php if ($accounts_detail['financial_institute']=='1'){echo 'selected';}?> value="1">ABS Building Society (a division of Greater Building Society Ltd)</option>
                                 <option <?php if ($accounts_detail['financial_institute']=='2'){echo 'selected';}?> value="2">Adelaide Bank (a division of Bendigo and Adelaide Bank Limited)</option>
                                  <option <?php if ($accounts_detail['financial_institute']=='3'){echo 'selected';}?> value="3">Advance Bank (a division of Westpac Banking Corporation)</option>
                                  <option <?php if ($accounts_detail['financial_institute']=='4'){echo 'selected';}?> value="4">AFG Securities Group</option>
                                   <option <?php if ($accounts_detail['financial_institute']=='5'){echo 'selected';}?> value="5">Airplus International</option>
                                   <option <?php if ($accounts_detail['financial_institute']=='6'){echo 'selected';}?> value="6">AMP Bank Limited</option>
                                   <option <?php if ($accounts_detail['financial_institute']=='7'){echo 'selected';}?> value="7">Anglican Community Fund Inc</option>
                                   <option <?php if ($accounts_detail['financial_institute']=='8'){echo 'selected';}?> value="8">Anglican Financial Services</option>
                                   <option <?php if ($accounts_detail['financial_institute']=='9'){echo 'selected';}?> value="9">Anglican Investment & Development Fund</option>
                                    <option <?php if ($accounts_detail['financial_institute']=='10'){echo 'selected';}?> value="10">ANZ (Australia and New Zealand Banking Group Limited)</option>
                                    <option <?php if ($accounts_detail['financial_institute']=='11'){echo 'selected';}?> value="11">APS Benefits (Australian Public Service Benevolent Society)</option>
                                     <option <?php if ($accounts_detail['financial_institute']=='12'){echo 'selected';}?> value="12">Arab Bank Australia Limited</option>
                                      <option <?php if ($accounts_detail['financial_institute']=='13'){echo 'selected';}?> value="13">Armidale Building Society Limited</option>
                                   <option <?php if ($accounts_detail['financial_institute']=='14'){echo 'selected';}?> value="14">ATM Global Pty Ltd</option>
                                    <option <?php if ($accounts_detail['financial_institute']=='15'){echo 'selected';}?> value="15">Australia Post</option>
                                 <option <?php if ($accounts_detail['financial_institute']=='16'){echo 'selected';}?> value="16">Australian Finance Direct Pty Ltd</option>
                                  <option <?php if ($accounts_detail['financial_institute']=='17'){echo 'selected';}?> value="17">Australian Military Bank</option>
                                  <option <?php if ($accounts_detail['financial_institute']=='18'){echo 'selected';}?> value="18">Australian Mutual LT2 Capital</option>
                                  <option <?php if ($accounts_detail['financial_institute']=='19'){echo 'selected';}?> value="19">Australian Mutual T1 Capital</option>
                                  <option <?php if ($accounts_detail['financial_institute']=='20'){echo 'selected';}?> value="20">Australian Settlements Limited</option>
                              </select>
                             </div>
                        </div> -->
                        <div class="form-group">
                           <label class="control-label col-md-5">Account name (name of account holder)</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="account_holder_name" value="<?php echo $accounts_detail['account_holder_name'];?>">
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">BSB</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="bsb" value="<?php echo $accounts_detail['bsb'];?>">
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">Account number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="account_number" value="<?php echo $accounts_detail['account_number'];?>">
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">Include balancing transaction</label>
                           <div class="col-md-7">
                               <label class="checkbox-inline" >
                              <input type="checkbox" name="ibt" value="ibt" <?php if ($accounts_detail['ibt']=='ibt'){echo 'checked';}?>>

                              </label>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-5">APCA #</label>
                           <div class="col-md-7">
                                <input class="form-control" placeholder="" type="text" name="apca" value="<?php echo $accounts_detail['apca'];?>">
                           </div>
                        </div> <?php }?>
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



