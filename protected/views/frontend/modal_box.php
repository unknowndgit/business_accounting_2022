
<?php     if (file_exists(SERVER_ROOT . '/protected/setting/frontend/assign_roles.php')) {

require SERVER_ROOT . '/protected/setting/frontend/assign_roles.php';
}
if (file_exists(SERVER_ROOT . '/protected/setting/frontend/common_data.php')) {

require SERVER_ROOT . '/protected/setting/frontend/common_data.php';
}?>


<!-- this is for add bank account transfer money
<a title="Add New Contact" class="text-danger " data-toggle="modal" href="#add_contact_modal"><i class="lnr lnr-plus-circle"></i>Add New Contact</a>
-->

<div class="modal fade" id="add_contact_modal" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">
                          Add Contact
                        </h4>
                      </div>
                      <div class="modal-body">
                      <div id="after_post_message_contact"></div>
     <form id="add_contact_form"  action="<?php echo $link->link('ajax',user);?>" method="post" class="form-horizontal">
      <input type="hidden" name="add_contact_form_submit" value="add_contact_form_submit">
<button class="btn btn-primary pull-right" type="submit" name="submit_contact">Submit </button>
                        <div class="form-group">
                           <label class="control-label col-md-3">Type of contact<font color="red">*</font></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input checked="" type="checkbox" name="contact_type[]" value="customer">
                              <span>Customer</span>
                              </label>
                              <label class="checkbox-inline">
                              <input id="supplier_fields" type="checkbox" name="contact_type[]" value="supplier"><span>Supplier</span>
                              </label>
                        <!--       <label class="checkbox-inline" id="label_super_fund_id">
                              <input id="super_fund_id" type="checkbox" name="contact_type[]" value="super fund"><span>Super Fund</span></label> -->
                       </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">This contact is</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input checked=""  type="radio" name="contact_is" value="business" id="business_id--">
                              <span> A business</span>
                              </label>
                              <label class="radio-inline">
                              <input  type="radio" name="contact_is" value="individual" id="individual_id--">
                              <span> An individual</span>
                              </label>
                           </div>
                        </div>


                        <div class="form-group" id="business_name_id">
                           <label class="control-label col-md-3">First name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="business_name" value="">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Last name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="display_name" value="">
                           </div>
                        </div>
                          <div class="form-group" >
                           <label class="control-label col-md-3">Company Name</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="company_name" value="">
                           </div>
                        </div>
                        <div class="form-group" id="branch_id">
                           <label class="control-label col-md-3">Branch</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="branch" value="">
                           </div>
                        </div>



                        <div class="form-group">
                           <label class="control-label col-md-3">Phone</label>
                           <div class="col-md-2">
                              <input class="form-control" placeholder="" type="text" name="phone_pre_code">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="phone_number">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Mobile</label>
                           <div class="col-md-2">
                              <input class="form-control" placeholder="" type="text" name="mobile_pre_code">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="mobile_number">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Fax</label>
                           <div class="col-md-2">
                              <input class="form-control" placeholder="" type="text" name="fax_pre_code">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="fax_number">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Email<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="name@address.com" type="text" name="email">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Website</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="www.name.com" type="text" name="website">
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-3">Office number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="office_number">
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-3">HP number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="hp_number">
                           </div>
                        </div>

               <br>

                        <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">
                               <label><strong>BILLING ADDRESS</strong></label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Address is</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input checked=""  name="postal_address_is" type="radio" value="national">
                              <span> National</span>
                              </label>
                              <label class="radio-inline">
                              <input name="postal_address_is" type="radio" value="international">
                              <span>International</span>
                              </label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Address</label>
                           <div class="col-md-7">
                              <textarea class="form-control" name="postal_address"></textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">City</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="postal_address_town">
                           </div>
                        </div>
                        <!-- <div class="form-group">
                           <label class="control-label col-md-3">Suburb</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="postal_address_suburb">
                           </div>
                        </div> -->
                        <div class="form-group">
                           <label class="control-label col-md-3">State</label>
                           <div class="col-md-7">
                                  <input class="form-control" placeholder="" type="text" name="postal_address_state">


                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Zip</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="Text" type="text" name="postal_address_postcode">

                           </div>
                        </div>

            </form>
                      </div>

                    </div>
                  </div>
                </div>





