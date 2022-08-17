<?php
echo $acc=$_REQUEST['acc'];
if (isset($acc)){
	$accounts=$db->get_all('accounts');
}
else {
	$accounts=$db->get_all('accounts',array('account_type'=>'bank'));
}


if (isset($_POST['submit'])){

    $transfer_date=$_POST['transfer_date'];
	$amount=$_POST['amount'];
	$transfer_money_from=$_POST['transfer_money_from'];
	$transfer_to=$_POST['transfer_to'];
	$description=$_POST['description'];
	$bank_fees=$_POST['bank_fees'];
	$reference=$_POST['reference'];
	$create_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];


	$empt_fields = $fv->emptyfields(array('Transfer Date'=>$transfer_date,
                                	    'Amount'=>$amount,
                                	    'Transfer Money'=>$transfer_money_from,
	                                    'Transfer To'=>$transfer_to,
	));

	if ($empt_fields)
	{
	    $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
	}
	elseif($transfer_money_from==$transfer_to){
	    $display_msg= '<div class="alert alert-danger"><i class="lnr lnr-sad"></i>
            		<button class="close" data-dismiss="alert" type="button">×</button> Transfer to and Transfer from account can not be same.
                		</div>';

	}
    else{
    $insert=$db->insert('transfer_money',array('transfer_date'=>$transfer_date,
											'amount'=>$amount,
											'transfer_money'=>$transfer_money_from,
											'transfer_to'=>$transfer_to,
											'description'=>$description,
                                            'bank_fees'=>$bank_fees,
                                            'reference'=>$reference,
											'create_date'=>$create_date,
											'ip_address'=>$ip_address,

	));

    //$db->debug();
    $last_receipt_insert_id=$db->lastInsertId();

	if ($insert){

	    $event="Money " .CURRENCY ."".$amount . " transfer from account  (" . $transfer_money_from . ") to account(" . $transfer_to . ")";
	    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                                	      'event'=>$event,
                                	      'created_date'=>date('Y-m-d'),
                                	      'ip_address'=>$_SERVER['REMOTE_ADDR']

	    ));

	   /* $opening_balance_from=$db->get_var('accounts',array('id'=>$transfer_money_from),'current_balance');
	    $opening_balance_to =$db->get_var('accounts',array('id'=>$transfer_to),'current_balance');
        $new_openinig_balance_from=$opening_balance_from-$amount;
        $new_openinig_balance_to=$opening_balance_to+$amount;


         $update1=$db->update('accounts',array('current_balance'=>$new_openinig_balance_from),array('id'=>$transfer_money_from));
       $update2=$db->update('accounts',array('current_balance'=>$new_openinig_balance_to),array('id'=>$transfer_to));
*/

        $account=serialize(array($transfer_to,$transfer_money_from));
	    $type=serialize(array("debit","credit"));
	    $debit=serialize(array($amount,""));
	    $credit=serialize(array("",$amount));
	    $journal_date=date(DATE_FORMAT);
	    $summary="generate from transfer money";

	    $insert=$db->insert('journal',array('journal_date'=>$journal_date,
                                	        'journal_type'=>'journal',
                                	        'generated_from'=>'Transfer_money',
                                	        'generated_from_id'=>$last_receipt_insert_id,
                                	        'summary'=>$summary,
                                	        'account'=>$account,
	                                        'reference'=>$reference,
                                	        'type'=>$type,
                                	        'debit'=>$debit,
                                	        'credit'=>$credit,
                                	        'visibility_status'=>'active',
                                	        'create_date'=>$create_date,
                                	        'ip_address'=>$ip_address,
                                	        'ladger_generate'=>'no'));
	    //$db->debug();
	    $last_id=$db->lastInsertId();
	    $journal_no="TR".sprintf('%06u', $last_id);
	    $db->update('journal',array('journal_no'=>$journal_no),array('id'=>$last_id));
         $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Money transfered successfull.</div>';
		echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("transfer_money",user)."'
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


 <div class="widget-container fluid-height" id="div1-wrapper">
        	<div class="widget-content padded" id="div1">

        		<form action="" class="form-horizontal" method="post">
        		  <a href="<?php echo $link->link('transfer_money',user);?>" class="btn btn-default pull-right">Back to List</a>
        			<a href="<?php echo $link->link('add_transfer_money',user);?>" class="btn btn-default pull-right">Cancel</a>
        			<button class="btn btn-primary pull-right" name="submit" type="submit">Submit</button>
					<h3>Transfer money</h3>
					   <div class="form-group">
			            <label class="control-label col-md-2">Transfer From<span style="color:red;">*</span></label>
			            <div class="col-md-3">
			              <select class="form-control" name="transfer_money_from">
			               <option value="">Select</option>
			              	<?php
			              		if (is_array($accounts)){
			              			foreach ($accounts as $account){?>
			              				<option value="<?php echo $account['id'];?>" <?php if ($_POST['transfer_money_from']==$account['id']){echo 'selected';}?>><?php echo $account['account_name'];?></option>
			              	<?php 	}
			              		}
			              	?>

			              </select>
			            </div>
			            <div  class="col-md-3"><a title="Add Bank Account" class="text-danger " data-toggle="modal" href="#add_bank_account"><i class="lnr lnr-plus-circle"></i> Add New Bank Account</a></div>
			       </div>
             <div class="form-group">
			            <label class="control-label col-md-2">Transfer to <span style="color:red;">*</span></label>
			            <div class="col-md-3">
			              <select class="form-control" name="transfer_to">
			               <option value="">Select</option>
			              	<?php
			              		if (is_array($accounts)){
			              			foreach ($accounts as $account){?>
			              				<option value="<?php echo $account['id'];?>" <?php if ($_POST['transfer_to']==$account['id']){echo 'selected';}?>><?php echo $account['account_name'];?></option>
			              	<?php 	}
			              		}
			              	?>
			              </select>
			            </div>
			        </div>
        			 <div class="form-group">
			            <label class="control-label col-md-2">Date <span style="color:red;">*</span></label>
			            <div class="col-md-3">
			              <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy" >
			                <input class="form-control" type="text" name="transfer_date" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span></input>
			              </div>
			            </div>
			         </div>

			         <div class="form-group">
			            <label class="control-label col-md-2">Amount <span style="color:red;">*</span></label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" name="amount" value="<?php echo $_POST['amount'];?>">
			            </div>
			        </div>
			           <div class="form-group">
			            <label class="control-label col-md-2">Bank Fees</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" name="bank_fees" value="<?php echo $_POST['bank_fees'];?>">
			            </div>
			         </div>
                   <div class="form-group">
			            <label class="control-label col-md-2">Reference</label>
			            <div class="col-md-3">
			              <input class="form-control" type="text" name="reference" value="<?php echo $_POST['reference'];?>">
			            </div>
			        </div>
			        <!-- <div class="form-group">
			            <label class="control-label col-md-2"></label>
			            <div class="col-md-3">
			              <label class="checkbox-inline"><input type="checkbox" name="show_all_account" value="all" id="show_all_account" <?php if ($acc!=''){echo 'checked';}?>><span>Show all accounts (not just bank accounts)</span></label>
			            </div>
			        </div> -->

                  <div class="form-group">
			            <label class="control-label col-md-2">Description</label>
			            <div class="col-md-3">
			              <textarea class="form-control" name="description"><?php echo $_POST['description'];?></textarea>
			            </div>
			        </div>

        		</form>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$("#show_all_account").click(function(){
	var acc=$(this).val();
	location.href=window.location.pathname+'?user=add_transfer_money&acc='+acc;
});

</script>
