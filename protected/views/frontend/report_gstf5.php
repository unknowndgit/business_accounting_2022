
<?php
//all tax related to standard rated supplies
//$all_trtsrs=$db->get_all('tax',array('iras_for_gst_code'=>'SR'));
$all_trtsrs=$db->run("SELECT* FROM `tax` WHERE `iras_for_gst_code`='SR' OR  `iras_for_gst_code`='DS'")->fetchAll();
$new_array1=array();
foreach ($all_trtsrs as $atrtsrs)
{
    array_push($new_array1, $atrtsrs['tax_name']);
}
//print_r($new_array1);

$bedquery="SELECT SUM(tax_payable_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array1))
{
    $scount=count($new_array1);
    $bedquery.=" AND (";
    foreach ($new_array1 as $s2)
    {
        $bedquery.="`tax_code`='$s2' OR ";
    }
    $bedquery = rtrim($bedquery, 'OR ');
    $bedquery.=" )";
}

$box1=$db->run($bedquery)->fetchColumn();


$bedquery_tax_amount="SELECT SUM(tax_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array1))
{
    $scount=count($new_array1);
    $bedquery_tax_amount.=" AND (";
    foreach ($new_array1 as $s2)
    {
        $bedquery_tax_amount.="`tax_code`='$s2' OR ";
    }
    $bedquery_tax_amount = rtrim($bedquery_tax_amount, 'OR ');
    $bedquery_tax_amount.=" )";
}
 $bedquery_tax_amount;

$box6=$db->run($bedquery_tax_amount)->fetchColumn();

//all tax related to zero rated supplies
$all_zrt=$db->get_all('tax',array('iras_for_gst_code'=>'ZR'));
$new_array2=array();
foreach ($all_zrt as $azrt)
{
    array_push($new_array2, $azrt['tax_name']);
}


$bedquery1="SELECT SUM(tax_payable_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array2))
{
    $scount=count($new_array2);
    $bedquery1.=" AND (";
    foreach ($new_array2 as $s2)
    {
        $bedquery1.="`tax_code`='$s2' OR ";
    }
    $bedquery1 = rtrim($bedquery1, 'OR ');
    $bedquery1.=" )";
}
$bedquery1;
$box2=$db->run($bedquery1)->fetchColumn();

//all tax related to exempt supplies
//$all_ert=$db->get_all('tax',array('iras_for_gst_code'=>'TX-E33'));
$all_ert=$db->run("SELECT* FROM `tax` WHERE `iras_for_gst_code`='ES33' OR  `iras_for_gst_code`='ESN33'")->fetchAll();
$new_array3=array();
foreach ($all_ert as $aert)
{
    array_push($new_array3, $aert['tax_name']);
}


$bedquery2="SELECT SUM(tax_payable_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array3))
{
    $scount=count($new_array3);
    $bedquery2.=" AND (";
    foreach ($new_array3 as $s2)
    {
        $bedquery2.="`tax_code`='$s2' OR ";
    }
    $bedquery2 = rtrim($bedquery2, 'OR ');
    $bedquery2.=" )";
}
$bedquery2;
$box3=$db->run($bedquery2)->fetchColumn();

$box4=$box1+$box2+$box3;




//all tax related to standard rated purchase

$all_ert=$db->run("SELECT* FROM `tax` WHERE `iras_for_gst_code`='TX' OR  `iras_for_gst_code`='ZP' OR  `iras_for_gst_code`='IM' OR  `iras_for_gst_code`='ME' OR  `iras_for_gst_code`='IGDS'")->fetchAll();
//$all_ert=$db->get_all('tax',array('iras_for_gst_code'=>'TX7'));
$new_array5=array();
foreach ($all_ert as $aert)
{
    array_push($new_array5, $aert['tax_name']);
}


$bedquery5="SELECT SUM(tax_payable_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array5))
{
    $scount=count($new_array5);
    $bedquery5.=" AND (";
    foreach ($new_array5 as $s2)
    {
        $bedquery5.="`tax_code`='$s2' OR ";
    }
    $bedquery5 = rtrim($bedquery5, 'OR ');
    $bedquery5.=" )";
}
$bedquery5;
$box5=$db->run($bedquery5)->fetchColumn();