<!-- this is for add item
<a title="Add New Item" class="text-danger " data-toggle="modal" href="#add_item_modal"><i class="lnr lnr-plus-circle"></i>Add New Item</a>
-->

<div class="modal fade" id="add_item_modal" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">
                          Add Items
                        </h4>
                      </div>
                      <div class="modal-body">
                      <div id="after_post_message_item"></div>

<form id="add_item_form" action="<?php echo $link->link('ajax',user);?>" class="form-horizontal" method="post">
<input type="hidden" name="add_item_form_submit" value="add_item_form_submit">
     <input type="hidden" name="item_to" value="both">
     <input type="hidden" name="item_status" value="active">
    <h3>Add item  <button class="btn btn-primary pull-right" type="submit" name="submit_item">Submit </button> </h3>
                <div class="form-group">
                                 <label class="control-label col-md-4">Name<font color="red">*</font></label>
                                 <div class="col-md-7">
                                    <input class="form-control" name="item_name" type="text" >
                                 </div>
                              </div>

                        <div class="form-group">
                           <label class="control-label col-md-4">Type<font color="red">*</font></label>
                           <div class="col-md-7">
                              <select class="form-control" name="item_type" >
                                 <option value="Product">Product</option>
                                 <option value="Service">Service</option>
                              </select>
                           </div>
                        </div>
 <div class="row">

                           <div class="col-lg-12">



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
                                    <input class="form-control" name="sell_item_price" type="text" id="sell_price">
                                 </div>
                              </div>
                               <div class="form-group">
					            <label class="control-label col-md-4">Income Account for tracking Sales<font color="red">*</font></label>
					            <div class="col-md-7">
					              <select class="form-control" name="sell_item_account" >
					              <option value="">Select Account</option>
							 	<?php
						           	$all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
	                                     		if (is_array($all_accounts)){
													foreach ($all_accounts as $all_account){ ?>
														<option value="<?php echo $all_account['id']?>"><?php echo $all_account['account_name'];?></option>
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
														<option value="<?php echo $taxs['id']?>"><?php echo $taxs['tax_name'].' - '.$taxs['tax_description']?></option>
											<?php   }
	                                     		}
	                                     	?>
                                     </select>
                                 </div>
                              </div>

                           		<br><br><br>

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
	                                    <input class="form-control" name="buy_item_price" type="text" id="buy_price">
	                                 </div>
	                              </div>
	                               <div class="form-group">
						            <label class="control-label col-md-4">Cost of Sales Account<font color="red">*</font></label>
						            <div class="col-md-7">
						              <select class="form-control" name="buy_item_account">
						           	   <option value="">Select Account</option>
							 	<?php
						           	$all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
	                                     		if (is_array($all_accounts)){
													foreach ($all_accounts as $all_account){ ?>
														<option value="<?php echo $all_account['id']?>"><?php echo $all_account['account_name'];?></option>
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
														<option value="<?php echo $taxb['id']?>"><?php echo $taxb['tax_name'].' - '.$taxb['tax_description']?></option>
											<?php   }
	                                     		}
	                                     	?>
	                                       </select>
	                                 </div>
	                              </div>


                        </div>
                        </div>


                     </form>
                      </div>

                    </div>
                  </div>
                </div>







<!-- this is for add Project

<a title="Add New Project" class="text-danger " data-toggle="modal" href="#add_project"><i class="lnr lnr-plus-circle"></i>Add New Project</a>


