


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
	<a href="<?php echo $link->link('time_timesheets',user);?>" class="btn btn-default pull-right">Back to List</a>
	
	</div>
	                            <div class="row">
                              <div class="widget-container fluid-height clearfix">
                                <div class="btn-group pull-right">
                                <button class="btn btn-primary">Save & Close</button>
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                 <li>
                                    <a href="#"><i class="fa fa-edit"></i>Save</a>
                                  </li>
                                </ul>
                                <br> <br><a class="pull-right" href="">Print</a>
                              </div>
	                           <a href="<?php echo $link->link('advisor',user,'&advisor_type=Journals');?>" class="btn btn-default pull-right">Cancel</a>
                                  <div class="heading">
                                    <i class="fa fa-bars"></i>Timesheets &nbsp;&nbsp;&nbsp;<span class="label label-info">Week view</span></div>
                                  
                                  <div class="widget-content padded">
                                    <form action="#" class="form-horizontal">
                                        <div class="row">
                            <div class="col-lg-3">
                                        <div class="form-group">
				 			<label class="control-label col-md-3">Employee<font color="red">*</font>
				 			</label>
				 			<div class="col-md-9">
				            <select class="form-control" name="payment_term">
				            <option value="1"selected="selected">All Employees</option>
				               <option value="2">Dean Darke</option>
				           <option value="3">Jason Hollis</option>
				           </select>
				           </div>
				          </div>
                                    </div>
                                            <div class="col-lg-4">
                                       <div class="form-group">
                                    <label class="control-label col-md-4">Week beginning<font color="red">*</font></label>
                                        <div class="col-md-8">
                                   <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                    
                                      </div>

                                      </div> 
                                   </div>
                                      </div>
                                     <div class="col-lg-3">
                                      <span>Mon, 20 Jun 2016 - Sun, 26 Jun 2016</span>
                                    </div>
                                            <div class="col-lg-2">
                                       <a href="<?php echo $link->link('advisor_journal',user);?>" class="btn btn-default pull-right">Switch to week view</a>
                                      </div>
                                </div>
                               
                
                      <br>
                                 <div class="row">
                              <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
					                     <th class="check-header hidden-xs">
					                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
					                    </th>
					                    <th>Project</th>
					                    <th >
					                   Customer
					                    </th>
					                    <th >
					                     Item
					                    </th>
					                   <th>
					                    Billable
					                    </th>
					                    <th >Mon 20</th>
					                     <th >Tue 21</th>
				                      <th>Wed 22</th>
				                       <th >Thur 23</th>
				                        <th>Fri 24</th>
				                         <th >Sat 25</th>
				                          <th >Sun 26</th>
					                    <th>Total</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                    <tr>
					                      <td class="check hidden-xs">
					                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
					                      </td>
					                         <td class="hidden-xs">
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
                                                  <option value="">Dividends Received &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</option>
                                                  <option value="">Fees and Charges - Restricted &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</option>
                                                   <option value="">Income &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</option>
                                                  </select>
                                            
					                      </td>
					                       <td>
					                       <select class="form-control">
                                                  <option value="">Dividends Received &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</option>
                                                  <option value="">Fees and Charges - Restricted &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</option>
                                                   <option value="">Income &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</option>
                                                  </select>
                                            
					                      </td>
					                      
					                      <td>
					                   <label class="checkbox-inline">
                                          <input type="checkbox"></label>
                                        </td>
					                      <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
                                           <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
                                           <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
                                           <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
                                           <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
                                           <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
                                           <td>
					                    <input class="form-control" placeholder="00:00" type="text">
                                       </td>
					                      <td class="hidden-xs">
					                     </td>
					                  </tr>
				                   </tbody>
					                </table>  
					                
					                <br>
					                <br>
					                <a href="" class="btn btn-default">Add new row</a>
                               
                                      </div>
                                    </form>
                                  </div>
                                </div>
                            
                          
					            </div>
					 </div>
        </div>
    </div>
</div>
