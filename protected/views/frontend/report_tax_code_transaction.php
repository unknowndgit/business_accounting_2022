<?php
$nature="income";
$type="debit";
//$acc_object->getsign($nature, $type);
$all_account=$db->get_all('accounts');
?>
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=tax');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=tax_code_transaction');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Tax code Transaction List<br>
					<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";

 $html.="<table style='width:100%'>

                         <tr>
                         <td>SRC</td>
                        <td>DATE</td>
                        <td>MEMO</td>
                        <td>#ID</td>
                        <td>DEBIT</td>
                        <td>CREDIT</td>
                        <td>ACCOUNT TAX</td>
                        <td>ENTERED TAX</td>
                        <td>DEFAULT TAX</td>
                      </tr>";
if (is_array($all_account)){
    foreach ($all_account as $alla){
        $aid=$alla['id'];
        if ($db->exists('account_transaction',array('account_id'=>$aid))){
        $account_name=$alla['account_name'];
        if ($alla['account_code']!=""){$code=$alla['account_code'];}
        if ($alla['account_type']!=""){$type=ucfirst(str_replace("_", " ", $alla['account_type']));}
        $default_tax=$db->get_var('tax',array('default_tax_code'=>'1'),'tax_name');
        $account_tax_code=$db->get_var('tax',array('id'=>$alla['default_tax_code']),'tax_name');
        $html.="<tr>
		    <td><h3><strong>".$code." ".$account_name."<strong></h3></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                     <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
               </tr>";


       $all_account_transations=$db->get_all('account_transaction',array('account_id'=>$alla['id']));
       if (is_array($all_account_transations)){
           foreach($all_account_transations as $alat){
               $date=date(DATE_FORMAT,strtotime($alat['create_date']));
               $type=$alat['type'];
               $transaction_type=$alat['transaction_type'];
               $contact_name=$db->get_var('contacts',array('id'=>$alat['contact']),'display_name');
               $entered_tax_code=$db->get_var('tax',array('id'=>$alat['tax_code']),'tax_name');
               $tax=$alat['tax_code'];

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

               $amount=CURRENCY . " " .number_format($alat['amount'],2,'.',',');

               $html.="<tr>
                        <td>".$type."</td>
                        <td>".$date."</td>
                       <td>memo</td>

                        <td>".$number."</td>";


               $html.="<td>";
                  if($transaction_type=="debit")
                  {
                      $html.=$amount;
                  }else
                  {
                      $html.="-";
                  }
                  $html.="</td>";
                  $html.="<td>";
                  if($transaction_type=="credit")
                  {
                      $html.=$amount;
                  }else
                  {
                      $html.="-";
                  }
                  $html.="<td>".$account_tax_code."</td>";
                  $html.="<td>".$entered_tax_code."</td>";
                  $html.="<td>".$default_tax."</td>";
	        	$html."</tr>";

}}
           $ai=$alla['id'];
           $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$ai";
           $amount=$db->run($query)->fetchColumn();




    }}}
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/tax_code_transaction.html';
file_put_contents ( $filename, $html );




echo $html;?>

</div>
        </div>
    </div>
</div>