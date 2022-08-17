
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=supplier');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=unpaid_bills');?>">&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Unpaid Bills<br>
						<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";

        	 $html.="<table style='width:100%'>
					<tr>
                        <td>DATE</td>
                        <td>NUMBER</td>
                        <td>REFERENCE</td>
                        <td>SUPPLIER</td>
                        <td>DUE DATE</td>
						<td>STATUS</td>
                        <td>TAX</td>
						<td>AMOUNT</td>
						<td>BALANCE</td>
                    </tr>";

        	 $all_bills=$db->get_all('bills',array('payment_status'=>'unpaid'));
					if (is_array($all_bills)){
						$tax=array();
						$subtotal=array();
						$remaining=array();
						foreach ($all_bills as $bills){
							$supplier=$db->get_var('contacts',array('id'=>$bills['supplier_id']),'display_name');
							if($bills['due_date']==""){ $due_date="-";}else{ $due_date= date(DATE_FORMAT,strtotime($bills['due_date']));}
							$html.="<tr>
										<td>".date(DATE_FORMAT,strtotime($bills['created_date']))."</td>
	        	 						<td>".$bills['bill_number']."</td>
	        	 						<td>".$bills['reference_code']."</td>
                    					<td>".$supplier."</td>
	        	 						<td>".$due_date."</td>
	        	 						<td>".ucfirst($bills['status'])."</td>
	        	 						<td>".number_format($bills['total_tax'],2,'.',',')." </td>
										<td>".CURRENCY." ".number_format($bills['subtotal'],2,'.',',')."</td>
										<td>".CURRENCY." ".number_format($bills['balance_remaining'],2,'.',',')."</td>
									</tr>";
							array_push($tax, $bills['total_tax']);
							array_push($subtotal, $bills['subtotal']);
							array_push($remaining, $bills['balance_remaining']);

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
			            <td></td>
			            <td><h5><strong>".CURRENCY." ".number_format($total_tax,2,'.',',')."</strong></h5></td>
			            <td><h5><strong>".CURRENCY.' '.number_format($sub_total,2,'.',',')."</strong></h5></td>
			            <td><h5><strong>".CURRENCY.' '.number_format($balance_remaining,2,'.',',')."</strong></h5></td>
			       </tr>";

			$html.="</table>";

        	 echo $html;
        	 $filename = SERVER_ROOT . '/uploads/pdf/unpaid_bills.html';
        	 file_put_contents ( $filename, $html );
        	 ?>

        	   </div>
           </div>
       </div>
   </div>