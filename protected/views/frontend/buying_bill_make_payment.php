
<?php

if (isset($_REQUEST['bill_id']))
{
$bill_id=$_REQUEST['bill_id'];
$bill_details=$db->get_row('bills',array('id'=>$bill_id));
$customer_detail=$db->get_row('contacts',array('id'=>$bill_details['supplier_id']));
$bill_paid_amount=$bill_details['paid_amount'];
}

 if (isset($_POST['rm_submit']))
{
 	//print_r($_POST);
    $contact_id=$_POST['contact_id'];
    $date_selling=$_POST['date_selling'];

    $payable_type=$_POST['payable_type'];
    $payment_method=$_POST['payment_method'];
    $reference=$_POST['reference'];
    $details=$_POST['details'];
    $bank_account_id=$_POST['bank_account'];
    //$use_transaction_total=$_POST['use_transaction_total'];

    $remaining_amount=$_POST['remaining_amount'];
    $allocation_notes=$_POST['allocation_notes'];
    $how_much_allocate=$_POST['how_much_allocate'];

    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $visibility_status="active";

  $empt_fields = $fv->emptyfields(array('Date'=>$date_selling,
                                        'Bank Account'=>$bank_account_id,
                                        'Payble type'=>$payable_type,
                                        'Reference'=>$reference
    ));

    if ($empt_fields)
    {
        $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }
    elseif ($_POST['how_much_allocate']!= $remaining_amount){
    	$display_msg= '<div class="alert alert-danger"><i class="lnr lnr-smile"></i>
    			<button class="close" data-dismiss="alert" type="button">×</button>
    			An unbalanced transaction may not be recorded .
                    		</div>';
    }
    else {

			$insert=$db->insert('make_payment',array('contact_id'=>$contact_id,
                        								 'date'=>date('Y-m-d',strtotime($date_selling)),
                        								 'payable_type'=>$payable_type,
                        								 'payment_method'=>$payment_method,
                        								 'reference'=>$reference,
                        								 'details'=>$details,
                        								 'bank_account'=>$bank_account_id,
                        								 //'use_transaction_total'=>$use_transaction_total,
                        								 'transaction_amount'=>$remaining_amount,
                        								 'reconcile'=>'no',
                        								 'allocation_notes'=>$allocation_notes,
                                                         'amount'=>$how_much_allocate,
                        								 'created_date'=>$created_date,
                        								 'ip_address'=>$ip_address,
                        								 'visibility_status'=>$visibility_status,
			    'payment_for'=>"bill",
			    'payment_for_id'=>$bill_id,
                        			));

			$last_payment_insert_id=$db->lastInsertId();
			if ($insert)
			{
			    /********************* entry in activity***************************/
			    $bill_number=$db->get_var('bills',array('id'=>$bill_id),'bill_number');
			    $event="Make payment of bill  (" . $bill_number . ")";
			    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                                			        'event'=>$event,
                                			        'created_date'=>date('Y-m-d'),
                                			        'ip_address'=>$_SERVER['REMOTE_ADDR']
                                                     ));


					$bill_remain_payment=$remaining_amount - $how_much_allocate;
					$bill_amount_paid=$bill_paid_amount + $how_much_allocate;

		$remaing_update=$db->update('bills',array('balance_remaining'=>$bill_remain_payment,
							                         'paid_amount'=>$bill_amount_paid),array('id'=>$bill_id));

					if ($remaing_update)
					{
					    /*to update current balance of the seleted account*/
					  //  $account_debit=$db->get_var('accounts',array('id'=>$bank_account_id),'current_balance');
					  //  $add_debit_to_current_opening=$account_debit-$how_much_allocate;
					 //   $update1=$db->update('accounts',array('current_balance'=>$add_debit_to_current_opening),array('id'=>$bank_account_id));


						$bill_paid_amount=$db->get_var('bills',array('id'=>$bill_id),'paid_amount');
						$bill_total_amount=$db->get_var('bills',array('id'=>$bill_id),'total_amount');
						if($bill_paid_amount == $bill_total_amount)
						{
							$payment_status_update=$db->update('bills',array('payment_status'=>'paid', 'status'=>'paid'),array('id'=>$bill_id));

							if ($payment_status_update)
							{
							    $account=serialize(array($bank_account_id,$payable_type));
							    $type=serialize(array("credit","debit"));
							    $debit=serialize(array("",$bill_total_amount));
							    $credit=serialize(array($bill_total_amount,""));
							    $journal_date=date('Y-m-d',strtotime($date_selling));
							    $summary="generate from make payment";
							    $contact=serialize(array($contact_id,$contact_id));

							    $isf=JOURNAL_START_FROM+1;
							    $journal_no12=sprintf('%06u', $isf);
							    $journal_no='PY'.$journal_no12;

							    $insert=$db->insert('journal',array('journal_no'=>$journal_no,
							                                        'journal_date'=>$journal_date,
                                							        'journal_type'=>'journal',
                                							        'generated_from'=>'make_payment',
                                							        'generated_from_id'=>$last_payment_insert_id,
                                							        'summary'=>$summary,
                                							        'account'=>$account,
							                                        'reference'=>$reference,
                                							        'type'=>$type,
                                							        'debit'=>$debit,
                                							        'credit'=>$credit,
							                                         'contact'=>$contact,
                                							        'visibility_status'=>'active',
                                							        'create_date'=>$created_date,
                                							        'ip_address'=>$ip_address,
                                							        'ladger_generate'=>'no',
                                							    ));
							    //$db->debug();
							    $last_id=$db->lastInsertId();
							   $db->update('daytoday_report_settings',array('journal_start_from'=>$isf),array('id'=>1));

 /***************************Entry in tax calculation table start*************************************/
if ($bill_details['gst_registered']=="yes"){
							    $project_id=unserialize($bill_details['project_id']);
							    $item_id=unserialize($bill_details['item_id']);
							    $taxcode=unserialize($bill_details['taxcode']);
							    $tax=unserialize($bill_details['tax']);
							    $amount=unserialize($bill_details['amount']);
							    $item_qty=unserialize($bill_details['item_qty']);

							     if (is_array($project_id))
							    {
							        foreach ($project_id as $key=>$value)
							        {
							            $project_t=$value;
							            $item_t=$item_id[$key];
							            $taxcode_t=$taxcode[$key];
							            $tax_account=$db->get_var('tax',array('tax_name'=>$taxcode_t),'tax_account_for_gst_collected');
							            $tax_rate=$db->get_var('tax',array('tax_name'=>$taxcode_t),'tax_rate');
							            $tax_amount_t=$tax[$key];
							            $amount_t=$amount[$key];
							            $item_qty_t=$item_qty[$key];
							            $month=date('M');
							            $year=date('Y');
							            $section="purchase";
							            $generated_from="bill";
							            $generated_from_id=$bill_id;
							            $created_date=date('Y-m-d');
							            $ip_address=$_SERVER['REMOTE_ADDR'];
							            if ($taxcode_t!=""){
							                $insert_tax=$db->insert('tax_calculation',array('project_id'=>$project_t,
                                            							                    'tax_code'=>$taxcode_t,
                                            							                    'tax_amount'=>$tax_amount_t,
                                            							                    'tax_account'=>$tax_account,
                                            							                    'tax_rate'=>$tax_rate,
                                            							                    'item'=>$item_t,
                                            							                    'quantity'=>$item_qty_t,
                                            							                    'tax_payable_amount'=>$amount_t,
                                            							                    'generated_from'=>$generated_from,
                                            							                    'generated_from_id'=>$generated_from_id,
                                            							                    'month'=>$month,
                                            							                    'year'=>$year,
                                            							                    'section'=>$section,
                                            							                    'created_date'=>$created_date,
                                            							                    'ip_address'=>$ip_address,
                                            							                    'visibility_status'=>'active'
							                ));
							               //$db->debug();
							            }
							     }

							    }
}
/***************************Entry in tax calculation table end*************************************/

							     if ($insert){
							        $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
        				<button class="close" data-dismiss="alert" type="button">×</button>
        				Payment Successfully. </div>';
							        echo "<script>
                          setTimeout(function(){
        	    		  window.location = '".$link->link("buying_mk",user)."'
        	                },3000);</script>";
							    }

							}
						}
					}

			}
    	}


}?>



