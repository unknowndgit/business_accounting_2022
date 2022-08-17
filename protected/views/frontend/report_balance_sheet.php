
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
				<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=financial');?>">Back to list</a>
                 <a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=balance_sheet');?>"
      ><i class="fa fa-file">&nbsp;PDF Generate</i></a>

				</div>
<br><br>
    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

<div class="row">
<?php

$html='<table style="width:100%;text-align:center;">
                       <tr><td><h3 style="text-align:center;">Balance sheet<br>
					<small>'.strtoupper(SITE_NAME).'<br>
					As at '.date(DATE_FORMAT).'</small>
                   </td></tr>
                    </table>';

$html.='<table width="100%">
     <tr>
      <th style="width: 215px;">ACCOUNT
CODE</th>
      <th style="width: 549px;">ACCOUNT NAME</th>
   <th style="width: 215px;">BALANCE</th>
   </tr>
                      <tr>
                         <td style="width: 215px;" colspan=2><h4><strong>ASSETS</strong></h4></td>
                                 <td style="width: 549px;"></td>
                                 <td  style="width: 215px;"></td>
                               </tr>';

$all_account=$db->get_all('accounts',array('visibility_status'=>'active','nature'=>'assets'));
if (is_array($all_account))
{     $ta1=array();
    foreach ($all_account as $allaa )
    {
        $aid=$allaa['id'];
        if ($db->exists('account_transaction',array('account_id'=>$aid))){
        $account_code=$allaa['account_code'];
        $account_name=$allaa['account_name'];

        $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid";
        $amount=$db->run($query)->fetchColumn();

        array_push($ta1, $amount);
        $html.='<tr>
                   <td style="width: 215px;">'.$account_code.'</td>
                   <td style="width: 549px;">'.$account_name.'</td>
                   <td  style="width: 215px;">' .CURRENCY .' '.number_format($amount,2,'.',',').'</td>
               </tr>';

    }}
}
$total_assets=array_sum($ta1);

                          $html.='<td style="width: 215px;"></td>
                                 <td style="width: 549px;"></td>
                                <td style="width: 215px;"><strong>TOTAL ASSETS		&nbsp;&nbsp;'.CURRENCY . ' ' .number_format($total_assets,2,'.',',').'</strong></td>
                               </tr>
                           <tr>
                                 <td style="width: 215px;" colspan=2><h4><strong>LIABILITIES</strong></h4></td>
                                  <td style="width: 549px;"></td>
                                 <td  style="width: 215px;"></td>
                               </tr>
                               ';

              $all_account=$db->get_all('accounts',array('visibility_status'=>'active','nature'=>'liabilities'));
              if (is_array($all_account))
              {     $ta3=array();
              foreach ($all_account as $allaa )
              {
                  $aid=$allaa['id'];
                  if ($db->exists('account_transaction',array('account_id'=>$aid))){
                      $account_code=$allaa['account_code'];
                      $account_name=$allaa['account_name'];

                      $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid";
                      $amount=$db->run($query)->fetchColumn();

                      array_push($ta3, $amount);
                                  $html.='<tr>
                   <td style="width: 215px;">'.$account_code.'</td>
                   <td style="width: 549px;">'.$account_name.'</td>
                   <td  style="width: 215px;">' .CURRENCY . ' ' .number_format($amount,2,'.',',').'</td>
               </tr>';

                              }}
                          }
$total_liability=array_sum($ta3);

$net_assets=$total_assets-$total_liability;





                                  $html.='

					         <tr>
                                  <td style="width: 215px;"></td>
                                 <td style="width: 549px;"></td>
                                <td style="width: 215px;"><strong>TOTAL LIABILITIES		&nbsp;&nbsp;'.CURRENCY . ' ' .number_format($total_liability,2,'.',',').'</strong></td>
                               </tr>
                                 <tr>
                                  <td style="width: 215px;"></td>
                                 <td style="width: 549px;"></td>
                                <td style="width: 215px;"><strong>NET ASSETS &nbsp;&nbsp;<font color="red">'.CURRENCY . ' ' .number_format($net_assets,2,'.',',').'</font></strong></td>
                               </tr>

                                   <tr>
                                   <td style="width: 215px;" colspan=2> <h4><strong>EQUITY</strong></h4></td>
                                  <td style="width: 549px;"></td>
                                 <td  style="width: 215px;"></td>
                               </tr>
					           <tr>';
$all_account=$db->get_all('accounts',array('visibility_status'=>'active','nature'=>'equity'));
if (is_array($all_account))
{     $ta4=array();
    foreach ($all_account as $allaa )
    {
        $aid=$allaa['id'];
        if ($db->exists('account_transaction',array('account_id'=>$aid))){
        $account_code=$allaa['account_code'];
        $account_name=$allaa['account_name'];

        $query="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid";
        $amount=$db->run($query)->fetchColumn();

        array_push($ta4, $amount);
        $html.='<tr>
                   <td style="width: 215px;">'.$account_code.'</td>
                   <td style="width: 549px;">'.$account_name.'</td>
                   <td  style="width: 215px;">'. CURRENCY . ' ' .number_format($amount,2,'.',',').'</td>
               </tr>';

    }}
}
$total_equity=array_sum($ta4);
                                  $html.='<td style="width: 215px;"></td>
                                 <td style="width: 549px;"></td>
                                <td style="width: 215px;"><strong>TOTAL EQUITY &nbsp;&nbsp;<font color="red">'.CURRENCY . ' ' .number_format($total_equity,2,'.',',').'</font></strong></td>
                               </tr>
                                              </table>';
echo $html;
$filename = SERVER_ROOT . '/uploads/pdf/balance_sheet.html';
file_put_contents ( $filename, $html );

?>

					        </div>
 </div>
        </div>
    </div>
</div>