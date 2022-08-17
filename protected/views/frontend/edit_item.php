<?php

if (isset($_REQUEST['action_edit'])){
 $item_id=$_REQUEST['action_edit'];
    $item_detail=$db->get_row('items',array('id'=>$item_id));
    //print_r($contact_detail);
}
if (isset($_REQUEST['item_to'])){
 $item_to=$_REQUEST['item_to'];
}
if (isset($_POST['submit_item'])){

	//print_r($_POST);
	//$item_name=$_POST['item_name'];
	$item_code=$_POST['item_code'];
	//$sub_item=$_POST['sub_item'];
	$item_status=$_POST['item_status'];
	 $item_type=$_POST['item_type'];
	//$item_tax=$_POST['item_tax'];
	$item_to=$_POST['item_to'];

	$sell_item_price=$_POST['sell_item_price'];
	$sell_item_account=$_POST['sell_item_account'];
	$sell_item_tax_code=$_POST['sell_item_tax_code'];
	$sell_item_description=$_POST['sell_item_description'];

	$buy_item_price=$_POST['buy_item_price'];
	$buy_item_account=$_POST['buy_item_account'];
	$buy_item_tax_code=$_POST['buy_item_tax_code'];
	$buy_item_description=$_POST['buy_item_description'];

	$date=date('Y-m-d');
	$ip=$_SERVER['REMOTE_ADDR'];
	$pattern = '/^(?:0|[0-9]\d*)(?:\.\d{2})?$/';
	if (empty($item_to)){
		$display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Alert! please select this item we.</strong></div>';
	}
	else{

	    if ($item_to=='sell'){

	        $empt_fields = $fv->emptyfields(array('Account for tracking Sales'=>$sell_item_account));

	        if ($empt_fields)
	        {
	            $display_message= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
	        }
	     elseif (preg_match($pattern, $sell_item_price) == '0'){
	            $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Price must be numeric.</strong></div>';
	        }
	        else{

	           if(empty($sell_item_price)){ $sell_item_price='0'; }
		   if (empty($buy_item_price)){ $buy_item_price='0'; };

		$update=$db->update('items',array(//'item_name'=>$item_name,
				'item_code'=>$item_code,
				'visibility_status'=>$item_status,
				'item_type'=>$item_type,
				'item_to'=>$item_to,
			  'sell_item_account'=>$sell_item_account,
				'sell_item_tax_code'=>$sell_item_tax_code,
				'sell_item_description'=>$sell_item_description,
			    'create_date'=>$date,
				'ip_address'=>$ip,
				'selling_price'=>$sell_item_price),array('id'=>$item_id));
	            //$db->debug();

	            if ($update){
	                $display_message= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Item is updated Successfully.
                		</div>';
	                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("item",user)."'
        	                },3000);</script>";


	            }


	    }
	    }
	    elseif ($item_to=='buy'){

	        $empt_fields = $fv->emptyfields(array('Cost of Sales Account'=>$buy_item_account));

	        if ($empt_fields)
	        {
	            $display_message= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
	        }
	     elseif (preg_match($pattern, $buy_item_price) == '0'){
	            $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Price must be numeric.</strong></div>';
	        }
	        else{

	            if(empty($sell_item_price)){ $sell_item_price='0'; }
	            if (empty($buy_item_price)){ $buy_item_price='0'; };

	            $update=$db->update('items',array(//'item_name'=>$item_name,
	                'item_code'=>$item_code,
	                'visibility_status'=>$item_status,
	                'item_type'=>$item_type,
	                'item_to'=>$item_to,
	                 'buy_item_account'=>$buy_item_account,
				'buy_item_tax_code'=>$buy_item_tax_code,
				'buy_item_description'=>$buy_item_description,
	                'create_date'=>$date,
	                'ip_address'=>$ip,
	               	'buying_price'=>$buy_item_price),array('id'=>$item_id));
	            //$db->debug();

	            if ($update){
	                $display_message= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Item is updated Successfully.
                		</div>';
	                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("item",user)."'
        	                },3000);</script>";


	            }


	        }
	    }
	    elseif ($item_to=='both'){

	        $empt_fields = $fv->emptyfields(array('Cost of Sales Account'=>$buy_item_account,'Account for tracking Sales'=>$sell_item_account));

	        if ($empt_fields)
	        {
	            $display_message= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
	        }
	      elseif (preg_match($pattern, $sell_item_price) == '0'){
	            $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Price must be numeric.</strong></div>';
	        }
	        elseif (preg_match($pattern, $buy_item_price) == '0'){
	            $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Price must be numeric.</strong></div>';
	        }
	        else{

	            if(empty($sell_item_price)){ $sell_item_price='0'; }
	            if (empty($buy_item_price)){ $buy_item_price='0'; };

	           $update=$db->update('items',array(//'item_name'=>$item_name,
				'item_code'=>$item_code,
				//'sub_item'=>$sub_item,
				 'visibility_status'=>$item_status,
				'item_type'=>$item_type,
				//'item_tax'=>$item_tax,
				 'item_to'=>$item_to,
			//	'net_sell_item_price'=>$net_sell_item_price,
				// 'gross_sell_item_price'=>$gross_sell_item_price,
				 'sell_item_account'=>$sell_item_account,
				'sell_item_tax_code'=>$sell_item_tax_code,
				'sell_item_description'=>$sell_item_description,
			//	'net_buy_item_price'=>$net_buy_item_price,
				// 'gross_buy_item_price'=>$gross_buy_item_price,
				 'buy_item_account'=>$buy_item_account,
				'buy_item_tax_code'=>$buy_item_tax_code,
				'buy_item_description'=>$buy_item_description,
				'create_date'=>$date,
				'ip_address'=>$ip,
				'selling_price'=>$sell_item_price,
				'buying_price'=>$buy_item_price),array('id'=>$item_id));
	            //$db->debug();

	            if ($update){

	                $item_name=$item_detail['item_name'];
	                $event="Edit item (" . $item_name . ")";
	                $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	                    'event'=>$event,
	                    'created_date'=>date('Y-m-d'),
	                    'ip_address'=>$_SERVER['REMOTE_ADDR']

	                ));
	                $display_message= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Item is updated Successfully.
                		</div>';
	                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("item",user)."'
        	                },3000);</script>";


	            }


	        }
	    }
	/*	if ($item_to=='sell'){
			$tax=$db->get_row('tax',array('id'=>$sell_item_tax_code));
			if ($item_tax=='Yes'){
				$pr=$sell_item_price-($sell_item_price/$tax['tax_rate']);
				$net_sell_item_price = $pr;
				$gross_sell_item_price = $sell_item_price;
			}
			if ($item_tax=='No'){
				$net_sell_item_price = $sell_item_price;
				$gross_sell_item_price = $sell_item_price+($sell_item_price/$tax['tax_rate']);
				//echo "<script>alert('hello');</script>";
			}
		}
		if ($item_to=='buy'){
			$tax1=$db->get_row('tax',array('id'=>$buy_item_tax_code));
			if ($item_tax=='Yes'){
				$net_buy_item_price = $buy_item_price-($buy_item_price/$tax1['tax_rate']);
				$gross_buy_item_price = $buy_item_price;
			}
			if ($item_tax=='No'){
				$net_buy_item_price = $buy_item_price;
				$gross_buy_item_price = $buy_item_price+($buy_item_price/$tax1['tax_rate']);
			}
		}
		if ($item_to=='both'){
			$tax=$db->get_row('tax',array('id'=>$sell_item_tax_code));
			$tax1=$db->get_row('tax',array('id'=>$buy_item_tax_code));
			if ($item_tax=='Yes'){
				$net_sell_item_price = $sell_item_price-($sell_item_price/$tax['tax_rate']);
				$gross_sell_item_price = $sell_item_price;
				$net_buy_item_price = $buy_item_price-($buy_item_price/$tax1['tax_rate']);
				$gross_buy_item_price = $buy_item_price;
			}
			if ($item_tax=='No'){
				$net_sell_item_price = $sell_item_price;
				$gross_sell_item_price = $sell_item_price+($sell_item_price/$tax['tax_rate']);
				$net_buy_item_price = $buy_item_price;
				$gross_buy_item_price = $buy_item_price+($buy_item_price/$tax1['tax_rate']);
			}
		}*/

	}
}

