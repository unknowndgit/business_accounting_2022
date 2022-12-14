<?php

$id=$_REQUEST['action_edit'];
$can_details=$db->get_row('customer_adjustment_notes',array('id'=>$id));
$customer_row=$db->get_row('contacts',array('id'=>$can_details['customer_id']));
$customer_project=$db->get_all('assign_customer_project',array('customer'=>$can_details['customer_id']));
$customer_item=$db->run("select * from `items` where `visibility_status`='active' AND (`item_to`='sell' OR `item_to`='both')")->fetchall();
$all_supply_item_tax=$db->run("select * from tax where visibility_status='active' && what_trans_is_used='supply'")->fetchall();
//print_r($customer_item);

$project_id=unserialize($can_details['project_id']);
$total_projects=count($project_id);
$item_id=unserialize($can_details['item_id']);
$item_price=unserialize($can_details['item_price']);
$account=unserialize($can_details['account']);
$item_description=unserialize($can_details['item_description']);
$item_qty=unserialize($can_details['item_qty']);
$taxcode=unserialize($can_details['taxcode']);
$tax=unserialize($can_details['tax']);
$amount=unserialize($can_details['amount']);
$total_tax=$can_details['total_tax'];
$subtotal=$can_details['subtotal'];
$total_amount=$can_details['total_amount'];


