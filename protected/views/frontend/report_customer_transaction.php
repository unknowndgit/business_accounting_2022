
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=customer');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=customer_transaction');?>">&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Customer Transaction<br>
					<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";

        	 $html.="<table style='width:100%'>
					<tr>
                        <td>TYPE</td>
                        <td>NUMBER</td>
                        <td>DATE</td>
                        <td>REFERENCE</td>
                        <td>DETAILS</td>
						<td>AMOUNT</td>
                    </tr>";

        	 $all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
        	 if (is_array($all_customer)){
				foreach ($all_customer as $customer){

				$html.="<tr>
                        	<td><h3>".$customer['display_name']."</h3></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        </tr>";
   $all_transaction=$db->get_all('account_transaction',array('contact'=>$customer['id']));
					if (is_array($all_transaction)){
						foreach ($all_transaction as $transaction){

						if ($transaction['type']=='journal'){
								$number=$db->get_var('journal',array('id'=>$transaction['type_id']),'journal_no');
								$refrence=$db->get_var('journal',array('id'=>$transaction['type_id']),'refrence');
								$description=$db->get_var('journal',array('id'=>$transaction['type_id']),'description');
							  }
							if ($transaction['amount']!="" && $transaction['amount']!=NULL)
							{
							    $amount=CURRENCY . " " .number_format($transaction['amount'],2,'.',',');}

							$html.="<tr>
	        	 						<td>".ucfirst($transaction['type'])."</td>
                        				<td>".$number."</td>
                        				<td>".date(DATE_FORMAT,strtotime($transaction['create_date']))."</td>
                        				<td>".$refrence."</td>
	        	 						<td>".$description."</td>";
										if(strstr($transaction['amount'], "-")){
										$html.="<td style='color:red'>".$amount."</td>";
										}
										else
										{
										$html.="<td>".$amount."</td>";
										}
							$html.="</tr>";

						}
					}
					$html.="<tr>
						<td></td>
                   		<td></td>
	        	 		<td></td>
                   		<td></td>
			            <td></td>
			            <td></td>
			            <td></td>
			            <td></td>
			       </tr>";
			 	}
        	 }


			$html.="</table>";

        	 echo $html;
        	 $filename = SERVER_ROOT . '/uploads/pdf/customer_transaction.html';
        	 file_put_contents ( $filename, $html );
        	 ?>

        	   </div>
           </div>
       </div>
   </div>