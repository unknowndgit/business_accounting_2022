
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=customer');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=invoive_list');?>">&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Invoice List<br>
				<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";

        	 $html.="<table style='width:100%'>
					<tr>
                        <td>DATE</td>
                        <td>INVOICE</td>
                        <td>REFERENCE</td>
                        <td>DUE DATE</td>
                        <td>STATUS</td>
                        <td>TAX</td>
						<td>AMOUNT</td>
						<td>BALANCE</td>
                    </tr>";

        	 $all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
        	 if (is_array($all_customer)){
				foreach ($all_customer as $customer){
					if ($db->exists('invoices',array('customer_id'=>$customer['id']))){

					$html.="<tr>
	                        	<td><h3>".$customer['display_name']."</h3></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        </tr>";


				$all_invoice=$db->get_all('invoices',array('customer_id'=>$customer['id']));
					if (is_array($all_invoice)){
						$tax=array();
						$subtotal=array();
						$remaining=array();
						foreach ($all_invoice as $invoice){
						    if($invoice['due_date']==""){ $due_date="-";}else{ $due_date= date(DATE_FORMAT,strtotime($invoice['due_date']));}
						    if($invoice['total_tax']==""){ $total_tax="0";}else{ $total_tax=$invoice['total_tax'];} 
						      
							$html.="<tr>
										<td>".date(DATE_FORMAT,strtotime($invoice['created_date']))."</td>
	        	 						<td>".$invoice['invoice_number']."</td>
	        	 						<td>".$invoice['reference_code']."</td>
	        	 						<td>".$due_date."</td>
	        	 						<td>".$invoice['status']."</td>
	        	 						<td>".CURRENCY." ".number_format($total_tax,2,'.',',')."</td>
										<td>".CURRENCY." ".number_format($invoice['subtotal'],2,'.',',')."</td>";
										if(strstr($invoice['balance_remaining'], "-")){
											$html.="<td style='color:red'>".CURRENCY." ".number_format($invoice['balance_remaining'],2,'.',',')."</td>";
										}else{
											$html.="<td>".CURRENCY." ".number_format($invoice['balance_remaining'],2,'.',',')."</td>";
										}
							$html.="</tr>";
							array_push($tax, $invoice['total_tax']);
							array_push($subtotal, $invoice['subtotal']);
							array_push($remaining, $invoice['balance_remaining']);

						}
					}
					$total_tax=array_sum($tax);
					$sub_total=array_sum($subtotal);
					$balance_remaining=array_sum($remaining);
					$html.="<tr> 
						<td></td>
                   		<td></td>
	        	 		<td></td>
                   		<td></td>
			            <td></td>
			            <td><h5><strong>".$customer['display_name'].' - '.CURRENCY.' '.number_format($total_tax,2,'.',',')."</strong></h5></td>
			            <td><h5><strong>".CURRENCY." ".number_format($sub_total,2,'.',',')."</strong></h5></td>
			            <td><h5><strong>".CURRENCY." ".number_format($balance_remaining,2,'.',',')."</strong></h5></td>
			       </tr>";
			 	}
				}
        	 }

  
			$html.="</table>";

        	 echo $html;
        	 $filename = SERVER_ROOT . '/uploads/pdf/invoive_list.html';
        	 file_put_contents ( $filename, $html );
        	 ?>

        	   </div>
           </div>
       </div>
   </div>