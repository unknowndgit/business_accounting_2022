


<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>PAYMENT SUMMARIES</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

					

               <div class="row">
	<div class="col-lg-12">


	<a href="<?php echo $link->link('payroll_payment_summaries_inb',user);?>" class="btn btn-primary"> INB </a>
	<a href="<?php echo $link->link('payroll_payment_summaries_etp',user);?>" class="btn btn-primary">ETP</a>
	
	<a data-toggle="modal" href="#add_payroll_payment_summaries"  class="btn btn-primary pull-right"> Add </a>
	
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="active">
	                        <a  href="<?php echo $link->link('payroll_payment_summaries_inb',user,'&tab=All');?>"><i class="icon-comments"></i><span>All</span></a>
	                      </li>
	                      <li>
	                        <a  href="<?php echo $link->link('payroll_payment_summaries_inb',user,'&tab=Draft');?>"><i class="icon-user"></i><span>Draft</span></a>
	                      </li>
	                      <li>
	                        <a  href="<?php echo $link->link('payroll_payment_summaries_inb',user,'&tab=Lodged');?>"><i class="icon-user"></i><span>Lodged</span></a>
	                      </li>
	                     </ul>
	                  </div>
	           
					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">
					            
					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
					                    <th class="check-header hidden-xs">
					                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
					                    </th>
					                    <th>
					                     Year
					                    </th>
					                    <th>
					                   Description
					                    </th>
					                    <th class="hidden-xs">
					                    Number of summaries
					                    </th>
					                   <th class="hidden-xs">
					                     Status
					                    </th>
					                    <th>Date created</th>
					                     <th>Lodge date</th>
					                      <th>Receipt number</th>
					                       <th>Amendment?</th>
					                     </tr>
					                  </thead>
					                  <tbody>
					                    <tr>
					                      <td class="check hidden-xs">
					                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
					                      </td>
					                      <td>
					                       
					                      </td>
					                      <td>
					                      
					                      </td>
					                      <td class="hidden-xs">
					                   
					                      </td>
					                      <td class="hidden-xs">
					                      
					                      </td>
					                      <td class="hidden-xs">
									
					                      </td>
					                      <td class="hidden-xs">
					                    
					                      </td>
					                       <td class="hidden-xs">
					                    
					                      </td>
					                       <td class="hidden-xs">
					                    
					                      </td>
					                     
					                    </tr>
					                  
                                  </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>
				


            </div>
        </div>
    </div>
</div>

<!-- ------------------ Modal Box To add_payroll_payment_summaries-------------------- -->

                <div class="modal fade" id="add_payroll_payment_summaries" >
                  <div class="modal-dialog" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title"><strong>Add INB payment summary</strong></h4>
                      </div>
                      <div class="modal-body">
                        <p>
                          <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
							 <div class="row">
							<div class="col-md-12">
							<div class="form-group">
				 			<label class="control-label col-md-3">Financial year<font color="red">*</font>
				 			</label>
				            <div class="col-md-7">
				            <select class="form-control" name="payment_term">
				             <option value="0" selected="selected"></option>
				           <option value="1">2015-2016</option>
				         </select>
				            </div>
				          </div>
				           <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text">
                            </div>
                          </div>
				           <div class="form-group">
                            <label class="control-label col-md-3">Is amendment:</label>
                            <div class="col-md-7">
                              <label class="radio-inline">
                              <input   name="optionsRadios2" type="radio" value="option1">
                              <span>Yes</span>
                              </label>
                              <label class="radio-inline">
                              <input checked="" name="optionsRadios2" type="radio" value="option2">
                              <span>No</span>
                              </label>
                             
                            </div>
                          </div>
                            <div class="form-group">
                                <div class="col-md-8 pull-right">
                                      <button class="btn btn-success" type="submit">Add INB payment summary</button>
                                      <button class="btn btn-default-outline">Cancel </button>
                                    </div>
                                  </div>
                           
   
                            </div>
                
                
                					</div>
                							 </form>
                                        </p>
                                      </div>
                
                                    </div>
                                  </div>
                                </div>