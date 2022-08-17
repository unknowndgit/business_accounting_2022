<?php
$id=$_REQUEST['action_edit'];
$invoice_details=$db->get_row('invoices',array('id'=>$id));
$customer_detail=$db->get_row('contacts',array('id'=>$invoice_details['customer_id']));
$customer_project=$db->get_all('assign_customer_project',array('customer'=>$invoice_details['customer_id']));
$customer_item=$db->run("select * from items where visibility_status='active' && (item_to='sell' || item_to='both')")->fetchall();
//$all_supply_item_tax=$db->run("select * from tax where visibility_status='active' && what_trans_is_used='supply'")->fetchall();

$project_id=unserialize($invoice_details['project_id']);
$total_projects=count($project_id);
$item_id=unserialize($invoice_details['item_id']);
$item_price=unserialize($invoice_details['item_price']);
$account=unserialize($invoice_details['account']);
$item_description=unserialize($invoice_details['item_description']);
$item_qty=unserialize($invoice_details['item_qty']);
//$taxcode=unserialize($invoice_details['taxcode']);
//$tax=unserialize($invoice_details['tax']);
$amount=unserialize($invoice_details['amount']);
//$total_tax=$invoice_details['total_tax'];
$subtotal=$invoice_details['subtotal'];
$total_amount=$invoice_details['total_amount'];



