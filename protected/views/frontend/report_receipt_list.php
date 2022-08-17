
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=advisor');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=receive_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>RECEIPT LIST<br>
							<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                       <td style='width:15%'>DATE</td>
                        <td style='width:15%'>CONTACT NAME</td> 
                        <td style='width:15%'>REFERENCE</td>
                        <td style='width:15%'>DETAILS</td>
                       <td style='width:15%'>BANK ACCOUNT</td>
                      <td style='width:15%'>AMOUNT</td>   
                   <td style='width:15%'>CLEARED DATE	</td>    
                      </tr>";

       $receive_list=$db->get_all('receive_money');
       if (is_array($receive_list)){
           foreach($receive_list as $receive){
               $contact_name=$db->get_var('contacts',array('id'=>$receive['contact_id']),'display_name');
               $bank_name=$db->get_var('accounts',array('id'=>$receive['bank_account']),'account_name');
               $query="SELECT SUM(`amount`) FROM `receive_money` ";
               $amount=$db->run($query)->fetchColumn();
                $html.="<tr>
                        <td>".$receive['date']."</td>
                         <td>".$contact_name."</td>
                        <td>".$receive['reference']."</td>
                         <td>".$receive['details']."</td>
                         <td>".$bank_name."</td>
                    <td>".CURRENCY." ".number_format($receive['amount'],2,'.',',')."</td>
                     <td>-</td>
                      </tr>";
 
}}
 
$html.="<tr>
   <td></td>
     <td></td>
     <td></td>
     <td></td>   
    <td></td>
     <td>".CURRENCY." ".number_format($amount,2,'.',',')."</td>                                                                         
    <td>Total</td>
    <td></td>
    </tr>";

$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/receive_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>