<?php

$id=$_REQUEST['id'];
$customer_row=$db->get_row('contacts',array('id'=>$id));
$customer_project=$db->get_col('assign_customer_project',array('customer'=>$id,'visibility_status'=>'active'),'project_id');
$customer_item=$db->run("select * from items where visibility_status='active' && (item_to='sell' || item_to='both')")->fetchall();
$all_supply_item_tax=$db->run("select * from tax where visibility_status='active' && what_trans_is_used='supply'")->fetchall();

$csf=CAN_START_FROM+1;
$invoice_number=sprintf('%06u', $csf);
if(!empty(CAN_PREFIX)){
    $invoice_number=CAN_PREFIX.$invoice_number;
}else{
    $invoice_number='CAN'.$invoice_number;
}

if (isset($_POST['can_submit']))
{
	//print_r($_POST);
    $customer_id=$_POST['customer_id'];
    $adjustment_type=$_POST['adjustment_type'];
    $adjustment_date=$_POST['adjustment_date'];
    $reference_code=$_POST['reference_code'];
    //$amounts=$_POST['amounts'];



    $project_id=serialize($_POST['project']);

    $account=array();
    if (is_array($_POST['item']))
    {
        foreach ($_POST['item'] as $ac)
        {
            $acc_id=$db->get_var('items',array('id'=>$ac),'sell_item_account');
            array_push($account, $acc_id);
        }
    }
    $accounts=serialize($account);
    $item_id=serialize($_POST['item']);
    $item_price=serialize($_POST['item_price']);
    //$account=serialize($_POST['account']);
    $item_description=serialize($_POST['description']);
    $item_qty=serialize($_POST['qty']);
   // $discount=serialize($_POST['discount']);
    $taxcode=serialize($_POST['tax_code']);
    $tax=serialize($_POST['tax']);
    $amount=serialize($_POST['total']);

    $status=$_POST['status'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $visibility_status="active";
    $total_tax=array_sum($_POST['tax']);
    $subtotal=array_sum($_POST['total']);
    $total_amount=$total_tax+$subtotal;
    $notes=$_POST['notes'];

    $empt_fields = $fv->emptyfields(array('Customer Name'=>$customer_id,'Adjustment type'=>$adjustment_type,
        'Adjustment Date'=>$adjustment_date,
    ));

    if ($empt_fields)
    {
        $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }
    else{

    $insert=$db->insert('customer_adjustment_notes',array('customer_id'=>$customer_id,
                                        'adjustment_type'=>$adjustment_type,
                                        'adjustment_number'=>$invoice_number,
                                        'adjustment_date'=>$adjustment_date,
                                        'reference_code'=>$reference_code,
                                        //'amounts'=>$amounts,
                                        'project_id'=>$project_id,
                                        'item_id'=>$item_id,
                                        'item_price'=>$item_price,
                                        'account'=>$accounts,
                                        'item_description'=>$item_description,
                                        'item_qty'=>$item_qty,
                                        //'discount'=>$discount,
                                        'taxcode'=>$taxcode,
                                        'tax'=>$tax,
                                        'amount'=>$amount,

                                        'status'=>$status,
                                        'created_date'=>$created_date,
                                        'ip_address'=>$ip_address,
                                        'visibility_status'=>$visibility_status,
							    		'total_tax'=>$total_tax,
							    		'subtotal'=>$subtotal,
							    		'total_amount'=>$total_amount,
    									'notes'=>$notes,
    									'balance_remaining'=>$total_amount,
    									'payment_status'=>'unpaid',
    									'gst_registered'=>'yes'
    ));
   // $db->debug();
    $last_id=$db->lastInsertId();


    $db->update('daytoday_report_settings',array('can_start_from'=>$csf),array('id'=>1));

    if ($insert){
        $event="Create Customer  adjustment note  (" . $invoice_number . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
        				<button class="close" data-dismiss="alert" type="button">×</button>
        				Save successfully. </div>';

        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("customer_adjustment_notes",user)."'
        	                },3000);</script>";

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
                  <h3>Customer adjustment note &nbsp;&nbsp;&nbsp;<span class="label label-info">Status : Draft</span>
                   <a href="<?php echo $link->link('customer_adjustment_notes',user);?>" class="btn btn-default pull-right">Back to List</a>
                         <a href="<?php echo $link->link('add_selling_can',user);?>" class="btn btn-default pull-right">Cancel</a>

                      <button class="btn btn-primary pull-right" type="submit" name="can_submit">Save</button>
                    </h3>
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
                                       <select class="form-control" name="customer_id" id="customer_id" >
                                       <option value="">select</option>
                                       <?php
											$all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
											if (is_array($all_customer)){
												foreach ($all_customer as $customer){ ?>
													<option value="<?php echo $customer['id'];?>" <?php if ($customer['id']==$customer_row['id']){echo 'selected';}?>><?php echo $customer['display_name'];?></option>
										<?php }
											}
										?>
                                       </select>
                                    </div>
                                    <div class="col-md-1"><a title="Add New Contact" class="text-danger btn" data-toggle="modal" href="#add_contact_modal"><i class="lnr lnr-plus-circle"></i></a></div>
                                 </div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3">Adjustment Type<font color="red">*</font></label>
                                    <div class="col-md-7">

                                       <select class="form-control" name="adjustment_type">
                                        <option value="">Select</option>
                                        <option value="debit">debit</option>
                                        <option value="credit">credit</option>

                                       </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-7">
                                       <p><?php echo $customer_row['postal_address'];?>
                                       <?php //echo $customer_row['postal_address_suburb'];?>
                                       <?php echo $customer_row['postal_address_postcode'];?>
                                       </p>
                                    </div>
                                 </div>
                                 <br>
                              </div>
                              <div class="col-md-6">
                               <div class="form-group">
                                    <label class="control-label col-md-3">Adjustment note number</label>
                                    <div class="col-md-7">
                                   <label class="control-label col-md-3"><?php echo $invoice_number; ?></label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Adjustment note date<font color="red">*</font></label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="adjustment_date" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3">Reference code</label>
                                    <div class="col-md-7">
                                       <input class="form-control" placeholder="" type="text" name="reference_code" value="<?php echo "REF-CAN".time();?>">
                                    </div>
                                 </div>
                                 <!-- <div class="form-group">
                                    <label class="control-label col-md-3">Amounts<font color="red">*</font></label>
                                    <div class="col-md-7">
                                       <select class="form-control" name="amounts" required>
                                          <option value="nontaxed">Non taxed</option>
                                          <option value="gross">Gross (Tax inclusive)</option>
                                          <option value="net">Net (Tax Enclusive)</option>
                                       </select>
                                    </div>
                                 </div> -->
                              </div>
                           </div>
                           <br>

<div class="row">
	<div class="row">
        <div class="col-md-2">Project<font color="red">*</font><a title="Add New Project" class="text-danger btn" data-toggle="modal" href="#add_project"><i class="lnr lnr-plus-circle"></i></a></div>
    <div class="col-md-2">Items<font color="red">*</font><a title="Add New Item" class="text-danger btn" data-toggle="modal" href="#add_item_modal"><i class="lnr lnr-plus-circle"></i></a></div>

    <div class="col-md-1">Item Price</div>
    <div class="col-md-2">Description</div>
    <div class="col-md-1">Qty</div>
    <div class="col-md-1">Tax code</div>
    <div class="col-md-1">Tax</div>
    <div class="col-md-1">Amount</div>
     <div class="col-md-1"></div>
    </div>
			               <div class="input_fields_wrap_selling_estimate">

  	<div class="row">
    <div class="col-md-2">
    	<select class="form-control" name="project[]" required><option value="">Select</option>
    		<?php if (is_array($customer_project)){
    				foreach ($customer_project as $projct){
    						$project_name=$db->get_var('projects',array('id'=>$projct),'project_name'); ?>
    							<option value="<?php echo $projct;?>"><?php echo $project_name;?></option>
    	<?php }}?></select></div>
    <div class="col-md-2">
    	<select class="form-control" name="item[]" id="itm_change" required><option value="">Select</option>
    		<?php
    			if (is_array($customer_item)){
    				foreach ($customer_item as $customer_items){?>
						<option class="itm<?php echo $customer_items['id'];?>" sell_prc="<?php echo $customer_items['net_sell_item_price'];?>" tax_code="<?php echo $customer_items['sell_item_tax_code'];?>" value="<?php echo $customer_items['id'];?>"><?php echo $customer_items['item_name'];?></option>
    		<?php }
    			}
    		?>
    	</select>
    </div>
    <div class="col-md-1"><input class="form-control" type="text" name="item_price[]"  id="it_prc1" required></div>
    <div class="col-md-2"><input class="form-control" type="text" name="description[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" id="qty" name="qty[]" required></div>

    <div class="col-md-1">
    <select class="form-control" id="tax_code" name="tax_code[]">
    	<option value="">Select</option>
    		<?php
    			if (is_array($all_supply_item_tax)){
    				foreach ($all_supply_item_tax as $item_tax){?>
						<option value="<?php echo $item_tax['tax_name'];?>"><?php echo $item_tax['tax_name'];?> @ <?php echo $item_tax['tax_rate']?>%</option>
    		<?php }
    			}
    		?>
    	</select></div>
    <div class="col-md-1">
    	<input class="form-control" type="text" id="taxx1" name="tax[]" readonly>
    	<input class="form-control" type="hidden" id="taxx_perc" name="tax_percentage[]">
    </div>

    <div class="col-md-1">
    	<input class="form-control" type="text" id="item_total1" name="total[]" readonly>
    	<!-- <input class="form-control" type="text" id="amount1" name="amount[]"> -->
    </div>
    <div class="col-md-1"></div>
    </div>
<br>
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
                                    <textarea class="form-control" rows="6" cols="200" placeholder="Note to Customer" name="notes"></textarea>
                                    </div>
                              </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="control-label col-md-8">Subtotal &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div class="sub_total" id="sub_total">0.00</div>
                                       </div>
                                    </div>
                                    <!--  <div class="form-group">
                                       <label class="control-label col-md-8">Total(excluding tax) &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div id="">0.00</div>
                                       </div>
                                    </div> -->
                                    <div class="form-group">
                                       <label class="control-label col-md-8">Tax &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div id="total_tax">0.00</div>
                                       </div>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                       <label class="control-label col-md-8">Total &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div id="total_amt">0.00</div>
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

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            	    '<div class="col-md-2"><select class="form-control" name="project[]" required><option value="">Select</option><?php if (is_array($customer_project)){ foreach ($customer_project as $projct){ $custom_proj=$db->get_row('projects',array('id'=>$projct)); ?><option value="<?php echo $custom_proj['id'];?>"><?php echo $custom_proj['project_name'];?></option><?php }}?></select></div>'+

            	    '<div class="col-md-2"><select id="'+x+'" class="form-control items_select'+x+'" name="item[]" required><option value="">Select</option><?php if (is_array($customer_item)){	foreach ($customer_item as $customer_items){?><option class="item_cost_<?php echo $customer_items['id'];?>" sell_price="<?php echo $customer_items['net_sell_item_price'];?>" value="<?php echo $customer_items['id'];?>"><?php echo $customer_items['item_name'];?></option><?php }} ?></select></div>'+

            	    '<div class="col-md-1"><input class="form-control" type="text" id="it_prc'+x+'" name="item_price[]" required></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="description[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" id="qty'+x+'" name="qty[]" required></div>'+
            	    '<div class="col-md-1">'+
            	    '<select  class="form-control" id="tax_code'+x+'" name="tax_code[]" >'+
            	    '<option value="">Select</option>'+
            	    <?php if (is_array($all_supply_item_tax)){foreach ($all_supply_item_tax as $tax_name){?>
            	    '<option  value="<?php echo $tax_name['tax_name'];?>"><?php echo $tax_name['tax_name'];?>@<?php echo $tax_name['tax_rate']?></option>'+
            	    <?php }} ?>
            	    '</select>'+
            	    '</div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" id="taxx'+x+'" name="tax[]" readonly>'+
            	    '<input class="form-control" type="hidden" id="taxx_perc'+x+'" name="tax_percentage[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" id="item_total'+x+'" name="total[]" readonly></div>'+

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
        				  var tax_code=res[1];
        				  var tax_percent=res[2];
        				  var tax_amount=(item_price*tax_percent)/100;
        				  //alert(tax_amount);

        				  $("#it_prc"+item_id).val(item_price);
        				  $("#tax_code"+item_id).val(tax_code);
        				  $("#taxx_perc"+item_id).val(tax_percent);
        				  $("#item_total"+item_id).val(item_price);
        				  $("#qty"+item_id).val('1');

        					//var tx=parseInt(res[0])/parseInt(res[2]);
        					var amt=parseInt(tax_amount) + parseInt(item_price);
        				  $("#taxx"+item_id).val(tax_amount);
        				  $("#amount"+item_id).val(amt);

							//----------- Sub Total /Total Tax/ Total amount --------
	        				var st=parseInt(0);
	        				var tx=parseFloat(0);

	      	            	for(var i=1; i<=x; i++){
	      	    				//var stt=parseInt($("#amount"+i).val());
	      	            		var stt=parseInt($("#item_total"+i).val());
	      	    				var txx=parseFloat($("#taxx"+i).val());
	      	    				if(isNaN(stt)){
		      	    				stt=0;
		      	    				txx=0;
		      	    			}
	      						var st= st + stt;
	      						var tx= tx + txx;
	      	                }
							//alert();parseInt($("#sub_total").html())
	      	                $("#sub_total").html(st);
	      	                $("#total_tax").html(tx);
	      	                var tot= st + tx;
	      	                $("#total_amt").html(tot);
        			  }
        		});
            });

            //--------- Calculate tax/ Total amount on change item price---------

            $("#it_prc"+x).keyup(function(){

                var item_qty=$('#qty'+x).val();
            	var item_price=$(this).val();
            var amount=item_price*item_qty
            var tax_percent=$("#taxx_perc"+x).val();
            var	tax_amount=(amount*tax_percent)/100;

            	$("#taxx"+x).val(tax_amount);
            	$("#item_total"+x).val(amount);


         	   //----------- Sub Total /Total Tax/ Total amount --------
				var st=parseInt(0);
				var tx=parseFloat(0);

	            	for(var i=1; i<=x; i++){

	            		var stt=parseFloat($("#item_total"+i).val());
						var st= st + stt;

						var txx=parseFloat($("#taxx"+i).val());
						var tx= tx + txx;
	                }

	                $("#sub_total").html(st.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	                var tot= st + tx;
	                $("#total_amt").html(tot.toFixed(2));


            });
	          //--------- Calculate tax/ Total amount on change quantity---------
            $("#qty"+x).keyup(function(){
                 var item_price=$('#it_prc'+x).val();
            	 var item_qty=$(this).val();

            	var item_amount=item_price*item_qty
            	$("#item_total"+x).val(item_amount);

            	var tax_percentage=$("#taxx_perc"+x).val();
            	var	tax_amount=(item_amount*tax_percentage)/100;
            	var tax=$("#taxx"+x).val(tax_amount);
           //----------- Sub Total /Total Tax/ Total amount --------
				var st=parseInt(0);
				var tx=parseFloat(0);

	            	for(var i=1; i<=x; i++){

	            		var stt=parseFloat($("#item_total"+i).val());
						var st= st + stt;

						var txx=parseFloat($("#taxx"+i).val());
						var tx= tx + txx;
	                }

	                $("#sub_total").html(st.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	                var tot= st + tx;
	                $("#total_amt").html(tot.toFixed(2));
            });



	          //--------- Calculate tax/ Total amount on change tax---------

            $("#tax_code"+x).change(function(){
            	var tax_name=$(this).val();
            	$.ajax({
            		  type: "POST",
            		  url: "<?php echo $link->link('ajax',frontend);?>",
            		  data: 'item_code_name='+tax_name,
            		  success: function (data) {
                          var item_total=$('#item_total'+x).val();
                          var tax_percent=data;
            			  var tax_amount=(item_total*tax_percent)/100;

                          $("#taxx_perc"+x).val(tax_percent);
            			  $("#taxx"+x).val(tax_amount);

            			  //----------- Sub Total /Total Tax/ Total amount --------
  						var st=parseInt(0);
  						var tx=parseFloat(0);

  			            	for(var i=1; i<=x; i++){

  			            		var stt=parseFloat($("#item_total"+i).val());
  								var st= st + stt;

  								var txx=parseFloat($("#taxx"+i).val());
  								var tx= tx + txx;
  			                }

  			                $("#sub_total").html(st.toFixed(2));
  			                $("#total_tax").html(tx.toFixed(2));
  			                var tot= st + tx;
  			                $("#total_amt").html(tot.toFixed(2));
            		  }
            	});
            });

            //======*******------ Cross Button Calculate (Sub Total /Total Tax/ Total amount)----******=====
            $("#remove_item"+x).click(function(){
            	var dd=$(this).attr('id');
	    		var res=dd.split("remove_item");
				var res_id=res[1];

				var amount=parseFloat($('#item_total'+res_id).val());
				var sub_total=parseFloat($('#sub_total').html());

				var new_sub_total=sub_total-amount;
				var new_total=new_sub_total;

				$("#sub_total").html(new_sub_total.toFixed(2));
				$("#total_amt").html(new_total.toFixed(2));
            });

        }
    });

    $(wrapper).on("click",".remove_field_selling_estimate", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
        //x--;
    })
});


				//= = = = = == = * * * * * First Fields ** * *  * * *  ******+++++++++++++++


