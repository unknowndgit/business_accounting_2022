
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=supplier');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=bill_list');?>">&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Bill List<br>
						<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";

        	 $html.="<table style='width:100%'>
					<tr>
                        <td style='width:10%'>DATE</td>
                        <td style='width:10%'>NUMBER</td>
                        <td style='width:10%'>REFERENCE</td>
						<td style='width:10%'>SUPPLIER</td>
                        <td style='width:10%'>DUE DATE</td>
                        <td style='width:10%'>STATUS</td>
                        <td style='width:10%'>TAX</td>
						<td style='width:10%'>AMOUNT</td>
						<td style='width:10%'>BALANCE</td>
                    </tr>";

        	 $all_supplier=$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
        	 if (is_array($all_supplier)){
				foreach ($all_supplier as $supplier){
					if ($db->exists('bills',array('supplier_id'=>$supplier['id']))){
					$html.="<tr>
	                        	<td><h3>".$supplier['display_name']."</h3></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        	<td></td>
	                        </tr>";


						$all_bill=$db->get_all('bills',array('supplier_id'=>$supplier['id']));
						if (is_array($all_bill)){
							$tax=array();
							$subtotal=array();
							$remaining=array();
							foreach ($all_bill as $bills){
							    if($bills['due_date']==""){ $due_date="-";}else{ $due_date= date(DATE_FORMAT,strtotime($bills['due_date']));}
								$html.="<tr>
											<td>".date(DATE_FORMAT,strtotime($bills['created_date']))."</td>
		        	 						<td>".$bills['bill_number']."</td>
		        	 						<td>".$bills['reference_code']."</td>
	                        				<td>".$supplier['display_name']."</td>
		        	 						<td>".$due_date."</td>
		        	 						<td>".ucfirst($bills['status'])."</td>
		        	 						<td>".number_format($bills['total_tax'],2,'.',',')." </td>
											<td>".CURRENCY." ".number_format($bills['subtotal'],2,'.',',')."</td>";
											if(strstr($bills['balance_remaining'], "-")){
												$html.="<td style='color:red'>".CURRENCY." ".number_format($bills['balance_remaining'],2,'.',',')."</td>";
											}else{
												$html.="<td>".CURRENCY." ".number_format($bills['balance_remaining'],2,'.',',')."</td>";
											}
								$html.="</tr>";
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
			            <td><h5><strong>".$supplier['display_name'].' - '.CURRENCY." ".number_format($total_tax,2,'.',',')."</strong></h5></td>
			            <td><h5><strong>".CURRENCY.' '.number_format($sub_total,2,'.',',')."</strong></h5></td>
			            <td><h5><strong>".CURRENCY.' '.number_format($balance_remaining,2,'.',',')."</strong></h5></td>
			       </tr>";
				}
			 	}
        	 }


			$html.="</table>";

        	 echo $html;
        	 $filename = SERVER_ROOT . '/uploads/pdf/bill_list.html';
        	 file_put_contents ( $filename, $html );
        	 ?>

        	   </div>
           </div>
       </div>
   </div>