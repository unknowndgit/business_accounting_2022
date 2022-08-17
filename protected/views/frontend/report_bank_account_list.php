
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=bank_account_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Bank account list<br>
						<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td style='width:25%'>DESCRIPTION</td>
                        <td style='width:10%'>TYPE</td>
                        <td style='width:10%'>BSB</td>
                        <td style='width:20%'>ACCOUNT NUMBER</td>
                        <td style='width:20%'>DATE OPENED</td>
                       <td style='width:20%'>OPENING BALANCE</td>
                      </tr>
    
                   <tr>
                    <td><strong>OPEN ACCOUNTS</strong></td>
               <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                       <td></td>
                        <td></td>
                         <td></td>
                        <td></td>
                    </tr>"; 
$active_bank_account_list=$db->get_all('accounts',array('account_type'=>'bank','visibility_status'=>'active'));
if (is_array($active_bank_account_list)){
    foreach($active_bank_account_list as $bnls){
        $remove_under=str_replace(_," ",$bnls['account_type']);
        $type=ucfirst($remove_under);
        if ($type=="")
        {
            $type="-";
        }
      if($bnls['bsb']=="")
        {
            $bnls['bsb']="-";
        }
       if($bnls['account_number']=="")
        {
            $bnls['account_number']="-";
        }
        $html.="<tr>
                        <td>".$bnls['account_name']."</td>
                        <td>".$type."</td>
                       <td>".$bnls['bsb']."</td>
                        <td>".$bnls['account_number']."</td>
                      <td>".$bnls['created_date']."</td>
                        <td> ".CURRENCY." ".number_format($bnls['opening_balance'],2,'.',',')."</td>
                      </tr>";

    }}

     $html.="<tr>
    <td><strong>CLOSED ACCOUNTS</strong></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>";
    
     $inactive_bank_account_list=$db->get_all('accounts',array('account_type'=>'bank','visibility_status'=>'inactive'));
     if (is_array($inactive_bank_account_list)){
         foreach($inactive_bank_account_list as $bnls_inactive){
             $remove_under=str_replace(_," ",$bnls_inactive['account_type']);
             $type_inactive=ucfirst($remove_under);
             $html.="<tr>
                        <td>".$bnls_inactive['account_name']."</td>
                        <td>".$type_inactive."</td>
                       <td>".$bnls_inactive['bsb']."</td>
                        <td>".$bnls_inactive['account_number']."</td>
                      <td>".$bnls_inactive['created_date']."</td>
                        <td> ".$bnls_inactive['opening_balance']."</td>
                      </tr>";


             }}


$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/bank_account_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>