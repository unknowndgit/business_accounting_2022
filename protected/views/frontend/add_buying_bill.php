


<?php

if (isset($_REQUEST['id'])){
  $id=$_REQUEST['id'];
  $supplier_row=$db->get_row('contacts',array('id'=>$id));
  $supplier_project=$db->get_col('assign_supplier_project',array('supplier'=>$id,'visibility_status'=>'active'),'project_id');
  $supplier_item=$db->run("select * from items where visibility_status='active' && (item_to='buy' || item_to='both')")->fetchall();
  $all_purchase_item_tax=$db->run("select * from tax where visibility_status='active' && what_trans_is_used='purchase'")->fetchall();


}
$bsf=BILL_START_FROM+1;
$bill_number=sprintf('%06u', $bsf);
if(!empty(BILL_PREFIX)){
    $bill_number=BILL_PREFIX.$bill_number;
}else{
    $bill_number='BILL'.$bill_number;
}

if (isset($_POST['add_buying_bill'])){

	//print_r($_POST);
    $supplier_id=$id;
    $bill_date=$_POST['bill_date'];
    $due_date=$_POST['due_date'];
    $bill_discount=$_POST['bill_discount'];
    $reference_code=$_POST['reference_code'];
    //$amounts=$_POST['amounts'];
    $status=$_POST['status'];

   /* add more k feilds    */
    $item_id=$_POST['item'];
    $tax_percentage=$_POST['tax_percentage'];
    $project_id=$_POST['project'];
    $item_price=$_POST['item_price'];
    $account=array();
    if (is_array($_POST['item']))
    {
        foreach ($_POST['item'] as $ac)
        {
            $acc_id=$db->get_var('items',array('id'=>$ac),'buy_item_account');
            array_push($account, $acc_id);
        }
    }
    $accounts=$account;
    $item_description=$_POST['description'];
    $item_qty=$_POST['qty'];
    //$discount=serialize($_POST['discount']);
    $taxcode=$_POST['tax_code'];
    $tax=$_POST['tax'];
    $amount=$_POST['total'];
    $visibility_status="active";
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $total_tax=array_sum($_POST['tax']);
    $subtotal=array_sum($_POST['total']);
    $total_amount=$total_tax+$subtotal;
    $notes=$_POST['notes'];

    $empt_fields = $fv->emptyfields(array('Supplier Name'=>$supplier_id,
        'Bill Date'=>$bill_date,
    ));

    if ($empt_fields)
    {
        $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }
    else{


        $insert=$db->insert("bills",array('supplier_id'=>$supplier_id,
                                        'bill_number'=>$bill_number,
                                        'bill_date'=>$bill_date,
                                        'due_date'=>$due_date,
                                     //   'bill_discount'=>$bill_discount,
                                        'reference_code'=>$reference_code,
                                        //'amounts'=>$amounts,
                                        'status'=>$status,
                                        'item_id'=>serialize($item_id),
                                        'project_id'=>serialize($project_id),
                                        'item_price'=>serialize($item_price),
                                        'item_description'=>serialize($item_description),
                                        'item_qty'=>serialize($item_qty),
                                        'account'=>serialize($accounts),
                                        //'discount'=>$discount,
                                        'taxcode'=>serialize($taxcode),
                                        'tax'=>serialize($tax),
                                        'amount'=>serialize($amount),
                                        'visibility_status'=>$visibility_status,
                                        'created_date'=>$created_date,
                                        'ip_address'=>$ip_address,
						        		'total_tax'=>$total_tax,
						        		'subtotal'=>$subtotal,
						        		'total_amount'=>$total_amount,
        								'notes'=>$notes,
        								'balance_remaining'=>$total_amount,
        								'payment_status'=>'unpaid',
        								'gst_registered'=>'yes',
        ));
      //  $db->debug();
        $last_id=$db->lastInsertId();


        $db->update('daytoday_report_settings',array('bill_start_from'=>$bsf),array('id'=>1));

       // $db->debug();

 		if ($insert){
 		    $event="Create Bill  (" . $bill_number . ")";
 		    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
 		        'event'=>$event,
 		        'created_date'=>date('Y-m-d'),
 		        'ip_address'=>$_SERVER['REMOTE_ADDR']

 		    ));


 		    $display_msg= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button>
 		            Save successfully.
                    		</div>';
 		    echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("buying_bills",user)."'
        	                },3000);</script>";

		}
 }
}
?>

