<?php
$all =$db->get_row('daytoday_report_settings',array('id'=>1));
if (isset($_POST['daytoday_selling_submit']))
{
	//print_r($_POST);
    $selling_approval=$_POST['selling_approval'];
    $estimate_prefix=$_POST['estimate_prefix'];
    $estimate_expiry=$_POST['estimate_expiry'];

    $estimate_term_condition=$_POST['estimate_term_condition'];
    $estimate_payment_notes=$_POST['estimate_payment_notes'];
    $invoice_prefix=$_POST['invoice_prefix'];
    $invoice_payment_details=$_POST['invoice_payment_details'];
    $can_prefix=$_POST['can_prefix'];



    $update=$db->update('daytoday_report_settings',array('selling_approval'=>$selling_approval,
                                        'estimate_prefix'=>$estimate_prefix,
                                        'estimate_expiry'=>$estimate_expiry,
                                        'estimate_term_condition'=>$estimate_term_condition,
                                        'estimate_payment_notes'=>$estimate_payment_notes,
                                        'invoice_prefix'=>$invoice_prefix,
                                        'invoice_payment_details'=>$invoice_payment_details,
                                        'can_prefix'=>$can_prefix),array('id'=>1));
  //$db->debug();
    if ($update){
        $event="Change general settings of selling section";
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
        	    		  window.location = '".$link->link("sale_purchase_prefrence",user)."'
        	                },3000);</script>";

    }
}
elseif (isset($_POST['daytoday_buying_submit']))
{
     $buying_approval=$_POST['buying_approval'];
    $bill_prefix=$_POST['bill_prefix'];
    $san_prefix=$_POST['san_prefix'];


    $update=$db->update('daytoday_report_settings',array( 'buying_approval'=>$buying_approval,
                                                    'bill_prefix'=>$bill_prefix,
                                                    'san_prefix'=>$san_prefix),array('id'=>1));
    //$db->debug();
    if ($update){
        $event="Change general settings of buy section";
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
        	    		  window.location = '".$link->link("sale_purchase_prefrence",user)."'
        	                },3000);</script>";

    }
}
?>
<div class="row">
	<div class="col-lg-12">
	 <?php echo $display_msg;?>
	<div class=" padded" >
					<h3>GENERAL SETTINGS</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

					<div class="col-lg-12">
						<!--  <a href="<?php echo $link->link('book_prefrences',user)?>" class="btn <?php if ($query1ans=="book_prefrences"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Book Settings</strong></a>
						<a href="<?php echo $link->link('general_email_setting',user)?>" class="btn <?php if ($query1ans=="general_email_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Email settings</strong></a>-->
						<a href="<?php echo $link->link('sale_purchase_prefrence',user)?>" class="btn <?php if ($query1ans=="sale_purchase_prefrence"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Day to day</strong></a>
						<?php if(in_array('view',$adm_report_settings)){?>
						<a href="<?php echo $link->link('general_report_setting',user)?>" class="btn <?php if ($query1ans=="general_report_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Report settings</strong></a>
                      <?php }?>

						<!-- <a class="pull-right"> View history </a> -->

						<h4><strong>Day to day</strong></h4>
					</div>
				</div>


				<div class="heading tabs">
                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                     <?php if(in_array('view',$adm_selling_settigs)){?>
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="icon-comments"></i><span>Selling</span></a>
                      </li>
                      <?php }if(in_array('view',$adm_buying_settings)){?>
                      <li>
                        <a data-toggle="tab" href="#tab2"><i class="icon-user"></i><span>Buying</span></a>
                      </li>
                      <?php }?>
                    </ul>
                  </div>


