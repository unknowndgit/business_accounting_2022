
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=account_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Account list<br>
					<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td style='width:20%'>ACCOUNT NAME</td>
                        <td style='width:15%'>ACCOUNT CODE</td>
                        <td style='width:15%'>TYPE</td>
                        <td style='width:15%'>STATUS</td>
                        <td style='width:15%'>DEFAULT TAX CODE</td>
                        <td style='width:10%'>BALANCE</td>
                      </tr>";

       $all_account_list=$db->get_all('accounts');
       if (is_array($all_account_list)){
           foreach($all_account_list as $alls){
             $tax_name=$db->get_var('tax',array('id'=>$alls['default_tax_code']),'tax_name');
             $remove_under=str_replace(_," ",$alls['account_type']);
             $type=ucfirst($remove_under);
             if ($alls['account_code']=="")
             {
                 $alls['account_code']="-";
             }
                $html.="<tr>
                        <td>".$alls['account_name']."</td>
                        <td>".$alls['account_code']."</td>
                        <td>".$type."</td>
                       <td>".$alls['visibility_status']."</td>
                        <td>".$tax_name."</td>
                        <td> ".CURRENCY." ".number_format($alls['opening_balance'],2,'.',',')."</td>
                      </tr>";
 
}}
 
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/account_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>