<div class="row">
   <div class="col-lg-12">
      <div class="padded" >
       <?php echo $display_msg;?>
         <h3>BUYING</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
         <form action="#" class="form-horizontal" method="post">
             <input type="hidden" value="<?php if (BUYING_APPROVAL=="enabled"){echo"draft";}else {echo "approved";}?>" name="status">
            <div class="row">
               <div class="col-lg-12">
                  <h3>Bill &nbsp;&nbsp;&nbsp;<span class="label label-info">Status : Draft</span>
                   <a href="<?php echo $link->link('buying_bills',user);?>" class="btn btn-default pull-right">Back to List</a>

                   <a href="<?php echo $link->link('add_buying_bill',user);?>" class="btn btn-default pull-right">Cancel</a>
                     <button class="btn btn-primary pull-right " type="submit" name="add_buying_bill">Submit</button>

                  </h3>

                 <div class="widget-content padded">


                           <div class="row">
                          <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                 </div>
                                 <br>
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Supplier<font color="red">*</font></label>
                                    <div class="col-md-7">

                                       <select class="form-control" name="supplier_name_id" id=suppiler_id >
                                        <option value="">Select Supplier</option>
                                          <?php $all_suppliert_name=$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
                                 if (is_array($all_suppliert_name)){
                            foreach ($all_suppliert_name as $sn){?>

                                       <option <?php if($supplier_row['id']==$sn['id'])echo 'selected="selected"';?> value="<?php echo $sn['id']?>"><?php echo $sn['display_name'];?></option>
                                          <?php }}?>
                                       </select>
                                    </div>
                                    <div class="col-md-1"><a title="Add New Contact" class="text-danger btn" data-toggle="modal" href="#add_contact_modal"><i class="lnr lnr-plus-circle"></i></a></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3"></label>
                                    <div class="col-md-7">
                                       <p><?php echo $supplier_row['postal_address'];?>
                                       <?php //echo $supplier_row['postal_address_suburb'];?>
                                       <?php echo $supplier_row['postal_address_postcode'];?>
                                       </p>
                                    </div>
                                 </div>
                                 <br>
                              </div>
                              <div class="col-md-6">
                               <div class="form-group">
                                    <label class="control-label col-md-3">Bill number</label>
                                    <div class="col-md-7">
                                   <label class="control-label col-md-3"><?php echo $bill_number; ?></label>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3">
                                    Bill date<font color="red">*</font></label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="bill_date" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                       </div>
                                    </div>
                                 </div>

                                     <div class="form-group">
                                    <label class="control-label col-md-3">Due date</label>
                                    <div class="col-md-7">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="due_date" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                       </div>
                                    </div>
                                 </div>
                                   <!--   <div class="form-group">
                                    <label class="control-label col-md-3">Bill discount</label>
                                    <div class="col-md-7">
                                       <input class="form-control" placeholder="" type="text" name="bill_discount">
                                    </div>
                                 </div> -->
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Reference code</label>
                                    <div class="col-md-7">
                                       <input class="form-control" placeholder="" type="text" name="reference_code" value="<?php echo "REF-BILL".time();?>">
                                    </div>
                                 </div>
                                 <!-- <div class="form-group">
                                    <label class="control-label col-md-3">Amounts<font color="red">*</font></label>
                                    <div class="col-md-7">
                                       <select class="form-control" name="amounts" required>
                                          <option value="nontaxed">Nontaxed</option>
                                          <option value="gross">Gross(Tax inclusive)</option>
                                          <option value="net">Net(Tax Enclusive)</option>
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
    		<?php if (is_array($supplier_project)){
    				foreach ($supplier_project as $projct){
    						$project_name=$db->get_var('projects',array('id'=>$projct),'project_name'); ?>
    							<option value="<?php echo $projct;?>"><?php echo $project_name;?></option>
    	<?php }}?></select>
    </div>
    <div class="col-md-2">
    	<select class="form-control" name="item[]" id="itm_change" required><option value="">Select</option>
    		<?php
    			if (is_array($supplier_item)){
    				foreach ($supplier_item as $supplier_items){?>
						<option class="itm<?php echo $supplier_items['id'];?>" sell_prc="<?php echo $supplier_items['net_sell_item_price'];?>" tax_code="<?php echo $supplier_items['sell_item_tax_code'];?>" value="<?php echo $supplier_items['id'];?>"><?php echo $supplier_items['item_name'];?></option>
    		<?php }
    			}
    		?>
    	</select>
    </div>
    <div class="col-md-1"><input class="form-control" type="text" name="item_price[]"  id="it_prc1" reqiured=""></div>
    <div class="col-md-2"><input class="form-control" type="text" name="description[]"></div>
    <div class="col-md-1"><input class="form-control" type="text" id="qty" name="qty[] required"></div>

    <div class="col-md-1">
    <select class="form-control" id="tax_code" name="tax_code[] ">
    	<option value="">Select</option>
    		<?php
    			if (is_array($all_purchase_item_tax)){
    				foreach ($all_purchase_item_tax as $item_tax){?>
						<option value="<?php echo $item_tax['tax_name'];?>"><?php echo $item_tax['tax_name'];?> @ <?php echo $item_tax['tax_rate']?>%</option>
    		<?php }
    			}
    		?>
    	</select>
    </div>
    <div class="col-md-1">
    	<input class="form-control" type="text" id="taxx1" name="tax[]" readonly>
    	<input class="form-control" type="hidden" id="taxx_perc" name="tax_percentage[]">
    </div>

    <div class="col-md-1">
    	<input class="form-control" type="text" id="item_total1" name="total[]" readonly>
    	<!-- <input class="form-control" type="text" id="amount1" name="amount[]"> -->
    <div class="col-md-1"></div>
    </div>
