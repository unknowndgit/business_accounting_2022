<?php //echo "hello";?>
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>GENERAL SETTINGS</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

					<div class="col-lg-12">
						<!--  <a href="<?php echo $link->link('book_prefrences',user)?>" class="btn <?php if ($query1ans=="book_prefrences"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Book Settings</strong></a>-->	
						<a href="<?php echo $link->link('sale_purchase_prefrence',user)?>" class="btn <?php if ($query1ans=="sale_purchase_prefrence"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Day to day</strong></a>
						<a href="<?php echo $link->link('general_report_setting',user)?>" class="btn <?php if ($query1ans=="general_report_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Report settings</strong></a>
						<a href="<?php echo $link->link('general_email_setting',user)?>" class="btn <?php if ($query1ans=="general_email_setting"){echo "btn-primary";}else{echo "btn-default";}?> "><strong>Email settings</strong></a>

						<a class="pull-right"> View history </a>

						<h4><strong>Email settings</strong></h4>
					</div>
				</div>
				 
      <form action="#" class="form-horizontal">
							<a href="#" class="btn btn-default pull-right">Cancel</a>
							<a href="#" class="btn btn-success pull-right">Save</a>
                     <br>

						   <div class="row">
						       <div class="col-md-1"></div>
						    <div class="col-md-9">
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
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span>Include CC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                         <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span> Include BCC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                        	<div class="form-group">
									       <label class="control-label col-md-4">CC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									    	<div class="form-group">
									       <label class="control-label col-md-4">BCC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
			                          	<div class="form-group">
									       <label class="control-label col-md-4">Default email subject</label>
									       <div class="col-md-7">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									   <div class="form-group">
									       <label class="control-label col-md-4">Default email content</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" placeholder="Dear &lt;contact name&gt;

Please find attached Estimate &lt;estimate number&gt; for &lt;estimate total&gt;, which expires on &lt;estimate expiry date&gt;.

If you have any queries please contact the undersigned.

Kind regards,


&lt;company name&gt;"></textarea>
									       
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
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span>Include CC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                         <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span> Include BCC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                        	<div class="form-group">
									       <label class="control-label col-md-4">CC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									    	<div class="form-group">
									       <label class="control-label col-md-4">BCC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
			                          	<div class="form-group">
									       <label class="control-label col-md-4">Default email subject</label>
									       <div class="col-md-7">
									           <input class="form-control" value="Invoice number is due" type="text">
									       </div>
									    </div>
									   <div class="form-group">
									       <label class="control-label col-md-4">Default email content</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" placeholder="Hi contact name"></textarea>
									       
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
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span>Include CC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                         <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span> Include BCC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                        	<div class="form-group">
									       <label class="control-label col-md-4">CC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									    	<div class="form-group">
									       <label class="control-label col-md-4">BCC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
			                          	<div class="form-group">
									       <label class="control-label col-md-4">Default email subject</label>
									       <div class="col-md-7">
									           <input class="form-control" value="" type="text">
									       </div>
									    </div>
									   <div class="form-group">
									       <label class="control-label col-md-4">Default email content</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" placeholder=""></textarea>
									       
									       </div>
									    </div>


			                          </div>
			                        </div>
			                      </div>

			<!-- ---------- Bills ---------- -->
			                             <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
			                              <div class="caret pull-right"></div>
			                              BILLS</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseFour">
			                        <div class="panel-body">
                                <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span>Include CC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                         <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span> Include BCC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                        	<div class="form-group">
									       <label class="control-label col-md-4">CC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									    	<div class="form-group">
									       <label class="control-label col-md-4">BCC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
			                          	<div class="form-group">
									       <label class="control-label col-md-4">Default email subject</label>
									       <div class="col-md-7">
									           <input class="form-control" value="" type="text">
									       </div>
									    </div>
									   <div class="form-group">
									       <label class="control-label col-md-4">Default email content</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" placeholder=""></textarea>
									       
									       </div>
									    </div>


			                          </div>
			                        </div>
			                      </div>
	<!-- ---------- ACTIVITY STATEMENTS ---------- -->
			                             <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseFour">
			                              <div class="caret pull-right"></div>
			                              ACTIVITY STATEMENTS</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseFour">
			                        <div class="panel-body">
                                <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span>Include CC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                         <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span> Include BCC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                        	<div class="form-group">
									       <label class="control-label col-md-4">CC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									    	<div class="form-group">
									       <label class="control-label col-md-4">BCC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
			                          	<div class="form-group">
									       <label class="control-label col-md-4">Default email subject</label>
									       <div class="col-md-7">
									           <input class="form-control" value="" type="text">
									       </div>
									    </div>
									   <div class="form-group">
									       <label class="control-label col-md-4">Default email content</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" placeholder=""></textarea>
									       
									       </div>
									    </div>


			                          </div>
			                        </div>
			                      </div>

			                      
	<!-- ----------TPAR---------- -->
			                             <div class="panel">
			                        <div class="panel-heading">
			                          <div class="panel-title">
			                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseFive">
			                              <div class="caret pull-right"></div>
			                              TPAR</a>
			                          </div>
			                        </div>
			                        <div class="panel-collapse collapse" id="collapseFive">
			                        <div class="panel-body">
                                <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span>Include CC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                         <div class="form-group">
                           <label class="control-label col-md-4"></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox">
                              <span> Include BCC by default when emailing</span>
                              </label>
                         </div>
                        </div>   
                        	<div class="form-group">
									       <label class="control-label col-md-4">CC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
									    	<div class="form-group">
									       <label class="control-label col-md-4">BCC emails to</label>
									       <div class="col-md-5">
									           <input class="form-control" placeholder="" type="text">
									       </div>
									    </div>
			                          	<div class="form-group">
									       <label class="control-label col-md-4">Default email subject</label>
									       <div class="col-md-7">
									           <input class="form-control" value="Expense claim, number expense claim number" type="text">
									       </div>
									    </div>
									   <div class="form-group">
									       <label class="control-label col-md-4">Default email content</label>
									       <div class="col-md-7">
									           <textarea rows="5" cols="100" placeholder="Please review the attached Expense claim expense claim number .Feel free to contact us if you have any questions."></textarea>
									       
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
   