if (isset($_POST['invoice_submit']))
{
    $customer_id=$_POST['customer_id'];
    $invoice_date=$_POST['invoice_date'];
    $reference_code=$_POST['reference_code'];
    $due_date=$_POST['due_date'];
    $invoice_discount=$_POST['invoice_discount'];
   // $amounts=$_POST['amounts'];
    $payment_term=$_POST['payment_term'];
    $project_id=$_POST['project'];
    $item_id=$_POST['item'];
    $item_price=$_POST['item_price'];
    $account=array();
    if (is_array($_POST['item']))
    {
        foreach ($_POST['item'] as $ac)
        {
            $acc_id=$db->get_var('items',array('id'=>$ac),'sell_item_account');
            array_push($account, $acc_id);
        }
    }
    $accounts=$account;
    $item_description=$_POST['description'];
    $item_qty=$_POST['qty'];
    //$discount=serialize($_POST['discount']);
    //$taxcode=$_POST['tax_code'];
    //$tax=$_POST['tax'];
    $amount=$_POST['total'];
    $status=$_POST['status'];
    $visibility_status='active';
    $notes=$_POST['notes'];
    $payment_notes=$_POST['payment_notes'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    //$total_tax=array_sum($_POST['tax']);
    $subtotal=array_sum($_POST['total']);
    $total_amount=$total_tax+$subtotal;

    $empt_fields = $fv->emptyfields(array('Customer Name'=>$customer_id,
        'InvoiceDate'=>$invoice_date,
    ));

    if ($empt_fields)
    {
        $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }
    else{
    $update=$db->update('invoices',array('customer_id'=>$customer_id,
                                        'invoice_date'=>$invoice_date,
                                        'reference_code'=>$reference_code,
                                        'due_date'=>$due_date,
                                       // 'invoice_discount'=>$invoice_discount,
                                       // 'amounts'=>$amounts,
                                        'payment_term'=>$payment_term,
                                        'project_id'=>serialize($project_id),
                                        'item_id'=>serialize($item_id),
                                        'item_price'=>serialize($item_price),
                                        'account'=>serialize($accounts),
                                        'item_description'=>serialize($item_description),
                                        'item_qty'=>serialize($item_qty),
                                       // 'discount'=>$discount,
                                       // 'taxcode'=>serialize($taxcode),
                                       // 'tax'=>serialize($tax),
                                        'amount'=>serialize($amount),
                                        'status'=>$status,
    									'visibility_status'=>$visibility_status,
    									'notes'=>$notes,
    									'payment_notes'=>$payment_notes,
                                        'created_date'=>$created_date,
                                        'ip_address'=>$ip_address,
							    	//'total_tax'=>$total_tax,
							    		'subtotal'=>$subtotal,
							    		'total_amount'=>$total_amount,
    									'balance_remaining'=>$total_amount,
    									'gst_registered'=>'no',
    ),array('id'=>$id));
    /*$last_id=$db->lastInsertId();
    $invoice_number=sprintf('%04u', $last_id);
	if(!empty(INVOICE_PREFIX)){
		$invoice_number==INVOICE_PREFIX.$invoice_number;
	}else{
		$invoice_number='INV'.$invoice_number;
	}
    $db->update('invoices',array('invoice_number'=>$invoice_number),array('id'=>$last_id));*/

    if ($update){
        $event="Edit invoice  (" . $invoice_details['invoice_number'] . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));



        if (is_array($project_id))
        {
            foreach ($project_id as $key=>$value){
                $project_t=$value;
                //$item_t=$item_id[$key];
                //$taxcode_t=$taxcode[$key];
                //$tax_account=$db->get_var('tax',array('tax_name'=>$taxcode_t),'tax_account_for_gst_collected');
                //$tax_rate=$db->get_var('tax',array('tax_name'=>$taxcode_t),'tax_rate');
                //$tax_amount_t=$tax[$key];
                $amount_t=$amount[$key];
                $item_qty_t=$item_qty[$key];
                $month=date('M');
                $year=date('Y');
                $section="sale";
                $generated_from="invoice";
                $generated_from_id=$last_id;
				if ($taxcode_t!=""){
                $update_tax=$db->update('tax_calculation',array('project_id'=>$project_t,
                                                                   //'tax_code'=>$taxcode_t,
                                                                    //'tax_amount'=>$tax_amount_t,
                                                                    //'tax_account'=>$tax_account,
                                                                    //'tax_rate'=>$tax_rate,
                                                                    'item'=>$item_t,
                                                                    'quantity'=>$item_qty_t,
                                                                    'tax_payable_amount'=>$amount_t,
                                                                    'generated_from'=>$generated_from,
                                                                    'generated_from_id'=>$generated_from_id,
                                                                    'month'=>$month,
                                                                    'year'=>$year,
                                                                    'section'=>$section,
                                                                    'created_date'=>$created_date,
                                                                    'ip_address'=>$ip_address,
                                                                    'visibility_status'=>'active'
                  ),array('genereted_from'=>'invoice', 'genereted_from_id'=>$id));
            }

            }
            $display_msg= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button>Invoice Save successfully.
                    		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("selling_invoice",user)."'
        	                },3000);</script>";
        	}
    	}
	}
}?>
<div class="row">
   <div class="col-lg-12">
      <div class=" padded" >
         <h3>SELLING</h3>
      </div>
      <?php echo $display_msg;?>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
         <form action="" class="form-horizontal" method="post">
         <input type="hidden" value="<?php if (SELLING_APPROVAL=="enabled"){echo"draft";}else {echo "approved";}?>" name="status">
            <div class="row">
               <div class="col-lg-12">
                  <h4>Edit Tax invoice &nbsp;&nbsp;&nbsp;<span class="label label-info">Status : <?php echo $invoice_details['status'];?></span>
                   <a href="<?php echo $link->link('selling_invoice',user);?>" class="btn btn-default pull-right">Back to List</a>
                         <a href="<?php echo $link->link('edit_invoice',user,'&action_edit='.$id );?>" class="btn btn-default pull-right">Cancel</a>

                      <button class="btn btn-primary pull-right" type="submit" name="invoice_submit">Save</button>
                    </h4>
                  <div class="widget-container fluid-height clearfix">

                   <!--   <div class="btn-group pull-right">
                        <button class="btn btn-primary" type="submit" name="invoice_submit">Save</button>
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="#"><i class="fa fa-plus"></i>Save & New</a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-edit"></i>Save</a>
                           </li>
                        </ul>
                     </div> -->

                <div class="widget-content padded">

                         <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                 </div>
                                 <br>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Customer<font color="red">*</font></label>
                                    <div class="col-md-7">
                                    	<input type="text" class="form-control" value="<?php echo $customer_detail['display_name'];?>" readonly>
                                    	<input type="hidden" class="form-control" value="<?php echo $customer_detail['id'];?>" name="customer_id">
                                       <!-- <select class="form-control" name="customer_id" id="customer_id" >
                                       <option value="">select</option>
                                       <?php
											$all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
											if (is_array($all_customer)){
												foreach ($all_customer as $customer){ ?>
													<option value="<?php echo $customer['id'];?>" <?php if ($customer['id']==$customer_row['id']){echo 'selected';}?>><?php echo $customer['display_name'];?></option>
										<?php }
											}
										?>
                                       </select> -->
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-7">
                                       <p><?php echo $customer_detail['postal_address'];?>
                                       <?php //echo $customer_detail['postal_address_suburb'];?>
                                       <?php echo $customer_detail['postal_address_postcode'];?>
                                       </p>
                                    </div>
                                 </div>
                                 <br>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Invoice number</label>
                                    <div class="col-md-7">
                                   <label class="control-label col-md-3"><?php echo $invoice_details['invoice_number'];?></label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3">
                                    Invoice date<font color="red">*</font></label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="invoice_date" value="<?php echo $invoice_details['invoice_date'];?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                       </div>
                                    </div>
                                 </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3">Reference code</label>
                                    <div class="col-md-7">
                                       <input class="form-control" placeholder="" type="text" name="reference_code" value="<?php echo $invoice_details['reference_code'];?>">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Due date</label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="due_date" value="<?php echo $invoice_details['due_date'];?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                       </div>
                                    </div>
                                 </div>
                                 <!--  <div class="form-group">
                                    <label class="control-label col-md-3">Invoice discount</label>
                                    <div class="col-md-7">
                                       <input class="form-control" placeholder="" type="text" name="invoice_discount">
                                    </div>
                                 </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3">Amounts<font color="red">*</font></label>
                                    <div class="col-md-7">
                                       <select class="form-control" name="amounts" required>
                                          <option value="nontaxed">Non taxed</option>
                                          <option value="gross">Gross (Tax inclusive)</option>
                                          <option value="net">Net (Tax Enclusive)</option>
                                       </select>
                                    </div>
                                 </div>  -->
                                  <div class="form-group">
                                    <label class="control-label col-md-3">Payment terms</label>
                                    <div class="col-md-7">
                                       <select class="form-control" name="payment_term">
                                          <option value="10">Due on receipt</option>
                                          <option value="15">Net 15</option>
                                          <option value="20">Net 20</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <br>