<!-- ------- Selling -------- -->
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                      <h3>
                        Selling
                      </h3>
                      <p>
                      	<form action="#" class="form-horizontal" method="post">
							<a href="" class="btn btn-default pull-right">Cancel</a>
							 <?php if(in_array('edit',$adm_selling_settigs)){?>
							<button class="btn btn-primary pull-right" type="submit" name="daytoday_selling_submit">Save</button>
							<?php }?>
                     <br>
                     <br>
							<!--  <div class="form-group">
						       <label class="control-label col-md-2">Approval process:</label>
						       <div class="col-md-7">
						           <label class="radio-inline">
						           <input name="selling_approval" type="radio" value="enabled" <?php if($all['selling_approval']=='enabled')echo 'checked';?>><span>Enabled</span></label>
						           <label class="radio-inline">
						           <input name="selling_approval" type="radio" value="disabled" <?php if($all['selling_approval']=='disabled')echo 'checked';?>><span>Disabled</span></label>
						       </div>
						    </div> -->
							<div class="widget-content">
			                    <div class="panel-group" id="accordion">

		<!-- ------- Estimates --------- -->
			                      <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
			                              <div class="caret pull-right"></div>
			                              ESTIMATES</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse in" id="collapseOne">
			                          <div class="panel-body">

			                          	<div class="form-group">
									       <label class="control-label col-md-4">Estimate prefix</label>
									       <div class="col-md-7">
									           <input class="form-control" placeholder="EST" type="text" name="estimate_prefix" value="<?php echo $all['estimate_prefix'];?>">
									       </div>
									    </div>
									  <!--  <div class="form-group">
									       <label class="control-label col-md-4">Default template</label>
									       <div class="col-md-7">
									           <select class="form-control">
									           		<option>Generic Estimate</option>
									           		<option>Generic Estimate</option>
									           		<option>Generic Estimate</option>
									           		<option>Generic Estimate</option>
									           </select>
									       </div>
									    </div>
									     <div class="form-group">
									       <label class="control-label col-md-4"></label>
									       <div class="col-md-7">
									       		<a data-toggle="modal" href="#myModal">Manage template</a>
									       </div>
									    </div> -->
									    <div class="form-group">
									       <label class="control-label col-md-4">Expiry</label>
									       <div class="col-md-3">
									           <input class="form-control" placeholder="" type="number" max="31" min="1" style="width:75%;" name="estimate_expiry" value="<?php echo $all['estimate_expiry'];?>">
									       </div>day
									    </div>
									    <div class="form-group">
									       <label class="control-label col-md-4">Term & condition</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100"  name="estimate_term_condition"><?php echo $all['estimate_term_condition'];?></textarea>
									       </div>
									    </div>
									    <div class="form-group">
									       <label class="control-label col-md-4">Payment notes</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" name="estimate_payment_notes"><?php echo $all['estimate_payment_notes'];?></textarea>
									       </div>
									    </div>


			                          </div>
			                        </div>
			                      </div>

		<!-- ------- Invoices -------- -->
			                      <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
			                              <div class="caret pull-right"></div>
			                              INVOICES</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseTwo">
			                          <div class="panel-body">

			                            <div class="form-group">
									       <label class="control-label col-md-4">Invoice prefix</label>
									       <div class="col-md-7">
									           <input class="form-control" placeholder="INV" type="text" name="invoice_prefix" value="<?php echo $all['invoice_prefix'];?>">
									       </div>
									    </div>
									   <!--  <div class="form-group">
									       <label class="control-label col-md-4">Default template</label>
									       <div class="col-md-7">
									           <select class="form-control">
									           		<option>Standerd Invoice</option>
									           		<option>Professional Invoice</option>
									           		<option>Generic Invoice</option>
									           </select>
									       </div>
									    </div>
									    <div class="form-group">
									       <label class="control-label col-md-4"></label>
									       <div class="col-md-7">
									           <a data-toggle="modal" href="#invoice">Manage templates</a>
									       </div>
									    </div>-->
									    <div class="form-group">
									       <label class="control-label col-md-4">Invoice start number</label>
									       <div class="col-md-7">
									           <a href="#">1  </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- ---Tooltip--- -->
									           <a class="tooltip-trigger" data-placement="right" data-toggle="tooltip" title="" data-original-title="Start number cannot be changed once the first invoice has been generated."><span class="lnr lnr-question-circle"></span></a>
									       </div>
									    </div>
									    <div class="form-group">
									       <label class="control-label col-md-4">Payment details</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" name="invoice_payment_details"><?php echo $all['invoice_payment_details'];?></textarea>
									       </div>
									    </div>


			                          </div>
			                        </div>
			                      </div>

		<!-- --------- Customer Adjustment ------------ -->
			                      <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
			                              <div class="caret pull-right"></div>
			                              CUSTOMER ADJUSTMENT NOTES</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseThree">
			                          <div class="panel-body">

			                          	<div class="form-group">
									       <label class="control-label col-md-4">Customer adjustment note prefix</label>
									       <div class="col-md-7">
									           <input class="form-control" placeholder="CAN" type="text" name="can_prefix" value="<?php echo $all['can_prefix'];?>">
									       </div>
									    </div>
									   <!--    <div class="form-group">
									       <label class="control-label col-md-4">Default template</label>
									       <div class="col-md-7">
									           <select class="form-control">
									           		<option>Standerd Customer adjustment note</option>
									           		<option>Standerd Customer adjustment note</option>
									           </select>
									       </div>
									    </div>
									  <div class="form-group">
									       <label class="control-label col-md-4"></label>
									       <div class="col-md-7">
									           	<a data-toggle="modal" href="#customerAdjustment"> Manage templates</a>
									       </div>
									    </div>-->


			                          </div>
			                        </div>

			                      </div>

			<!-- ---------- Invoice payment term ---------- -->
			                   <!--  <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
			                              <div class="caret pull-right"></div>
			                              INVOICE PAYMENT TERMS</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseFour">
			                          <div class="panel-body">


								        <div class="row">
								          <div class="col-lg-12">
								            <div class="widget-container fluid-height clearfix">
								              <div class="heading">
								                <i class="icon-table"></i>
								              </div>
								              <div class="widget-content padded clearfix">

								                <table class="table table-bordered table-striped" id="dataTable1">
								                  <thead>
								                    <th class="check-header hidden-xs">
								                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
								                    </th>
								                    <th>
								                      Term name
								                    </th>
								                    <th>
								                      Description
								                    </th>
								                    <th class="hidden-xs">
								                      Default
								                    </th>
								                    <th class="hidden-xs">
								                      Status
								                    </th>
								                    <th> </th>
								                  </thead>
								                  <tbody>
								                    <tr>
								                      <td class="check hidden-xs">
								                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
								                      </td>
								                      <td>
								                        Due on receipt
								                      </td>
								                      <td>
								                        Due on receipt
								                      </td>
								                      <td class="hidden-xs">
								                        No
								                      </td>
								                      <td class="hidden-xs">
														Active
								                      </td>
								                      <td class="hidden-xs">
								                        <a data-toggle="modal" href="#viewHistory">View history</a>
								                      </td>
								                    </tr>
								                    <tr>
								                      <td class="check hidden-xs">
								                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
								                      </td>
								                      <td>
								                        Net 15
								                      </td>
								                      <td>
								                        Net due 15 days from issue
								                      </td>
								                      <td class="hidden-xs">
								                        No
								                      </td>
								                      <td class="hidden-xs">
														Active
								                      </td>
								                      <td class="hidden-xs">
								                        <a data-toggle="modal" href="#viewHistory">View history</a>
								                      </td>
								                    </tr>

								                  </tbody>
								                </table>

								              </div>
								           &nbsp;&nbsp;&nbsp;&nbsp; <a data-toggle="modal" href="#add_payment" class="btn btn-success">add</a>
								            </div>

								          </div>
								        </div>


			                          </div>
			                        </div>
			                      </div>-->
			                    </div>
			                  </div>
                      	</form>
                      </p>
                    </div>

                    <!-- NEXT TAB->BUYING TAB -->
                            <div class="tab-pane" id="tab2">
                      <h3>
                        Buying
                      </h3>
                      <p>
                      	<form action="#" class="form-horizontal" method="post">
							<a href="" class="btn btn-default pull-right">Cancel</a>
							<?php if(in_array('edit',$adm_buying_settings)){?>
							<button class="btn btn-primary pull-right"  type="submit" name="daytoday_buying_submit">Save</button>
							<?php }?>
                     <br>
                     <br>
							<!-- <div class="form-group">
						       <label class="control-label col-md-2">Approval process:</label>
						       <div class="col-md-7">
						           <label class="radio-inline">
						           <input name="buying_approval" type="radio" value="enabled" <?php if($all['buying_approval']=='enabled')echo 'checked';?> ><span>Enabled</span></label>
						           <label class="radio-inline">
						           <input name="buying_approval" type="radio" value="disabled" <?php if($all['buying_approval']=='disabled')echo 'checked';?>><span>Disabled</span></label>
						       </div>
						    </div> -->
							<div class="widget-content">
			                    <div class="panel-group" id="accordion">

		<!-- ------- Estimates --------- -->
			                      <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseFive">
			                              <div class="caret pull-right"></div>BILLS</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse in" id="collapseFive">
			                          <div class="panel-body">

			                          	<div class="form-group">
									       <label class="control-label col-md-4">Bill prefix</label>
									       <div class="col-md-7">
									           <input class="form-control" placeholder="BIL" type="text" name="bill_prefix" value="<?php echo $all['bill_prefix'];?>">
									       </div>
									    </div>
									    <!--  <div class="form-group">
									       <label class="control-label col-md-4">Default template</label>
									       <div class="col-md-7">
									           <select class="form-control">
									           		<option>Standard Bill</option>
									           		<option>Standard Bill</option>
									           		<option>Standard Bill</option>
									           	</select>
									       </div>
									    </div>
									  <div class="form-group">
									       <label class="control-label col-md-4"></label>
									       <div class="col-md-7">
									       		<a data-toggle="modal" href="#mymodal_buying">Manage template</a>
									       </div>
									    </div>-->

			                          </div>
			                        </div>
			                      </div>


		<!-- --------- Customer Adjustment ------------ -->
			                      <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseSix">
			                              <div class="caret pull-right"></div>
			                              SUPPLIER ADJUSTMENT NOTES</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseSix">
			                          <div class="panel-body">

			                          	<div class="form-group">
									       <label class="control-label col-md-4">Supplier adjustment note prefix</label>
									       <div class="col-md-7">
									           <input class="form-control" placeholder="SAN" type="text" name="san_prefix" value="<?php echo $all['san_prefix'];?>">
									       </div>
									    </div>
									   <!--  <div class="form-group">
									       <label class="control-label col-md-4">Default template</label>
									       <div class="col-md-7">
									           <select class="form-control">
									           		<option>Standerd Supplier adjustment note</option>
									           		<option>Standerd Supplier adjustment note</option>
									           </select>
									       </div>
									    </div>
									  <div class="form-group">
									       <label class="control-label col-md-4"></label>
									       <div class="col-md-7">
									           	<a data-toggle="modal" href="#customerAdjustment"> Manage templates</a>
									       </div>
									    </div> -->


			                          </div>
			                        </div>
			                      </div>


			                    </div>
			                  </div>
                      	</form>
                      </p>
                    </div>
                      <!-- NEXT TAB->BUYING TAB --><br>
                      <br>                  </div>


            </div>
        </div>
    </div>






