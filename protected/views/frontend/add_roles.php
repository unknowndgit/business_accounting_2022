

<?php
if (isset($_POST['submit'])) {
	//print_r($_POST);
	$role=$_POST['role'];
	$description=$_POST['description'];
	$dtd_bank_account=serialize($_POST['dtd_bank_account']);
	$dtd_transfer_money=serialize($_POST['dtd_transfer_money']);
	$dtd_bank_payment=serialize($_POST['dtd_bank_payment']);
	$dtd_estimate=serialize($_POST['dtd_estimate']);
	$dtd_invoice=serialize($_POST['dtd_invoice']);
	$dtd_adjustment_notes=serialize($_POST['dtd_adjustment_notes']);
	$dtd_receipt=serialize($_POST['dtd_receipt']);
	$dtd_bills=serialize($_POST['dtd_bills']);
	$dtd_supplier_adjustment_notes=serialize($_POST['dtd_supplier_adjustment_notes']);
	$dtd_payment=serialize($_POST['dtd_payment']);
	$dtd_projects=serialize($_POST['dtd_projects']);
	$dtd_items=serialize($_POST['dtd_items']);
	$dtd_timesheets=serialize($_POST['dtd_timesheets']);
	$dtd_expense_claims=serialize($_POST['dtd_expense_claims']);
	$rp_budgets=serialize($_POST['rp_budgets']);
	$fr_profit_and_loss=serialize($_POST['fr_profit_and_loss']);
	$fr_balance_sheet=serialize($_POST['fr_balance_sheet']);
	$fr_trial_balance=serialize($_POST['fr_trial_balance']);
	$fr_account_enquary=serialize($_POST['fr_account_enquary']);
	$tr_gst_summery=serialize($_POST['tr_gst_summery']);
	$tr_tax_code_transaction=serialize($_POST['tr_tax_code_transaction']);
	$cr_aged_debtors=serialize($_POST['cr_aged_debtors']);
	$cr_aged_debtor_transaction=serialize($_POST['cr_aged_debtor_transaction']);
	$cr_invoice_list=serialize($_POST['cr_invoice_list']);
	$cr_customer_transaction=serialize($_POST['cr_customer_transaction']);
	$sr_aged_creditors=serialize($_POST['sr_aged_creditors']);
	$sr_aged_creditors_transaction=serialize($_POST['sr_aged_creditors_transaction']);
	$sr_bill_list=serialize($_POST['sr_bill_list']);
	$sr_supplier_transaction=serialize($_POST['sr_supplier_transaction']);
	$ar_aged_debtor_summery=serialize($_POST['ar_aged_debtor_summery']);
	$ar_aged_creditor_summery=serialize($_POST['ar_aged_creditor_summery']);
	$ar_top_ten_customers=serialize($_POST['ar_top_ten_customers']);
	$ar_top_ten_suppliers=serialize($_POST['ar_top_ten_suppliers']);
	$ar_top_ten_income_accounts=serialize($_POST['ar_top_ten_income_accounts']);
	$ar_top_ten_expense_accounts=serialize($_POST['ar_top_ten_expense_accounts']);
	$ar_budget=serialize($_POST['ar_budget']);
	$lr_account_list=serialize($_POST['lr_account_list']);
	$lr_bank_account_list=serialize($_POST['lr_bank_account_list']);
	$lr_item_list=serialize($_POST['lr_item_list']);
	$lr_project_list=serialize($_POST['lr_project_list']);
	$lr_customer_list=serialize($_POST['lr_customer_list']);
	$lr_supplier_list=serialize($_POST['lr_supplier_list']);
	//$lr_employee_list=serialize($_POST['lr_employee_list']);
	$lr_tax_code_list=serialize($_POST['lr_tax_code_list']);
	$advr_journal_list=serialize($_POST['advr_journal_list']);
	$advr_payment_and_receipt=serialize($_POST['advr_payment_and_receipt']);
	$advr_bank_account_reconcilation=serialize($_POST['advr_bank_account_reconcilation']);
	$adv_journal=serialize($_POST['adv_journal']);
	$adv_activity_statement=serialize($_POST['adv_activity_statement']);
	$adv_tpar=serialize($_POST['adv_tpar']);
	$con_cintact=serialize($_POST['con_cintact']);
	$con_payroll_employee_details=serialize($_POST['con_payroll_employee_details']);
	$con_superfunds=serialize($_POST['con_superfunds']);
	/*$adm_accounts=serialize($_POST['adm_accounts']);
	$adm_users=serialize($_POST['adm_users']);
	$adm_roles=serialize($_POST['adm_roles']);
	$adm_book_settings=serialize($_POST['adm_book_settings']);
	$adm_selling_settigs=serialize($_POST['adm_selling_settigs']);
	$adm_payment_terms=serialize($_POST['adm_payment_terms']);
	$adm_buying_settings=serialize($_POST['adm_buying_settings']);
	$adm_time_and_expense_settings=serialize($_POST['adm_time_and_expense_settings']);
	$adm_email_settings=serialize($_POST['adm_email_settings']);
	$adm_email_history=serialize($_POST['adm_email_history']);
	$adm_report_settings=serialize($_POST['adm_report_settings']);
	$adm_tax_settings=serialize($_POST['adm_tax_settings']);
	$adm_payroll_items=serialize($_POST['adm_payroll_items']);
	$adm_payroll_settings=serialize($_POST['adm_payroll_settings']);*/
	$create_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];

		$insert=$db->insert('roles',array('role'=>$role,
											'description'=>$description,
											'dtd_bank_account'=>$dtd_bank_account,
											'dtd_transfer_money'=>$dtd_transfer_money,
		                                   'dtd_bank_payment'=>$dtd_bank_payment,
											'dtd_estimate'=>$dtd_estimate,
											'dtd_invoice'=>$dtd_invoice,
											'dtd_adjustment_notes'=>$dtd_adjustment_notes,
											'dtd_receipt'=>$dtd_receipt,
											'dtd_bills'=>$dtd_bills,
											'dtd_supplier_adjustment_notes'=>$dtd_supplier_adjustment_notes,
											'dtd_payment'=>$dtd_payment,
											'dtd_projects'=>$dtd_projects,
											'dtd_items'=>$dtd_items,
											//'dtd_timesheets'=>$dtd_timesheets,
											//'dtd_expense_claims'=>$dtd_expense_claims,
											'rp_budgets'=>$rp_budgets,
											'fr_profit_and_loss'=>$fr_profit_and_loss,
											'fr_balance_sheet'=>$fr_balance_sheet,
											'fr_trial_balance'=>$fr_trial_balance,
											'fr_account_enquary'=>$fr_account_enquary,
											'tr_gst_summery'=>$tr_gst_summery,
											'tr_tax_code_transaction'=>$tr_tax_code_transaction,
											//'cr_aged_debtors'=>$cr_aged_debtors,
											//'cr_aged_debtor_transaction'=>$cr_aged_debtor_transaction,
											'cr_invoice_list'=>$cr_invoice_list,
											'cr_customer_transaction'=>$cr_customer_transaction,
											//'sr_aged_creditors'=>$sr_aged_creditors,
											//'sr_aged_creditors_transaction'=>$sr_aged_creditors_transaction,
											'sr_bill_list'=>$sr_bill_list,
											'sr_supplier_transaction'=>$sr_supplier_transaction,
											//'ar_aged_debtor_summery'=>$ar_aged_debtor_summery,
											//'ar_aged_creditor_summery'=>$ar_aged_creditor_summery,
											//'ar_top_ten_customers'=>$ar_top_ten_customers,
											//'ar_top_ten_suppliers'=>$ar_top_ten_suppliers,
											//'ar_top_ten_income_accounts'=>$ar_top_ten_income_accounts,
											//'ar_top_ten_expense_accounts'=>$ar_top_ten_expense_accounts,
											//'ar_budget'=>$ar_budget,
											'lr_account_list'=>$lr_account_list,
											'lr_bank_account_list'=>$lr_bank_account_list,
											'lr_item_list'=>$lr_item_list,
											'lr_project_list'=>$lr_project_list,
											'lr_customer_list'=>$lr_customer_list,
											'lr_supplier_list'=>$lr_supplier_list,
											//'lr_employee_list'=>$lr_employee_list,
											'lr_tax_code_list'=>$lr_tax_code_list,
											'advr_journal_list'=>$advr_journal_list,
											'advr_payment_and_receipt'=>$advr_payment_and_receipt,
											'advr_bank_account_reconcilation'=>$advr_bank_account_reconcilation,
											'adv_journal'=>$adv_journal,
											'adv_activity_statement'=>$adv_activity_statement,
											//'adv_tpar'=>$adv_tpar,
											'con_cintact'=>$con_cintact,
											//'con_payroll_employee_details'=>$con_payroll_employee_details,
											//'con_superfunds'=>$con_superfunds,
											//'adm_accounts'=>$adm_accounts,
										//'adm_users'=>$adm_users,
											//'adm_roles'=>$adm_roles,
											//'adm_book_settings'=>$adm_book_settings,
											//'adm_selling_settigs'=>$adm_selling_settigs,
											//'adm_payment_terms'=>$adm_payment_terms,
											//'adm_buying_settings'=>$adm_buying_settings,
											//'adm_time_and_expense_settings'=>$adm_time_and_expense_settings,
											//'adm_email_settings'=>$adm_email_settings,
											//'adm_email_history'=>$adm_email_history,
											//'adm_report_settings'=>$adm_report_settings,
											//'adm_tax_settings'=>$adm_tax_settings,
											//'adm_payroll_items'=>$adm_payroll_items,
											//'adm_payroll_settings'=>$adm_payroll_settings,
											'create_date'=>$create_date,
											'ip_address'=>$ip_address,
			));
		if ($insert) {
		    $event="Add user role (" . $role . ")";
		    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
		        'event'=>$event,
		        'created_date'=>date('Y-m-d'),
		        'ip_address'=>$_SERVER['REMOTE_ADDR']

		    ));
			$display_msg= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button> Role is saved successfully.
                    		</div>';
			echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("user_roles",user)."'
        	                },3000);</script>";
		}

}
?>


