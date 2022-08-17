<?php

$all_tax=$db->get_all('tax',array('visibility_status'=>'active'));
?>
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=tax');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=gst_summary');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>GST(Summary)<br>
					<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
					</small>
                   </td></tr>
                    </table>";






        	 $html.="<table style='width:100%'>

                      <tr style='border-bottom:1px solid #ccc;'>
                        <td><h4><strong>Code</strong></h4></td>
                        <td><h4><strong>Description</strong></h4></td>
                        <td><h4><strong>Rate</strong></h4></td>
                        <td><h4><strong>Sale Value</strong></h4></td>
                        <td><h4><strong>Purchase Value</strong></h4></td>
                        <td><h4><strong>GST Collected</strong></h4></td>
                        <td><h4><strong>GST paid</strong></h4></td>
                      </tr>";
if (is_array($all_tax)){
    foreach ($all_tax as $alla){
        $aid=$alla['id'];
        $a_code=$alla['tax_name'];
        $tax_description=$alla['tax_description'];
        $tax_rate=$alla['tax_rate'];
        if ($db->exists('tax_calculation',array('tax_code'=>$a_code))){

           $query="SELECT SUM(tax_payable_amount) FROM `tax_calculation` WHERE `tax_code`='$a_code'  AND  `section`='sale'";
           $sale_vale=$db->run($query)->fetchColumn();
           $query="SELECT SUM(tax_payable_amount) FROM `tax_calculation` WHERE `tax_code`='$a_code' AND `section`='purchase'";
           $purchase_vale=$db->run($query)->fetchColumn();

            $query="SELECT SUM(tax_amount) FROM `tax_calculation` WHERE `tax_code`='$a_code'  AND  `section`='sale'";
            $gst_collected=$db->run($query)->fetchColumn();

            $query="SELECT SUM(tax_amount) FROM `tax_calculation` WHERE `tax_code`='$a_code'  AND  `section`='purchase'";
            $gst_paid=$db->run($query)->fetchColumn();
              $html.="<tr>
                        <td>".$a_code."</td>
                        <td>".$tax_description."</td>
                        <td>".number_format($tax_rate,2,'.',',')." %</td>
                        <td>";
                        if ($sale_vale!="" || $sale_vale!=NULL)
                        {$html.= CURRENCY." ".number_format($sale_vale,2,'.',',');}
              $html.="</td><td>";

               if ($purchase_vale!="" || $purchase_vale!=NULL)
                        {$html.= CURRENCY." ".number_format($purchase_vale,2,'.',',');}
              $html.="</td><td>";
              if ($gst_collected!="" || $gst_collected!=NULL)
              {$html.= CURRENCY." ".number_format($gst_collected,2,'.',',');}

                $html.="</td><td>";

                if ($gst_paid!="" || $gst_paid!=NULL)
                {$html.= CURRENCY." ".number_format($gst_paid,2,'.',',');}
             $html."</td></tr>";







           }

           $query="SELECT SUM(tax_amount) FROM `tax_calculation` WHERE `section`='sale'";
           $gst_collected_total=$db->run($query)->fetchColumn();
           $query="SELECT SUM(tax_amount) FROM `tax_calculation` WHERE `section`='purchase'";
           $gst_purchase_total=$db->run($query)->fetchColumn();



    }

    $html.="<tr >
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style='border-top:1px solid #ccc'><h4><strong>Total</strong></h4></td>
                        <td style='border-top:1px solid #ccc'><h4><strong>";
    if ($gst_collected_total!="" || $gst_collected_total!=NULL)
    {$html.= CURRENCY." ".number_format($gst_collected_total,2,'.',',');}
                     $html.="</strong></h4></td>";
                      $html.="<td style='border-top:1px solid #ccc'><h4><strong>";

    if ($gst_purchase_total!="" || $gst_purchase_total!=NULL)
                      {$html.= CURRENCY." ".number_format($gst_purchase_total,2,'.',',');}

                      $html.="</strong></h4></td>";


    $html."</tr>";


    }
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/gst_summary.html';
file_put_contents ( $filename, $html );




echo $html;?>














                  </div>
        </div>
    </div>
</div>