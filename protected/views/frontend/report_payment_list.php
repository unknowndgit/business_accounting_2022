
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=advisor');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=payment_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Payment list<br>
							<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td style='width:10%'>RECONCILED</td>
                        <td style='width:10%'>DATE</td>
                        <td style='width:10%'>CONTACT NAME</td> 
                        <td style='width:10%'>REFERENCE</td>
                        <td style='width:15%'>DETAILS</td>
                         <td style='width:20%'>BANK ACCOUNT</td>
                         <td style='width:20%'>AMOUNT</td>   
                           <td style='width:20%'>CLEARED DATE</td>    
                      </tr>";

       $payment_list=$db->get_all('make_payment');
       if (is_array($payment_list)){
           foreach($payment_list as $pymnt){
               $contact_name=$db->get_var('contacts',array('id'=>$pymnt['contact_id']),'display_name');
               $bank_name=$db->get_var('accounts',array('id'=>$pymnt['bank_account']),'account_name');
               $query="SELECT SUM(`amount`) FROM `make_payment` ";
               $amount=$db->run($query)->fetchColumn();
         
                $html.="<tr>
                        <td>".ucfirst($pymnt['reconcile'])."</td>
                        <td>".$pymnt['date']."</td>
                         <td>".$contact_name."</td>
                        <td>".$pymnt['reference']."</td>
                         <td>".$pymnt['details']."</td>
                         <td>".$bank_name."</td>
                    <td>".CURRENCY." ".number_format($pymnt['amount'],2,'.',',')."</td>
                     <td>-</td>
                      </tr>";
 
}}
 
$html.="<tr>
    <td></td>
    <td></td>
     <td></td>
     <td></td>
     <td></td>   
    <td></td>
     <td><strong>Total</strong> ".CURRENCY." ".number_format($amount,2,'.',',')."</td>                                                                         
    <td></td>
    <td></td>
    </tr>";
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/payment_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>