<!-- ------************** Modal Manage Estimate Template **************------ -->

				<div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Manage Template
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form action="" class="form-horizontal" method="POST">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<button class="btn btn-success pull-right" type="submit">Done</button>
	                        			<a href="#" class="btn btn-default pull-right">Cancel</a><br><br>
	                        			<a href="#" class="pull-right">Preview</a>
	                        		</div>
	                        	</div>

								<div class="form-group">
							       <label class="control-label col-md-4">Template Name</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           	<option>Generic template</option>
							           	<option>Generic template</option>
							           	<option>Generic template</option>
							           </select>
							       </div>
							    </div>

	                        	<div class="widget-content">
				                    <div class="panel-group" id="accordion">
		<!-- -------- Header ------------- -->
				                      <div class="panel">
				                        <div class="panel-heading">
				                          <div class="panel-title">
				                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne1">
				                              <div class="caret pull-right"></div>
				                              HEADER</a>
				                          </div>
				                        </div>
				                        <div class="panel-collapse collapse in" id="collapseOne1">
				                          <div class="panel-body">

				                          		Include in the letterhead
												<div class="row">
	                        						<div class="col-md-8">

														<div class="form-group">
													       <label class="control-label col-md-4">Custom logo</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Company name</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Company addresss</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">ABN</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Phone number</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Email</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Website</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Billing addresss</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Shipping address</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Estimate date</label>
													       <div class="col-md-7">
													       		Mandatory Field
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Estimate number</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Expiry date</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>
													    <div class="form-group">
													       <label class="control-label col-md-4">Refrence code</label>
													       <div class="col-md-7">
													           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													           <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													       </div>
													    </div>

	                        						</div>
	                        						<div class="col-md-4">
														The optimal settings for a logo are<br><br>
														Dimensions: 470px by 125px<br><br>
														Resolution: 300dpi<br><br>
														File size: 2MB or less
	                        						</div>

	                        					</div>

				                          </div>
				                        </div>
				                      </div>
		<!-- -------- Contant ------------- -->
				                      <div class="panel">
				                        <div class="panel-heading">
				                          <div class="panel-title">
				                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo2">
				                              <div class="caret pull-right"></div>
				                              CONTANT</a>
				                          </div>
				                        </div>
				                        <div class="panel-collapse collapse" id="collapseTwo2">
				                          <div class="panel-body">

				                          	<div class="form-group">
												<label class="control-label col-md-4">Project</label>
													 <div class="col-md-7">
													      <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													      <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													 </div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Item</label>
													 <div class="col-md-7">
													      <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													      <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
													 </div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Item Price</label>
												<div class="col-md-7">
													 <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													  <label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												 </div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Description</label>
												<div class="col-md-7">
													 Mandatory Field
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Quantity</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Tax code</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Tax</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Amount</label>
												<div class="col-md-7">
													Mandatory Field
												</div>
											</div>

				                          </div>
				                        </div>
				                      </div>
		<!-- -------- Footer ------------- -->
				                      <div class="panel">
				                        <div class="panel-heading">
				                          <div class="panel-title">
				                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree3">
				                              <div class="caret pull-right"></div>
				                              FOOTER</a>
				                          </div>
				                        </div>
				                        <div class="panel-collapse collapse" id="collapseThree3">
				                          <div class="panel-body">

				                            <div class="form-group">
												<label class="control-label col-md-4">Note</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Subtotal</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Tax amount</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Total(including tax)</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Total</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Term and condition</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Payment notes</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Signature</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>

				                          </div>
				                        </div>
				                      </div>
				                     </div>
				                   </div><br>

							</form>

                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

