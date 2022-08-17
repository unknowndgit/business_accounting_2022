

<?php
if (isset($_REQUEST['action_edit'])){
    $role_id=$_REQUEST['action_edit'];
    $role_detail=$db->get_row('roles',array('id'=>$role_id));
    //print_r($contact_detail);
    $dtd_bank_account=unserialize($role_detail['dtd_bank_account']);

    $dtd_transfer_money=unserialize($role_detail['dtd_transfer_money']);
    $dtd_bank_payment=unserialize($role_detail['dtd_bank_payment']);
    //print_r($dtd_bank_payment);
    $dtd_estimate=unserialize($role_detail['dtd_estimate']);
    $dtd_invoice = unserialize($role_detail['dtd_invoice']);
    $dtd_adjustment_notes = unserialize($role_detail['dtd_adjustment_notes']);
    $dtd_receipt = unserialize($role_detail['dtd_receipt']);
    $dtd_bills = unserialize($role_detail['dtd_bills']);
    $dtd_supplier_adjustment_notes = unserialize($role_detail['dtd_supplier_adjustment_notes']);
    $dtd_payment = unserialize($role_detail['dtd_payment']);
    $dtd_projects = unserialize($role_detail['dtd_projects']);
    $dtd_items = unserialize($role_detail['dtd_items']);
    $dtd_timesheets=unserialize($role_detail['dtd_timesheets']);
    $dtd_expense_claims=unserialize($role_detail['dtd_expense_claims']);
    $rp_budgets=unserialize($role_detail['rp_budgets']);
    $fr_profit_and_loss=unserialize($role_detail['fr_profit_and_loss']);
    $fr_balance_sheet=unserialize($role_detail['fr_balance_sheet']);
    $fr_trial_balance=unserialize($role_detail['fr_trial_balance']);
    $fr_account_enquary=unserialize($role_detail['fr_account_enquary']);
    $tr_gst_summery=unserialize($role_detail['tr_gst_summery']);
    $tr_tax_code_transaction=unserialize($role_detail['tr_tax_code_transaction']);
    $cr_aged_debtors=unserialize($role_detail['cr_aged_debtors']);
    $cr_aged_debtor_transaction=unserialize($role_detail['cr_aged_debtor_transaction']);
    $cr_invoice_list=unserialize($role_detail['cr_invoice_list']);
    $cr_customer_transaction=unserialize($role_detail['cr_customer_transaction']);
    $sr_aged_creditors=unserialize($role_detail['sr_aged_creditors']);
    $sr_aged_creditors_transaction=unserialize($role_detail['sr_aged_creditors_transaction']);
    $sr_bill_list=unserialize($role_detail['sr_bill_list']);
    $sr_supplier_transaction=unserialize($role_detail['sr_supplier_transaction']);
    $ar_aged_debtor_summery=unserialize($role_detail['ar_aged_debtor_summery']);
    $ar_aged_creditor_summery=unserialize($role_detail['ar_aged_creditor_summery']);
    $ar_top_ten_customers=unserialize($role_detail['ar_top_ten_customers']);
    $ar_top_ten_suppliers=unserialize($role_detail['ar_top_ten_suppliers']);
    $ar_top_ten_income_accounts=unserialize($role_detail['ar_top_ten_income_accounts']);
    $ar_top_ten_expense_accounts=unserialize($role_detail['ar_top_ten_expense_accounts']);
    $ar_budget=unserialize($role_detail['ar_budget']);
    $lr_account_list=unserialize($role_detail['lr_account_list']);
    $lr_bank_account_list=unserialize($role_detail['lr_bank_account_list']);
    $lr_item_list=unserialize($role_detail['lr_item_list']);
    $lr_project_list=unserialize($role_detail['lr_project_list']);
    $lr_customer_list=unserialize($role_detail['lr_customer_list']);
    $lr_supplier_list=unserialize($role_detail['lr_supplier_list']);
   // $lr_employee_list=unserialize($role_detail['lr_employee_list']);
    $lr_tax_code_list=unserialize($role_detail['lr_tax_code_list']);
    $advr_journal_list=unserialize($role_detail['advr_journal_list']);
    $advr_payment_and_receipt=unserialize($role_detail['advr_payment_and_receipt']);
    $advr_bank_account_reconcilation=unserialize($role_detail['advr_bank_account_reconcilation']);
    $adv_journal=unserialize($role_detail['adv_journal']);
    $adv_activity_statement=unserialize($role_detail['adv_activity_statement']);
    $adv_tpar=unserialize($role_detail['adv_tpar']);
    $con_cintact=unserialize($role_detail['con_cintact']);
    $con_payroll_employee_details=unserialize($role_detail['con_payroll_employee_details']);
    $con_superfunds=unserialize($role_detail['con_superfunds']);
    $adm_accounts=unserialize($role_detail['adm_accounts']);
    $adm_users=unserialize($role_detail['adm_users']);
    $adm_roles=unserialize($role_detail['adm_roles']);
    $adm_book_settings=unserialize($role_detail['adm_book_settings']);
    $adm_selling_settigs=unserialize($role_detail['adm_selling_settigs']);
    $adm_payment_terms=unserialize($role_detail['adm_payment_terms']);
    $adm_buying_settings=unserialize($role_detail['adm_buying_settings']);
    $adm_time_and_expense_settings=unserialize($role_detail['adm_time_and_expense_settings']);
    $adm_email_settings=unserialize($role_detail['adm_email_settings']);
    $adm_email_history=unserialize($role_detail['adm_email_history']);
    $adm_report_settings=unserialize($role_detail['adm_report_settings']);
    $adm_tax_settings=unserialize($role_detail['adm_tax_settings']);
    $adm_payroll_items=unserialize($role_detail['adm_payroll_items']);
    $adm_payroll_settings=unserialize($role_detail['adm_payroll_settings']);
}


