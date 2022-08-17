<?php
$current_tab=$_COOKIE['current_tab'];

if ($current_tab!="draft" && $current_tab!="approved" && $current_tab!="overdue" && $current_tab!="paid")
{	$current_tab="all"; }

if ($current_tab=="draft")
{
    $db->order_by='id desc';
    $all_bills=$db->get_all('bills',array('visibility_status'=>'active','status'=>'draft'));
}
elseif ($current_tab=="approved")
{
    $db->order_by='id desc';
    $all_bills=$db->get_all('bills',array('visibility_status'=>'active','status'=>'approved'));
}
elseif ($current_tab=="overdue")
{

    $today_date=date('d-m-Y');

    $sql="SELECT* FROM `bills` WHERE `visibility_status`='active' AND `due_date`< '$today_date' AND `status`!='paid'";
    $all_invoices=$db->run($sql)->fetchAll();

}
elseif ($current_tab=="paid")
{
    $db->order_by='id desc';
    $all_bills=$db->get_all('bills',array('visibility_status'=>'active','status'=>'paid'));
}
else{
    $db->order_by='id desc';
    $all_bills=$db->get_all('bills',array('visibility_status'=>'active'));}

if (isset($_REQUEST['action_approve']))
{
    $action_id=$_REQUEST['action_approve'];

    /****************** Calculation start for bill to make entry in journal  *****************/
    $bill_details=$db->get_row('bills',array('id'=>$action_id));
    $new_account=array();
    $new_type=array();
    $new_debit=array();
    $new_credit=array();
    $new_contact=array();
    //receivables calculations
    array_push($new_account, Liability_Account_for_Item_Receipts);
    array_push($new_type, 'credit');
    array_push($new_debit, '');
    array_push($new_credit, $bill_details['total_amount']);
    array_push($new_contact,$bill_details['supplier_id']);

    //tax calculation
    array_push($new_account, ACCOUNT_FOR_TAX_PAID);
    array_push($new_type, 'debit');
    array_push($new_debit, $bill_details['total_tax']);
    array_push($new_credit, '');
    array_push($new_contact,$bill_details['supplier_id']);



    $account=unserialize($bill_details['account']);



    $amount=unserialize($bill_details['amount']);
    foreach ($account as $key=>$value)
    {

        array_push($new_account, $value);
        array_push($new_type, 'debit');
        array_push($new_debit, $amount[$key]);
        array_push($new_credit, '');
        array_push($new_contact,$bill_details['supplier_id']);

    }


    $account=serialize($new_account);
    $type=serialize($new_type);
    $debit=serialize($new_debit);
    $credit=serialize($new_credit);
    $contact=serialize($new_contact);
    $journal_date=date(DATE_FORMAT);
    $generated_from="bill";
    $generated_from_id=$action_id;
    $summary="generate from bill";
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];

    $isf=JOURNAL_START_FROM+1;
    $journal_no12=sprintf('%06u', $isf);
    $journal_no='PJ'.$journal_no12;

    $reference=$bill_details['reference_code'];

   /* echo "<pre>";
    print_r($new_account);
    echo "</pre>";
    echo "<pre>";
    print_r($new_type);
    echo "</pre>";
   */
    $insert_journal=$db->insert('journal',array('journal_no'=>$journal_no,
                                                'journal_date'=>$journal_date,
                                                'journal_type'=>'journal',
                                                'generated_from'=>$generated_from,
                                                'generated_from_id'=>$generated_from_id,
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
    $db->update('daytoday_report_settings',array('journal_start_from'=>$isf),array('id'=>1));

    /************************************* calculation end for journal****************************************************/

   $update=$db->update('bills',array('status'=>'approved'),array('id'=>$action_id));
    if ($update)
    {
        $bill_number=$db->get_var('bills',array('id'=>$action_id),'bill_number');
        $event="Status change to approved of Bill  (" . $bill_number . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">�</button>
                    Bill Approved Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("buying_bills",user)."'
        	                },3000);</script>";
    }
}

