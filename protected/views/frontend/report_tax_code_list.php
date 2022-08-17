
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=tax_code_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Tax code list<br>
							<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td style='width:10%'>CODE</td>
                        <td style='width:30%'>DESCRIPTION</td>
                        <td style='width:25%'>TYPE</td>
                        <td style='width:20%'>APPLIES TO</td>
                        <td style='width:20%'>TAX RATE</td>
                      </tr>
        <tr>
                    <td><strong>ACTIVE</strong></td>
                       <td></td>
                        <td></td>
                        <td></td>
                    <td></td>
                      
                    </tr>";

       $all_tax_code_list=$db->get_all('tax',array('visibility_status'=>'active'));
       if (is_array($all_tax_code_list)){
           foreach($all_tax_code_list as $tax){
            
                $html.="<tr>
                        <td>".$tax['tax_name']."</td>
                        <td>".$tax['tax_description']."</td>
                       <td> Code </td>
                       <td>".ucfirst($tax['what_trans_is_used'])."</td>
                           <td>".number_format($tax['tax_rate'],2,'.',',')." %</td>
                      </tr>";
 
}}
 
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/tax_code_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>