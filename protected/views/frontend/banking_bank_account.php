

<?php

$current_tab=$_COOKIE['current_tab'];

if ($current_tab!="all" && $current_tab!="open" && $current_tab!="closed")
{	$current_tab="all";  }

?>
	  <div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>BANKING</h3></div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">

	<div class="col-lg-12">


	<a href="<?php echo $link->link('banking_bank_account',user);?>" class="btn btn-primary">Bank accounts</a>
	<a href="<?php echo $link->link('transfer_money',user);?>" class="btn btn-default">Transfer money</a>
	<!-- <a href="<?php echo $link->link('transaction_rules',user);?>" class="btn btn-default">Transaction rules</a> -->
	<a href="<?php echo $link->link('receive_money',user);?>" class="btn btn-default">Receive money </a>
 <?php if(in_array('create_and_edit',$dtd_bank_account)){?>
	 <a href="<?php echo $link->link('add_banking_bank_account',user);?>" class="btn btn-default pull-right"> Add Account</a>
<?php }?>

	<!-- <a href="<?php echo $link->link('banking_transfer_money',user);?>" class="btn <?php if ($query1ans=="banking_transfer_money"){echo "btn-primary";}else{echo "btn-default";}?>">Transfer money</a>
	<a href="<?php echo $link->link('banking_transaction_rules',user);?>" class="btn <?php if ($query1ans=="banking_transaction_rules"){echo "btn-primary";}else{echo "btn-default";}?>">Transaction rules</a>
	<a href="<?php echo $link->link('banking_bank_connections',user);?>" class="btn <?php if ($query1ans=="banking_bank_connections"){echo "btn-primary";}else{echo "btn-default";}?>">Bank connections</a>
	<a href="<?php echo $link->link('banking_bank_payments',user);?>" class="btn <?php if ($query1ans=="banking_bank_payments"){echo "btn-primary";}else{echo "btn-default";}?>">Bank payments</a>
   <a href="" class="btn btn-default pull-right"> Add </a> -->



	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                     <li tab="all"  class="set_cookie <?php if ($current_tab=="all" || $current_tab==""){echo"active";}?>">
	                        <a  href="#"><i class="icon-comments"></i><span>All</span></a>
	                      </li>
	                      <li tab="open"  class="set_cookie <?php if ($current_tab=="open" || $current_tab==""){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Open</span></a>
	                      </li>
	                      <li tab="closed"  class="set_cookie <?php if ($current_tab=="closed"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Closed</span></a>
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
					                    <th width="10%">S.no</th>
					                    <th width="30%">Bank Account Name</th>
					                    <th width="15%">Opening balance</th>
					                    <th width="15%">Current balance</th>
					                     <th width="10%">Status</th>
                                         <th width="20%">Action</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  <?php $all_bank_accounts=$db->get_all('accounts',array('account_type'=>'bank'));
					                  if (is_array($all_bank_accounts)){
					                      $sn=1;
					                      foreach ($all_bank_accounts as $allba)
					                      {?>
					                    <tr>
					                      <td><?php echo $sn;?></td>
					                      <td><?php echo $allba['account_name'];?></td>
					                      <td><?php echo CURRENCY." ".number_format($allba['opening_balance'],2,'.',',') ;?></td>
					                      <td <?php if ($allba['current_balance']<0){echo "style='color:red'";}?>><?php echo CURRENCY." ".number_format($allba['current_balance'],2,'.',',') ;?></td>
					                      <td><?php echo ucfirst($allba['visibility_status']);?></td>


					                       <td>

					                       <!--<div class="action-buttons">
					                           <a class="table-actions" href="<?php echo $link->link('transaction_rules',user,'&action_delete='.$rule['id']);?>"><i class="lnr lnr-trash" style="color:red;"></i></a>
			                              </div>-->

			                          <?php if (!empty($dtd_bank_account)){?>
			                              <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
										<?php if(in_array('create_and_edit',$dtd_bank_account)){?>
                                            <li>
                                            <a class="table-actions" href="<?php echo $link->link('edit_banking_bank_account',user,'&edit_bank_account='.$allba['id']);?>">Edit</a>
                                              </li>
										<?php }if(in_array('view',$dtd_bank_account) || in_array('create_and_edit',$dtd_bank_account)){?>
                                              <li>
                                            <a class="table-actions" href="<?php echo $link->link('bank_transactions',user,'&bank_account='.$allba['id']);?>">New Transctions</a>
                                              </li>
                                        <?php }?>

                                            </ul>
                                          </div>

			                            <?php }?></td>

                          				</tr>

					                <?php  $sn++;}} ?>
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
<script>
      $(".set_cookie").click(function(){
          var tab=$(this).attr('tab');
        //  alert(tab);

          var ct=document.cookie = "current_tab="+tab;
          window.location.href="";

          });</script>