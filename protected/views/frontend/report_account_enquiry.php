<?php
//$nature="income";
//$type="debit";

$all_account=$db->get_all('accounts');
?>
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user);?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=account_enquery');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>General Ledger<br>
					<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";
 $html.="<table style='width:100%'>

<tr>
                        <td>DATE</td>
                        <td>TYPE</td>
                        <td>NUMBER</td>
                        <td>CONTACT</td>
                        <td>TAX CODE</td>
                        <td>(".CURRENCY.") AMOUNT</td>
                      </tr>";
if (is_array($all_account)){
    foreach ($all_account as $alla){
        $aid=$alla['id'];
        if ($db->exists('account_transaction',array('account_id'=>$aid))){
        $account_name=$alla['account_name'];
        if ($alla['account_code']!=""){$code= "Code: " .$alla['account_code'];}
        if ($alla['account_type']!=""){$type= "Type: " .ucfirst(str_replace("_", " ", $alla['account_type']));}
        $html.="<tr>
		    <td><h3>".$account_name."</h3><br>".$code." ".$type."</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
               </tr>";


        if($alla['opening_balance']=='') {echo $opening_balance="";}else{$opening_balance=number_format($alla['opening_balance'],2,'.',',');}

   $html.="<tr>
            <td></td>
			<td></td>
            <td></td>
            <td></td>
            <td><strong>Opening balance</strong></td>
            <td>";
           if ($alla['opening_balance']!="")
           {
               $html.=$opening_balance;
           }
       $html.="</td>
       </tr>";

       $all_account_transations=$db->get_all('account_transaction',array('account_id'=>$alla['id']));
       if (is_array($all_account_transations)){
           foreach($all_account_transations as $alat){

               $date=date(DATE_FORMAT,strtotime($alat['create_date']));
               $contact_name=$db->get_var('contacts',array('id'=>$alat['contact']),'display_name');


            $account_nature=$db->get_var('accounts',array('id'=>$alat['account_id']),'nature');
             $account_current_balance=$db->get_var('accounts',array('id'=>$alat['account_id']),'current_balance');
             $transaction_type=$alat['transaction_type'];
               $sign=$acc_object->getsign($account_nature, $transaction_type);
 if($alat['amount']=='') {echo $amount="";}
              else{
                  $amount_new=$alat['amount'];
                  $amount=CURRENCY . " " .number_format($amount_new,2,'.',',');}

              $tax_code=$db->get_var('tax',array('id'=>$alat['tax_code']),'tax_name');

               if ($alat['type']=="journal")
               {
                   $number=$db->get_var('journal',array('id'=>$alat['type_id']),'journal_no');
               }elseif ($alat['type']=="bill")
               {
                   $number=$db->get_var('bills',array('id'=>$alat['type_id']),'bill_number');
               }
               elseif ($alat['type']=="invoice")
               {
                   $number=$db->get_var('invoices',array('id'=>$alat['type_id']),'invoice_number');
               }
               else
               {$number= "-";}
             $html.="<tr>
                        <td>".$date."</td>
                        <td>".$type."</td>
                        <td>".$number."</td>
                       <td>".$contact_name."</td>
                        <td>".$tax_code."</td>";
	        	 		if($sign=="-" && $amount_new!=0){
							$html.="<td style='color:red'>".$sign."".number_format($amount_new,2,'.',',')."</td>";
						}else{
							$html.="<td>".number_format($amount_new,2,'.',',')."</td>";
						}
	        	$html."</tr>";
}}
           $ai=$alla['id'];
           $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$ai";
           $amount=$db->run($query)->fetchColumn();


           $html.="<tr>
			<td></td>
                   <td></td>
            <td></td>
            <td></td>
            <td><strong>Closing balance</strong></td>
            <td>";
       if ($account_current_balance!="" && $account_current_balance!=NULL){ $html.= number_format($account_current_balance,2,'.',',');}
           $html.="</td>
       </tr>";

    }}}
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/account_enquery.html';
file_put_contents ( $filename, $html );




echo $html;?>














                  </div>
        </div>
    </div>
</div>