?>

<style>
a:hover {
    color: #eee;
}
.panel-title>a {
    color: white;
}
</style>

<div class="row">
   <div class="col-lg-12">
      <div class=" padded" >
         <h3>ITEMS</h3>
      </div>
      <?php echo $display_message;?>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
                <form action="" class="form-horizontal" method="post">
                 <div class="row">
               <div class="col-lg-12">
               <h3>Edit item
                  <a href="<?php echo $link->link('item',user);?>" class="btn btn-default pull-right">Back to List</a>
                 <a href="<?php echo $link->link('edit_item',user,'&action_edit='.$item_id.'&item_to='.$item_to);?>" class="btn btn-default pull-right">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit" name="submit_item">Submit </button>
              </h3>
                  <div class="widget-content padded">
                        <div class="row">
                           <div class="col-lg-6">
                           <div class="form-group">
                                 <label class="control-label col-md-4">Name<font color="red">*</font></label>
                                 <div class="col-md-7">
                                    <input class="form-control" name="item_name" type="text" value="<?php echo $item_detail['item_name'];?>" disabled>
                                 </div>
                              </div>
                                <div class="form-group">
                                 <label class="control-label col-md-4">Code</label>
                                 <div class="col-md-7">
                                    <input class="form-control" name="item_code" type="text" value="<?php echo $item_detail['item_code'];?>">
                                 </div>
                              </div>
                           <!--     <div class="form-group">
					            <label class="control-label col-md-4">Sub-item of</label>
					            <div class="col-md-7">
					              <select class="form-control" name="sub_item">
					              	<option>Assets</option>
					              	<option>Current Assets</option>
					              	<option>Current Financial Assets</option>
					              	<option></option>
					              </select>
					            </div>
					        </div> -->

                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                           <label class="control-label col-md-4">Status</label>
                           <div class="col-md-7">
                              <select class="form-control" name="item_status">
                                 <option <?php if ($item_detail['item_status']=='active'){echo 'selected';}?> value="active">Active</option>
                                 <option <?php if ($item_detail['item_status']=='inactive'){echo 'selected';}?> value="inactive">Inactive</option>
                              </select>
                           </div>
                        </div>
                          <div class="form-group">
                           <label class="control-label col-md-4">Type<font color="red">*</font></label>
                           <div class="col-md-7">
                              <select class="form-control" name="item_type" >
                                 <option <?php if ($item_detail['item_type']=='Product'){echo 'selected';}?> value="Product">Product</option>
                                 <option <?php if ($item_detail['item_type']=='Service'){echo 'selected';}?> value="Service">Service</option>
                              </select>
                           </div>
                        </div>
                           <!--  <div class="form-group">
                           <label class="control-label col-md-4">Amounts include tax?</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              	<input name="item_tax" type="radio" value="Yes" id="include_tax">
                              <span> Yes</span>
                              </label>
                              <label class="radio-inline">
                              	<input  checked=""  name="item_tax" type="radio" value="No" id="exclude_tax">
                              <span> No</span>
                              </label>
                           </div>
                        </div> -->
                           </div>
                        </div>
                     </div>
                        <br>
            <div class="row">
              <div class="col-lg-12">
                <div class="widget-container fluid-height">

                  <div class="widget-content">
                    <div class="panel-group" id="accordion">
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne" style="background-color: black;">
                              <div class="caret pull-right"></div>
                             $ BUYING AND SELLING</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse in" id="collapseOne">
                          <div class="panel-body">

                     <div class="row">

                           <div class="col-lg-6">
                              <div class="form-group">
					            <label class="control-label col-md-4">This is an item we<font color="red">*</font></label>
					            <div class="col-md-7">
					              <select class="form-control" name="item_to" id="item_to">
					              	<option value="">Select</option>
					              	<option <?php if ($item_to=='sell'){echo 'selected';}?> value="sell">Sell</option>
					              	<option <?php if ($item_to=='buy'){echo 'selected';}?> value="buy">Buys</option>
					              	<option <?php if ($item_to=='both'){echo 'selected';}?> value="both">Sell and Buys</option>
					              </select>
					            </div>
					        </div>
   <?php if($item_to=='sell' ||$item_to=='both'){?>
   <div class="form-group">
					               <label class="control-label col-md-4"></label>
                                    <div class="col-md-7">
                                           <label><strong>IT WILL BE SOLD FOR</strong></label>
                                        </div>
                                      </div>
					         <div class="form-group">
                                 <label class="control-label col-md-4" id="sell_net">Price per unit (net)</label>
                                 <label class="control-label col-md-4" style="display:none;" id="sell_grs">Price per unit (gross)</label>
                                 <div class="col-md-7">
                                    <input class="form-control" name="sell_item_price" type="text" id="sell_price" value="<?php echo $item_detail['selling_price'];?>">
                                 </div>
                              </div>
                               <div class="form-group">
					            <label class="control-label col-md-4">Income Account for tracking Sales<font color="red">*</font></label>
					            <div class="col-md-7">
					              <select class="form-control" name="sell_item_account" >
					              <option value="">Select Account</option>
							 	<?php
						           	$aaftr=Asset_Account_for_Tracking_Receivables;
							 	$lafir=Liability_Account_for_Item_Receipts;
							 	$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='income' AND `account_type`!='bank' AND  `id`!='$aaftr' AND  `id`!='$lafir'";
							 	$all_accounts=$db->run($sql)->fetchAll();
	                                     		if (is_array($all_accounts)){
													foreach ($all_accounts as $all_account){ ?>
														<option <?php if ($item_detail['sell_item_account']==$all_account['id']){echo 'selected';}?> value="<?php echo $all_account['id']?>"><?php echo $all_account['account_name'];?></option>
											<?php   }
	                                     		}
	                                     	?>
					              </select>
					            </div>
					        </div>
                           <div class="form-group">
                                 <label class="control-label col-md-4">Tax code</label>
                                 <div class="col-md-7">
                                     <select class="form-control" name="sell_item_tax_code">
                                      <option value="">Select Account</option>
                                  		<?php
                                  		$all_tax_supply=$db->get_all('tax',array('what_trans_is_used'=>'supply'));
	                                     		if (is_array($all_tax_supply)){
													foreach ($all_tax_supply as $taxs){ ?>
														<option <?php if ($item_detail['sell_item_tax_code']==$taxs['id']){echo 'selected';}?> value="<?php echo $taxs['id']?>"><?php echo $taxs['tax_name'].' - '.$taxs['tax_description']?></option>
											<?php   }
	                                     		}
	                                     	?>
                                     </select>
                                 </div>
                              </div>
                              	     <div class="form-group">
                                        <label class="control-label col-md-4">Description</label>
                                        <div class="col-md-7">
                                          <textarea class="form-control" rows="5" name="sell_item_description"><?php echo $item_detail['sell_item_description'];?></textarea>
                                        </div>
                                      </div>

                            <?php }?>
                            </div>
                           <div class="col-md-6">
                           		<br><br><br>
                           			<?php if($item_to=='buy' ||$item_to=='both'){?>

                           <div class="form-group">
						               <label class="control-label col-md-4"></label>
	                                    <div class="col-md-7">
	                                           <label><strong>IT WILL BE BUY FOR</strong></label>
	                                        </div>
	                                      </div>
						         <div class="form-group">
	                                 <label class="control-label col-md-4" id="buy_net">Price per unit (net)</label>
	                                 <label class="control-label col-md-4" style="display:none;" id="buy_grs">Price per unit (gross)</label>
	                                 <div class="col-md-7">
	                                    <input class="form-control" name="buy_item_price" type="text" id="buy_price" value="<?php echo $item_detail['buying_price'];?>">
	                                 </div>
	                              </div>
	                               <div class="form-group">
						            <label class="control-label col-md-4">Cost of Sales Account<font color="red">*</font></label>
						            <div class="col-md-7">
						              <select class="form-control" name="buy_item_account">
						           	   <option value="">Select Account</option>
							 	<?php
						           $aaftr=Asset_Account_for_Tracking_Receivables;
							 	$lafir=Liability_Account_for_Item_Receipts;
							 	$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='expense' AND `account_type`!='bank' AND  `id`!='$aaftr' AND  `id`!='$lafir'";
							 	$all_accounts=$db->run($sql)->fetchAll();
	                                     		if (is_array($all_accounts)){
													foreach ($all_accounts as $all_account){ ?>
														<option <?php if ($item_detail['buy_item_account']==$all_account['id']){echo 'selected';}?> value="<?php echo $all_account['id']?>"><?php echo $all_account['account_name'];?></option>
											<?php   }
	                                     		}
	                                     	?>
						              </select>
						            </div>
						        </div>
	                           <div class="form-group">
	                                 <label class="control-label col-md-4">Tax code</label>
	                                 <div class="col-md-7">
	                                     <select class="form-control" name="buy_item_tax_code">
	                                      <option value="">Select Account</option>
	                                     	<?php
	                                     	$all_tax_purchase=$db->get_all('tax',array('what_trans_is_used'=>'purchase'));
	                                     		if (is_array($all_tax_purchase)){
													foreach ($all_tax_purchase as $taxb){ ?>
														<option <?php if ($item_detail['buy_item_tax_code']==$taxb['id']){echo 'selected';}?> value="<?php echo $taxb['id']?>"><?php echo $taxb['tax_name'].' - '.$taxb['tax_description']?></option>
											<?php   }
	                                     		}
	                                     	?>
	                                       </select>
	                                 </div>
	                              </div>
	                              	     <div class="form-group">
	                                        <label class="control-label col-md-4">Description</label>
	                                        <div class="col-md-7">
	                                          <textarea class="form-control" rows="5" name="buy_item_description"><?php echo $item_detail['buy_item_description'];?></textarea>
	                                        </div>
	                                   </div>

	                          <?php }?>
                        </div>
                        </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div></div>
            </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>


<script>

$("#item_to").change(function(){
	var item_to=$(this).val();
	location.href=window.location.pathname+'?user=edit_item&action_edit='+<?php echo $item_id;?>+'&item_to='+item_to;
});

$("#include_tax").click(function(){
	$("#sell_net").hide();
	$("#sell_grs").show();
	$("#buy_net").hide();
	$("#buy_grs").show();
});
$("#exclude_tax").click(function(){
	$("#sell_net").show();
	$("#sell_grs").hide();
	$("#buy_net").show();
	$("#buy_grs").hide();
});

</script>