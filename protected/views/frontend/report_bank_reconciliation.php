<?php


if (isset($_POST['bank_reconciliation_report_submit'])){
   // print_r($_POST);
    $bank_account=$_POST['bank_account'];
    $till_date=$_POST['till_date'];


    if ($bank_account=="")
    {
        $display_msg= '<div class="alert alert-danger"><i class="lnr lnr-sad"></i>
            		<button class="close" data-dismiss="alert" type="button">×</button> Bank Account can not empty.
                		</div>';
    }
    elseif ($till_date=="")
    {
        $display_msg= '<div class="alert alert-danger"><i class="lnr lnr-sad"></i>
            		<button class="close" data-dismiss="alert" type="button">×</button>Select Reporting period .
                		</div>';
    }
    else
    {
        $till_date=date('Y-m-d',strtotime($till_date));

        $bank_name=$db->get_var('accounts',array('id'=>$bank_account),'account_name');
        $bank_current_balance=$db->get_var('accounts',array('id'=>$bank_account),'current_balance');
        $bank_last_reconciliation_amount=$db->get_var('accounts',array('id'=>$bank_account),'last_reconciliation_amount');
       $bank_last_reconciliation_date=$db->get_var('accounts',array('id'=>$bank_account),'last_reconciliation_date');
        $sql="SELECT* FROM `account_transaction` WHERE `account_id`='$bank_account' AND `reconcile`='yes' AND `create_date`<='$till_date'";
        $reconciled_list=$db->run($sql)->fetchAll();
       // print_r($reconciled_list);



        //$reconciled_list=$db->get_all('account_transaction',array('account_id'=>$bank_account,'reconcile'=>'yes'));
      //  print_r($reconciled_list);
       $query="SELECT SUM(`amount`) FROM `account_transaction` WHERE `account_id`='$bank_account' AND `reconcile`='yes' AND `create_date`<='$till_date'";
        $amount=$db->run($query)->fetchColumn();
    }
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
			<h3>BANK RECONCILIATION</h3>
		</div>
		<?php echo $display_msg;?>


 <div class="widget-container fluid-height" id="div1-wrapper">
        	<div class="widget-content padded" id="div1">

        		<form action="" class="form-horizontal" method="post">
        		  <a href="<?php echo $link->link('reports',user,'&report_type=advisor');?>" class="btn btn-default pull-right">Back to List</a>
        		 <?php if (!empty($reconciled_list)){?>
        		  <a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=bank_reconciliation');?>">&nbsp;PDF Generate</a>
<?php }?>


             <div class="form-group">
			            <label class="control-label col-md-2">Bank account <span style="color:red;">*</span></label>
			            <div class="col-md-3">
			              <select class="form-control" name="bank_account">
			               <option value="">Select</option>
			              	<?php
			              	$accounts=$db->get_all('accounts',array('account_type'=>'bank'));
			              		if (is_array($accounts)){
			              			foreach ($accounts as $account){?>
			              				<option <?php if ($bank_account==$account['id']){echo "selected='selected'";}?> value="<?php echo $account['id'];?>"><?php echo $account['account_name'];?></option>
			              	<?php 	}
			              		}
			              	?>
			              </select>
			            </div>
			        </div>
        			 <div class="form-group">
			            <label class="control-label col-md-2">Reporting period <span style="color:red;">*</span></label>
			            <div class="col-md-3">
			              <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy" >
			                <input class="form-control" type="text" name="till_date" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span></input>
			              </div>
			            </div>
			         </div>
			          <div class="form-group">
			            <label class="control-label col-md-2"></label>
			            <div class="col-md-3">

			                <button class="btn btn-default pull-right" name="bank_reconciliation_report_submit" type="submit">Refresh</button>

			            </div>
			         </div>





        		</form>

        		<br>
        		<br>
        		       	<?php
        		       	if (isset($_POST['bank_reconciliation_report_submit'])){


  $query="SELECT SUM(`transaction_amount`) FROM `receive_money` WHERE `bank_account`='$bank_account' AND `reconcile`='yes' AND `created_date`<='$till_date'";
    $add_reconciled_receipts=$db->run($query)->fetchColumn();

    $query1="SELECT SUM(`transaction_amount`) FROM `receive_money` WHERE `bank_account`='$bank_account' AND `reconcile`='no' AND `created_date`<='$till_date'";
   $add_unreconciled_receipts=$db->run($query1)->fetchColumn();

    $query2="SELECT SUM(`transaction_amount`) FROM `make_payment` WHERE `bank_account`='$bank_account' AND `reconcile`='yes' AND `created_date`<='$till_date'";
   $deduct_reconciled_payments=$db->run($query2)->fetchColumn();

     $query3="SELECT SUM(`transaction_amount`) FROM `make_payment` WHERE `bank_account`='$bank_account' AND `reconcile`='no' AND `created_date`<='$till_date'";
   $deduct_unreconciled_payments=$db->run($query3)->fetchColumn();








$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>BANK RECONCILIATION<br>
							<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";

$html.="<hr>";

$html.="<table style='width:100%;text-align:right';>
                       <tr>
                    		    <td style='width:50%'></td>
                    		    <td style='width:20%'>Reconciled balance at ";

                            if ($bank_last_reconciliation_date!="")
                            {
                                $html.=date(DATE_FORMAT,strtotime($bank_last_reconciliation_date));
                            }
                            $html.="</td>";
                               $html.=" <td style='width:20%'>".CURRENCY." ".number_format($bank_last_reconciliation_amount,2,'.',',')."</td>
                                        <td style='width:10%'></td>
            		   </tr>
                        <tr>
                		    <td style='width:50%'></td>
                		    <td style='width:20%'>Add reconciled receipts </td>
                            <td style='width:20%'>".CURRENCY." ".number_format($add_reconciled_receipts,2,'.',',')."</td>
                            <td style='width:10%'></td>
            		   </tr>
                          <tr>
                		    <td style='width:50%'></td>
                		    <td style='width:20%'>Deduct reconciled payments </td>
                            <td style='width:20%'>".CURRENCY." ".number_format($deduct_reconciled_payments,2,'.',',')."</td>
                            <td style='width:10%'></td>
                		   </tr>
            <tr>
                		    <td style='width:50%'></td>
                		    <td style='width:20%'>Bank balance at " .date(DATE_FORMAT). " </td>
                            <td style='width:20%'>".CURRENCY." ".number_format($bank_current_balance,2,'.',',')."</td>
                            <td style='width:10%'></td>
                		   </tr>
        	     <tr>
                		    <td style='width:50%'></td>
                		    <td style='width:20%'> Add unreconciled receipts </td>
                            <td style='width:20%'>".CURRENCY." ".number_format($add_unreconciled_receipts,2,'.',',')."</td>
                            <td style='width:10%'></td>
                		   </tr>
        		       <tr>
                		    <td style='width:50%'></td>
                		    <td style='width:20%'>Deduct unreconciled payments </td>
                            <td style='width:20%'>".CURRENCY." ".number_format($deduct_unreconciled_payments,2,'.',',')."</td>
                            <td style='width:10%'></td>
                		   </tr>
                    </table>";
if (!empty($reconciled_list)){
$html.="<hr><h5>RECONCILED</h5>";
$html.="<table style='width:100%'>

<tr>
                        <td style='width:10%'>DATE</td>
                        <td style='width:10%'>TYPE</td>
                        <td style='width:15%'>REFERENCE</td>
                        <td style='width:10%'>CONTACT</td>
                        <td style='width:25%'>DESCRIPTION</td>
                         <td style='width:20%'>AMOUNT</td>

                      </tr>";


       if (is_array($reconciled_list)){


           foreach($reconciled_list as $pymnt){
               $contact_name=$db->get_var('contacts',array('id'=>$pymnt['contact']),'display_name');

               $journal_detail=$db->get_row('journal',array('id'=>$pymnt['type_id']));
               $generated_from=$journal_detail['generated_from'];
               $generated_from_id=$journal_detail['generated_from_id'];

               if ($generated_from=="receive_money")
               {
                   $receive_money_detail=$db->get_row('receive_money',array('id'=>$generated_from_id));
                   $reference=$receive_money_detail['reference'];
                   $details=$receive_money_detail['details'];

               }
               elseif($generated_from=="make_payment")
               {
                   $make_payment_detail=$db->get_row('make_payment',array('id'=>$generated_from_id));
                   $reference=$make_payment_detail['reference'];
                   $details=$make_payment_detail['details'];
               }
               elseif($generated_from=="Transfer_money")
               {
                   $transfer_money_detail=$db->get_row('transfer_money',array('id'=>$generated_from_id));
                   $reference=$transfer_money_detail['reference'];
                   $details=$transfer_money_detail['description'];

               }else
               {
                   $reference="";
                   $details=$journal_detail['description'];
               }


                 $html.="<tr>
                         <td>".ucfirst($pymnt['transaction_date'])."</td>
                         <td>".$pymnt['type']."</td>
                         <td>".$reference."</td>
        		         <td>".$contact_name."</td>
                         <td>".$details."</td>
                         <td>".CURRENCY." ".number_format($pymnt['amount'],2,'.',',')."</td>

                      </tr>";

}}

$html.="<tr>
    <td></td>
    <td></td>
     <td></td>
     <td></td>
     <td></td>
    <td><strong>Total</strong> ".CURRENCY." ".number_format($amount,2,'.',',')."</td>

    </tr>";
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/bank_reconciliation.html';
file_put_contents ( $filename, $html );
echo $html;
}else{
    echo $html;

    echo "No transaction";}
}

?>

			</div>
		</div>
	</div>
</div>