if (isset($_POST['submit'])) {
	//print_r($_POST);
	//$role=$_POST['role'];
	//$description=$_POST['description'];
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
	$adm_accounts=serialize($_POST['adm_accounts']);
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
	$adm_payroll_settings=serialize($_POST['adm_payroll_settings']);
	$create_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];

		$update=$db->update('roles',array(//'role'=>$role,
											//'description'=>$description,
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
			),array('id'=>$role_id));
		if ($update) {
		    $role_name=$db->get_var('roles',array('id'=>$role_id),'role');
		    $event="Edit user role (" . $role_name . ")";
		    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
		        'event'=>$event,
		        'created_date'=>date('Y-m-d'),
		        'ip_address'=>$_SERVER['REMOTE_ADDR']

		    ));
			$display_msg= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button> Role is updated successfully.
                    		</div>';
			echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("user_roles",user)."'
        	                },3000);</script>";
			/*echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("edit_role",user,'&action_edit='.$role_id)."'
        	                },10);</script>";*/
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



                    	<div class="form-group">
				            <label class="control-label col-md-2">Role name <span>*</span></label>
				            <div class="col-md-7">
				              <input class="form-control" placeholder="" type="text" name="role" value="<?php echo $role_detail['role'];?>" disabled>
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="control-label col-md-2">Description</label>
				            <div class="col-md-7">
				              <input class="form-control" placeholder="" type="text" name="description" value="<?php echo $role_detail['description'];?>" disabled>
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="control-label col-md-2">Check All</label>
				            <div class="col-md-7">
				             <label class="checkbox-inline"><input type="checkbox" value="" id="select_all"></label>
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="control-label col-md-2"></label>
				            <div class="col-md-7">
				             <button class="btn btn-success btn-block" name="submit" type="submit">Save</button>
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
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="view" <?php if(in_array('view',$dtd_bank_account)) {echo 'checked'; }?>><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_bank_account)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="delete" <?php if(in_array('delete',$dtd_bank_account)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="import" <?php if(in_array('import',$dtd_bank_account)) {echo 'checked'; }?>><span>Import</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_account[]" value="perform_bank_reconcilation" <?php if(in_array('perform_bank_reconcilation', $dtd_bank_account)) {echo 'checked'; }?>><span>Print and email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Transfer Money</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_transfer_money[]" value="view" <?php if(in_array('view',$dtd_transfer_money)) {echo 'checked'; }?> ><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_transfer_money[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_transfer_money)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_transfer_money[]" value="delete" <?php if(in_array('delete',$dtd_transfer_money)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Bank Payment</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_payment[]" value="view" <?php if(in_array('view',$dtd_bank_payment)) {echo 'checked'; }?>><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_payment[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_bank_payment)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bank_payment[]" value="delete" <?php if(in_array('delete',$dtd_bank_payment)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Estimate</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="view" <?php if(in_array('view',$dtd_estimate)) {echo 'checked'; }?>><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_estimate)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="delete" <?php if(in_array('delete',$dtd_estimate)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_estimate[]" value="print_and_email" <?php if(in_array('print_and_email',$dtd_estimate)) {echo 'checked'; }?>><span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Invoice</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="view" <?php if(in_array('view',$dtd_invoice)) {echo 'checked'; }?>><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_invoice)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="delete" <?php if(in_array('delete',$dtd_invoice)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="approve" <?php if(in_array('approve',$dtd_invoice)) {echo 'checked'; }?>><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_invoice[]" value="print_and_email" <?php if(in_array('print_and_email',$dtd_invoice)) {echo 'checked'; }?>><span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Adjustment notes</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="view" <?php if(in_array('view',$dtd_adjustment_notes)) {echo 'checked'; }?> ><span>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_adjustment_notes)) {echo 'checked'; }?> ><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="delete" <?php if(in_array('delete',$dtd_adjustment_notes)) {echo 'checked'; }?> ><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="approve" <?php if(in_array('approve',$dtd_adjustment_notes)) {echo 'checked'; }?> ><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_adjustment_notes[]" value="print_and_email" <?php if(in_array('print_and_email',$dtd_adjustment_notes)) {echo 'checked'; }?> ><Span>Print and email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Receipt</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_receipt[]" value="view" <?php if(in_array('view',$dtd_receipt)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_receipt[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_receipt)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_receipt[]" value="delete" <?php if(in_array('delete',$dtd_receipt)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Bill</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="view" <?php if(in_array('view',$dtd_bills)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_bills)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="delete" <?php if(in_array('delete',$dtd_bills)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="approve" <?php if(in_array('approve',$dtd_bills)) {echo 'checked'; }?>><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_bills[]" value="print_and_email" <?php if(in_array('print_and_email',$dtd_bills)) {echo 'checked'; }?>><Span>Print and Email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Supplier adjustment notes</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="view" <?php if(in_array('view',$dtd_supplier_adjustment_notes)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_supplier_adjustment_notes)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="delete" <?php if(in_array('delete',$dtd_supplier_adjustment_notes)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="approve" <?php if(in_array('approve',$dtd_supplier_adjustment_notes)) {echo 'checked'; }?>><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_supplier_adjustment_notes[]" value="print" <?php if(in_array('print',$dtd_supplier_adjustment_notes)) {echo 'checked'; }?>><span>Print</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Payments</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_payment[]" value="view" <?php if(in_array('view',$dtd_payment)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_payment[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_payment)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_payment[]" value="delete" <?php if(in_array('delete',$dtd_payment)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Project</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_projects[]" value="view" <?php if(in_array('view',$dtd_projects)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_projects[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_projects)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_projects[]" value="delete" <?php if(in_array('delete',$dtd_projects)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Items</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_items[]" value="view" <?php if(in_array('view',$dtd_items)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_items[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_items)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_items[]" value="delete" <?php if(in_array('delete',$dtd_items)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					          </div>

					          <!-- <div class="form-group">
					            <label class="control-label col-md-2">Timesheets</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="view" <?php if(in_array('view',$dtd_timesheets)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_timesheets)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="delete" <?php if(in_array('delete',$dtd_timesheets)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="manage" <?php if(in_array('manage',$dtd_timesheets)) {echo 'checked'; }?>><span>Manage</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_timesheets[]" value="print_and_email" <?php if(in_array('print_and_email',$dtd_timesheets)) {echo 'checked'; }?>><span>Print and email</span></label>
					            </div>
					          </div>

					          <div class="form-group">
					            <label class="control-label col-md-2">Expense claim</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="view" <?php if(in_array('view',$dtd_expense_claims)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="create_and_edit" <?php if(in_array('create_and_edit',$dtd_expense_claims)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="delete" <?php if(in_array('delete',$dtd_expense_claims)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="approve" <?php if(in_array('approve',$dtd_expense_claims)) {echo 'checked'; }?>><span>Approve</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="manage" <?php if(in_array('manage',$dtd_expense_claims)) {echo 'checked'; }?>><span>Manage</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="dtd_expense_claims[]" value="print_and_email" <?php if(in_array('print_and_email',$dtd_expense_claims)) {echo 'checked'; }?>><span>Print and email</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="rp_budgets[]" value="view" <?php if(in_array('view',$rp_budgets)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="rp_budgets[]" value="create_and_edit" <?php if(in_array('create_and_edit',$rp_budgets)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="rp_budgets[]" value="delete" <?php if(in_array('delete',$rp_budgets)) {echo 'checked'; }?>><span>Delete</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="fr_profit_and_loss[]" value="view" <?php if(in_array('view',$fr_profit_and_loss)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_profit_and_loss[]" value="export" <?php if(in_array('export',$fr_profit_and_loss)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Balance sheet</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_balance_sheet[]" value="view" <?php if(in_array('view',$fr_balance_sheet)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_balance_sheet[]" value="export" <?php if(in_array('export',$fr_balance_sheet)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Trial balancce</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_trial_balance[]" value="view" <?php if(in_array('view',$fr_trial_balance)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_trial_balance[]" value="export" <?php if(in_array('export',$fr_trial_balance)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Account enquary</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="fr_account_enquary[]" value="view" <?php if(in_array('view',$fr_account_enquary)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="fr_account_enquary[]" value="export" <?php if(in_array('export',$fr_account_enquary)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="tr_gst_summery[]" value="view" <?php if(in_array('view',$tr_gst_summery)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="tr_gst_summery[]" value="export" <?php if(in_array('export',$tr_gst_summery)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Tax code transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="tr_tax_code_transaction[]" value="view" <?php if(in_array('view',$tr_tax_code_transaction)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="tr_tax_code_transaction[]" value="export" <?php if(in_array('export',$tr_tax_code_transaction)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtors[]" value="view" <?php if(in_array('view',$cr_aged_debtors)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtors[]" value="export" <?php if(in_array('export',$cr_aged_debtors)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Aged debtor transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtor_transaction[]" value="view" <?php if(in_array('view',$cr_aged_debtor_transaction)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_aged_debtor_transaction[]" value="export" <?php if(in_array('export',$cr_aged_debtor_transaction)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div> -->

					        <div class="form-group">
					            <label class="control-label col-md-2">Invoice list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_invoice_list[]" value="view" <?php if(in_array('view',$cr_invoice_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_invoice_list[]" value="export" <?php if(in_array('export',$cr_invoice_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Customer transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="cr_customer_transaction[]" value="view" <?php if(in_array('view',$cr_customer_transaction)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="cr_customer_transaction[]" value="export" <?php if(in_array('export',$cr_customer_transaction)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors[]" value="view" <?php if(in_array('view',$sr_aged_creditors)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors[]" value="export" <?php if(in_array('export',$sr_aged_creditors)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Aged creditor transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors_transaction[]" value="view" <?php if(in_array('view',$sr_aged_creditors_transaction)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_aged_creditors_transaction[]" value="export" <?php if(in_array('export',$sr_aged_creditors_transaction)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div> -->

					        <div class="form-group">
					            <label class="control-label col-md-2">Bill list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_bill_list[]" value="view" <?php if(in_array('view',$sr_bill_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_bill_list[]" value="export" <?php if(in_array('export',$sr_bill_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Suplier transaction</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="sr_supplier_transaction[]" value="view" <?php if(in_array('view',$sr_supplier_transaction)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="sr_supplier_transaction[]" value="export" <?php if(in_array('export',$sr_supplier_transaction)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_debtor_summery[]" value="view" <?php if(in_array('view',$ar_aged_debtor_summery)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_debtor_summery[]" value="export" <?php if(in_array('export',$ar_aged_debtor_summery)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Aged creditor summery</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_creditor_summery[]" value="view" <?php if(in_array('view',$ar_aged_creditor_summery)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_aged_creditor_summery[]" value="export" <?php if(in_array('export',$ar_aged_creditor_summery)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Top 10 customers</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_customers[]" value="view" <?php if(in_array('view',$ar_top_ten_customers)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_customers[]" value="export" <?php if(in_array('export',$ar_top_ten_customers)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <!-- <div class="form-group">
					            <label class="control-label col-md-2">Top 10 supliers</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_suppliers[]" value="view" <?php if(in_array('view',$ar_top_ten_suppliers)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_suppliers[]" value="export" <?php if(in_array('export',$ar_top_ten_suppliers)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Top 10 income account</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_income_accounts[]" value="view" <?php if(in_array('view',$ar_top_ten_income_accounts)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_income_accounts[]" value="export" <?php if(in_array('export',$ar_top_ten_income_accounts)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Top 10 expense account</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_expense_accounts[]" value="view" <?php if(in_array('view',$ar_top_ten_expense_accounts)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_top_ten_expense_accounts[]" value="export" <?php if(in_array('export',$ar_top_ten_expense_accounts)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Budgets</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="ar_budget[]" value="view" <?php if(in_array('view',$ar_budget)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="ar_budget[]" value="export" <?php if(in_array('export',$ar_budget)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="lr_account_list[]" value="view" <?php if(in_array('view',$lr_account_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_account_list[]" value="export" <?php if(in_array('export',$lr_account_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Bank account list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_bank_account_list[]" value="view" <?php if(in_array('view',$lr_bank_account_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_bank_account_list[]" value="export" <?php if(in_array('export',$lr_bank_account_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Item list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_item_list[]" value="view" <?php if(in_array('view',$lr_item_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_item_list[]" value="export" <?php if(in_array('export',$lr_item_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Project list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_project_list[]" value="view" <?php if(in_array('view',$lr_project_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_project_list[]" value="export" <?php if(in_array('export',$lr_project_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Customer list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_customer_list[]" value="view" <?php if(in_array('view',$lr_customer_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_customer_list[]" value="export" <?php if(in_array('export',$lr_customer_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Supplier list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_supplier_list[]" value="view" <?php if(in_array('view',$lr_supplier_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_supplier_list[]" value="export" <?php if(in_array('export',$lr_supplier_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>


					        <!-- <div class="form-group">
					            <label class="control-label col-md-2">Tax code list</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="lr_tax_code_list[]" value="view" <?php if(in_array('view',$lr_tax_code_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="lr_tax_code_list[]" value="export" <?php if(in_array('export',$lr_tax_code_list)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="advr_journal_list[]" value="view" <?php if(in_array('view',$advr_journal_list)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="advr_journal_list[]" value="export" <?php if(in_array('export',$advr_journal_list)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payment and receipt</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="advr_payment_and_receipt[]" value="view" <?php if(in_array('view',$advr_payment_and_receipt)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="advr_payment_and_receipt[]" value="export" <?php if(in_array('export',$advr_payment_and_receipt)) {echo 'checked'; }?>><span>Export</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Bank account reconcilation</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="advr_bank_account_reconcilation[]" value="view" <?php if(in_array('view',$advr_bank_account_reconcilation)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="advr_bank_account_reconcilation[]" value="export" <?php if(in_array('export',$advr_bank_account_reconcilation)) {echo 'checked'; }?>><span>Export</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="view" <?php if(in_array('view',$adv_journal)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adv_journal)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="delete" <?php if(in_array('delete',$adv_journal)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_journal[]" value="approve" <?php if(in_array('approve',$adv_journal)) {echo 'checked'; }?>><span>Approve</span></label>
					            </div>
					        </div>

					        <!-- <div class="form-group">
					            <label class="control-label col-md-2">Activity statement</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="view" <?php if(in_array('view',$adv_activity_statement)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adv_activity_statement)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="delete" <?php if(in_array('delete',$adv_activity_statement)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="print_and_email" <?php if(in_array('print_and_email',$adv_activity_statement)) {echo 'checked'; }?>><span>Print and email</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_activity_statement[]" value="lodge_activity_statement" <?php if(in_array('lodge_activity_statement',$adv_activity_statement)) {echo 'checked'; }?>><span>Lodge activity statement</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">TPAR</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="view" <?php if(in_array('view',$adv_tpar)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adv_tpar)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="delete" <?php if(in_array('delete',$adv_tpar)) {echo 'checked'; }?>><span>Delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="print_and_email" <?php if(in_array('print_and_email',$adv_tpar)) {echo 'checked'; }?>><span>Print and email</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adv_tpar[]" value="lodge_tpar" <?php if(in_array('lodge_tpar',$adv_tpar)) {echo 'checked'; }?>><span>Lodge TPAR</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="con_cintact[]" value="view" <?php if(in_array('view',$con_cintact)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_cintact[]" value="create_and_edit" <?php if(in_array('create_and_edit',$con_cintact)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_cintact[]" value="delete"  <?php if(in_array('delete',$con_cintact)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					        </div>

					       <!--  <div class="form-group">
					            <label class="control-label col-md-2">Payroll employee details</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="con_payroll_employee_details[]" value="view" <?php if(in_array('view',$con_payroll_employee_details)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_payroll_employee_details[]" value="create_and_edit" <?php if(in_array('create_and_edit',$con_payroll_employee_details)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_payroll_employee_details[]" value="delete" <?php if(in_array('delete',$con_payroll_employee_details)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">SuperFunds</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="con_superfunds[]" value="view" <?php if(in_array('view',$con_superfunds)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_superfunds[]" value="create_and_edit" <?php if(in_array('create_and_edit',$con_superfunds)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="con_superfunds[]" value="delete" <?php if(in_array('delete',$con_superfunds)) {echo 'checked'; }?>><span>Delete</span></label>
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
					              <label class="checkbox-inline"><input type="checkbox" name="adm_accounts[]" value="view" <?php if(in_array('view',$adm_accounts)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_accounts[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adm_accounts)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_accounts[]" value="delete" <?php if(in_array('delete',$adm_accounts)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Users</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="view" <?php if(in_array('view',$adm_users)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adm_users)) {echo 'checked'; }?>><span>Create and delete</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="edit_other_user_personal_details" <?php if(in_array('edit_other_user_personal_details',$adm_users)) {echo 'checked'; }?>><span>Edit other user personal details</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_users[]" value="delete" <?php if(in_array('delete',$adm_users)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Roles</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_roles[]" value="view" <?php if(in_array('view',$adm_roles)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_roles[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adm_roles)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_roles[]" value="delete" <?php if(in_array('delete',$adm_roles)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Book settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_book_settings[]" value="view" <?php if(in_array('view',$adm_book_settings)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_book_settings[]" value="edit" <?php if(in_array('edit',$adm_book_settings)) {echo 'checked'; }?>><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Selling settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_selling_settigs[]" value="view" <?php if(in_array('view',$adm_selling_settigs)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_selling_settigs[]" value="edit" <?php if(in_array('edit',$adm_selling_settigs)) {echo 'checked'; }?>><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payment terms</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payment_terms[]" value="view" <?php if(in_array('view',$adm_payment_terms)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payment_terms[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adm_payment_terms)) {echo 'checked'; }?>><span>Create and edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payment_terms[]" value="delete" <?php if(in_array('delete',$adm_payment_terms)) {echo 'checked'; }?>><span>Delete</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Buying settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_buying_settings[]" value="view" <?php if(in_array('view',$adm_buying_settings)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_buying_settings[]" value="edit" <?php if(in_array('edit',$adm_buying_settings)) {echo 'checked'; }?>><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Time and expense settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_time_and_expense_settings[]" value="view" <?php if(in_array('view',$adm_time_and_expense_settings)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_time_and_expense_settings[]" value="edit" <?php if(in_array('edit',$adm_time_and_expense_settings)) {echo 'checked'; }?>><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Email settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_settings[]" value="view" <?php if(in_array('view',$adm_email_settings)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_settings[]" value="edit" <?php if(in_array('edit',$adm_email_settings)) {echo 'checked'; }?>><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Email history</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_history[]" value="view" <?php if(in_array('view',$adm_email_history)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_email_history[]" value="edit" <?php if(in_array('edit',$adm_email_history)) {echo 'checked'; }?>><span>Resend</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Report settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_report_settings[]" value="view" <?php if(in_array('view',$adm_report_settings)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_report_settings[]" value="edit" <?php if(in_array('edit',$adm_report_settings)) {echo 'checked'; }?>><span>Edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Tax settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_tax_settings[]" value="view" <?php if(in_array('view',$adm_tax_settings)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_tax_settings[]" value="edit" <?php if(in_array('edit',$adm_tax_settings)) {echo 'checked'; }?>><span>Edit</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_tax_settings[]" value="delete_tax_code_and_group" <?php if(in_array('delete_tax_code_and_group',$adm_tax_settings)) {echo 'checked'; }?>><span>Delete tax code and group</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payroll Items</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_items[]" value="view" <?php if(in_array('view',$adm_payroll_items)) {echo 'checked'; }?>><sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_items[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adm_payroll_items)) {echo 'checked'; }?>><span>create and edit</span></label>
					            </div>
					        </div>

					        <div class="form-group">
					            <label class="control-label col-md-2">Payroll settings</label>
					            <div class="col-md-7">
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_settings[]" value="view" <?php if(in_array('view',$adm_payroll_settings)) {echo 'checked'; }?>> <sPan>View</span></label>
					              <label class="checkbox-inline"><input type="checkbox" name="adm_payroll_settings[]" value="create_and_edit" <?php if(in_array('create_and_edit',$adm_payroll_settings)) {echo 'checked'; }?>><span>Create and edit</span></label>
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
