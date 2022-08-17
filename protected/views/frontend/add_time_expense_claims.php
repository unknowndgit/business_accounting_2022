<div class="row">
   <div class="col-lg-12">
      <div class=" padded" >
         <h3>TIME AND EXPENSES</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
            <div class="row">
               <?php  $current_tab=$_REQUEST['tab'];?>
               <a href="<?php echo $link->link('time_timesheets',user);?>" class="btn <?php if ($query1ans=="time_timesheets"){echo "btn-primary";}else{echo "btn-default";}?> ">Timesheets</a>
               <a href="<?php echo $link->link('time_expense_claims',user);?>" class="btn <?php if ($query1ans=="time_expense_claims"){echo "btn-primary";}else{echo "btn-default";}?>">Expense claims</a>
               <a href="<?php echo $link->link('time_expense_claims',user);?>" class="btn btn-default pull-right">Back to List</a>
                <a href="<?php echo $link->link('time_expense_claims',user);?>" class="btn btn-default pull-right">Back to List</a>
            </div>
            <div class="row">
               <div class="widget-container fluid-height clearfix">
             <div class="btn-group pull-right">
                  <button class="btn btn-primary">Save & Close</button>
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
                  </div>
                  <a href="<?php echo $link->link('time_expense_claims',user);?>" class="btn btn-default pull-right">Cancel</a>
                 <a class="btn btn-default pull-right">Riemburse</a>
                  <div class="heading">
                <i class="fa fa-bars"></i>Expense claim &nbsp;&nbsp;&nbsp;<span class="label label-info">Status:Unpaid</span>
                  
                  </div>
                  	<div class="pull-right">
							<a href="#">Print </a> |
							<a href="#">Send via Email</a>
						</div>
                  <br>
                  <div class="widget-content padded">
                     <form action="#" class="form-horizontal">
                        <div class="row">
                          	<div class="col-lg-3">

							<div class="form-group">
                              <label>Employee<font color="red">*</font></label>
                               <select class="form-control" name="payment_term">
				            <option value="1"selected="selected">All Employees</option>
				               <option value="2">Dean Darke</option>
				           <option value="3">Jason Hollis</option>
				           </select>
                            </div>
                           </div>
						<div class="col-lg-3"></div> 
					        	<div class="col-lg-3">
					        	<div class="form-group">
                              <label>Expense claim date<font color="red">*</font></label>
                             <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                    
                                      </div>
                            </div>
					      <div class="form-group">
                              <label>Project</label>
                               <select class="form-control">
                                          <option value="">Aportis</option>
                                          <option value="">Melbourne Operations</option>
                                          <option value="">Melbourne Operations:Kentucky Fried Fish</option>
                                          <option value="">Melbourne Operations:Kentucky Fried Fish:test</option>
                                          <option value="">Sydney Operations</option>
                                          <option value="">Sydney Operations:Kentucky Fried Fish</option>
                                       </select>
                            </div>
                               <div class="form-group">
                              <label>Amounts<font color="red">*</font></label>
                           <select class="form-control">
                                       <option value="">Non-Taxed</option>
                                       <option value="">Net (Tax Exclusive)</option>
                                       <option value="">Gross (Tax Inclusive)</option>
                                    </select>
                            </div>
                          
					        </div> 
					        	<div class="col-lg-3">
					        	    <div class="form-group">
                              <label>Reference code</label>
                            <input class="form-control" placeholder="" type="text">
                            </div>
                            <div class="form-group">
                              <label>Customer</label>
                               <select class="form-control">
                                          <option value="">Aportis</option>
                                          <option value="">Melbourne Operations</option>
                                          <option value="">Melbourne Operations:Kentucky Fried Fish</option>
                                          <option value="">Melbourne Operations:Kentucky Fried Fish:test</option>
                                          <option value="">Sydney Operations</option>
                                          <option value="">Sydney Operations:Kentucky Fried Fish</option>
                                       </select>
                            </div>
							</div> 
                       </div>
                       <h5><strong>ITEMS AND ACCOUNTS FOR THIS CLAIM</strong></h5>
                       <div class="row">
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                  <table class="table table-striped invoice-table">
                    <thead>
                    <tr row="">
                      <th width="20%">Date</th>
                      <th>
                        Project
                      </th>
                      <th>
                        Supplier
                      </th>
                      <th>
                        Customer
                      </th>
                      <th>
                        Billable
                      </th>
                      <th>
                       Status
                      </th>
                      <th>
                        Total
                      </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td >
                       <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                    
                                      </div> </td>
                       <td >
                       <select class="form-control">
                      <option value="">Aportis</option>
                      <option value="">Melbourne Operations</option>
                      <option value="">Melbourne Operations:Kentucky Fried Fish</option>
                      <option value="">Melbourne Operations:Kentucky Fried Fish:test</option>
                      <option value="">Sydney Operations</option>
                      <option value="">Sydney Operations:Kentucky Fried Fish</option>
                      </select>
                </td>
                      <td >
             <select class="form-control">
                  <option value="">Aportis</option>
                  <option value="">Melbourne Operations</option>
                  <option value="">Melbourne Operations:Kentucky Fried Fish</option>
                  <option value="">Melbourne Operations:Kentucky Fried Fish:test</option>
                  <option value="">Sydney Operations</option>
                  <option value="">Sydney Operations:Kentucky Fried Fish</option>
                  </select>
              </td>
                              <td>
                 <select class="form-control">
                      <option value="">Aportis</option>
                      <option value="">Melbourne Operations</option>
                      <option value="">Melbourne Operations:Kentucky Fried Fish</option>
                      <option value="">Melbourne Operations:Kentucky Fried Fish:test</option>
                      <option value="">Sydney Operations</option>
                      <option value="">Sydney Operations:Kentucky Fried Fish</option>
                      </select>
                  </td>
                        <td>
                        <label class="checkbox-inline">
                                          <input type="checkbox"></label>
                        </td>
                        <td>
                        Unbillable	
                        </td>
                        <td>
                          $0.00
                        </td>
                       
                      </tr>
                 
                      
                   </tbody>
                 
                 <tfoot>
                        
                      <tr>
                   <td class="text-right" colspan="6">
                          <strong>Subtotal</strong>
                        </td>
                        <td>
                          $1,000
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="6">
                          <strong>Tax</strong>
                        </td>
                        <td>
                          $70
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="6">
                          <strong>Shipping</strong>
                        </td>
                        <td>
                          $30
                        </td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="6">
                          <h4 class="text-primary">
                            Total
                          </h4>
                        </td>
                        <td>
                          <h4 class="text-primary">
                            $1,100
                          </h4>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>