<!-- ------**************Close Modal Manage Estimate Template **************------ -->





<!-- ------************** Modal Manage Invoice Template **************------ -->

				<div class="modal fade" id="invoice">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Manage Template
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form action="#" class="form-horizontal" method="post">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<button class="btn btn-success pull-right" type="submit">Done</button>
	                        			<a href="#" class="btn btn-default pull-right">Cancel</a><br><br>
	                        			<a href="#" class="pull-right">Preview</a>
	                        		</div>
	                        	</div>

								<div class="form-group">
							       <label class="control-label col-md-4">Template Name</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           	<option>Standered Invoice</option>
							           	<option>Proffesional Invoice</option>
							           	<option>Standered Invoice</option>
							           </select>
							       </div>
							    </div>

							    Include in the letterhead.
								<div class="widget-content">
				                    <div class="panel-group" id="accordion">
			<!-- -------Header---------------------- -->
				                      <div class="panel">
				                        <div class="panel-heading">
				                          <div class="panel-title">
				                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne11">
				                              <div class="caret pull-right"></div>
				                              HEADER</a>
				                          </div>
				                        </div>
				                        <div class="panel-collapse collapse in" id="collapseOne11">
				                          <div class="panel-body">

				                          	<div class="row">
				                          		<div class="col-md-8">

													<div class="form-group">
														<label class="control-label col-md-4">Custom logo</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Company name</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Company address</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">ABN</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Phone number</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Email</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Website</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Invoice to</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Ship to</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Invoice date</label>
														<div class="col-md-7">
															Mandatory field
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Invoice number</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Due date</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Refrence code</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Invoice Discount</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4">Payment terms</label>
														<div class="col-md-7">
															<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
															<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
														</div>
													</div>

				                          		</div>
				                          		<div class="col-md-4">
													The optimal settings for a logo are<br><br>
													Dimensions: 470px by 125px<br><br>
													Resolution: 300dpi<br><br>
													File size: 2MB or less
				                          		</div>
				                          	</div>

				                          </div>
				                        </div>
				                      </div>
			<!-- -------Content---------------------- -->
				                      <div class="panel">
				                        <div class="panel-heading">
				                          <div class="panel-title">
				                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo22">
				                              <div class="caret pull-right"></div>
				                              CONTANT</a>
				                          </div>
				                        </div>
				                        <div class="panel-collapse collapse" id="collapseTwo22">
				                          <div class="panel-body">

				                          	<div class="form-group">
												<label class="control-label col-md-4">Project</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Item</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Item price</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Account</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Description</label>
												<div class="col-md-7">
													Mandatory field
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Quantity</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Discount</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Tax code</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Tax</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Account</label>
												<div class="col-md-7">
													Mandatory field
												</div>
											</div>

				                          </div>
				                        </div>
				                      </div>
			<!-- -------Footer---------------------- -->
				                      <div class="panel">
				                        <div class="panel-heading">
				                          <div class="panel-title">
				                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree33">
				                              <div class="caret pull-right"></div>
				                              FOOTER</a>
				                          </div>
				                        </div>
				                        <div class="panel-collapse collapse" id="collapseThree33">
				                          <div class="panel-body">

				                            <div class="form-group">
												<label class="control-label col-md-4">Note</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Subtotal</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Tax amount</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Invoice Discount</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Balance due</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4">Total (excluding tax)</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>
				                            <div class="form-group">
												<label class="control-label col-md-4">How to pay</label>
												<div class="col-md-7">
													<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
													<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
												</div>
											</div>

				                          </div>
				                        </div>
				                      </div>
				                    </div>
				                 </div>

                        </form>

                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