<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
			<h3>USER AND ROLES</h3>
		</div>
		<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<form action="" class="form-horizontal" method="post" id="role_form">
        	<div class="row">
              <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading"></div>
                  <div class="widget-content">
                    <div class="panel-group" id="accordion">

                    <button class="btn btn-success" name="submit" type="submit">Save</button>

                    	<div class="form-group">
				            <label class="control-label col-md-2">Role name <span>*</span></label>
				            <div class="col-md-7">
				              <input class="form-control" placeholder="" type="text" name="role">
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="control-label col-md-2">Description</label>
				            <div class="col-md-7">
				              <input class="form-control" placeholder="" type="text" name="description">
				            </div>
				        </div>
				         <div class="form-group">
				            <label class="control-label col-md-2">Check All</label>
				            <div class="col-md-7">
				             <label class="checkbox-inline"><input type="checkbox" value="" id="select_all"></label>
				            </div>
				        </div>

                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
                              <div class="caret pull-right"></div>
                              1. DAY TO DAY</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse in" id="collapseOne">
                          <div class="panel-body">
                          	<div class="form-group">
					            <label class="control-label col-md-2">Bank Account</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="view"><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="import"><span>Import</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="perform_bank_reconcilation"><span>Print and email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Transfer Money</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_transfer_money[]" value="view"><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_transfer_money[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_transfer_money[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Bank Payment</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_payment[]" value="view"><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_payment[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_payment[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Estimate</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="view"><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="print_and_email"><span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Invoice</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="view"><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="approve"><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="print_and_email"><span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Adjustment notes</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="view"><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="approve"><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="print_and_email"><Span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Receipt</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_receipt[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_receipt[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_receipt[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Bill</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="approve"><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="print_and_email"><Span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Supplier adjustment notes</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="approve"><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="print"><span>Print</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Payments</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_payment[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_payment[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_payment[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Project</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_projects[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_projects[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_projects[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Items</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_items[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_items[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_items[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

					          <!-- <div class="form-group">
					            <label class="control-label col-md-2">Timesheets</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="manage"><span>Manage</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="print_and_email"><span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Expense claim</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="approve"><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="manage"><span>Manage</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="print_and_email"><span>Print and email</span></label>
					            </div>
					          </div> -->

                          </div>
                        </div>
                      </div>


    <!-- ========= 2. REPORTING	 ================== -->
                      <!-- <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
                              <div class="caret pull-right"></div>
                              2. REPORTING</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTwo">
                          <div class="panel-body">

                            <div class="form-group">
					            <label class="control-label col-md-2">Budget</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="rp_budgets[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="rp_budgets[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="rp_budgets[]" value="delete"><span>Delete</span></label>
					            </div>
					          </div>

                          </div>
                        </div>
                      </div> -->


    <!-- ========= 3. FINANCIAL REPORTS ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                              <div class="caret pull-right"></div>
                              2. FINANCIAL REPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree">
                          <div class="panel-body">

                          	<div class="form-group">
					            <label class="control-label col-md-2">Profit and loss</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_profit_and_loss[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_profit_and_loss[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Balance sheet</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_balance_sheet[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_balance_sheet[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Trial balancce</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_trial_balance[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_trial_balance[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Account enquary</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_account_enquary[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_account_enquary[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div>

    <!-- ========= 4. TAX REPORTS ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree4">
                              <div class="caret pull-right"></div>
                              3. TAX REPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree4">
                          <div class="panel-body">

                        	<div class="form-group">
					            <label class="control-label col-md-2">GST summery</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="tr_gst_summery[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="tr_gst_summery[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Tax code transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="tr_tax_code_transaction[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="tr_tax_code_transaction[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div>

<!-- ========= 5. CUSTOMER REPORTS ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree5">
                              <div class="caret pull-right"></div>
                              4. CUSTOMER REPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree5">
                          <div class="panel-body">

                        	<!-- <div class="form-group">
					            <label class="control-label col-md-2">Aged debtors</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtors[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtors[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Aged debtor trnsaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtor_transaction[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtor_transaction[]" value="export"><span>Export</span></label>
					            </div>
					        </div> -->

					        <div class="form-group">
					            <label class="control-label col-md-2">Invoice list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_invoice_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_invoice_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Customer transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_customer_transaction[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_customer_transaction[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div>

    <!-- ========= 6. SUPPLIER REPORTS ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree6">
                              <div class="caret pull-right"></div>
                              5. SUPPLIER REPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree6">
                          <div class="panel-body">

                        	<!-- <div class="form-group">
					            <label class="control-label col-md-2">Aged creditors</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Aged creditor trnsaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors_transaction[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors_transaction[]" value="export"><span>Export</span></label>
					            </div>
					        </div> -->

					        <div class="form-group">
					            <label class="control-label col-md-2">Bill list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_bill_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_bill_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Suplier transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_supplier_transaction[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_supplier_transaction[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div>

    <!-- ========= 7. ANALYTICS REPORTS ================== -->
                      <!-- <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree7">
                              <div class="caret pull-right"></div>
                              6. ANALYTICS REPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree7">
                          <div class="panel-body">

                        	<!-- <div class="form-group">
					            <label class="control-label col-md-2">Aged debtor summery</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_debtor_summery[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_debtor_summery[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Aged creditor summery</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_creditor_summery[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_creditor_summery[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Top 10 customers</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_customers[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_customers[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <!-- <div class="form-group">
					            <label class="control-label col-md-2">Top 10 supliers</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_suppliers[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_suppliers[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Top 10 income account</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_income_accounts[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_income_accounts[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Top 10 expense account</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_expense_accounts[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_expense_accounts[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Budgets</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_budget[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_budget[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div> -->

    <!-- ========= 8. LIST exportS ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree8">
                              <div class="caret pull-right"></div>
                              7. LIST EXPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree8">
                          <div class="panel-body">

                          	<div class="form-group">
					            <label class="control-label col-md-2">Account list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_account_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_account_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Bank account list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_bank_account_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_bank_account_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Item list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_item_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_item_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Project list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_project_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_project_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Customer list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_customer_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_customer_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Supplier list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_supplier_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_supplier_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>


					        <!-- <div class="form-group">
					            <label class="control-label col-md-2">Tax code list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_tax_code_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_tax_code_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div> -->

                          </div>
                        </div>
                      </div>

    <!-- ========= 9. ADVISOR REPORTS ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree9">
                              <div class="caret pull-right"></div>
                              8. ADVISOR REPORTS</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree9">
                          <div class="panel-body">

                          	<div class="form-group">
					            <label class="control-label col-md-2">Journal list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="advr_journal_list[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="advr_journal_list[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payment and receipt</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="advr_payment_and_receipt[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="advr_payment_and_receipt[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Bank account reconcilation</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="advr_bank_account_reconcilation[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="advr_bank_account_reconcilation[]" value="export"><span>Export</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div>

    <!-- ========= 10. ADVISOR ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree10">
                              <div class="caret pull-right"></div>
                              9. Advisor</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree10">
                          <div class="panel-body">

                          	<div class="form-group">
					            <label class="control-label col-md-2">Journals</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="approve"><span>Approve</span></label>
					            </div>
					        </div>

					        <!-- <div class="form-group">
					            <label class="control-label col-md-2">Activity statement</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="print_and_email"><span>Print and email</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="lodge_activity_statement"><span>Lodge activity statement</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">TPAR</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="delete"><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="print_and_email"><span>Print and email</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="lodge_tpar"><span>Lodge TPAR</span></label>
					            </div>
					        </div> -->

                          </div>
                        </div>
                      </div>

    <!-- ========= 11. CONTACT ================== -->
                      <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree11">
                              <div class="caret pull-right"></div>
                             10. CONTACT</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree11">
                          <div class="panel-body">

                            <div class="form-group">
					            <label class="control-label col-md-2">Cantacts</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="con_cintact[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_cintact[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_cintact[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div>

					       <!--  <div class="form-group">
					            <label class="control-label col-md-2">Payroll employee details</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="con_payroll_employee_details[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_payroll_employee_details[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_payroll_employee_details[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">SuperFunds</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="con_superfunds[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_superfunds[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_superfunds[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div> -->

                          </div>
                        </div>
                      </div>

    <!-- ========= 12. CONTACT ================== -->
                      <!-- <div class="panel">
                        <div class="panel-heading">
                          <div class="panel-title">
                            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree12">
                              <div class="caret pull-right"></div>
                              12. ADMINISTRATION</a>
                          </div>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree12">
                          <div class="panel-body">

                          	<div class="form-group">
					            <label class="control-label col-md-2">Accounts</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_accounts[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_accounts[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_accounts[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Users</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="create_and_edit"><span>Create and delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="edit_other_user_personal_details"><span>Edit other user personal details</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Roles</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_roles[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_roles[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_roles[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Book settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_book_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_book_settings[]" value="edit"><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Selling settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_selling_settigs[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_selling_settigs[]" value="edit"><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payment terms</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payment_terms[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payment_terms[]" value="create_and_edit"><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payment_terms[]" value="delete"><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Buying settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_buying_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_buying_settings[]" value="edit"><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Time and expense settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_time_and_expense_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_time_and_expense_settings[]" value="edit"><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Email settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_settings[]" value="edit"><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Email history</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_history[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_history[]" value="edit"><span>Resend</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Report settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_report_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_report_settings[]" value="edit"><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Tax settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_tax_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_tax_settings[]" value="edit"><span>Edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_tax_settings[]" value="delete_tax_code_and_group"><span>Delete tax code and group</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payroll Items</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_items[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_items[]" value="create_and_edit"><span>create and edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payroll settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_settings[]" value="view"><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_settings[]" value="create_and_edit"><span>Create and edit</span></label>
					            </div>
					        </div>

                          </div>
                        </div>
                      </div> -->


                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>

		</div>
	</div>
</div>