-->
<div class="modal fade" id="add_project" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">
                        Add Project
                        </h4>
                        <div id="after_post_message_project"></div>

                      </div>
                      <div class="modal-body">
         <form id="add_project_form"  action="<?php echo $link->link('ajax',user);?>" method="post" class="form-horizontal">
                <input type="hidden" name="add_project_form_submit" value="add_project_form_submit">
                 <div class="row">
               <div class="col-lg-12">
               <h3>Add project &nbsp;&nbsp;&nbsp;<span class="label label-info">Status : Active</span></h3>
      <div class="form-group">
                              <label>Project name<font color="red">*</font></label>
                            <input class="form-control" placeholder="" type="text" name="project_name" >
                            </div>
                            	<div class="form-group">
                              <label>Start date</label>
                             <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="start_date" value="<?php echo date("d-m-Y");?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                      </div>
                            </div>
                              <div class="form-group">
                              <label>Status</label>
                             <select class="form-control" name="visibility_status">
                                 <option value="active">Active</option>
                                 <option value="inactive">Inactive</option>
                              </select>
                            </div>
                             <div class="form-group">
                              <label>End date</label>
                             <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="end_date"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                      </div>
                            </div>
                            <div class="form-group">
                              <label>Description</label>
                            <input class="form-control" placeholder="" type="text" name="description">
                            </div>



                      <div class="row">
             <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">

                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Customers</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>Suppliers</span></a>
                      </li>
                    <!--   <li>
                        <a data-toggle="tab" href="#tab3"><i class="fa fa-paper-clip"></i><span>Items</span></a>
                      </li> -->
                    </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                       <p>
                      Assigning customers to a project allows the costs of the project to be shared between them. <br>
                      You do not have to assign customers to a project.
                      </p>
             <div class="row">
<div class="form-group">
            <label class="control-label col-md-4">Multi-Select</label>
            <div class="col-md-8">
              <select class="form-control" multiple="" name="customer">
              <?php $all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
              if (is_array($all_customer)){
                  foreach ($all_customer as $all_c)
                  {?>
                      <option value="<?php echo $all_c['id']?>"><?php echo $all_c['display_name'];?></option>
                  <?php }}?>
        </select>
            </div>
          </div>
</div>
                    </div>
                    <div class="tab-pane" id="tab2">
                         <p>
                    Assigning suppliers to a project allows you to track suppliers in the project.<br>
You do not have to assign suppliers to a project.
                      </p>
                                         <div class="row">
<div class="form-group">
            <label class="control-label col-md-4">Multi-Select</label>
            <div class="col-md-8">
              <select class="form-control" multiple="" name="supplier">
               <?php $all_supplier=$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
              if (is_array($all_supplier)){
                  foreach ($all_supplier as $alls)
                  {?>
                      <option value="<?php echo $alls['id']?>"><?php echo $alls['display_name'];?></option>
                  <?php }}?>
              </select>
            </div>
          </div>
</div>
                    </div>
                 <!--    <div class="tab-pane" id="tab3">
                     <p>
                   Assigning items to a project means they will appear at the top of the item list when entering transactions.<br>
It also allows you to customise the sale rate for this particular project.
                      </p>
                      <div class="row">


			    <div class="row">

<div class="form-group">
            <label class="control-label col-md-4">Multi-Select</label>
            <div class="col-md-8">
              <select class="form-control" multiple="" name="items[]">
              <?php $all_items=$db->get_all('items',array('visibility_status'=>'active'));
              if (is_array($all_items)){
                  foreach ($all_items as $alli)
                  {?>
                      <option value="<?php echo $alli['id']?>"><?php echo $alli['item_name']."--(".$alli['item_type'].")";?></option>
                  <?php }}?>
              </select>
            </div>
          </div>
    </div>


</div>
                    </div> -->
                  </div>
                </div>
                 <button class="btn btn-primary btn-block" type="submit" name="add_project_submit"> Submit </button>
              </div>
            </div>


             </div>
           </div>
            </form>
                      </div>

                    </div>
                  </div>
                </div>