//for Input tax and refunds claimed
$bedquery7="SELECT SUM(tax_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array5))
{
    $scount=count($new_array5);
    $bedquery7.=" AND (";
    foreach ($new_array5 as $s2)
    {
        $bedquery7.="`tax_code`='$s2' OR ";
    }
    $bedquery7 = rtrim($bedquery7, 'OR ');
    $bedquery7.=" )";
}
$bedquery7;
$box7=$db->run($bedquery7)->fetchColumn();

$box8=$box6-$box7;




//all tax related to standard rated purchase

$all_ert=$db->run("SELECT* FROM `tax` WHERE `iras_for_gst_code`='ME'")->fetchAll();
//$all_ert=$db->get_all('tax',array('iras_for_gst_code'=>'TX7'));
$new_array9=array();
foreach ($all_ert as $aert)
{
    array_push($new_array9, $aert['tax_name']);
}


$bedquery9="SELECT SUM(tax_payable_amount) FROM `tax_calculation`
                    WHERE  `visibility_status` ='active'" ;
if(is_array($new_array9))
{
    $scount=count($new_array9);
    $bedquery9.=" AND (";
    foreach ($new_array9 as $s2)
    {
        $bedquery9.="`tax_code`='$s2' OR ";
    }
    $bedquery9 = rtrim($bedquery9, 'OR ');
    $bedquery9.=" )";
}
$bedquery9;
$box9=$db->run($bedquery9)->fetchColumn();

?>
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=tax');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=gstf5_report');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>GST F5 SUMMARY REPORT<br>
						<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

                     <tr>
                       <td></td>
                        <td><strong>Total</strong></td>
                      </tr>";


       $html.="<tr>
                        <td>Box 1 : Total value of standard-rated supplies</td>
                        <td>";
       if ($box1!="" || $box1!=NULL)
       {
           $html.=CURRENCY." ".number_format($box1,2,'.',',');
       }
      $html.="</td></tr>";

      $html.="<tr>
       <td>Box 2 : Total value of zero-rated supplies</td>
       <td>";
      if ($box2!="" || $box2!=NULL)
      {
          $html.=CURRENCY." ".number_format($box2,2,'.',',');
      }
      $html.="</td></tr>";

      $html.="<tr>
       <td>Box 3 : Total value of exempt supplies</td>
       <td>";
      if ($box3!="" || $box3!=NULL)
      {
          $html.=CURRENCY." ".number_format($box3,2,'.',',');
      }
      $html.="</td></tr>";







       $html.="<tr style='border-top:1px solid #ccc;'>
                        <td><strong>Box 4 : Total value of (1) + (2) + (3)</strong></td>
                        <td>".CURRENCY." ".number_format($box4,2,'.',',')."</td>
                       </tr>";
      $html.="<tr>
                       <td>Box 5 : Total value of taxable purchases</td>
                       <td>";
       if ($box5!="" || $box5!=NULL)
       {
           $html.=CURRENCY." ".number_format($box5,2,'.',',');
       }
       $html.="</td></tr>";





                       $html.="<tr>
                       <td>Box 6 : Output tax due</td>
                       <td>";
                       if ($box6!="" || $box6!=NULL)
                       {
                           $html.=CURRENCY." ".number_format($box6,2,'.',',');
                       }
                       $html.="</td></tr>";

                       $html.="<tr>
                       <td>Box 7 : Input tax and refunds claimed</td>
                       <td>";
                       if ($box7!="" || $box7!=NULL)
                       {
                           $html.=CURRENCY." ".number_format($box7,2,'.',',');
                       }
                       $html.="</td></tr>";





                       $html.="<tr>
                       <td><strong>Box 8 : Net GST to be paid to/ claim from IRAS</strong></td>
                       <td>";
                       if ($box7!="" || $box7!=NULL)
                       {
                           $html.=CURRENCY." ".number_format($box8,2,'.',',');
                       }
                       $html.="</td></tr>";




                       $html.="<tr>
                       <td><strong>Box 9 : Total value of goods imported under under the MES/ A3PL/ Other Approved Schemes</strong></td>
                       <td>";
                       if ($box7!="" || $box7!=NULL)
                       {
                           $html.=CURRENCY." ".number_format($box9,2,'.',',');
                       }
                       $html.="</td></tr>";


                       $html.="<tr>
                       <td>Box 13 : Revenue</td>
                       <td>";
                       if ($box7!="" || $box7!=NULL)
                       {
                           $html.=CURRENCY." ".number_format($box9,2,'.',',');
                       }
                       $html.="</td></tr>";





$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/gstf5_report.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>
    </div>
</div>