<!-- ------************** Close Modal Manage Invoice Template **************------ -->




<!-- ------************** Modal Manage SELLING ->Customer Adjustment Note Template **************------ -->

				<div class="modal fade" id="customerAdjustment">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Manage Template
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form action="#" class="form-horizontal" method="post">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<button class="btn btn-success pull-right" type="submit">Done</button>
	                        			<a href="#" class="btn btn-default pull-right">Cancel</a><br><br>
	                        			<a href="#" class="pull-right">Preview</a>
	                        		</div>
	                        	</div>

								<div class="form-group">
							       <label class="control-label col-md-4">Template Name</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           	<option>Standered Invoice</option>
							           	<option>Proffesional Invoice</option>
							           	<option>Standered Invoice</option>
							           </select>
							       </div>
							    </div>

								<div class="row">
									<div class="col-md-8">

										<div class="form-group">
											<label class="control-label col-md-4">Custom logo</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Company name</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Company address</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">ABN</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Phone number</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Email</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Website</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>

									</div>
									<div class="col-md-4">

										<div class="form-group">
								              <div class="fileupload fileupload-new" data-provides="fileupload">
								                <div class="input-group">
								                  <div class="form-control">
								                    <i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span>
								                  </div>
								                  <div class="input-group-btn">
								                    <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file"></span>
								                  </div>
								                </div>
								              </div>
								          </div>

										The optimal settings for a logo are<br><br>
										Dimensions: 470px by 125px<br><br>
										Resolution: 300dpi<br><br>
										File size: 2MB or less
									</div>
								</div>

                        </form>

                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