<!-- this is for add Bank Account
<a title="Add Bank Account" class="text-danger " data-toggle="modal" href="#add_bank_account"><i class="lnr lnr-plus-circle"></i>Add New Bank Account</a>-->
<div class="modal fade" id="add_bank_account" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog" >
                    <div class="modal-content" >
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">
                        Add Bank Account
                        </h4>
                      </div>
                      <div class="modal-body">
                      <div id="after_post_message_bank"></div>
                <form id="add_bank_account_form"  action="<?php echo $link->link('ajax',user);?>" method="post" class="form-horizontal">
                <input type="hidden" name="add_bank_account_form_submit" value="add_bank_account_form_submit">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group">
                           <label class="control-label col-md-4">Account display name <font color="red">*</font></label>
                        <div class="col-md-8">
                              <input class="form-control" placeholder="" type="text" name="account_name" value="">
                              <span>The account display name must be unique within this book</span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Account type</label>
                           <div class="col-md-8">
                              <label class="radio-inline">
                              <input checked="" type="radio" name="account_nature" id="bank_account" value="assets">
                              <span> Bank account (asset)</span>
                              </label>
                              <label class="radio-inline">
                              <input  type="radio" name="account_nature" value="liabilities"  id="credit_account" >
                              <span>Credit account (liability)</span>
                              </label>
                           </div>
                        </div>

                          <div class="form-group">
                                    <label class="control-label col-md-4">Date account opened
                                    </label>
                                    <div class="col-md-8">
                                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                          <input class="form-control" type="text" name="account_opening_date" value="<?php echo date('d-m-Y'); ?>">
                                          <span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                       </div>
                                        <span>Leave blank if opened before 7 January 2012</span>
                                    </div>
                                 </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Opening balance</label>
                           <div class="col-md-8">
                              <input class="form-control" placeholder="00.00" type="text" name="opening_balance" value="">
                                <span>As at 7 January 2012</span>
                           </div>

                        </div>
                         <button class="btn btn-primary btn-block" name="submit">Submit</button>


                     </div>


               </div>


         </form>
                    </div>
                  </div>
                </div>
                </div>


<script>
/************************add_bank_account_form***********************************************/
$("#add_bank_account_form").submit(function(e)
		{
            var postData = $(this).serializeArray();
		    var formURL = $(this).attr("action");

		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        dataType: 'json',
		        success:function(data, textStatus, jqXHR)
		        {
			      $("#after_post_message").html(data.msg);
		        	 if(data.error==false){
		        	  setTimeout(function(){
		        		  $('#add_project').modal('toggle');
		        		  window.location='<?php echo $link->link($query1ans,user);?>';
			                },6000);
		        	 //  var url = '<?php echo $link->link($query1ans,user);?>';
			  	     //   $('#div1-wrapper').load(url + ' #div1');
				  	  //    $('#divaba-wrapper').load(url + ' #div_aba');

			  	        }
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});

/************************add_project_form***********************************************/
$("#add_project_form").submit(function(e)
		{
            var postData = $(this).serializeArray();
		    var formURL = $(this).attr("action");

		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        dataType: 'json',
		        success:function(data, textStatus, jqXHR)
		        {
			      $("#after_post_message_project").html(data.msg);
		        	 if(data.error==false){
		        	  setTimeout(function(){
		        		  $('#add_project').modal('toggle');
		        		  window.location='<?php echo $link->link($query1ans,user);?>';
			                },6000);
		        	 //  var url = '<?php echo $link->link($query1ans,user);?>';
			  	     //   $('#div1-wrapper').load(url + ' #div1');
				  	  //    $('#divaba-wrapper').load(url + ' #div_aba');

			  	        }
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});
/************************add_item_form***********************************************/
$("#add_item_form").submit(function(e)
		{
            var postData = $(this).serializeArray();
		    var formURL = $(this).attr("action");

		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        dataType: 'json',
		        success:function(data, textStatus, jqXHR)
		        {
			      $("#after_post_message_item").html(data.msg);
		        	 if(data.error==false){
		        	  setTimeout(function(){
		        		  $('#add_item_modal').modal('toggle');
		        		  window.location='<?php echo $link->link($query1ans,user);?>';
			                },3000);
                   }
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});
/************************add_contact form***********************************************/
$("#add_contact_form").submit(function(e)
		{
            var postData = $(this).serializeArray();
		    var formURL = $(this).attr("action");

		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        dataType: 'json',
		        success:function(data, textStatus, jqXHR)
		        {
			      $("#after_post_message_contact").html(data.msg);
		        	 if(data.error==false){
		        	  setTimeout(function(){
		        		  $('#add_contact_modal').modal('toggle');
		        		  window.location='<?php echo $link->link($query1ans,user);?>';
			                },3000);
                   }
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});
</script>




