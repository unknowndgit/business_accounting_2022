
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user);?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=top_customers');?>">&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Top Customers<br>
					<small>".strtoupper(SITE_NAME)."<br>
					For the month ending 31 July 2016, accrual basis</small>
                   </td></tr>
                    </table>";

        	 $html.="<table style='width:100%'>
					<tr>
                        <td>CUSTOMER NAME</td>
						<td>AMOUNT</td>
						<td>PERCENTAGE</td>
                    </tr>";

        	 $all_customers=$db->get_all('contacts',array('is_customer'=>'yes', 'visibility_status'=>'active'));
					if (is_array($all_customers)){
						$total=array();
						foreach ($all_customers as $customer){
							$supplier=$db->get_var('contacts',array('id'=>$bills['supplier_id']),'display_name');
							$html.="<tr>
										<td>".date(DATE_FORMAT,strtotime($bills['create_date']))."</td>
	        	 						<td>".$bills['bill_number']."</td>
	        	 						<td>".$bills['reference_code']."</td>
									</tr>";
							array_push($total, $bills['total_tax']);
						}
					}
					$total_tax=array_sum($tax);
					$html.="<tr>
                   		<td></td>
			            <td></td>
			            <td><h5><strong>".CURRENCY.' '.$total_tax."</strong></h5></td>
			       </tr>";

			$html.="</table>";

        	 echo $html;
        	 $filename = SERVER_ROOT . '/uploads/pdf/top_customers.html';
        	 file_put_contents ( $filename, $html );
        	 ?>

        	   </div>
           </div>
       </div>
   </div>