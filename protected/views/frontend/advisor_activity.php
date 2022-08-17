


<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>ADVISOR</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">



               <div class="row">
	<div class="col-lg-12">
		  <?php  $current_tab=$_REQUEST['tab'];?>
	<a href="<?php echo $link->link('advisor_journal',user);?>" class="btn btn-default"> Journals </a>
	<a href="<?php echo $link->link('advisor_activity',user);?>" class="btn btn-primary"> Activity statements </a>
	<a href="<?php echo $link->link('advisor_tpar_report',user);?>" class="btn btn-default">TPAR reports </a>


	<a data-toggle="modal" href="#add_advisor_activity" class="btn btn-default pull-right"> Add Activity</a>

	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="<?php if ($current_tab=="All" || $current_tab==""){echo"active";}?>">
	                        <a  href="<?php echo $link->link('advisor_activity',user,'&tab=All');?>"><i class="icon-comments"></i><span>All</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="Draft"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('advisor_activity',user,'&tab=Draft');?>"><i class="icon-user"></i><span>Draft</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="Lodged"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('advisor_activity',user,'&tab=Lodged');?>"><i class="icon-user"></i><span>Lodged</span></a>
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
					                    S.no
					                    </th>
					                    <th>Period</th>
					                    <th>
					                   Document ID
					                    </th>
					                    <th class="hidden-xs">
					                     Description
					                    </th>
					                   <th class="hidden-xs">
					                     Due date
					                    </th>
					                    <th>Is amendment?</th></tr>
					                  </thead>
					                  <tbody>
					                    <tr>
					                      <td class="check hidden-xs">
					                        1
					                      </td>
					                      <td>
					                       Jan 2015 - Mar 2015
					                      </td>
					                      <td></td>
					                      <td class="hidden-xs"></td>
					                      <td class="hidden-xs"></td>
					                        <td class="hidden-xs">No</td>
					                    </tr>
					                       <tr>
					                      <td class="check hidden-xs">
					                        2
					                      </td>
					                      <td>
					                       Jan 2015 - Mar 2015
					                      </td>
					                      <td></td>
					                      <td class="hidden-xs"></td>
					                      <td class="hidden-xs"></td>
					                        <td class="hidden-xs">No</td>
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


<!-- ------------------ Modal Box To add activity-------------------- -->

                <div class="modal fade" id="add_advisor_activity" >
                  <div class="modal-dialog" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title"><strong>New activity statement</strong></h4>
                      </div>
                      <div class="modal-body">
                        <p>
                          <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
							 <div class="row">
							<div class="col-md-12">
							 <h4 class="modal-title"><strong>New activity statement</strong></h4>
							 <br>
							 <br>
							<h5>Please select the following options for this report:</h5>
                            <div class="form-group">
				 			<label class="control-label col-md-3">Reporting period:
				 			</label>
				            <div class="col-md-9">
				            <select class="form-control" name="payment_term">
				             <option value="0" selected="selected"></option>
				           <option value="1">Quarter 4 - April to June 2016</option>
				           <option value="2">Quarter 3 - 07 January to 31 March 2012</option>
				           <option value="3">Quarter 4 - April to June 2012</option>
				           <option value="4">Quarter 1 - July to September 2012</option>
				           <option value="5">Quarter 2 - October to December 2012</option>
				           <option value="6">Quarter 3 - January to March 2013</option>
				           <option value="7">Quarter 4 - April to June 2013</option>
				           <option value="8">Quarter 1 - July to September 2013</option>
				           <option value="9">Quarter 2 - October to December 2013</option>
				           <option value="10">Quarter 3 - January to March 2014</option>
				         </select>
				            </div>
				          </div>
				           <div class="form-group">
                                        <label class="control-label col-md-3">Is amendment:</label>
                                        <div class="col-md-9">
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
                                        <label class="control-label col-md-3">Document ID:</label>
                                        <div class="col-md-9">
                                          <input class="form-control" placeholder="" type="text">
                                        </div>
                                      </div>
                                       <div class="form-group">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                          <textarea class="form-control" rows="5"></textarea>
                                        </div>
                                      </div>

                                             <div class="form-group">
                                        <label class="control-label col-md-7"></label>
                                        <div class="col-md-5">
                                          <button class="btn btn-success" type="submit">Submit</button>
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
