
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >

				<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user);?>">Back to list</a>
                <a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=trial_balance');?>"

					><i class="fa fa-file">&nbsp;PDF Generate</i></a>
				</div>
<br>
<br>
    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
        	  <div class="row">

        	  	<?php
        echo	$html="<table style='width:100%';text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Trial balance<br>
					<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";



$html='<table width="100%">
     <tr>
      <th>ACCOUNTCODE</th>
      <th>ACCOUNT NAME</th>
   <th>ACCOUNT TYPE</th>
   <th>DEBIT</th>
    <th>CREDIT</th>
   </tr>';
$all_account=$db->get_all('account_transaction');
//print_r($all_account)
if (is_array($all_account)){
    $debit_array=array();
    $credit_array=array();
    foreach ($all_account as $alla){
        $aid=$alla['id'];
        $account_id=$alla['account_id'];
        $account_details=$db->get_row('accounts',array('id'=>$account_id));
        $account_code=$account_details['account_code'];
        $account_name=$account_details['account_name'];
        $account_type=$account_details['account_type'];
        $account_nature=$account_details['nature'];

      if ($alla['transaction_type']=="debit")
        {
            $debit_amount=$alla['amount'];
            $credit_amount="";
            array_push($debit_array, $debit_amount);
        }elseif($alla['transaction_type']=="credit")
        {
            $credit_amount=$alla['amount'];
            $debit_amount="";
            array_push($credit_array, $credit_amount);
        }



                                 $html.='<tr><td width="20%">'.$account_code.'</td>
                                 <td width="20%">'.$account_name.'</td>
                                 <td width="20%">'.$account_type.'</td>
                                 <td width="20%">';
                                 if ($debit_amount!=""){
                                 $html.=CURRENCY ." ".number_format($debit_amount,2,'.',',');
                                 }
                                 $html.='</td>';
                                 $html.='<td width="20%">';
                                 if ($credit_amount!=""){
                                     $html.=CURRENCY ." ".number_format($credit_amount,2,'.',',');
                                 }
                                $html.='</td>';
                               $html.='</tr>';
                                }}
                                $amount_debit=array_sum($debit_array);
                                $amount_credit=array_sum($credit_array);

                            /*    $query="SELECT SUM(amount) FROM `account_transaction` where `transaction_type`='debit'";
                                $amount_debit=$db->run($query)->fetchColumn();

                                $query="SELECT SUM(amount) FROM `account_transaction` where `transaction_type`='credit'";
                                $amount_credit=$db->run($query)->fetchColumn();*/

                                 $html.='<tr>
                                  <td ></td>
                                 <td ></td>
                                 <td ></td>
                                 <td ><strong>TOTAL&nbsp;&nbsp;&nbsp;'.CURRENCY ." ".number_format($amount_debit,2,'.',',').'</strong></td>
                                 <td ><strong>'.CURRENCY ." ".number_format($amount_credit,2,'.',',').'</strong></td>
                               </tr>
                             </table>';


$filename = SERVER_ROOT . '/uploads/pdf/trial_balance.html';
file_put_contents ( $filename, $html );
echo $html?>



 </div>
        </div>
    </div>
</div>
</div>