if (isset($_POST['can_submit']))
{
	//print_r($_POST);
    $customer_id=$_POST['customer_id'];
    $adjustment_date=$_POST['adjustment_date'];
    $reference_code=$_POST['reference_code'];
    //$amounts=$_POST['amounts'];

    $project_id=serialize($_POST['project']);
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

    $empt_fields = $fv->emptyfields(array('Customer Name'=>$customer_id,
        'Adjustment Date'=>$adjustment_date,
    ));

    if ($empt_fields)
    {
        $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">?</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }
    else{
    $update=$db->update('customer_adjustment_notes',array('customer_id'=>$customer_id,
                                        'adjustment_date'=>$adjustment_date,
                                        'reference_code'=>$reference_code,
                                        //'amounts'=>$amounts,
                                        'project_id'=>$project_id,
                                        'item_id'=>$item_id,
                                        'item_price'=>$item_price,
                                        //'account'=>$account,
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
    ),array('id'=>$id));
	//$db->debug();
    //$last_id=$db->lastInsertId();
    /*$invoice_number=sprintf('%04u', $last_id);
    if(!empty(CAN_PREFIX)){
    	$invoice_number=CAN_PREFIX.$invoice_number;
    }else{
    	$invoice_number='CAN'.$invoice_number;
    }
    $db->update('customer_adjustment_notes',array('adjustment_number'=>$invoice_number),array('id'=>$last_id));*/

    if ($update){
        $event="Edit Customer adjustment note  (" . $can_details['adjustment_number'] . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
        				<button class="close" data-dismiss="alert" type="button">?</button>
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


                      <button class="btn btn-primary pull-right" type="submit" name="can_submit">Save</button>
                    </h3>
                  <div class="widget-container fluid-height clearfix">

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

										<input type="text" class="form-control" name="" value="<?php echo $customer_row['display_name'];?>" readonly>
										<input type="hidden" class="form-control" name="customer_id" value="<?php echo $customer_row['id'];?>">

                                       <!-- <select class="form-control" name="customer_id" id="customer_id" >
                                       <option value="">select</option>
                                       <?php
                                       		$all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
											if (is_array($all_customer)){
												foreach ($all_customer as $customer){ ?>
													<option value="<?php echo $customer['id'];?>" <?php if ($customer['id']==$customer_row['id']){echo 'selected';}?>><?php echo $customer['display_name'];?></option>
										<?php }} ?>
                                       </select> -->
                                    </div>
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
                                       <input class="form-control" placeholder="" type="text" name="reference_code" value="<?php echo "REF-CAN".rand(1,1000);?>">
                                    </div>
                                 </div>

                              </div>
                           </div>
                           <br>

<div class="row">
	<div class="row">
    <div class="col-md-1">Project<font color="red">*</font></div>
    <div class="col-md-1">Items<font color="red">*</font></div>
    <div class="col-md-1">Item Price</div>
    <div class="col-md-2">Description</div>
    <div class="col-md-1">Qty</div>
    <div class="col-md-1">Tax code</div>
    <div class="col-md-1">Tax</div>
    <div class="col-md-1">Amount</div>
     <div class="col-md-1"></div>
    </div>

<div class="input_fields_wrap_selling_estimate">
	<?php
	if (is_array($project_id)){
		foreach ($project_id as $key=>$projects){ ?>

  	<div class="row">
    <div class="col-md-1">
    	<select class="form-control" name="project[]" required>
    	<option value="">Select</option>
    		<?php if (is_array($customer_project)){
    				foreach ($customer_project as $projct){
    						$project_name=$db->get_var('projects',array('id'=>$projct['project_id']),project_name); ?>
    							<option value="<?php echo $projct['project_id'];?>" <?php if ($projct['project_id']==$projects){echo 'selected';}?>><?php echo $project_name;?></option>
    	<?php }}?></select>
    	</div>
    <div class="col-md-1">
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
    <div class="col-md-1"><input class="form-control" type="text" value="<?php echo $item_price[$key];?>" name="item_price[]"  id="it_prc<?php echo $key;?>" ></div>
    <div class="col-md-2"><input class="form-control" type="text" value="<?php echo $item_description[$key];?>" name="description[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" id="qty<?php echo $key;?>" value="<?php echo $item_qty[$key];?>" name="qty[]" value=""></div>
     <div class="col-md-1">

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
    <div class="col-md-1">
    	<input class="form-control" type="text" id="taxx<?php echo $key;?>" value="<?php echo $tax[$key];?>" name="tax[]" readonly>
    	<input class="form-control" type="hidden" id="taxx_perc<?php echo $key;?>" name="tax_percentage[]">
    </div>

    <div class="col-md-1">
    	<input class="form-control" type="text" id="item_total<?php echo $key;?>" value="<?php echo $amount[$key];?>" name="total[]" readonly>
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
			  var tax_code=res[1];
			  var tax_percent=res[2];
			  var tax_amount=(item_price*tax_percent)/100;

			  $("#it_prc"+item_id).val(item_price);
			  $("#tax_code"+item_id).val(tax_code);
			  $("#taxx_perc"+item_id).val(tax_percent);
			  $("#taxx"+item_id).val(tax_amount);
			  $("#item_total"+item_id).val(item_price);
			  $("#qty"+item_id).val('1');

			//var tx=parseInt(res[0])/parseInt(res[2]);
			var amt=parseFloat(tax_amount) + parseFloat(item_price);
			  $("#taxx"+item_id).val(tax_amount);
			  $("#amount"+item_id).val(amt);

				//----------- Sub Total /Total Tax/ Total amount --------
				var st=parseFloat(0);
				var tx=parseFloat(0);
				var n=<?php echo $total_projects;?>;
	            	for(var i=0; i<n; i++){
	    				//var stt=parseInt($("#amount"+i).val());
	            		var stt=parseFloat($("#item_total"+i).val());
	    				var txx=parseFloat($("#taxx"+i).val());
	    				if(isNaN(stt)){
  	    					stt=0;
  	    					txx=0;
  	    				}
						var st= st + stt;
						var tx= tx + txx;
	                }
	            	parseFloat($("#sub_total").html())
	                $("#sub_total").html(st);
	                $("#total_tax").html(tx);
	                var tot= st + tx;
	                $("#total_amt").html(tot);
		  }
	});
});


//--------- Calculate tax/ Total amount on change item price---------

$("#it_prc"+<?php echo $key;?>).keyup(function(){

    var item_qty=$('#qty'+<?php echo $key;?>).val();
	var item_price=$(this).val();
var amount=item_price*item_qty
var tax_percent=$("#taxx_perc"+<?php echo $key;?>).val();
var	tax_amount=(amount*tax_percent)/100;

	$("#taxx"+<?php echo $key;?>).val(tax_amount);
	$("#item_total"+<?php echo $key;?>).val(amount);


	   //----------- Sub Total /Total Tax/ Total amount --------
	var st=parseInt(0);
	var tx=parseFloat(0);
	var n=<?php echo $total_projects;?>;
    	for(var i=0; i<n; i++){
    		var stt=parseFloat($("#item_total"+i).val());
			var txx=parseFloat($("#taxx"+i).val());
			if(isNaN(stt)){
					stt=0;
					txx=0;
				}
			var st= st + stt;
			var tx= tx + txx;
        }

        $("#sub_total").html(st.toFixed(2));
        $("#total_tax").html(tx.toFixed(2));
        var tot= st + tx;
        $("#total_amt").html(tot.toFixed(2));


});
//--------- Calculate tax/ Total amount on change quantity---------
$("#qty"+<?php echo $key;?>).keyup(function(){
     var item_price=$('#it_prc'+<?php echo $key;?>).val();
	 var item_qty=$(this).val();

	var item_amount=item_price*item_qty
	$("#item_total"+<?php echo $key;?>).val(item_amount);

	var tax_percentage=$("#taxx_perc"+<?php echo $key;?>).val();
	var	tax_amount=(item_amount*tax_percentage)/100;
	var tax=$("#taxx"+<?php echo $key;?>).val(tax_amount);
//----------- Sub Total /Total Tax/ Total amount --------
	var st=parseInt(0);
	var tx=parseFloat(0);
	var n=<?php echo $total_projects;?>;
    	for(var i=0; i<n; i++){
    		var stt=parseFloat($("#item_total"+i).val());
			var txx=parseFloat($("#taxx"+i).val());
			if(isNaN(stt)){
					stt=0;
					txx=0;
				}
			var st= st + stt;
			var tx= tx + txx;
        }

        $("#sub_total").html(st.toFixed(2));
        $("#total_tax").html(tx.toFixed(2));
        var tot= st + tx;
        $("#total_amt").html(tot.toFixed(2));
});

//======*******------ Cross Button Calculate (Sub Total /Total Tax/ Total amount)----******=====
$("#remove_item"+<?php echo $key;?>).click(function(){
	var dd=$(this).attr('id');
	var res=dd.split("remove_item");
	var res_id=res[1];

	var tax=parseFloat($('#taxx'+res_id).val());
	var amount=parseFloat($('#item_total'+res_id).val());
	var sub_total=parseFloat($('#sub_total').html());
	var total_tax=parseFloat($('#total_tax').html());

	if(!isNaN(amount)){
		var new_sub_total=sub_total-amount;
		var new_tax=total_tax-tax;
		var new_total=new_sub_total+new_tax;

		$("#sub_total").html(new_sub_total.toFixed(2));
		$("#total_tax").html(new_tax.toFixed(2));
		$("#total_amt").html(new_total.toFixed(2));
	}
});

//--------- Calculate tax/ Total amount on change tax---------

$("#tax_code"+<?php echo $key;?>).change(function(){
	var tax_name=$(this).val();
	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'item_code_name='+tax_name,
		  success: function (data) {
              var item_total=$('#item_total'+<?php echo $key;?>).val();
              var tax_percent=data;
			  var tax_amount=(item_total*tax_percent)/100;

              $("#taxx_perc"+<?php echo $key;?>).val(tax_percent);
			  $("#taxx"+<?php echo $key;?>).val(tax_amount);

			  //----------- Sub Total /Total Tax/ Total amount --------
				var st=parseInt(0);
				var tx=parseFloat(0);
				var n=<?php echo $total_projects;?>;
	            	for(var i=0; i<n; i++){
	            		var stt=parseFloat($("#item_total"+i).val());
	    				var txx=parseFloat($("#taxx"+i).val());
	    				if(isNaN(stt)){
  	    					stt=0;
  	    					txx=0;
  	    				}
						var st= st + stt;
						var tx= tx + txx;
	                }

	                $("#sub_total").html(st.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	                var tot= st + tx;
	                $("#total_amt").html(tot.toFixed(2));
		  }
	});

});

