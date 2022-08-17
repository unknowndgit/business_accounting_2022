<?php if (isset($_REQUEST['report_type']))
{
    $report_type=$_REQUEST['report_type'];
}?>
<div class="row">
	<div class="col-lg-12">
	<div class="padded" >
	<h3>REPORTS CENTRE</h3>
	</div>

    	<div class="widget-container fluid-height">
        	 <div class="widget-content padded">
  <div class="row">
          <div class="col-md-3">
                                  <div class="panel filter-categories">
                                    <div class="panel-heading">

                                    </div>




                                       <a href="<?php echo $link->link('reports',user,'&report_type=financial');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="financial" || $report_type==""){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>Financial
                                      </a>
                                      <?php if (IS_GST_REGISTERED=="yes"){?>
                                       <a href="<?php echo $link->link('reports',user,'&report_type=tax');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="tax"){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>Tax
                                      </a>
                                      <?php }?>
                                         <a href="<?php echo $link->link('reports',user,'&report_type=customer');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="customer"){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>Customer
                                      </a>
                                         <a href="<?php echo $link->link('reports',user,'&report_type=supplier');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="supplier"){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>Supplier
                                      </a>
                                        <!-- <a href="<?php echo $link->link('reports',user,'&report_type=analytics');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="analytics"){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>Analytics
                                      </a>  -->
                                         <a href="<?php echo $link->link('reports',user,'&report_type=list');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="list"){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>List
                                      </a>
                                   <a href="<?php echo $link->link('reports',user,'&report_type=advisor');?>" class="btn btn-block btn-default-outline <?php if ($report_type=="advisor"){echo'active';}?>">
                                         <i class="fa fa-gamepad"></i>Advisor
                                      </a>


                                  </div>
                                  </div>
                                  <div class="col-md-9">
                                  <?php if ($report_type=="financial" || $report_type==""){?>
                                 <div class="row">
                                 <?php if (in_array('view',$fr_profit_and_loss)){?>
                                <div class="col-md-3" style="padding: 19px;">
                                  <div class="well">
                                    <strong>PROFIT AND LOSS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                This shows income vs expenditure for a given period.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                     <br>
                                    <a href="<?php echo $link->link('report_profit_loss',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$fr_balance_sheet)){?>
                                <div class="col-md-3" style="padding: 19px;">
                                  <div class="well">
                                    <strong>BALANCE SHEET<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                  This shows the status of the businesses assets, liabilities and equity.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_balance_sheet',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$fr_trial_balance)){?>
                                <div class="col-md-3" style="padding: 19px;">
                                  <div class="well">
                                    <strong>TRIAL BALANCE<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                   This shows balances for all used accounts.
                                   This report is useful when investigating data entry errors.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_trial_bal',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$fr_account_enquary)){?>
                                <div class="col-md-3" style="padding: 19px;">
                                  <div class="well">
                                    <strong>GENERAL LEDGER<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                    The payment schedule report shows the breakdown of net pay by employee bank account.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_account_enquiry',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>
                                  </div>
                                  <?php }elseif ($report_type=="tax"){?>
                                    <div class="row">
                                    <!-- ---=== Tax Report Section ---- -->
                                   <?php if (in_array('view',$tr_gst_summery)){?>
                                   <div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>GST SUMMARY<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows tax amounts by GST category.
		                                   <br>
		                                   This report can be used to help prepare your BAS.
		                                   </p>
		                                    <br> <br>
		                                    <a href="<?php echo $link->link('report_gst_summary',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	  <div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>GST F5 SUMMARY<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows tax amounts by GST category.
		                                   <br>
		                                   This report can be used to help prepare your BAS.
		                                   </p>
		                                    <br> <br>
		                                    <a href="<?php echo $link->link('report_gstf5',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
									<?php }?>
									<?php if (in_array('view',$tr_tax_code_transaction)){?>
                                	<div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>TAX CODE TRANSACTIONS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows the transactions assigned to each tax code for a given period.</p>
		                                    <br> <br><br>
		                                    <a href="<?php echo $link->link('report_tax_code_transaction',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
									<?php }?>
                                     </div>
                                   <?php }
                                   elseif ($report_type=="customer"){?>


       <!-- ---=== Customer Report Section ---- -->
       								<?php if (in_array('view',$cr_invoice_list)){?>
                                   <div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>INVOICE LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows invoices issued to customers.</p>
		                                    <br> <br><br> <br>
		                                    <a href="<?php echo $link->link('report_invoice_list',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	<?php }?>
									<?php if (in_array('view',$cr_customer_transaction)){?>
                                	<div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>CUSTOMER TRANSACTIONS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows all entered transactions for selected customers in a given period.</p>
		                                    <br> <br><br>
		                                    <a href="<?php echo $link->link('report_customer_transaction',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	<?php }?>
                                	<?php if (in_array('view',$cr_invoice_list)){?>
                                	<div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>UNPAID INVOICE<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows invoices your customers have not fully paid.</p>
		                                    <br> <br><br> <br>
		                                    <a href="<?php echo $link->link('report_unpaid_invoice',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	<?php }?>
                                   <?php }elseif ($report_type=="supplier"){?>

					<!-- ---=== Supplier Report Section ---- -->
									<?php if (in_array('view',$sr_bill_list)){?>
                                   <div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>BILL LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows bills received from suppliers.</p>
		                                    <br> <br><br> <br>
		                                    <a href="<?php echo $link->link('report_bill_list',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	<?php }?>
									<?php if (in_array('view',$sr_supplier_transaction)){?>
                                	<div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>SUPPLIER TRANSACTIONS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows all entered transactions for selected suppliers in a given period.</p>
		                                    <br> <br><br>
		                                    <a href="<?php echo $link->link('report_supplier_transaction',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
									<?php }?>
									<?php if (in_array('view',$sr_bill_list)){?>
                                	<div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>UNPAID BILLS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows bills you have not fully paid.</p>
		                                    <br> <br><br> <br>
		                                    <a href="<?php echo $link->link('report_unpaid_bills',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	<?php }?>

                                   <?php }elseif ($report_type=="analytics"){?>

           <!-- ---=== Analytics Report Section ---- -->
           						<?php if (in_array('view',$ar_top_ten_customers)){?>
                                   <div class="col-md-3" style="padding: 19px;">
                                  		<div class="well">
                                    		<strong>TOP 10 CUSTOMERS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
		                                    <br><br><br>
		                                   <p>This shows which of your customers paid you the most money for a given period.</p>
		                                    <br> <br><br> <br>
		                                    <a href="<?php echo $link->link('report_top_customers',user);?>" class="btn btn-default">Generate</a>
		                                 </div>
                                	</div>
                                	<?php }?>

                                 <!--  <div class="row">
                                <div class="col-md-3" style="padding: 19px;">
                                  <div class="well">
                                    <strong>TOP 10 INCOME ACCOUNTS<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                               This shows the income accounts that have the most money transacted to them for a given period. This report can help identify your main income sources.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                     <br>
                                    <a href="<?php echo $link->link('report_income_account',user);?>" class="btn btn-default">Generate</a>
                                 </div>

                                </div>
                                </div>-->
                                   <?php }elseif ($report_type=="list"){?>

                                   <div class="row">
                                   <?php if (in_array('view',$lr_account_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>ACCOUNT LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                               This shows the details of the accounts used in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_account_list',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$lr_bank_account_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                     <strong>BANK ACCOUNT LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                              This shows the details of each of the bank accounts set up in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_bank_account_list',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$lr_item_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>ITEM LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                   This shows the details of the chargeable items configured in this book.
                                    </p>
                                    <br>
                                    <br>

                                    <a href="<?php echo $link->link('report_item_list',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$lr_project_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>PROJECT LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                    This shows the details of the projects configured in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_project_list',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>
                                  </div>

                                   <div class="row">
                                <?php if (in_array('view',$lr_customer_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>CUSTOMER LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                              This shows the details of your customers entered in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>

                                    <a href="<?php echo $link->link('report_customer_list',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$lr_supplier_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>SUPPLIER LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                             This shows the details of your suppliers entered in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_supplier_list',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }?>

                                <?php if (IS_GST_REGISTERED=="yes"){?>
                                <?php if (in_array('view',$lr_tax_code_list)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>TAX CODE LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                   This shows the details of the tax codes used in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_tax_code_list',user);?>" class="btn btn-default">Generate</a>
                                  </div>
                                </div>
                                <?php }}?>

                                  </div>
                           <?php }elseif ($report_type=="advisor"){?>
                                      <div class="row">
                                <?php if (in_array('view',$advr_payment_and_receipt)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>PAYMENT LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                             This shows the payment (money-out) transactions entered in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>

                                    <a href="<?php echo $link->link('report_payment_list',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$advr_payment_and_receipt)){?>
                                 <div class="col-md-3">
                                  <div class="well">
                                    <strong>RECEIPT LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                              This shows the receipt (money-in) transactions entered in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>

                                    <a href="<?php echo $link->link('report_receipt_list',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
                                <?php if (in_array('view',$advr_journal_list)){?>
                                 <div class="col-md-3">
                                  <div class="well">
                                    <strong>JOURNAL LIST<font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                              This shows the details of the journals entered in this book.
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_journal_list',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
								<?php if (in_array('view',$advr_bank_account_reconcilation)){?>
                                <div class="col-md-3">
                                  <div class="well">
                                    <strong>BANK RECONCILATION <font color="green"><i class="lnr lnr-heart pull-right"></i></font></strong>
                                    <br>
                                    <br>
                                    <br>
                                   <p>
                                   This shows the reconciliation of your bank account
                                    </p>
                                    <br>
                                    <br>
                                    <br>
                                    <a href="<?php echo $link->link('report_bank_reconciliation',user);?>" class="btn btn-default">Generate</a>
                                 </div>
                                </div>
                                <?php }?>
                             </div>
                          <?php }?>

 </div>
</div>


                      <br>







            </div>
        </div>
    </div>
</div>
