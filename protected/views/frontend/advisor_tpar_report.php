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
	<a href="<?php echo $link->link('advisor_activity',user);?>" class="btn btn-default"> Journals </a>
	<a href="<?php echo $link->link('advisor_activity',user);?>" class="btn btn-default"> Activity statements </a>
	<a href="<?php echo $link->link('advisor_tpar_report',user);?>" class="btn btn-primary">TPAR reports </a>


	<a data-toggle="modal" href="#add_tpar_report"  class="btn btn-default pull-right"> Add TPAR reports </a>

	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="<?php if ($current_tab=="All" || $current_tab==""){echo"active";}?>">
	                        <a  href="<?php echo $link->link('advisor_tpar_report',user,'&tab=All');?>"><i class="icon-comments"></i><span>All</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="Draft"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('advisor_tpar_report',user,'&tab=Draft');?>"><i class="icon-user"></i><span>Draft</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="Lodged"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('advisor_tpar_report',user,'&tab=Lodged');?>"><i class="icon-user"></i><span>Lodged</span></a>
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
					                    <th>
					                     Financial period
					                    </th>
					                    <th>
					                   Status
					                    </th>
					                    <th class="hidden-xs">
					                     Date lodged
					                    </th>
					                   <th class="hidden-xs">
					                      Is amendment?
					                    </th>
					                    <th>Reference</th></tr>

					                  </thead>
					                  <tbody>
					                    <tr>
					                    <td class="check hidden-xs">
					                        1
					                      </td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                     <td></td>
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

<!-- ------------------ Modal Box To add tpar--------------------- -->

                <div class="modal fade" id="add_tpar_report" >
                  <div class="modal-dialog" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title"><strong>Create TPAR Report</strong></h4>
                      </div>
                      <div class="modal-body">
                        <p>
                          <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
							 <div class="row">
							<div class="col-md-12">
							 <h4 class="modal-title"><strong>Create TPAR Report</strong></h4>
							 <br>
							 <br>
							<div class="form-group">
				 			<label class="control-label col-md-3">Reporting period
				 			</label>
				            <div class="col-md-9">
				            <select class="form-control" name="payment_term">
				             <option value="0" selected="selected"></option>
				           <option value="1">01/07/2011 - 30/06/2012</option>
				           <option value="2">01/07/2012 - 30/06/2013</option>
				           <option value="3">01/07/2012 - 30/06/2014</option>
				           <option value="4">01/07/2012 - 30/06/2015</option>
				           <option value="5">01/07/2012 - 30/06/2016</option>
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