<!-- ------************** Close Modal Manage Customer Adjustment Note Template **************------ -->




<!-- ------************** Modal Add Payment Term **************------ -->
            <div class="modal fade" id="add_payment">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Add payment term
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form  id="add_payment_form_submit" action="#" class="form-horizontal" method="post">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        		<div id="after_post_message"></div>
	                        			<button class="btn btn-success pull-right" type="submit" name="add_paymet_submit">Done</button>
	                        			<a href="#" class="btn btn-default pull-right">Cancel</a>
	                        		</div>
	                        	</div>
                       <br>
	                        	<div class="form-group">
							       <label class="control-label col-md-4">Term name <span style="color:red;">*</span></label>
							       <div class="col-md-7">
							           <input class="form-control" placeholder="" type="text" name="term_name">
							       </div>
							    </div>
							    <div class="form-group">
							       <label class="control-label col-md-4">Description</label>
							       <div class="col-md-7">
							           <textarea class="form-control" name="payment_description"></textarea>
							       </div>
							    </div>
							  <div class="form-group">
                           <label class="control-label col-md-4">Net due<span style="color:red;">*</span></label>
                            <div class="col-md-2">
                              <input class="form-control" placeholder="" type="number" min="0" max="31" name="net_due">
                           </div>
                           <div class="col-md-5">
                              <select class="form-control" name="date_description">
                                 <option value="day_after_issue">day(s) after issue</option>
                                 <option value="day_current_month">day of current month</option>
                                 <option value="day_next_month">day of next month</option>
                              </select>
                              <span>If the specified day is not valid for that month, then the month's last day will be used instead.</span>
                           </div>

                        </div>
							       <div class="form-group">
                           <label class="control-label col-md-4">Status</label>
                           <div class="col-md-7">
                              <select class="form-control" name="visibility_status">
                                 <option value="active">Active</option>
                                 <option value="inactive">Inactive</option>
                              </select>
                           </div>
                        </div>
                    <!--     <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input checked="" type="checkbox" >
                              <span> Default</span>
                              </label>
                         </div>
                        </div>
                           <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input checked="" type="checkbox">
                              <span> If due date is on a weekend, push due date to the first Monday</span>
                              </label>
                         </div>
                        </div>
                           <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input checked="" type="checkbox" >
                              <span> If invoice issued within
                              <input class="form-control" placeholder="" type="text" style="width:40px;">day(s) of the due date, then push to the following month.</span>
                              </label>
                         </div>
                        </div> -->

							</form>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button" >Close</button>
                      </div>
                    </div>
                  </div>
                </div>