<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>Make Payment</h3>
				</div>
				<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

	                        <form action="#" class="form-horizontal" method="post">


                              <div class="row">
                            <div class="col-lg-12">


                          <h3>Add Make Payment
                   <a href="<?php echo $link->link('buying_bills',user);?>" class="btn btn-default pull-right">Back to List</a>
                   <button class="btn btn-primary pull-right " type="submit" name="rm_submit">Submit</button>
                   <a href="<?php echo $link->link('buying_bill_make_payment',user);?>" class="btn btn-default pull-right">Cancel</a>

                   </h3>
                   <div class="widget-content padded">
                            <div class="row">
                     <div class="col-lg-6">
                      <div class="form-group">
                           <label class="control-label col-md-3">Bill no</label>
                           <div class="col-md-7">
                           		<h3>#<?php echo $bill_details['bill_number'];?></h3>
                           </div>
                        </div>
                      <div class="form-group">
                           <label class="control-label col-md-3">Contact<font color="red">*</font></label>
                           <div class="col-md-7">
                           		<?php $all_contact_name=$db->get_row('contacts',array('id'=>$bill_details['supplier_id'], 'visibility_status'=>'active')); ?>
								<input class="form-control" placeholder="" type="text" value="<?php echo $all_contact_name['display_name'];?>" readonly>
								<input class="form-control" placeholder="" type="hidden" name="contact_id" value="<?php echo $all_contact_name['id'];?>">


                           		<!-- <select class="form-control" name="contact_id" id=contact_id required readonly>
                                          <?php $all_contact_name=$db->get_row('contacts',array('id'=>$bill_details['customer_id'], 'visibility_status'=>'active'));
                                 			if (is_array($all_contact_name)){
                            					foreach ($all_contact_name as $cn){?>
			                                       <option value="<?php echo $cn['id']?>"><?php echo $cn['display_name']."-:&nbsp;&nbsp;&nbsp;&nbsp;".$cn['contact_type'];?></option>
                                          <?php }}?>
                                 </select> -->
                           </div>
                        </div>

                            <div class="form-group">
                           <label class="control-label col-md-3">Date<font color="red">*</font></label>
                           <div class="col-md-7">
                           <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="date_selling" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                      </div></div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Payble type<font color="red">*</font></label>
                           <div class="col-md-7">
                             	<select class="form-control" name="payable_type" >

                                          <?php
                                         $all_account=$db->run("SELECT * FROM `accounts` WHERE `visibility_status`='active' and `account_type`!='bank' ")->fetchAll();



                                       //   $all_account=$db->get_all('accounts',array('visibility_status'=>'active'));
                                 if (is_array($all_account)){
                            foreach ($all_account as $acc){?>
                                       <option <?php if ($acc['id']==Liability_Account_for_Item_Receipts){echo "selected='selected'";}?> value="<?php echo $acc['id']?>"><?php echo $acc['account_name']."-:&nbsp;&nbsp;&nbsp;&nbsp;".$acc['nature'];?></option>
                                          <?php }}?>
                                  </select>
                           </div>
                        </div>

                               <div class="form-group">
                           <label class="control-label col-md-3">Payment method</label>
                           <div class="col-md-7">
                              <select class="form-control" name="payment_method">
                               <option value="cheque">Cheque</option>
                                 <option value="cash">Cash</option>
                                  <option value="bank_transfer">Bank Transfer</option>
                                  <option value="NETS">NETS</option>
                                   <option value="bpay">Wirecard AG</option>
                                   <option value="GTPay">GTPay</option>
                                   <option value="Asia Pay">Asia Pay</option>
                              </select>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-3">Reference</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="reference">
                           </div>
                        </div>
                          <div class="form-group">
                           <label class="control-label col-md-3">Details</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="details">
                           </div>
                        </div>

                        <br>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-3">Bank account<font color="red">*</font></label>
                           <div class="col-md-7">
                              <select class="form-control" name="bank_account" required>
                              	<?php $bank_account=$db->get_all('accounts',array('account_type'=>'bank', 'visibility_status'=>'active'));
									if (is_array($bank_account)){
										foreach ($bank_account as $account){ ?>
											<option <?php if ($acc['id']==Bank_Account_for_Paying_Bills){echo "selected='selected'";}?> value="<?php echo $account['id'];?>"><?php echo $account['account_name'];?></option>
								<?php 	}
									}?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">

                           </div>
                        </div>
                        <br>

                        <div class="form-group">
                           <label class="control-label col-md-3">Remaining amount</label>
                           <div class="transaction_ifyes_div" style="display:none12;">
                         <div class="col-md-7">
                              <input class="form-control" placeholder="$0" type="text" name="remaining_amount" id="amount" value="<?php echo $bill_details['balance_remaining'];?>" readonly>
                           </div>
                           </div>
                        </div>
                           <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">

                           </div>
                        </div>
                         <div class="form-group">
                                        <label class="control-label col-md-3">Allocation notes</label>
                                        <div class="col-md-7">
                                          <textarea class="form-control" rows="5"  name="allocation_notes"></textarea>
                                        </div>
                                      </div>
                        <br>

                     </div>

               </div>

                      <br>
                       <div class="row">
             <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">

                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Allocate</span></a>
                      </li>

                     </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                    <br>
                       <h5><strong>ALLOCATE THIS MONEY TO AN EXISTING TRANSACTION</strong></h5>
             <div class="row">
   <table class="table table-bordered table-striped" id="dataTable112">
					                  <thead>
					                  <tr >

					                    <th>Date</th>
					                    <th>Id</th>
					                    <th>Type</th>
					                    <th>Total amount</th>
					                    <th>Balance remaining</th>
                                        <th>How much to allocate</th>
					                    </tr></thead>
					                  <tbody>


					                    <tr>

					                      <td><?php echo $bill_details['bill_date'];?></td>
					                      <td><?php echo $bill_details['bill_number'];?>
					                      		<input class="form-control" type="hidden" name="invoice_id" value="<?php echo $bill_details['id'];?>">
					                      </td>
					                      <td>Bill</td>
					                      <td><?php echo CURRENCY . " " . $bill_details['total_amount'];?></td>
					                      <td><?php echo CURRENCY . " " . $bill_details['balance_remaining'];?></td>
                                          <td><input class="form-control" type="text" name="how_much_allocate" value="<?php echo $bill_details['balance_remaining'];?>"></td>

					                    </tr>


					                  </tbody>
					                </table>
					                <br>

					                <h5><strong>Other Bills related to <?php echo $customer_detail['display_name']?></strong></h5>

					                   <table class="table table-bordered table-striped">
					                  <thead>
					                  <tr >

					                    <th>Date</th>
					                    <th>Id</th>
					                    <th>Type</th>
					                    <th>Total amount</th>
					                    <th>Balance remaining</th>
                                        <th>Payment Status</th>
					                    </tr></thead>
					                  <tbody>