//---------------- To Change Item and get tax/tax code/qty/amount -------------------
$("#itm_change").change(function(){
	var itm=$(this).val();
	var sell_prc=$(".itm"+itm).attr('sell_prc');
	//$("#it_prc1").val(sell_prc);

		$.ajax({
			  type: "POST",
			  url: "<?php echo $link->link('ajax',frontend);?>",
			  data: 'item_id='+itm,
			  success: function (data) {
				  var res=data.split("__");
				  var lenth=res.length;


				  var item_price=res[0];
				  var tax_code=res[1];
				  var tax_percent=res[2];
				  var tax_amount=(item_price*tax_percent)/100;

				  $("#it_prc1").val(item_price);
				  $("#tax_code").val(tax_code);
				  $("#taxx_perc").val(tax_percent);
				  $("#item_total1").val(item_price);
				  $("#qty").val('1');
					//var tx=parseInt(res[0])/parseInt(res[2]);
					var amt=parseFloat(tax_amount) + parseFloat(item_price);
				  $("#taxx1").val(tax_amount);
				  $("#amount1").val(amt);

					//----------- Sub Total /Total Tax/ Total amount --------
					//var amt=parseInt($("#amount1").val());
				  var amt=parseInt($("#item_total1").val());
					var tx=parseFloat($("#taxx1").val());
					var total_amt=amt+tx
					$("#sub_total").html(amt.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	              $("#total_amt").html(total_amt.toFixed(2));
			  }
		});
});

//--------- Calculate tax/ Total amount on change quantity---------
$("#qty").keyup(function(){
	var itm_prc1=$('#it_prc1').val();
	var itm_qty=$(this).val();
    var amount=itm_prc1*itm_qty
    var tax_percent=$("#taxx_perc").val();
    var	tax_amount=(amount*tax_percent)/100;

	$("#taxx1").val(tax_amount);
	$("#item_total1").val(amount);


	//----------- Sub Total /Total Tax/ Total amount --------
	var amt=parseFloat($("#item_total1").val());
	var tx=parseFloat($("#taxx1").val());

	var total_amt=amt+tx
	$("#sub_total").html(amt.toFixed(2));
    $("#total_tax").html(tx.toFixed(2));
  $("#total_amt").html(total_amt.toFixed(2));


});

//--------- Calculate tax/ Total amount on change item price---------
$("#it_prc1").keyup(function(){

	var item_qty=$('#qty').val();
	var item_price=$(this).val();
var amount=item_price*item_qty
var tax_percent=$("#taxx_perc").val();
var	tax_amount=(amount*tax_percent)/100;

	$("#taxx1").val(tax_amount);
	$("#item_total1").val(amount);


	//----------- Sub Total /Total Tax/ Total amount --------
	var amt=parseFloat($("#item_total1").val());
	var tx=parseFloat($("#taxx1").val());
	var total_amt=amt+tx
	$("#sub_total").html(amt.toFixed(2));
    $("#total_tax").html(tx.toFixed(2));
  $("#total_amt").html(total_amt.toFixed(2));


});
//--------- Calculate tax/ Total amount on change tax---------

$("#tax_code").change(function(){
	var tax_name=$(this).val();
	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'item_code_name='+tax_name,
		  success: function (data) {
              var item_total=$('#item_total1').val();
              var tax_percent=data;
			  var tax_amount=(item_total*tax_percent)/100;

              $("#taxx_perc").val(tax_percent);
			  $("#taxx1").val(tax_amount);

 //----------- Sub Total /Total Tax/ Total amount --------
				var amt=parseFloat($("#item_total1").val());
				var tx=parseFloat($("#taxx1").val());
				var total_amt=amt+tx
				$("#sub_total").html(amt.toFixed(2));
                $("#total_tax").html(tx.toFixed(2));
              $("#total_amt").html(total_amt.toFixed(2));
		  }
	});


});


//----------- Send Customer Id To Header --------------
$("#customer_id").change(function(){
	var id=$(this).val();
	location.href=window.location.pathname+'?user=add_selling_can&id='+id;
});
</script>