<!-- ------************** Close Modal Add Payment Term ********------ -->




<!-- ------************** Modal View History (Invoice Payment Term) **************------ -->
            <div class="modal fade" id="viewHistory">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Invoice Payment Term Hostory
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form action="#" class="form-horizontal" method="post">
	                        	<div class="row">
	                        		<label class="checkbox-inline" >
                              <input checked="" type="checkbox" >
                              <span>Only show notes, hide other history items</span>
                              </label>
	                        		<div class="col-md-12">
	                        			<button class="btn btn-success pull-right" type="submit">Add Note</button>
	                        		</div>

	                        	</div>

								<!-- DataTables Example -->
								        <div class="row">
								          <div class="col-lg-12">
								            <div class="widget-container fluid-height clearfix">
								              <div class="heading">
								                <i class="icon-table"></i>
								              </div>
								              <div class="widget-content padded clearfix">

								                <table class="table table-bordered table-striped" id="dataTable1">
								                  <thead>
								                    <th>
								                      Date
								                    </th>
								                    <th>
								                      Full name
								                    </th>
								                    <th class="hidden-xs">
								                      Description
								                    </th>
								                  </thead>
								                  <tbody>
								                    <tr>
								                      <td>
								                        22 June 2016 11:44:10 am
								                      </td>
								                      <td>
								                        Robert
								                      </td>
								                      <td class="hidden-xs">
								                        Testing
								                      </td>
								                    </tr>

								                  </tbody>
								                </table>
								              </div>
								            </div>
								          </div>
								        </div>
								        <!-- end DataTables Example -->

							</form>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

<!-- ------************** Close Modal View History (Invoice Payment Term) ********------ -->







 <!-- -----------*********************** for buying tab -->





 <!-- ------************** Modal Manage SELLING ->Customer Adjustment Note Template **************------ -->

				<div class="modal fade" id="mymodal_buying">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Manage Template
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form action="#" class="form-horizontal" method="post">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<button class="btn btn-success pull-right" type="submit">Done</button>
	                        			<a href="#" class="btn btn-default pull-right">Cancel</a><br><br>
	                        			<a href="#" class="pull-right">Preview</a>
	                        		</div>
	                        	</div>

								<div class="form-group">
							       <label class="control-label col-md-4">Template Name</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           	<option>Standered Bill</option>

							           </select>
							       </div>
							    </div>

								<div class="row">
									<div class="col-md-8">

										<div class="form-group">
											<label class="control-label col-md-4">Custom logo</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Company name</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Company address</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">ABN</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Phone number</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Email</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">Website</label>
											<div class="col-md-7">
												<label class="radio-inline"><input name="optionsRadios2" type="radio" value="option1"><span>Yes</span></label>
												<label class="radio-inline"><input  name="optionsRadios2" type="radio" value="option2"><span>No</span></label>
											</div>
										</div>

									</div>
									<div class="col-md-4">

										<div class="form-group">
								              <div class="fileupload fileupload-new" data-provides="fileupload">
								                <div class="input-group">
								                  <div class="form-control">
								                    <i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span>
								                  </div>
								                  <div class="input-group-btn">
								                    <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file"></span>
								                  </div>
								                </div>
								              </div>
								          </div>

										The optimal settings for a logo are<br><br>
										Dimensions: 470px by 125px<br><br>
										Resolution: 300dpi<br><br>
										File size: 2MB or less
									</div>
								</div>

                        </form>

                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
<!-- ------************** Close Modal Manage Customer Adjustment Note Template **************------ -->




<!-- ------************** En of buying tab **************------ -->










                 <!-- <div class="widget-content">
                    <div class="panel-group" id="accordion">
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
                              <div class="caret pull-right"></div>
                              ESTIMATES</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse in" id="collapseOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
                              <div class="caret pull-right"></div>
                              INVOICES</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTwo">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                              <div class="caret pull-right"></div>
                              CUSTOMER ADJUSTMENT NOTES</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
                              <div class="caret pull-right"></div>
                              INVOICE PAYMENT TERMS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseFour">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit,
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> -->

