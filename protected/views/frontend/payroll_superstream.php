


<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>SUPERSTREAM</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

					

               <div class="row">
	<div class="col-lg-12">
	<?php  $tab_name=$_REQUEST['payroll_type'];?>
	<a data-toggle="modal" href="#add_payroll_superstream" class="btn btn-primary pull-right"> Add </a>
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="active">
	                        <a  href="<?php echo $link->link('payroll_superstream',user,'&tab=All');?>"><i class="icon-comments"></i><span>All</span></a>
	                       </li>
	                      <li>
	                        <a  href="<?php echo $link->link('payroll_superstream',user,'&tab=Draft');?>"><i class="icon-user"></i><span>Draft</span></a>
	                      </li>
	                      <li>
	                        <a  href="<?php echo $link->link('payroll_superstream',user,'&tab=Lodged');?>"><i class="icon-user"></i><span>Lodged</span></a>
	                      </li>
	                     </ul>
	                  </div>
	           
					        <div class="row">
					      <div class="widget-container fluid-height clearfix">
					            
					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
					                    <th class="check-header hidden-xs">
					                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
					                    </th>
					                    <th>
					                   From
					                    </th>
					                    <th>
					                   To
					                    </th>
					                    <th class="hidden-xs">
					                   Description
					                    </th>
					                   <th class="hidden-xs">
					                    Number of employees
					                    </th>
					                    <th>Status</th>
					                    <th>Lodge Date</th>
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

<!-- ------------------ Modal Box To add_payroll_superstream--------------------- -->

                <div class="modal fade" id="add_payroll_superstream" >
                  <div class="modal-dialog" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title"><strong>Add SuperStream batch</strong></h4>
                      </div>
                      <div class="modal-body">
                        <p>
                          <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
							 <div class="row">
						
							<div class="col-md-12">
							
				       
                        <div class="form-group">
                        <label class="control-label col-md-3">From<font color="red">*</font></label>
                         <div class="col-md-7">
                         <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                        <input class="form-control" type="text"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                           </div>
                         </div>
                         </div> 
                         <div class="form-group">
                        <label class="control-label col-md-3">To<font color="red">*</font></label>
                         <div class="col-md-7">
                         <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                        <input class="form-control" type="text"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                           </div>
                         </div> 
                         </div>
                           <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text">
                            </div>
                          </div>
                         
                        <div class="form-group">
                        <div class="col-md-7 pull-right">
                              <button class="btn btn-success" type="submit">Add SuperStream batch</button>
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