<div class="row">
	<div class="row">
    <div class="col-md-2">Project<font color="red">*</font></div>
    <div class="col-md-2">Items<font color="red">*</font></div>
    <div class="col-md-2">Item Price</div>
    <div class="col-md-2">Description</div>
    <div class="col-md-2">Qty</div>
    <!-- <div class="col-md-1">Item total</div> -->
    <!-- <div class="col-md-1">Discount</div>
    <div class="col-md-1">Tax code</div>
    <div class="col-md-1">Tax amount</div> -->

    <div class="col-md-1">Amount</div>
     <div class="col-md-1"></div>
    </div>

<div class="input_fields_wrap_selling_estimate">
	<?php foreach ($project_id as $key=>$projects){ ?>

  	<div class="row">
    <div class="col-md-2">
    	<select class="form-control" name="project[]" required>
    	<option value="">Select</option>
    		<?php if (is_array($customer_project)){
    				foreach ($customer_project as $projct){
    						$project_name=$db->get_var('projects',array('id'=>$projct['project_id']),project_name); ?>
    							<option value="<?php echo $projct['project_id'];?>" <?php if ($projct['project_id']==$projects){echo 'selected';}?>><?php echo $project_name;?></option>
    	<?php }}?></select>
    	</div>
    <div class="col-md-2">
    	<select class="form-control items_select<?php echo $key;?>" name="item[]" id="<?php echo $key;?>" required>
    	<option value="">Select</option>
    		<?php
    			if (is_array($customer_item)){
    				foreach ($customer_item as $customer_items){?>
						<option class="itm<?php echo $customer_items['id'];?>" sell_prc="<?php echo $customer_items['net_sell_item_price'];?>" tax_code="<?php echo $customer_items['sell_item_tax_code'];?>" value="<?php echo $customer_items['id'];?>" <?php if ($customer_items['id']==$item_id[$key]){echo 'selected';}?> ><?php echo $customer_items['item_name'];?></option>
    		<?php }
    			}
    		?>
    	</select>
    </div>
    <div class="col-md-2"><input class="form-control" type="text" value="<?php echo $item_price[$key];?>" name="item_price[]"  id="it_prc<?php echo $key;?>" ></div>
    <div class="col-md-2"><input class="form-control" type="text" value="<?php echo $item_description[$key];?>" name="description[]"></div>
    <div class="col-md-2"><input class="form-control" type="text" id="qty<?php echo $key;?>" value="<?php echo $item_qty[$key];?>" name="qty[]" value="" required></div>

     <!-- <div class="col-md-2">
    <select class="form-control" id="tax_code<?php echo $key;?>" name="tax_code[] required="">
    	<option value="">Select</option>
    		<?php
    			if (is_array($all_supply_item_tax)){
    				foreach ($all_supply_item_tax as $item_tax1){?>
						<option <?php if ($taxcode[$key]==$item_tax1['tax_name']){echo "selected='selected'";}?> value="<?php echo $item_tax1['tax_name'];?>"><?php echo $item_tax1['tax_name'];?> @ <?php echo $item_tax1['tax_rate']?>%</option>
    		<?php }
    			}
    		?>
    	</select>
    	</div>
    <div class="col-md-2">
    	<input class="form-control" type="text" id="taxx<?php echo $key; ?>" value="<?php echo $tax[$key];?>" name="tax[]" readonly>
    	<input class="form-control" type="hidden" id="taxx_perc<?php echo $key; ?>" name="tax_percentage[]">
    </div> -->

    <div class="col-md-1">
    	<input class="form-control" type="text" id="item_total<?php echo $key; ?>" value="<?php echo $amount[$key];?>" name="total[]" readonly>
    	<!-- <input class="form-control" type="text" id="amount1" name="amount[]"> -->
    </div>
    	<a href="#" id="remove_item<?php echo $key; ?>" class="remove_field_selling_estimate btn btn-default">x</a>
    </div>
<br>
<script>
$(".items_select"+<?php echo $key;?>).change(function(){
	var item_id = $(this).attr('id');
	var idm=$(this).val();
	var sell_prc=$(".item_cost_"+idm).attr('sell_price');
	//$("#it_prc"+item_id).val(sell_prc);

	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'item_id='+idm,
		  success: function (data) {

			  var res=data.split("__");
			  //var lenth=res.length;

			  var item_price=res[0];
			  //var tax_code=res[1];
			  //var tax_percent=res[2];
			  //var tax_amount=(item_price*tax_percent)/100;

			  $("#it_prc"+item_id).val(item_price);
			  //$("#tax_code"+item_id).val(tax_code);
			  //$("#taxx_perc"+item_id).val(tax_percent);
			  //$("#taxx"+item_id).val(tax_amount);
			  $("#item_total"+item_id).val(item_price);
			  $("#qty"+item_id).val('1');

			//var tx=parseInt(res[0])/parseInt(res[2]);
			var amt= parseFloat(item_price); //parseFloat(tax_amount) +
			  //$("#taxx"+item_id).val(tax_amount);
			  $("#amount"+item_id).val(amt);

				//----------- Sub Total /Total Tax/ Total amount --------
				var st=parseFloat(0);
				//var tx=parseFloat(0);
				var n=<?php echo $total_projects;?>;
	            	for(var i=0; i<n; i++){
	    				//var stt=parseInt($("#amount"+i).val());
	            		var stt=parseFloat($("#item_total"+i).val());
	    				//var txx=parseFloat($("#taxx"+i).val());
	    				if(isNaN(stt)){
  	    					stt=0;
  	    					//txx=0;
  	    				}
						var st= st + stt;
						//var tx= tx + txx;
	                }
	            	parseFloat($("#sub_total").html())
	                $("#sub_total").html(st);
	                //$("#total_tax").html(tx);
	                var tot= tx;   //st +
	                $("#total_amt").html(tot);
		  }
	});
});


