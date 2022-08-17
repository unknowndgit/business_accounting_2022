 <?php


 if (isset($_REQUEST['journal_view_id']))
 {
   $journal_id=$_REQUEST['journal_view_id'];
   $journal_details=$db->get_row('journal',array('id'=>$journal_id));

                   $account=unserialize($journal_details['account']);
                    $type=unserialize($journal_details['type']);
                    $debit=unserialize($journal_details['debit']);
                    $credit=unserialize($journal_details['credit']);
                    $item_taxcode=unserialize($journal_details['tax_code']);

                    $item_tax=unserialize($journal_details['tax']);
                    $narration=unserialize($_POST['narration']);
                    $contact=unserialize($journal_details['contact']);
                    $trans_type=unserialize($journal_details['trans_type']);

                    $project=unserialize($journal_details['project']);



                    if (is_array($account))
                    {$amount=array();
                        foreach ($account as $key=>$att)
                        {
                            if ($type[$key]=="debit")
                            {
                                array_push($amount, $debit[$key]);
                            }
                            if ($type[$key]=="credit")
                            {
                                array_push($amount, $credit[$key]);
                            }
                        }
                    }
//print_r($amount);

}

 ?>
  <div class="container-fluid main-content">
        <div class="page-title">
          <h1>Journal detail
          <button class="btn btn-default pull-right" onclick="goBack()">
            <i class="lnr lnr-arrow-left"></i> Back</button>
             <?php if(in_array('print_and_email',$dtd_estimate)){?>
               <span onClick="printdiv('div_print');"
				class="print btn btn-default  pull-right"><i class="lnr lnr-printer"></i>&nbsp;Print</span>
				<?php }?>
          </h1>
        </div>
        <div class="invoice" id="div_print">
          <div class="row">
            <div class="col-lg-12">
              <div class="row invoice-header">
                <div class="col-md-6">
                  <!-- <img width="183" src="images/sn-logo%402x.png" /> -->
                </div>
                <div class="col-md-6 text-right">
                  <h2>
                    <?php echo "#".$journal_details['journal_no'];?>
                  </h2>
                 <p>
                  Journal Date:
                  <?php echo $journal_details['journal_date'];?>
                  </p>
                   <p>
                   journal Type :
                    <?php

                      echo $journal_details['journal_type'];

                   ?>
                  </p>
                     <p>
                   Reference code :
                    <?php
                   if($journal_details['reference_code']==""){
                       echo "N/A";
                   }
                   else
                   {
                      echo $journal_details['reference_code'];
                   }
                   ?>

                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                  <table class="table table-striped invoice-table">
                    <thead>
                    <tr>
                       <th width="5%"></th>
                      <th width="10%">Account</th>
                      <th width="10%">Type</th>
                      <th width="10%">Debit</th>
                      <th width="10%">Credit</th>
                      <th width="5%">Tax code</th>
                     <th width="10%">Tax</th>
                      <th width="10%">Narration</th>
                     <th width="10%">Contact</th>
                     <th width="10%">Trans Type</th>
                     <th width="10%">Project</th>
                     <tr>
                    </thead>
                    <tbody>

                    <?php



                    $a=1;
                    if (is_array($account)){
                     foreach ($account as $key=>$value)
                     {

                         $account1=$account[$key];
                         $account_name=$db->get_var('accounts',array('id'=>$account1),'account_name');
                         $type1=$type[$key];
                         $debit1=$debit[$key];
                         $credit1=$credit[$key];
                         $item_taxcode1=$item_taxcode[$key];
                         $tax_name=$db->get_var('tax',array('id'=>$item_taxcode1),'tax_name');
                         $item_tax1=$item_tax[$key];
                         $narration1=$narration[$key];
                         $contact1=$contact[$key];
                         $contact_name=$db->get_var('contacts',array('id'=>$contact1),'display_name');
                         $trans_type1=$trans_type[$key];
                         $project1=$project[$key];
                         $project_name1=$db->get_var('projects',array('id'=>$project1),'project_name');


                        ?>
                    <tr>
                    <td><?php echo "#".$a;?></td>

                    <td><?php echo $account_name;?></td>
                    <td><?php echo $type1;?></td>
                    <td><?php echo $debit1;?></td>
                    <td><?php echo $credit1;?></td>
                    <td><?php echo $tax_name;?></td>
                    <td><?php echo $item_tax1;?></td>
                    <td><?php echo $narration1;?></td>
                    <td><?php echo $contact_name;?></td>
                    <td><?php echo $trans_type1;?></td>
                    <td><?php echo $project_name1;?></td>

                    </tr>
                      <?php  $a++;} }?>
                    </tbody>
                     <tfoot>

                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>Summary</strong>
                <p>
                 <?php echo $journal_details['summary'];?>
                </p>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>Description:</strong>
                <p>
                 <?php echo $journal_details['description'];?>
                </p>
              </div>
            </div>
          </div>


        </div>
      </div>
<script language="javascript">
         function printdiv(printpage)
{
var headstr = '<html><head><title></title><style>@media print {body{padding-top:0px;}.invoice strong {font-size: 85%; color:<?php echo $settings['print_color'];?> !important;display: block;padding-bottom: 8px;margin-bottom: 10px;} }</style>'+
'</head><body>';
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>