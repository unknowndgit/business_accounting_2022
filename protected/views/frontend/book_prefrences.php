<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>GENERAL SETTINGS</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
			<form action="#" class="form-horizontal">
        		<div class="row">
					<div class="col-lg-12">
					<!--  <a href="<?php echo $link->link('book_prefrences',user)?>" class="btn <?php if ($query1ans=="book_prefrences"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Book Settings</strong></a>-->	
						<a href="<?php echo $link->link('sale_purchase_prefrence',user)?>" class="btn <?php if ($query1ans=="sale_purchase_prefrence "){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Day to day</strong></a>
						<a href="<?php echo $link->link('general_report_setting',user)?>" class="btn <?php if ($query1ans=="general_report_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Report settings</strong></a>
						<a href="<?php echo $link->link('general_email_setting',user)?>" class="btn <?php if ($query1ans=="general_email_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Email settings</strong></a>

						<button class="btn btn-success pull-right"> Save </button>
						<button class="btn btn-default pull-right"> Cancel </button>

						<h4><strong>Book settings</strong></h4>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">

						<div class="form-group">
					       <label class="control-label col-md-4">Book name <span style="color:red;">*</span></label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Book locked off until</label>
					       <div class="col-md-7">
					           <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
				                <input class="form-control" type="text"><span class="input-group-addon"><i class="lnr lnr-calendar-full"></i></span></input>
				              </div>
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Industry type</label>
					       <div class="col-md-7">
					           On-selling electricity and electricity market operation <a data-toggle="modal" href="#myModal">Change industry type</a>
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Address to send emails from <span style="color:red;">*</span></label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Show emails as being sent from</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">BankData - retrieve last <span style="color:red;">*</span></label>
					       <div class="col-md-3">
					           <input class="form-control" placeholder="" type="text" value="" style="width:75%;">
					       </div> day
					    </div>

					</div>
					<div class="col-md-4">
						<strong>About this book</strong><br><br>
						This book was created on 27 September 2013 and started on 07 January 2012.<br><br>
						It applies to Australia and has a financial year starting 1 July.
					</div>
				</div>

				<div class="heading tabs">
                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="icon-comments"></i><span>General details</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab2"><i class="icon-user"></i><span>Leagal address</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab3"><i class="icon-paper-clip"></i><span>Physical address</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab4"><i class="icon-paper-clip"></i><span>Contact details</span></a>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                      <h3>
                        General details
                      </h3>
                      <p>

                        <div class="form-group">
					       <label class="control-label col-md-4">Company name</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Legal name</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">ABN</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Branch number</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>

                      </p>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <h3>
                        Leagal address
                      </h3>
                      <p>

                      	<div class="form-group">
					       <label class="control-label col-md-4">Address is</label>
					       <div class="col-md-7">
					           <label class="radio-inline"><input checked="" name="optionsRadios2" type="radio" value="option1"><span>National</span></label>
					           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option2"><span>International</span></label>
					       </div>
					    </div>
                      	<div class="form-group">
					       <label class="control-label col-md-4">Company address</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4"></label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <!-- <div class="form-group">
					       <label class="control-label col-md-4">Suburb</label>
					       <div class="col-md-7">
					           <select class="form-control">
					           		<option>Australian Capital Territory</option>
					           		<option>New South Wales</option>
					           		<option>Northern Territory</option>
					           		<option>Queensland</option>
					           		<option>South Australia</option>
					           		<option>Tasmania</option>
					           		<option>Victoria</option>
					           		<option>Western Australia</option>
					           </select>
					       </div>
					    </div> -->
					    <div class="form-group">
					       <label class="control-label col-md-4">Zip</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>

                      </p>
                    </div>
                    <div class="tab-pane" id="tab3">
                      <h3>
                        Physical address
                      </h3>
                      <p>

                        <div class="form-group">
					       <label class="control-label col-md-4">Address is</label>
					       <div class="col-md-7">
					           <label class="radio-inline"><input checked="" name="optionsRadios2" type="radio" value="option1"><span>National</span></label>
					           <label class="radio-inline"><input name="optionsRadios2" type="radio" value="option2"><span>International</span></label>
					       </div>
					    </div>
                      	<div class="form-group">
					       <label class="control-label col-md-4">Company address</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4"></label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <!-- <div class="form-group">
					       <label class="control-label col-md-4">Suburb</label>
					       <div class="col-md-7">
					           <select class="form-control">
					           		<option>Australian Capital Territory</option>
					           		<option>New South Wales</option>
					           		<option>Northern Territory</option>
					           		<option>Queensland</option>
					           		<option>South Australia</option>
					           		<option>Tasmania</option>
					           		<option>Victoria</option>
					           		<option>Western Australia</option>
					           </select>
					       </div>
					    </div> -->
					    <div class="form-group">
					       <label class="control-label col-md-4">Zip</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>

                      </p>
                    </div>
                    <div class="tab-pane" id="tab4">
                      <h3>
                        Contact details
                      </h3>
                      <p>

                        <div class="form-group">
					       <label class="control-label col-md-4">Contact name</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
                           <label class="control-label col-md-4">Phone</label>
                           <div class="col-md-1">
                              <input class="form-control" placeholder="" type="text" name="phone_pre_code">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="phone_number">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Mobile</label>
                           <div class="col-md-1">
                              <input class="form-control" placeholder="" type="text" name="mobile_pre_code">
                            </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="mobile_number">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-4">Fax</label>
                           <div class="col-md-1">
                              <input class="form-control" placeholder="" type="text" name="fax_pre_code">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="fax_number">
                           </div>
                        </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Email</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>
					    <div class="form-group">
					       <label class="control-label col-md-4">Website</label>
					       <div class="col-md-7">
					           <input class="form-control" placeholder="" type="text">
					       </div>
					    </div>

                      </p>
                    </div>
                  </div>



			</form>
            </div>
        </div>
    </div>
</div>



<!-- ------ Modal To Change Industry Type ------ -->
				<div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Change industry type
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<form action="#" class="form-horizontal">
	                        	<div class="row">
	                        		<div class="col-md-12">
	                        			<button href="#" class="btn btn-success pull-right">Done</button>
	                        			<a href="#" class="btn btn-default pull-right">Cancel</a>
	                        		</div>
	                        	</div>

	                        	<div class="form-group">
							       <label class="control-label col-md-4">Industry</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           		<option>Electricity, gas, water and waste services</option>
							           		<option>Agriculture, forestry and fishing</option>
							           		<option>Construction</option>
							           </select>
							       </div>
							    </div>
							    <div class="form-group">
							       <label class="control-label col-md-4">Category</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           		<option>Building installation services</option>
							           		<option>Heavy and civil engineering construction</option>
							           		<option>Other construction services</option>
							           </select>
							       </div>
							    </div>
							    <div class="form-group">
							       <label class="control-label col-md-4">Business type</label>
							       <div class="col-md-7">
							           <select class="form-control">
							           		<option>Abrasive blasting</option>
							           		<option>Clothes hoist installation</option>
							           		<option>Garden drainage systems installation</option>
							           </select>
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