<br>
</div>
</div>
<button class="btn btn-default add_field_button_selling_estimate">Add</button>


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
                                      <!--  <div class="form-group">
                                       <label class="control-label col-md-8">Total(excluding tax) &nbsp;&nbsp;&nbsp;<?php echo CURRENCY;?></label>
                                       <div class="col-md-1"></div>
                                       <div class="col-md-2">
                                          <div id="">0.00</div>
                                       </div>
                                    </div> -->

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
            	    '<div class="col-md-2"><select class="form-control" name="project[]" required><option value="">Select</option><?php if (is_array($supplier_project)){ foreach ($supplier_project as $projct){ $custom_proj=$db->get_row('projects',array('id'=>$projct)); ?><option value="<?php echo $custom_proj['id'];?>"><?php echo $custom_proj['project_name'];?></option><?php }}?></select></div>'+

            	    '<div class="col-md-2"><select id="'+x+'" class="form-control items_select'+x+'" name="item[]" required><option value="">Select</option><?php if (is_array($supplier_item)){	foreach ($supplier_item as $supplier_items){?><option class="item_cost_<?php echo $supplier_items['id'];?>" sell_price="<?php echo $supplier_items['net_sell_item_price'];?>" value="<?php echo $supplier_items['id'];?>"><?php echo $supplier_items['item_name'];?></option><?php }} ?></select></div>'+

            	    '<div class="col-md-1"><input class="form-control" type="text" id="it_prc'+x+'" name="item_price[]" required></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="description[]"></div>'+
            	    '<div class="col-md-1"><input class="form-control" type="text" id="qty'+x+'" name="qty[]" required></div>'+
            	    '<div class="col-md-1">'+
            	    '<select  class="form-control" id="tax_code'+x+'" name="tax_code[]" >'+
            	    '<option value="">Select</option>'+
            	    <?php if (is_array($all_purchase_item_tax)){foreach ($all_purchase_item_tax as $tax_name){?>
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
        			  data: 'buy_item_id='+idm,
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

            				var tx=parseInt(res[0])/parseInt(res[2]);
            				var amt=parseInt(tx) + parseInt(res[0]);
            			  $("#taxx"+item_id).val();
            			  $("#amount"+item_id).val();

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
            	var dd=$(this).attr('id');
	    		var res=dd.split("qty");
				var res_id=res[1];
				//alert(res[1]);

            	var itm_prc=$('#it_prc'+res_id).val();
            	var itm_qty=$(this).val();

            	var itms_price=itm_prc*itm_qty;
            	$("#item_total"+res_id).val(itms_price);

            	var tax_percentage=$("#taxx_perc"+x).val();
            	var	tax_amount=(itms_price*tax_percentage)/100;
            	var tax=$("#taxx"+res_id).val(tax_amount);
            	$("#amount"+res_id).val(parseFloat(itms_price) + parseFloat(tax_amount));

            	//----------- Sub Total /Total Tax/ Total amount --------
				var st=parseFloat(0);
				var tx=parseFloat(0);

				for(var i=1; i<=x; i++){
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

	                $("#sub_total").html(st.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	                var tot= st + tx;
	                $("#total_amt").html(tot.toFixed(2));
            });

	          //--------- Calculate tax/ Total amount on change item price---------

            $("#it_prc"+x).keyup(function(){
            	var dd=$(this).attr('id');
	    		var res=dd.split("it_prc");
				var res_id=res[1];

                var item_qty=$('#qty'+res_id).val();
            	var item_price=$(this).val();
            var amount=item_price*item_qty;
            var tax_percent=$("#taxx_perc"+res_id).val();
            var	tax_amount=(amount*tax_percent)/100;

            	$("#taxx"+res_id).val(tax_amount.toFixed(2));
            	$("#item_total"+res_id).val(amount.toFixed(2));


         	   //----------- Sub Total /Total Tax/ Total amount --------
				var st=parseFloat(0);
				var tx=parseFloat(0);

				for(var i=1; i<=x; i++){
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

	                $("#sub_total").html(st.toFixed(2));
	                $("#total_tax").html(tx.toFixed(2));
	                var tot= st + tx;
	                $("#total_amt").html(tot.toFixed(2));


            });



	          //--------- Calculate tax/ Total amount on change tax---------

            $("#tax_code"+x).change(function(){
            	var dd=$(this).attr('id');
	    		var res=dd.split("tax_code");
				var res_id=res[1];

            	var tax_name=$(this).val();
            	$.ajax({
            		  type: "POST",
            		  url: "<?php echo $link->link('ajax',frontend);?>",
            		  data: 'item_code_name='+tax_name,
            		  success: function (data) {
                          var item_total=$('#item_total'+x).val();
                          var tax_percent=data;
            			  var tax_amount=(item_total*tax_percent)/100;

                          $("#taxx_perc"+res_id).val(tax_percent);
            			  $("#taxx"+res_id).val(tax_amount.toFixed(2));

            			  //----------- Sub Total /Total Tax/ Total amount --------
  						var st=parseFloat(0);
  						var tx=parseFloat(0);

  						for(var i=1; i<=x; i++){
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



		//= = = = = == = * * * * * First Fields ** * *  * * *  ******+++++++++++++++



//---------------- To Change Item and get tax/tax code/qty/amount -------------------
$("#itm_change").change(function(){
	var itm=$(this).val();
	var sell_prc=$(".itm"+itm).attr('sell_prc');
	//$("#it_prc1").val(sell_prc);

		$.ajax({
			  type: "POST",
			  url: "<?php echo $link->link('ajax',frontend);?>",
			  data: 'buy_item_id='+itm,
			  success: function (data) {

				//  alert(data);
				  var res=data.split("__");
				  var lenth=res.length;

				  var item_price=res[0];
    			  var tax_code=res[1];
    			  var tax_percent=res[2];
    			  var tax_amount=(item_price*tax_percent)/100;

                  $("#it_prc1").val(item_price);
				  $("#tax_code").val(tax_code);
				  $("#taxx_perc").val(tax_percent);
				  $("#taxx1").val(tax_amount);
				  $("#item_total1").val(item_price);
				  $("#qty").val('1');



					var amt=parseInt(tax_amount) + parseInt(item_price);
				  $("#taxx1").val(tax_amount.toFixed(2));
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

//--------- Calculate tax/ Total amount on change quantity---------

$("#qty").keyup(function(){
	var item_price=$('#it_prc1').val();
	var item_qty=$(this).val();

	var item_amount=item_price*item_qty

	$("#item_total1").val(item_amount);

	var tax_percent=$("#taxx_perc").val();
    var	tax_amount=(item_amount*tax_percent)/100;

	$("#taxx1").val(tax_amount.toFixed(2));


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

	$("#taxx1").val(tax_amount.toFixed(2));
	$("#item_total1").val(amount.toFixed(2));


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
			  $("#taxx1").val(tax_amount.toFixed(2));

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



//----------- Send Supplier Id To Header --------------
$("#suppiler_id").change(function(){
	var id=$(this).val();
	location.href=window.location.pathname+'?user=add_buying_bill&id='+id;
});
</script>