elseif(isset($_REQUEST['action_delete']))
{
    $delete_id=$_REQUEST['action_delete'];

    $display_msg='<form method="POST" action="">
    <div class="alert alert-danger">
    <button class="close" data-dismiss="alert" type="button">�</button>
	Are you sure ? You want to delete this .
	<input type="hidden" name="del_id" value="'.$delete_id.'" >
	<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="lnr lnr-checkmark-circle"></i></button>
	<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="lnr lnr-cross-circle"></i></button>
	</div>
	</form>';
    if(isset($_POST['yes']))
    {
        $bill_number=$db->get_var('bills',array('id'=>$_POST['del_id']),'bill_number');
        $event="Delete bill  (" . $bill_number . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                                          'event'=>$event,
                                          'created_date'=>date('Y-m-d'),
                                          'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('bills',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">�</button>
                    Bill Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("buying_bills",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('buying_bills',user);
    }
}
?>
<style>
.number1 {
	font-size: 1.5em;
	font-weight: 100;
	color: #007aff;
	line-height: 1.4em;
	padding-top: 8px;
	letter-spacing: -0.06em;
}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class=" padded">
			<h3>BUYING</h3>
			<div class="row">
				<div class="col-lg-12">
					<div class="widget-container stats-container">
						<div class="col-md-4">
							<div class="number1 number_font" style="font-family: serif;">
               <?php
                $sql="SELECT SUM(total_amount) FROM bills WHERE visibility_status='active'";
                 $total_invoice_amount=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_invoice_amount,2,'.',',');?>
                                  </div>
							<div class="text">Total Amount</div>
						</div>
						<div class="col-md-4">
							<div class="number1 number_font" style="font-family: serif;">
                <?php
                $sql="SELECT SUM(paid_amount) FROM bills WHERE visibility_status='active'";
                 $total_paid_amount=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_paid_amount,2,'.',',');?>
                    </div>
							<div class="text">Amount Paid</div>
						</div>
						<div class="col-md-4">
							<div class="number1 number_font" style="font-family: serif;">
                 <?php
                $sql="SELECT SUM(balance_remaining) FROM bills WHERE visibility_status='active'";
                 $total_balance_remaining=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_balance_remaining,2,'.',',');?>                  </div>
							<div class="text">Amount Due</div>
						</div>

					</div>
				</div>
			</div>
		</div>
					<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
			<div class="widget-content padded">
				<div class="row">

					<div class="col-lg-12">

						<a href="<?php echo $link->link('buying_bills',user);?>"
							class="btn <?php if ($query1ans=="buying_bills"){echo "btn-primary";}else{echo "btn-default";}?> ">Bills</a>
						<a href="<?php echo $link->link('buying_san',user);?>"
							class="btn <?php if ($query1ans=="buying_san"){echo "btn-primary";}else{echo "btn-default";}?>">Supplier
							adjustment notes</a> <a
							href="<?php echo $link->link('buying_mk',user);?>"
							class="btn <?php if ($query1ans=="buying_mk"){echo "btn-primary";}else{echo "btn-default";}?>">Make
							payment</a>
  <?php if(in_array('create_and_edit',$dtd_bills)){?>
  	<?php if (IS_GST_REGISTERED=='yes'){?>
   	<a href="<?php echo $link->link('add_buying_bill',user);?>" class="btn btn-default pull-right"> Add Bill</a>
   	<?php }if (IS_GST_REGISTERED=='no'){?>
   	<a href="<?php echo $link->link('add_bill_without_tax',user);?>" class="btn btn-default pull-right"> Add Bill</a>
   	<?php }?>
<?php }?>


	</div>
				</div>
				<div class="heading tabs">
					<i class="icon-sitemap"></i>
					<ul class="nav nav-tabs pull-left" data-tabs="tabs">
						<li tab="all"
							class="set_cookie <?php if ($current_tab=="all" || $current_tab=="" ){echo"active";}?>">
							<a href="#"><i class="icon-comments"></i><span>All</span></a>
						</li>
						<li tab="draft"
							class="set_cookie <?php if ($current_tab=="draft"){echo"active";}?>">
							<a href="#"><i class="icon-user"></i><span>Draft</span></a>
						</li>
						<li tab="approved"
							class="set_cookie <?php if ($current_tab=="approved"){echo"active";}?>">
							<a href="#"><i class="icon-user"></i><span>Approved</span></a>
						</li>
						<li tab="overdue"
							class="set_cookie <?php if ($current_tab=="overdue"){echo"active";}?>">
							<a href="#"><i class="icon-user"></i><span>Overdue</span></a>
						</li>
						<li tab="paid"
							class="set_cookie <?php if ($current_tab=="paid"){echo"active";}?>">
							<a href="#"><i class="icon-user"></i><span>Paid</span></a>
						</li>
					</ul>

				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="widget-container fluid-height clearfix">

							<div class="widget-content padded clearfix">
								<table class="table table-bordered table-striped"
									id="dataTable1">
									<thead>
										<tr row="">
											<th class="check-header hidden-xs">S.no</th>
											<th>Date</th>
											<th>Bill no.</th>
											<th class="hidden-xs">Contact</th>
											<th class="hidden-xs">Reference</th>
											<th>Status</th>
											<th>Total Amount</th>
											<th>Balance remaining</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
					                  <?php
					                  if (is_array($all_bills)){
					                      $sn=1;
					                      foreach ($all_bills as $allb){

					                  ?>
					                  <tr>
											<td class="check hidden-xs">
					                        <?php echo $sn;?>
					                      </td>
											<td><?php echo date(DATE_FORMAT,strtotime($allb['bill_date']));?></td>
											<td><?php echo $allb['bill_number'];?></td>
											<td><?php echo $contact_name=$db->get_var('contacts',array('id'=>$allb['supplier_id']),'display_name');?></td>
											<td><?php echo $allb['reference_code'];?></td>
											<td><?php echo $allb['status'];?></td>
											<td><?php if ($allb['total_amount']!=""){ echo CURRENCY . " " .number_format($allb['total_amount'],2,'.',',');}?></td>
											<td><?php if ($allb['balance_remaining']!=""){ echo CURRENCY . " " .number_format($allb['balance_remaining'],2,'.',',');}?></td>
											<td>
                                          <?php if ($allb['status']!="paid"){?>
                                          <div class="btn-group">
													<button class="btn btn-xs btn-default dropdown-toggle"
														data-toggle="dropdown">
														Action <span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
                                              <?php if(in_array('view',$dtd_bills)){?>
                                              <li><a
															href="<?php echo $link->link('view_buying_bills',user,'&action_view='.$allb['id']);?>"><i
																class="fa fa-edit"></i>View</a></li>
                                          <?php }
                                          if(in_array('create_and_edit',$dtd_bills) && $allb['status']=="draft"){?>
											<li>
											<?php if ($allb['gst_registered']=='no'){?>
	                                            <a href="<?php echo $link->link('edit_bill_without_tax',user,'&action_edit='.$allb['id']);?>"><i class="fa fa-edit"></i>Edit</a>
	                                         <?php }else{ ?>
	                                         	<a href="<?php echo $link->link('edit_bills',user,'&action_edit='.$allb['id']);?>"><i class="fa fa-edit"></i>Edit</a>
	                                         <?php } ?>
	                                         </li>

                                              <?php }if(in_array('approve',$dtd_bills)){?>
                                               <li>
                                               <?php if ($allb['status']=="approved"){?>
                                                  <a
															href="<?php echo $link->link('buying_bill_make_payment',user,'&bill_id='.$allb['id']);?>"><i
																class="fa fa-plus"></i>Make payment</a>
                                                  <?php }elseif ($allb['status']=="draft"){?>
                                                  <a
															href="<?php echo $link->link('buying_bills',user,'&action_approve='.$allb['id']);?>"><i
																class="fa fa-plus"></i>Approved</a>
                                                  <?php }?>
                                               </li>
                                               <?php }if(in_array('delete',$dtd_bills)){?>
                                               <li>
                                               <?php if ($allb['status']=="approved" || $allb['status']=="draft"){?>
                                                  <a
															href="<?php echo $link->link('buying_bills',user,'&action_delete='.$allb['id']);?>"><i
																class="fa fa-edit"></i>Delete</a>
                                                  <?php }?>
                                               </li>
                                               <?php }?>
                                            </ul>
												</div>
                                           <?php }else{
                                            if(in_array('view',$dtd_bills)){?>

                                           	<a
												href="<?php echo $link->link('view_buying_bills',user,'&action_view='.$allb['id']);?>"><i
													class="fa fa-edit"></i>View</a>



                                         <?php }} ?>
                                          </td>

										</tr>
					                    <?php $sn++; }}?>



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