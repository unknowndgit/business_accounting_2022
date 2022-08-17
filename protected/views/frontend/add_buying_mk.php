<?php
if (isset($_REQUEST['id']))
{ $cid=$_REQUEST['id'];
$contact_details=$db->get_row('contacts',array('id'=>$cid));

}

 if (isset($_POST['mk_submit']))
{
  //print_r($_POST);
     $contact_id=$_POST[contact_id];
   $date_buying=$_POST['date_buying'];
    $payable_type=$_POST['payable_type'];
    $payment_method=$_POST['payment_method'];
    $reference=$_POST['reference'];
    $details=$_POST['details'];
    $bank_account=$_POST['bank_account'];
    $use_transaction_total=$_POST['use_transaction_total'];
    
    if(isset($_POST['use_transaction_total']))
    {
        $use_transaction_total=$_POST['use_transaction_total'];
    }
    else
    {
        $use_transaction_total=no;
    }
    
    $transaction_amount=$_POST['transaction_amount'];
    $allocation_notes=$_POST['allocation_notes'];
    
    $project_id=serialize($_POST['project_id']);
    $item_id=serialize($_POST['item_id']);
    $item_price=serialize($_POST['item_price']);
    $account=serialize($_POST['account']);
   $item_qty=serialize($_POST['item_qty']);
   $discount=serialize($_POST['discount']);
   $taxcode=serialize($_POST['taxcode']);
    $tax=serialize($_POST['tax']);
    $amount=serialize($_POST['amount']);
  $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $visibility_status="active";

    $insert=$db->insert('buying_make_payment',array('contact_id'=>$contact_id,
                                        'date'=>date_buying,
                                        'payable_type'=>$payable_type,
                                        'payment_method'=>$payment_method,
                                        'reference'=>$reference,
                                        'details'=>$details,
                                        'bank_account'=>$bank_account,
                                        'use_transaction_total'=>$use_transaction_total,
                                        'transaction_amount'=>$transaction_amount,
                                        'allocation_notes'=>$allocation_notes,
                                         'project_id'=>$project_id,
                                        'item_id'=>$item_id,
                                        'item_price'=>$item_price,
                                        'account'=>$account,
                                        'discount'=>$discount,
                                        'item_qty'=>$item_qty,
                                        'taxcode'=>$taxcode,
                                        'tax'=>$tax,
                                        'amount'=>$amount,
                                        'created_date'=>$created_date,
                                        'ip_address'=>$ip_address,
                                        'visibility_status'=>$visibility_status
    ));
    //$db->debug();
    if ($insert)
    {
        $display_msg= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button> Save successfully.
                    		</div>';
    }
}?>


<div class="row">
	<div class="col-lg-12">
	<div class="padded" >
					<h3>BUYING</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

               <div class="row">
	 <?php  $current_tab=$_REQUEST['tab'];?>
	<a href="<?php echo $link->link('buying_bills',user);?>" class="btn <?php if ($query1ans=="buying_bills"){echo "btn-primary";}else{echo "btn-default";}?> ">Bills</a>
	<a href="<?php echo $link->link('buying_san',user);?>" class="btn <?php if ($query1ans=="buying_san"){echo "btn-primary";}else{echo "btn-default";}?>">Supplier adjustment notes</a>
	<a href="<?php echo $link->link('buying_mk',user);?>" class="btn <?php if ($query1ans=="buying_mk"){echo "btn-primary";}else{echo "btn-default";}?>">Make payment</a>
  </div>
	                         
                            <form action="#" class="form-horizontal"  method="post">
                                    <div class="row">
                            <div class="col-lg-12">
              
                     
                          <h3>Make Payment 
                   <a href="<?php echo $link->link('buying_mk',user);?>" class="btn btn-default pull-right">Back to List</a>
                   <button class="btn btn-primary pull-right " type="submit" name="mk_submit">Submit</button>
                   <a href="<?php echo $link->link('add_buying_mk',user);?>" class="btn btn-default pull-right">Cancel</a>
                  
                   </h3>
        	               <div class="widget-content padded">
                            <div class="row">
                                     <div class="col-lg-6">
                            <div class="form-group">
                           <label class="control-label col-md-3">Date<font color="red">*</font></label>
                           <div class="col-md-7">
                            <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="date_buying" required><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                      </div>
                                    
                                    </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Payable type<font color="red">*</font></label>
                           <div class="col-md-7">
                              <select class="form-control" name="payable_type" required>
                                 <option value="accounts">Accounts Payable</option>
                                 <option value="payroll">Payroll Payable</option>
                                  <option value="super">Super Payable</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Contact<font color="red">*</font></label>
                           <div class="col-md-7">
                              <select class="form-control" name="contact_id" id=contact_id required>
                                        <option value="">Select Contact</option>
                                          <?php $all_contact_name=$db->get_all('contacts',array('visibility_status'=>'active'));
                                 if (is_array($all_contact_name)){
                            foreach ($all_contact_name as $cn){?>
                    
                                       <option  <?php if($contact_details['id']==$cn['id'])echo 'selected="selected"';?> value="<?php echo $cn['id']?>"><?php echo $cn['display_name']."-:&nbsp;&nbsp;&nbsp;&nbsp;".$cn['contact_type'];?></option>
                                          <?php }}?>
                                       </select>
                           </div>
                        </div>
                          <div class="form-group">
                           <label class="control-label col-md-3">Payment method</label>
                           <div class="col-md-7">
                              <select class="form-control" name="payment_method">
                                 <option value="cheque">Cheque</option>
                                 <option value="cash">Cash</option>
                                  <option value="direct_deposit">Direct Deposit</option>
                                  <option value="eftpos">EFTPOS</option>
                                   <option value="bpay">BPay</option>
                                   <option value="visa">Visa</option>
                                   <option value="mastercard">MasterCard</option>
                                   <option value="diners">Diners</option>
                              </select>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-3">Reference</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="reference">
                           </div>
                        </div>
                          <div class="form-group">
                           <label class="control-label col-md-3">Details</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="details">
                           </div>
                        </div>
                     
                        <br>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-3">Bank account<font color="red">*</font></label>
                           <div class="col-md-7">
                              <select class="form-control" name="bank_account" required>
                                 <option value="nab_account">NAB Business Account</option>
                                 <option value="nab_credit_card">NAB Business Credit Card</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">
                              
                           </div>
                        </div>
                        <br>
                        <div class="form-group">
                           <label class="control-label col-md-3">Use transaction total</label>
                           <div class="col-md-7">
                           
                              <label class="checkbox-inline">
                              <input checked="" type="checkbox"  class="transaction_yesCheck" name="use_transaction_total" value="yes">
                              </label>
                           </div>
                           <i class="fa fa-fw fa-question-circle"></i>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Amount</label>
                           <div class="transaction_ifyes_div" style="display:none;">
                         <div class="col-md-7">
                              <input class="form-control" placeholder="$0" type="text" name="transaction_amount">
                           </div>
                           </div>
                        </div>
                           <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">
                              
                           </div>
                        </div>
                         <div class="form-group">
                                        <label class="control-label col-md-3">Allocation notes</label>
                                        <div class="col-md-7">
                                          <textarea class="form-control" rows="5" name="allocation_notes"></textarea>
                                        </div>
                                      </div>
                             <br>
                      
                          </div>
 
                       </div>
                       <br>
                                              <div class="row">
             <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">

                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Allocate</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>New</span></a>
                      </li>
                     </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                    <br>
                       <h5><strong>ALLOCATE THIS MONEY TO AN EXISTING TRANSACTION</strong></h5>
             <div class="row">
         <div class="row">
    <div class="col-md-2">Date</div>
    <div class="col-md-1">ID</div>
    <div class="col-md-2">Type</div>
    <div class="col-md-2">Total Amount</div>
    <div class="col-md-2">Balance owing</div>
    <div class="col-md-2">How much to allocate</div>
    <div class="col-md-1"></div>
    </div> 

		               <div class="input_fields_wrap_add_buying_mk_allocate">

  	<div class="row">
  	<div class="col-md-2"><input class="form-control" type="text" name="date[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" name="id[]"></div>
    <div class="col-md-2"><input class="form-control" type="text" name="type[]"></div>
     <div class="col-md-2"><input class="form-control" type="text" name="total_amount[]"></div>
    <div class="col-md-2"><input class="form-control" type="text" name="balance_owing[]"></div>
    <div class="col-md-2"><input class="form-control" type="text" name="how_much_to_allocate[]"></div>
    <div class="col-md-1"></div>
    </div>
