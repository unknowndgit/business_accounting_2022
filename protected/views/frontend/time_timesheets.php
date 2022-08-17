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
               <a href="<?php echo $link->link('add_time_timesheets');?>" class="btn btn-default pull-right"> Add </a>
               <br>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label col-md-5">Select an employee<font color="red">*</font>
                     </label><br>
                     <div class="col-md-5">
                        <select class="form-control" name="payment_term">
                           <option value="1"selected="selected">All Employees</option>
                           <option value="2">Dean Darke</option>
                           <option value="3">Jason Hollis</option>
                        </select>
                     </div>
                  </div>
               </div>
               <br>
            </div>
            <div class="heading tabs">
               <i class="icon-sitemap"></i>
               <ul class="nav nav-tabs pull-left" data-tabs="tabs">
                  <li class="<?php if ($current_tab=="All" || $current_tab==""){echo"active";}?>">
                     <a  href="<?php echo $link->link('time_timesheets',user,'&tab=All');?>"><i class="icon-comments"></i><span>All</span></a>
                  </li>
                  <li class="<?php if ($current_tab=="Non-billable"){echo"active";}?>">
                     <a  href="<?php echo $link->link('time_timesheets',user,'&tab=Non-billable');?>"><i class="icon-user"></i><span>Non-billable</span></a>
                  </li>
                  <li class="<?php if ($current_tab=="Billable"){echo"active";}?>">
                     <a  href="<?php echo $link->link('time_timesheets',user,'&tab=Billable');?>"><i class="icon-user"></i><span>Billable</span></a>
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
                              <th>Date</th>
                              <th>Employee</th>
                              <th class="hidden-xs">
                                 Customer
                              </th>
                              <th class="hidden-xs">
                                 Item
                              </th>
                              <th>Project</th>
                              <th>Notes</th>
                              <th>Time</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="check hidden-xs">
                                 <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                              </td>
                              <td>
                                 31 Jul 2013
                              </td>
                              <td>Dean Darke</td>
                              <td class="hidden-xs">Dean Darke</td>
                              <td class="hidden-xs">Consulting (Junior)</td>
                              <td class="hidden-xs">Sydney Operations</td>
                              <td class="hidden-xs">-</td>
                              <td class="hidden-xs">12:00</td>
                              <td class="hidden-xs">Billed</td>
                           </tr>
                           <tr>
                              <td class="check hidden-xs">
                                 <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                              </td>
                              <td>
                                 31 Jul 2013
                              </td>
                              <td>Dean Darke</td>
                              <td class="hidden-xs">Dean Darke</td>
                              <td class="hidden-xs">Consulting (Junior)</td>
                              <td class="hidden-xs">Sydney Operations</td>
                              <td class="hidden-xs">-</td>
                              <td class="hidden-xs">12:00</td>
                              <td class="hidden-xs">Billed</td>
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