<?php

$sql="SELECT* FROM `bills` WHERE `supplier_id`='$bill_details[supplier_id]' AND (`status`='approved' OR `status`='unpaid') AND `id`!='$bill_id'";
$other_bills=$db->run($sql)->fetchAll();
if (is_array($other_bills)){
    foreach ($other_bills as $ob){
        ?>

					                    <tr>

					                      <td><?php echo $ob['bill_date'];?></td>
					                      <td><?php echo $ob['bill_number'];?></td>
					                      <td>Bill</td>
					                      <td><?php echo CURRENCY . " " . $ob['total_amount'];?></td>
					                      <td><?php echo CURRENCY . " " . $ob['balance_remaining'];?></td>
                                          <td>
                                            <?php if ($ob['payment_status']=="paid"){?>
                                                <span class="label label-success" ><?php echo  ucfirst($ob['payment_status']);?></span>
                                                <?php }elseif ($ob['payment_status']=="unpaid")
                                                {?>
                                                <span class="label label-danger" ><?php echo  ucfirst($ob['payment_status']);?></span>
                                                <a
															href="<?php echo $link->link('buying_bill_make_payment',user,'&bill_id='.$ob['id']);?>"><i
																class="fa fa-plus"></i>Make payment</a>
                                                <?php }?>
                                         </td>

					                    </tr>
    <?php }
}?>

					                  </tbody>
					                </table></div>
                    </div>


                  </div>
                </div>
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