<br>

</div>

<button class="btn btn-default add_field_button_add_buying_mk_allocate">Add new row</button>
</div>
                    </div>
                 
                 
                    <div class="tab-pane" id="tab2">
                       <br>
                       <h5><strong>NEW TRANSACTION ALLOCATION</strong></h5>
          <div class="row">
<div class="row">
    <div class="col-md-2">Project</div>
    <div class="col-md-2">Items</div>
    <div class="col-md-1">Item Price</div>
     <div class="col-md-1">Account</div>
    <div class="col-md-1">Qty</div>
    <div class="col-md-1">Discount</div>
    <div class="col-md-1">Tax code</div>
    <div class="col-md-1">Tax</div>
    <div class="col-md-1">Amount</div>
     <div class="col-md-1"></div>
    </div> 

				               <div class="input_fields_wrap_add_buying_mk_new">

  	<div class="row">
    <div class="col-md-2"><input class="form-control" type="text" name="project_id[]"></div>
    <div class="col-md-2"><input class="form-control" type="text" name="item_id[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" name="item_price[]"></div>
     <div class="col-md-1"><input class="form-control" type="text" name="account[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" name="item_qty[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" name="discount[]"></div>
   <div class="col-md-1"><input class="form-control" type="text" name="taxcode[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" name="tax[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" name="amount[]"></div>
    <div class="col-md-1"></div>
    </div>
<br>
</div>

<button class="btn btn-default add_field_button_add_buying_mk_new">Add new row</button>
</div>
                    </div>
      
                  </div>
                </div>
              </div>
            </div>
            </div>
                                      
 </div>
 </div>
                              
</form>
</div>
    </div>
</div>


<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_add_buying_mk_allocate"); //Fields wrapper
    var add_button      = $(".add_field_button_add_buying_mk_allocate"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            		'<div class="col-md-2"><input class="form-control" type="text" name="date[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="id[]"></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="type[]"></div>'+
            	     '<div class="col-md-2"><input class="form-control" type="text" name="total_amount[]"></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="balance_owing[]"></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="how_much_to_allocate[]"></div>'+
            	    '<a  href="#" class="remove_field_add_buying_mk_allocate btn btn-default">x</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field_add_buying_mk_allocate", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


</script>




<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_add_buying_mk_new"); //Fields wrapper
    var add_button      = $(".add_field_button_add_buying_mk_new"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="project_id[]"></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="item_id[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="item_price[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="account[]"></div>'+
            	   '<div class="col-md-1"><input class="form-control" type="text" name="item_qty[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="discount[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="taxcode[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="tax[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" name="amount[]"></div>'+
            	    '<a  href="#" class="remove_field_add_buying_mk_new btn btn-default">x</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field_add_buying_mk_new", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


</script>

<script>
$("#contact_id").change(function(){
	var id=$(this).val();
	location.href=window.location.pathname+'?user=add_buying_mk&id='+id;
	});
</script>