//--------- Calculate tax/ Total amount on change item price---------

$("#it_prc"+<?php echo $key;?>).keyup(function(){

    var item_qty=$('#qty'+<?php echo $key;?>).val();
	var item_price=$(this).val();
var amount=item_price*item_qty
//var tax_percent=$("#taxx_perc"+<?php echo $key;?>).val();
//var	tax_amount=(amount*tax_percent)/100;

	//$("#taxx"+<?php echo $key;?>).val(tax_amount);
	$("#item_total"+<?php echo $key;?>).val(amount);


	   //----------- Sub Total /Total Tax/ Total amount --------
	var st=parseInt(0);
	//var tx=parseFloat(0);
	var n=<?php echo $total_projects;?>;
    	for(var i=0; i<n; i++){

    		var stt=parseFloat($("#item_total"+i).val());
			var st= st + stt;

			//var txx=parseFloat($("#taxx"+i).val());
			//var tx= tx + txx;
        }

        $("#sub_total").html(st.toFixed(2));
        //$("#total_tax").html(tx.toFixed(2));
        var tot= st;  // + tx;
        $("#total_amt").html(tot.toFixed(2));


});
//--------- Calculate tax/ Total amount on change quantity---------
$("#qty"+<?php echo $key;?>).keyup(function(){
     var item_price=$('#it_prc'+<?php echo $key;?>).val();
	 var item_qty=$(this).val();

	var item_amount=item_price*item_qty
	$("#item_total"+<?php echo $key;?>).val(item_amount);

	//var tax_percentage=$("#taxx_perc"+<?php echo $key;?>).val();
	//var	tax_amount=(item_amount*tax_percentage)/100;
	//var tax=$("#taxx"+<?php echo $key;?>).val(tax_amount);
//----------- Sub Total /Total Tax/ Total amount --------
	var st=parseInt(0);
	//var tx=parseFloat(0);
	var n=<?php echo $total_projects;?>;
    	for(var i=0; i<n; i++){

    		var stt=parseFloat($("#item_total"+i).val());
			var st= st + stt;

			//var txx=parseFloat($("#taxx"+i).val());
			//var tx= tx + txx;
        }

        $("#sub_total").html(st.toFixed(2));
        //$("#total_tax").html(tx.toFixed(2));
        var tot= st;  // + tx;
        $("#total_amt").html(tot.toFixed(2));
});