</script>
<?php }} ?>

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
                                    <textarea class="form-control" rows="6" cols="200" placeholder="Note to Customer" name="notes"><?php echo $can_details['notes']?></textarea>
                                    </div>
                              </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="control-label col-md-8">Subtotal &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div class="sub_total" id="sub_total"><?php echo number_format($subtotal,2,'.',',');?></div>
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
                                          <div id="total_tax"><?php echo number_format($total_tax,2,'.',',');?></div>
                                       </div>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                       <label class="control-label col-md-8">Total &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div id="total_amt"><?php echo number_format($total_amount,2,'.',',');?></div>
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

    var x = <?php echo $total_projects-1;?>; //1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            	    '<div class="col-md-1"><select class="form-control" name="project[]" required><option value="">Select</option><?php if (is_array($customer_project)){foreach ($customer_project as $projct){$project_name=$db->get_var('projects',array('id'=>$projct['project_id']),project_name); ?><option value="<?php echo $projct['project_id'];?>" <?php if ($projct['project_id']==$projects){echo 'selected';}?>><?php echo $project_name;?></option><?php }}?></select></div>'+

            	    '<div class="col-md-1"><select id="'+x+'" class="form-control items_select'+x+'" name="item[]" required><option value="">Select</option><?php if (is_array($customer_item)){	foreach ($customer_item as $customer_items){?><option class="item_cost_<?php echo $customer_items['id'];?>" sell_price="<?php echo $customer_items['net_sell_item_price'];?>" value="<?php echo $customer_items['id'];?>"><?php echo $customer_items['item_name'];?></option><?php }} ?></select></div>'+

            	    '<div class="col-md-1"><input class="form-control" type="text" id="it_prc'+x+'" name="item_price[]" ></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="description[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" id="qty'+x+'" name="qty[]"></div>'+
            	    '<div class="col-md-1">'+
            	    '<select  class="form-control" id="tax_code'+x+'" name="tax_code[]" required>'+
            	    '<option value="">Select</option>'+
            	    <?php if (is_array($all_supply_item_tax)){foreach ($all_supply_item_tax as $tax_name){?>
            	    '<option  value="<?php echo $tax_name['tax_name'];?>"><?php echo $tax_name['tax_name'];?>@<?php echo $tax_name['tax_rate']?></option>'+
            	    <?php }} ?>
            	    '</select>'+
            	    '</div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" id="taxx'+x+'" name="tax[]" readonly><input class="form-control" type="hidden" id="taxx_perc'+x+'" name="tax1[]"></div>'+
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

	            	for(var i=0; i<=x; i++){
	            		var stt=parseFloat($("#item_total"+i).val());
	    				var txx=parseFloat($("#taxx"+i).val());
	    				if(isNaN(stt)){
  	    					stt=0;
  	    					txx=0;
  	    				}
						var st= st + stt;
						var tx= tx + txx;
	                }

	                $("#sub_total").html(st.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	                var tot= st + tx;
	                $("#total_amt").html(tot.toFixed(2));
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

	            	for(var i=0; i<=x; i++){
	            		var stt=parseFloat($("#item_total"+i).val());
	    				var txx=parseFloat($("#taxx"+i).val());
	    				if(isNaN(stt)){
  	    					stt=0;
  	    					txx=0;
  	    				}
						var st= st + stt;
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

  			            	for(var i=0; i<=x; i++){
  			            		var stt=parseFloat($("#item_total"+i).val());
  			    				var txx=parseFloat($("#taxx"+i).val());
  			    				if(isNaN(stt)){
  		  	    					stt=0;
  		  	    					txx=0;
  		  	    				}
  								var st= st + stt;
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

				var tax=parseFloat($('#taxx'+res_id).val());
				var amount=parseFloat($('#item_total'+res_id).val());
				var sub_total=parseFloat($('#sub_total').html());
				var total_tax=parseFloat($('#total_tax').html());

				if(!isNaN(amount)){
					var new_sub_total=sub_total-amount;
					var new_tax=total_tax-tax;
					var new_total=new_sub_total+new_tax;

					$("#sub_total").html(new_sub_total.toFixed(2));
					$("#total_tax").html(new_tax.toFixed(2));
					$("#total_amt").html(new_total.toFixed(2));
				}
            });


        }
    });

    $(wrapper).on("click",".remove_field_selling_estimate", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
        //x--;
    })
});





//----------- Send Customer Id To Header --------------
$("#customer_id").change(function(){
	var id=$(this).val();
	location.href=window.location.pathname+'?user=edit_selling_can&id='+id;
});
</script>
