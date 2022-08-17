<?php

$table_array=array('account_transaction','activity_logs','assign_customer_project','assign_item_project','assign_supplier_project',
    'bank_statement','bills','buying_make_payment','contacts','customer_adjustment_notes','estimates','invoices','items',
    'journal','make_payment','payment_terms','projects','receive_money','supplier_adjustment_notes','tax_calculation',
    'transfer_money'
);

foreach ($table_array as $ta){

$sql1="TRUNCATE TABLE $ta";
$db->run();

}


$sql2="UPDATE `accounts` SET `current_balance` = '0', `opening_balance`='0'";
$db->run($sql2);

$sql3="UPDATE `daytoday_report_settings` SET `estimate_start_from` = '0', `invoice_start_from`='0',`can_start_from`='0',`bill_start_from`='0',
    san_start_from='0',journal_start_from='0'";
$db->run($sql3);

?>