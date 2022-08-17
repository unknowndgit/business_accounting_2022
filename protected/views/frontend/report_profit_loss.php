
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >

				<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=financial');?>">Back to list</a>
                <a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=profit_loss');?>"
><i class="fa fa-file">&nbsp;PDF Generate</i></a>

				</div>
<br>
<br>
    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
        	  <div class="row">
<?php
$html='<table style="width:100%;text-align:center;">
                       <tr><td><h3 style="text-align:center;">Profit and loss<br>
					<small>'.strtoupper(SITE_NAME).'<br>
				As at '.date(DATE_FORMAT).'</small>
                   </td></tr>
                    </table>';


 $html.=' <table width="100%">
     <tr>
      <td style="width: 215px;">CODE</td>
      <td style="width: 549px;">ACCOUNT</td>
      <td style="width: 215px;">AMOUNT</td>
   </tr>

					           <tr>
                                    <td style="width: 215px;" colspan=2><h4><strong>EXPENSES</strong></h4></td>
                                  <td style="width: 549px;"></td>
                                 <td  style="width: 215px;"></td>
                               </tr>';
$allexpense_account=$db->get_all('accounts',array('visibility_status'=>'active','nature'=>'expense'));
if (is_array($allexpense_account)){
    $ta=array();
    foreach ($allexpense_account as $allea){
    	$aid=$allea['id'];
    	if ($db->exists('account_transaction',array('account_id'=>$aid))){
        $acode=$allea['account_code'];
        $aname=$allea['account_name'];

        $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid";
        $amount=$db->run($query)->fetchColumn();

        array_push($ta, $amount);
					           $html.='<tr>
                                  <td style="width: 215px;">'.$acode.'</td>
                                  <td style="width: 549px;">'.$aname.'</td>
                                 <td  style="width: 215px;">'.CURRENCY.' '.number_format($amount,2,'.',',').'</td>
                               </tr>';
}}}
$tae=array_sum($ta);
                                $html.='<tr>
                                  <td style="width: 215px;"></td>
                                 <td style="width: 549px;"></td>
                                  <td style="width: 215px;"><strong>TOTAL EXPENSES	&nbsp;&nbsp;'.CURRENCY.' '.number_format($tae,2,'.',',').'</strong></td>
                               </tr>
                    <tr>
                                  <td style="width: 215px;" colspan=2><h4><strong>NET POSITION</strong></h4></td>
                                  <td style="width: 549px;"></td>
                                 <td  style="width: 215px;"></td>
                               </tr>';
$allexpense_account=$db->get_all('accounts',array('visibility_status'=>'active','nature'=>'income'));
if (is_array($allexpense_account)){
    $ta1=array();
    foreach ($allexpense_account as $allea){
    	$aid=$allea['id'];
    	if ($db->exists('account_transaction',array('account_id'=>$aid))){
        $acode=$allea['account_code'];
        $aname=$allea['account_name'];
        $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid";
        $amount=$db->run($query)->fetchColumn();

        array_push($ta1, $amount);

					           $html.='<tr>
                                  <td style="width: 215px;">'.$acode.'</td>
                                  <td style="width: 549px;">'.$aname.'</td>
                                 <td  style="width: 215px;">'.CURRENCY.' '.number_format($amount,2,'.',',').'</td>
                               </tr>';
}}}
$tincome=array_sum($ta1);

$net_position=$tincome-$tae;
                                 $html.='<td style="width: 215px;"></td>
                                  <td style="width: 549px;">Gross profit</td>
                                 <td  style="width: 215px;">'.CURRENCY.' '.number_format($tincome,2,'.',',').'</td>
                               </tr>
                               <tr>
                                  <td style="width: 215px;"></td>
                                  <td style="width: 549px;">Expenses</td>
                                 <td  style="width: 215px;">'.CURRENCY.' '.number_format($tae,2,'.',',').'</td>
                               </tr>

                                   <tr>
                                  <td style="width: 215px;"></td>
                                  <td style="width: 549px;"></td>
                                 <td  style="width: 215px;"><strong>NET POSITION &nbsp;&nbsp;<font color="red">'.CURRENCY.' '.number_format($net_position,2,'.',',').'</font></strong>
                                 <td>
                               </tr>
                               </table>';
                               echo $html;

$filename = SERVER_ROOT . '/uploads/pdf/profit_loss.html';
file_put_contents ( $filename, $html );?>        </div>
 </div>
        </div>
    </div>
</div>