//======*******------ Cross Button Calculate (Sub Total /Total Tax/ Total amount)----******=====
$("#remove_item"+<?php echo $key;?>).click(function(){
	var dd=$(this).attr('id');
	var res=dd.split("remove_item");
	var res_id=res[1];

	var amount=parseFloat($('#item_total'+res_id).val());
	var sub_total=parseFloat($('#sub_total').html());

	if(!isNaN(amount)){
		var new_sub_total=sub_total - amount;
		var new_total=new_sub_total;

		$("#sub_total").html(new_sub_total.toFixed(2));
		$("#total_amt").html(new_total.toFixed(2));
	}
});


//--------- Calculate tax/ Total amount on change tax---------

/*$("#tax_code"+<?php echo $key;?>).change(function(){
	var tax_name=$(this).val();
	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'item_code_name='+tax_name,
		  success: function (data) {
              var item_total=$('#item_total'+<?php echo $key;?>).val();
             // var tax_percent=data;
			 // var tax_amount=(item_total*tax_percent)/100;

              //$("#taxx_perc"+<?php echo $key;?>).val(tax_percent);
			  //$("#taxx"+<?php echo $key;?>).val(tax_amount);

			  //----------- Sub Total /Total Tax/ Total amount --------
				var st=parseInt(0);
				//var tx=parseFloat(0);
				var n=<?php echo $total_projects;?>;
	            	for(var i=0; i<n; i++){

	            		var stt=parseFloat($("#item_total"+i).val());
						var st= st + stt;

						//var txx=parseFloat($("#taxx"+i).val());
						//var tx= tx + txx;
	                }

	                $("#sub_total").html(st.toFixed(2));
	                //$("#total_tax").html(tx.toFixed(2));
	                var tot= st;  // + tx;
	                $("#total_amt").html(tot.toFixed(2));
		  }
	});


});*/

