 <?php


 if (isset($_REQUEST['action_view']))
 {
   $estimate_id=$_REQUEST['action_view'];
   $estimates_details=$db->get_row('estimates',array('id'=>$estimate_id));
   $customer_detail=$db->get_row('contacts',array('id'=>$estimates_details['customer_id']));
  // $user=$db->get_row('users',array('user_id'=>$_SESSION['user_id']));

   $project=unserialize($estimates_details['project_id']);
   $item=unserialize($estimates_details['item_id']);
   $item_price=unserialize($estimates_details['item_price']);
  // $item_description=unserialize($estimates_details['item_description']);

   //print_r($item_description);


   $item_qty=unserialize($estimates_details['item_qty']);
   $item_total=unserialize($estimates_details['item_total']);
   $item_markup=unserialize($estimates_details['markup']);
   $item_taxcode=unserialize($estimates_details['taxcode']);
   $item_tax=unserialize($estimates_details['tax']);
   $item_amount=unserialize($estimates_details['amount']);
}

 ?>
  <div class="container-fluid main-content">
        <div class="page-title">
          <h1>Selling Estimates
          <button class="btn btn-primary pull-right" onclick="goBack()">
            <i class="fa fa-backward"></i> Go Back</button>
             <?php if(in_array('print_and_email',$dtd_estimate)){?>
               <span onClick="printdiv('div_print');"  style=" font-family: sans-serif; cursor: pointer;"
				class="print btn btn-primary pull-right"><i class="fa fa-print">&nbsp;Print</i></span>
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
                    <?php echo "#".$estimates_details['estimate_number'];?>
                  </h2>
                 <p>
                  Estimate Date:
                  <?php echo $estimates_details['estimate_date'];?>
                  </p>
                   <p>
                   Expiry date :
                    <?php
                   if($estimates_details['expiry_date']==""){
                       echo "N/A";
                   }
                   else
                   {
                      echo $estimates_details['expiry_date'];
                   }
                   ?>
                  </p>
                     <p>
                   Reference code :
                    <?php
                   if($estimates_details['reference_code']==""){
                       echo "N/A";
                   }
                   else
                   {
                      echo $estimates_details['reference_code'];
                   }
                   ?>

                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
                <div class="col-lg-12">
          <table style="width:100%">
          <tr>
          <th style="width:50%"></th><th style="width:50%"></th></tr>
          <tr >
          <td >

           <div class="col-md-12">
             <div class="well">
                <strong>TO</strong>
                <h3><?php echo ucwords($customer_detail['display_name']);?></h3>
                <p><?php echo $customer_detail['postal_address_state'];?>
                <br><?php echo $customer_detail['phone_pre_code'].$customer_detail['phone_number'] ;?>
                <br><?php echo $customer_detail['email'];?>
                </p>
              </div>
           </div>
          </td>
          <td >
           <div class="col-md-12">
               <div class="well">
                <strong>FROM</strong>
                <h3><?php echo SITE_NAME;?></h3>
                <p><?php echo SITE_ADDRESS;?><br>
                <?php echo SITE_PHONE1;?><br>
                <?php echo SITE_EMAIL;?><br>
                </p>
              </div>
                </div>
</td>
          </tr>


          </table>
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
                      <th width="15%">Project</th>
                      <th width="20%">Items</th>
                      <th width="10%">Item price</th>
                      <th width="10%">Qty</th>
                      <th width="10%">Item total</th>
                   <?php if ($estimates_details['gst_registered']!='no'){?>
                     <th width="10%">Tax code</th>
                      <th width="10%">Tax</th>
                   <?php }?>
                     <th width="10%">Amount</th>
                     <tr>
                    </thead>
                    <tbody>

                    <?php
                    $a=1;
                    if (is_array($project)){
                     foreach ($project as $key=>$value)
                     {
                         $project_name1=$db->get_var('projects',array('id'=>$value),'project_name');
                         $item_name1=$db->get_var('items',array('id'=>$item[$key]),'item_name');
                         $item_price1=$item_price[$key];
                        // $item_description1=$item_description[$key];
                         $item_qty1=$item_qty[$key];
                         $item_total1=$item_total[$key];
                        // $item_markup1=$item_markup[$key];
                         $item_taxcode1=$item_taxcode[$key];
                         $item_tax1=$item_tax[$key];
                         $item_amount1=$item_amount[$key];?>
                    <tr>
                    <td><?php echo "#".$a;?></td>
                    <td><?php echo $project_name1;?></td>
                    <td><?php echo $item_name1;?></td>
                    <td><?php echo CURRENCY." ".number_format($item_price1,2,'.',',');?></td>

                    <td><?php echo $item_qty1;?></td>
                    <td><?php echo CURRENCY." ".number_format($item_total1,2,'.',',');?></td>
				<?php if ($estimates_details['gst_registered']!='no'){?>
                    <td><?php echo $item_taxcode1;?></td>
                    <td><?php echo number_format($item_tax1,2,'.',',');?></td>
                <?php }?>
                    <td><?php echo CURRENCY." ".number_format($item_amount1,2,'.',',');?></td>
                    <td></td>
                    </tr>
                      <?php  $a++;} }?>
                    </tbody>
                     <tfoot>
                      <tr>
                        <td class="text-right" colspan="8">
                          <strong>Subtotal</strong>
                        </td>
                        <td >
                          <?php echo CURRENCY." ".number_format($estimates_details['subtotal'],2,'.',',');?>
                        </td>
                      </tr>
                  <?php if ($estimates_details['gst_registered']!='no'){?>
                      <tr>
                        <td class="text-right" colspan="8">
                          <strong>Tax(%)</strong>
                        </td>
                        <td>
                        <?php echo CURRENCY." ".number_format($estimates_details['total_tax'],2,'.',',');?>
                        </td>
                      </tr>
                  <?php }?>
                     <tr>
                        <td class="text-right" colspan="8" >
                          <h4 class="text-primary" >
                            Total
                          </h4>
                        </td>
                        <td>
                          <h4 class="text-primary">
                          <?php echo CURRENCY." ".number_format($estimates_details['total_amount'],2,'.',',');?>
                          </h4>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>NOTES</strong>
                <p>
                 <?php echo $estimates_details['notes'];?>
                </p>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>TERMS & CONDITIONS:</strong>
                <p>
                 <?php echo $estimates_details['tc'];?>
                </p>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>PAYMENT NOTES:</strong>
                <p>
                 <?php echo $estimates_details['payment_notes'];?>
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