</script>
<?php } ?>

</div>

<button class="btn btn-default add_field_button_selling_estimate">Add</button>
</div>

                           <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                 <label class="control-label"></label>
                                    </div>
                             <br>
                             <br>
                             <br>
                             <br>
                             <div class="form-group">
                                 <label class="control-label">NOTE:</label>
                                    <textarea class="form-control" rows="6" cols="200" placeholder="Note to Customer" name="notes"><?php echo $invoice_details['notes'];?></textarea>
                                    </div>

                                     <div class="form-group">
                                 <label class="control-label">PAYMENT NOTES:</label>
                                    <textarea class="form-control" rows="6" cols="200" placeholder="Payment notes" name="payment_notes"><?php if ($invoice_details['payment_notes']!=""){ echo $invoice_details['payment_notes'];} else{ echo INVOICE_PAYMENT_DETAILS;}?></textarea>
                                    </div>

                              </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                       <label class="control-label col-md-8">Subtotal &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div class="sub_total" id="sub_total"><?php echo $subtotal;?></div>
                                       </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                       <label class="control-label col-md-8">Total &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div id="total_amt"><?php echo $total_amount;?></div>
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
</div>



<script>
    		$(document).ready(function() {
    		    var max_fields      = 10; //maximum input boxes allowed
    		    var wrapper         = $(".input_fields_wrap_selling_estimate"); //Fields wrapper
    		    var add_button      = $(".add_field_button_selling_estimate"); //Add button ID

    		    var x = <?php echo $total_projects-1;?>//1; //initlal text box count
    		    $(add_button).click(function(e){ //on add input button click
    		        e.preventDefault();

    		        if(x < max_fields){ //max input box allowed
    		            x++; //text box increment
    		            $(wrapper).append('<div class="row">'+
    		            	    '<div class="col-md-2"><select class="form-control" name="project[]" required><option value="">Select</option><?php if (is_array($customer_project)){ foreach ($customer_project as $projct){ $custom_proj=$db->get_row('projects',array('id'=>$projct['project_id'])); ?><option value="<?php echo $custom_proj['id'];?>"><?php echo $custom_proj['project_name'];?></option><?php }}?></select></div>'+

    		            	    '<div class="col-md-2">'+
    		            	    '<select id="'+x+'" class="form-control items_select'+x+'" name="item[]" required>'+
    		            	    '<option value="">Select</option><?php if (is_array($customer_item)){	foreach ($customer_item as $customer_items){?><option class="item_cost_<?php echo $customer_items['id'];?>" sell_price="<?php echo $customer_items['net_sell_item_price'];?>" value="<?php echo $customer_items['id'];?>"><?php echo $customer_items['item_name'];?></option><?php }} ?></select></div>'+

    		            	    '<div class="col-md-2"><input class="form-control" type="text" id="it_prc'+x+'" name="item_price[]" ></div>'+
    		            	    '<div class="col-md-2"><input class="form-control" type="text" name="description[]"></div>'+
    		            	    '<div class="col-md-2"><input class="form-control" type="text" id="qty'+x+'" name="qty[]" required></div>'+
    		            	    /*'<div class="col-md-1">'+
    		            	    '<select  class="form-control" id="tax_code'+x+'" name="tax_code[]" required>'+
    		            	    '<option value="">Select</option>'+
    		            	    <?php if (is_array($all_supply_item_tax)){foreach ($all_supply_item_tax as $tax_name){?>
    		            	    '<option  value="<?php echo $tax_name['tax_name'];?>"><?php echo $tax_name['tax_name'];?>@<?php echo $tax_name['tax_rate']?></option>'+
    		            	    <?php }} ?>
    		            	    '</select>'+
    		            	    '</div>'+
    		            	    '<div class="col-md-1"><input class="form-control" type="text" id="taxx'+x+'" name="tax[]" readonly><input class="form-control" type="hidden" id="taxx_perc'+x+'" name="tax_percentage[]"></div>'+*/
    		            	    '<div class="col-md-1"><input class="form-control" type="text" id="item_total'+x+'" name="total[]" readonly></div>'+
    		            	    //'<div class="col-md-1"><input class="form-control" type="text" id="amount'+x+'" name="amount[]"></div>'+
    		            	    '<a  href="#" id="remove_item'+x+'" class="remove_field_selling_estimate btn btn-default">x</a></div>'); //add input box

    		            $(".items_select"+x).change(function(){
    		            	var item_id = $(this).attr('id');
    		            	var idm=$(this).val();
    		            	var sell_prc=$(".item_cost_"+idm).attr('sell_price');
    		            	//$("#it_prc"+item_id).val(sell_prc);
    		            	$.ajax({
    		            		  type: "POST",
    		            		  url: "<?php echo $link->link('ajax',frontend);?>",
    		            		  data: 'item_id='+idm,
    		            		  success: function (data) {
    		            			  var res=data.split("__");
    		            			  //var lenth=res.length;

    		            			  var item_price=res[0];
    		            			  //var tax_code=res[1];
    		            			  //var tax_percent=res[2];
    		            			  //var tax_amount=(item_price*tax_percent)/100;

    		            			  $("#it_prc"+item_id).val(item_price);
    		            			  //$("#tax_code"+item_id).val(tax_code);
    		            			  //$("#taxx_perc"+item_id).val(tax_percent);
    		            			  //$("#taxx"+item_id).val(tax_amount);
    		            			  $("#item_total"+item_id).val(item_price);
    		            			  $("#qty"+item_id).val('1');

    		            				//var tx=parseInt(res[0])/parseInt(res[2]);
    		            				var amt=  parseFloat(item_price);  //parseFloat(tax_amount) + parseFloat(item_price);
    		            			  //$("#taxx"+item_id).val(tax_amount);
    		            			  $("#amount"+item_id).val(amt);

    		            				//----------- Sub Total /Total Tax/ Total amount --------
    		            				var st=parseFloat(0);
    		            				//var tx=parseFloat(0);

    		            	            	for(var i=0; i<=x; i++){
    		            	    				//var stt=parseInt($("#amount"+i).val());
    		            	            		var stt=parseFloat($("#item_total"+i).val());
    		            	    			//	var txx=parseFloat($("#taxx"+i).val());
    		            	    				if(isNaN(stt)){
    		              	    				stt=0;
    		              	    				//txx=0;
    		              	    			}
    		            						var st= st + stt;
    		            						//var tx= tx + txx;
    		            	                }

    		            	            	parseFloat($("#sub_total").html())
    		            	                $("#sub_total").html(st);
    		            	                //$("#total_tax").html(tx);
    		            	                var tot= st;   // + tx;
    		            	                $("#total_amt").html(tot);
    		            		  }
    		            	});
    		            });



  			          //--------- Calculate tax/ Total amount on change quantity---------
    		            $("#qty"+x).keyup(function(){
    		            	var dd=$(this).attr('id');
    			    		var res=dd.split("qty");
    						var res_id=res[1];

                             var item_price=$('#it_prc'+res_id).val();
    		            	 var item_qty=$(this).val();

    		            	var item_amount=item_price*item_qty
    		            	$("#item_total"+res_id).val(item_amount);

    		            	//var tax_percentage=$("#taxx_perc"+x).val();
    		            	//var	tax_amount=(item_amount*tax_percentage)/100;
    		            	//var tax=$("#taxx"+x).val(tax_amount);
                       //----------- Sub Total /Total Tax/ Total amount --------
    						var st=parseInt(0);
    						//var tx=parseFloat(0);

    			            	for(var i=0; i<=x; i++){

    			            		var stt=parseFloat($("#item_total"+i).val());
    								var st= st + stt;

    							//	var txx=parseFloat($("#taxx"+i).val());
    							//	var tx= tx + txx;
    			                }

    			                $("#sub_total").html(st.toFixed(2));
    			                //$("#total_tax").html(tx.toFixed(2));
    			                var tot= st;  // + tx;
    			                $("#total_amt").html(tot.toFixed(2));
    		            });
    		            //--------- Calculate tax/ Total amount on change item price---------

    		            $("#it_prc"+x).keyup(function(){
    		            	var dd=$(this).attr('id');
    			    		var res=dd.split("it_prc");
    						var res_id=res[1];

                            var item_qty=$('#qty'+res_id).val();
    		            	var item_price=$(this).val();
    		            var amount=item_price*item_qty
    		            //var tax_percent=$("#taxx_perc"+x).val();
    		            //var	tax_amount=(amount*tax_percent)/100;

    		            	//$("#taxx"+x).val(tax_amount);
    		            	$("#item_total"+res_id).val(amount);


 		            	   //----------- Sub Total /Total Tax/ Total amount --------
    						var st=parseInt(0);
    						//var tx=parseFloat(0);

    			            	for(var i=0; i<=x; i++){

    			            		var stt=parseFloat($("#item_total"+i).val());
    								var st= st + stt;

    							//	var txx=parseFloat($("#taxx"+i).val());
    							//	var tx= tx + txx;
    			                }

    			                $("#sub_total").html(st.toFixed(2));
    			                //$("#total_tax").html(tx.toFixed(2));
    			                var tot= st;   // + tx;
    			                $("#total_amt").html(tot.toFixed(2));


    		            });


    		        	//======*******------ Cross Button Calculate (Sub Total /Total Tax/ Total amount)----******=====
    		            $("#remove_item"+x).click(function(){
    		            	var dd=$(this).attr('id');
    			    		var res=dd.split("remove_item");
    						var res_id=res[1];

    						var amount=parseFloat($('#item_total'+res_id).val());
    						var sub_total=parseFloat($('#sub_total').html());

    						if(!isNaN(amount)){
    							var new_sub_total=sub_total - amount;
    							var new_total=new_sub_total;

    							$("#sub_total").html(new_sub_total.toFixed(2));
    							$("#total_amt").html(new_total.toFixed(2));
    						}
    		            });



      		          //--------- Calculate tax/ Total amount on change tax---------

    		           /* $("#tax_code"+x).change(function(){
    		            	var tax_name=$(this).val();
    		            	$.ajax({
    		            		  type: "POST",
    		            		  url: "<?php echo $link->link('ajax',frontend);?>",
    		            		  data: 'item_code_name='+tax_name,
    		            		  success: function (data) {
    		                          var item_total=$('#item_total'+x).val();
    		                          //var tax_percent=data;
    		            			  //var tax_amount=(item_total*tax_percent)/100;

    		                          //$("#taxx_perc"+x).val(tax_percent);
    		            			  //$("#taxx"+x).val(tax_amount);

    		            			  //----------- Sub Total /Total Tax/ Total amount --------
  		    						var st=parseInt(0);
  		    						//var tx=parseFloat(0);

  		    			            	for(var i=0; i<=x; i++){

  		    			            		var stt=parseFloat($("#item_total"+i).val());
  		    								var st= st + stt;

  		    								//var txx=parseFloat($("#taxx"+i).val());
  		    								//var tx= tx + txx;
  		    			                }

  		    			                $("#sub_total").html(st.toFixed(2));
  		    			                //$("#total_tax").html(tx.toFixed(2));
  		    			                var tot= st; // + tx;
  		    			                $("#total_amt").html(tot.toFixed(2));
    		            		  }
    		            	});


    		            });*/





    		        }
    		    });

    		    $(wrapper).on("click",".remove_field_selling_estimate", function(e){ //user click on remove text
    		        e.preventDefault(); $(this).parent('div').remove();
    		        //x--;
    		    })
    		});



    		</script>
<script>


//----------- Send Customer Id To Header --------------
$("#customer_id").change(function(){
	var id=$(this).val();
	location.href=window.location.pathname+'?user=add_selling_invoice&id='+id;
});
</script>