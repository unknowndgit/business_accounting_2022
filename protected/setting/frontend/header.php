<!DOCTYPE html>
<html>
<head>
    <title>
      <?php echo $settings['name'];?>
    </title>
    <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />


    <link href="<?php echo SITE_URL.'/assets/frontend/css/bootstrap.min.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="<?php echo SITE_URL.'/assets/frontend/css/jquery.fancybox.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/fullcalendar.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/datatables.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/datepicker.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/timepicker.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/style.css';?>" media="all" rel="stylesheet" type="text/css" />
    <!-- for mark_leave date design -->
    <link href="<?php echo SITE_URL.'/assets/frontend/css/jquery-ui.min.css';?>" media="all" rel="stylesheet" type="text/css" />
    <!-- *********************************************************** -->

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript">  </script>
     <!-- for mark_leave date  -->
  <script src="<?php echo SITE_URL.'/assets/frontend/js/jquery-ui.min.js';?>" type="text/javascript"></script>
  <!-- *************************************************************************** -->

  <!-- ------------- Loader ------------------- -->
  <style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(<?php echo SITE_URL.'/assets/frontend/loader/reload.gif';?>) center no-repeat  rgba(0,0,0,0.5);
	}
  </style>

  </head>
  <body <?php if (!file_exists($fview))
      echo 'class=""';
       else echo 'class="default"';

?>>

<div class="se-pre-con"></div>

    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">

 				<!-- <li class="dropdown notifications hidden-xs">
                	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
               			MENU
                	</a>
                	<ul class="dropdown-menu">
                 		 <li><a href="#">
                    		MENU 1
                   			</a>
                 		 </li>
                	</ul>
              	</li> -->

              <li class="dropdown notifications hidden-xs ">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                	<i class="lnr lnr-plus-circle" style="font-size: 20pt;"></i>
                </a>

                <ul class="dropdown-menu" style="width:600px;">

              <div class="col-md-12">
                <br>

                <div class="col-md-4">
                   Customers
                   <ul >
                    <?php if(in_array('create_and_edit',$dtd_estimate)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_selling_estimate"){echo "current";}?>" href="<?php echo $link->link('add_selling_estimate',user);?>" style="color: #333;">Estimate </a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_invoice)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_selling_invoice"){echo "current";}?>" href="<?php echo $link->link('add_selling_invoice',user);?>" style="color: #333;">Invoice </a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_adjustment_notes)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_selling_can"){echo "current";}?>" href="<?php echo $link->link('add_selling_can',user);?>" style="color: #333;">Customer adjustment note </a>
                  </li>
                  <?php }?>
                  </ul>
                </div>
                <div class="col-md-4">
                Suppliers
                 <ul>
                 <?php if(in_array('create_and_edit',$dtd_bills)){?>
                 <li>
                  	<a class="<?php if($query1ans=="add_buying_bill"){echo "current";}?>" href="<?php echo $link->link('add_buying_bill',user);?>" style="color: #333;">Bill</a>
                 </li>
                  <?php }if(in_array('create_and_edit',$dtd_supplier_adjustment_notes)){?>
                <li>
                  	<a class="<?php if($query1ans=="add_buying_san"){echo "current";}?>" href="<?php echo $link->link('add_buying_san',user);?>" style="color: #333;">Supplier adjustment note</a>
                  </li>
                  <?php }?>
                  </ul>
                 </div>
                <div class="col-md-4">
                 Others
                 <ul>
                  <?php if(in_array('create_and_edit',$dtd_projects)){?>
                 <li>
                  	<a class="<?php if($query1ans=="add_project"){echo "current";}?>" href="<?php echo $link->link('add_project',user);?>" style="color: #333;">Project</a>
                  </li>
                <?php }if(in_array('create_and_edit',$dtd_items)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_item"){echo "current";}?>" href="<?php echo $link->link('add_item',user);?>" style="color: #333;">Item</a>
                  </li>
                 <?php }if(in_array('create_and_edit',$adv_journal)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_journal"){echo "current";}?>" href="<?php echo $link->link('add_journal',user);?>" style="color: #333;">Journal</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$con_cintact)){?>
                   <li>
                  	<a class="<?php if($query1ans=="add_contact"){echo "current";}?>" href="<?php echo $link->link('add_contact',user);?>" style="color: #333;">Contact</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$adm_accounts)){?>
                   <li>
                  	<a class="<?php if($query1ans=="add_account"){echo "current";}?>" href="<?php echo $link->link('add_account',user);?>" style="color: #333;">New Account</a>
                  </li>
                  <?php }if(in_array('edit',$adm_tax_settings)){?>
                   <li>
                  	<a class="<?php if($query1ans=="add_tax"){echo "current";}?>" href="<?php echo $link->link('add_tax',user);?>" style="color: #333;">Tax</a>
                  </li>
                  <?php }?>
                  </ul>
                </div>

                </div>
                 <!--  <li>
                  	<a style="color:red;">Create A New </a>
                  </li>
                   <?php if(in_array('create_and_edit',$dtd_estimate)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_selling_estimate"){echo "current";}?>" href="<?php echo $link->link('add_selling_estimate',user);?>">Estimate </a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_invoice)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_selling_invoice"){echo "current";}?>" href="<?php echo $link->link('add_selling_invoice',user);?>">Invoice </a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_adjustment_notes)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_selling_can"){echo "current";}?>" href="<?php echo $link->link('add_selling_can',user);?>">Customer adjustment note </a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_bills)){?>
                 <li>
                  	<a class="<?php if($query1ans=="add_buying_bill"){echo "current";}?>" href="<?php echo $link->link('add_buying_bill',user);?>">Bill</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_supplier_adjustment_notes)){?>
                <li>
                  	<a class="<?php if($query1ans=="add_buying_san"){echo "current";}?>" href="<?php echo $link->link('add_buying_san',user);?>">Supplier adjustment note</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_projects)){?>
                <li>
                  	<a class="<?php if($query1ans=="add_project"){echo "current";}?>" href="<?php echo $link->link('add_project',user);?>">Project</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$dtd_items)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_item"){echo "current";}?>" href="<?php echo $link->link('add_item',user);?>">Item</a>
                  </li>
                  <?php }?>
                 <li>
                  	<a class="<?php if($query1ans=="add_selling_receive_money"){echo "current";}?>" href="<?php echo $link->link('add_selling_receive_money',user);?>">Receive money</a>
                  </li>
                <li>
                  	<a class="<?php if($query1ans=="add_buying_mk"){echo "current";}?>" href="<?php echo $link->link('add_buying_mk',user);?>">Make payment</a>
                  </li>
                 <li>
                  	<a href="#">Expense claim</a>
                  </li>
                  <li>
                  	<a href="#">Timesheet</a>
                  </li>
                   <li>
                  	<a href="#">Transfer money</a>
                  </li>
                   <li>
                  	<a class="<?php if($query1ans=="iras_gst_codes"){echo "current";}?>" href="<?php echo $link->link('iras_gst_codes',user);?>">IRAS GST Code</a>
                  </li>
                   <?php if(in_array('create_and_edit',$adv_journal)){?>
                  <li>
                  	<a class="<?php if($query1ans=="add_journal"){echo "current";}?>" href="<?php echo $link->link('add_journal',user);?>">Journal</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$con_cintact)){?>
                   <li>
                  	<a class="<?php if($query1ans=="add_contact"){echo "current";}?>" href="<?php echo $link->link('add_contact',user);?>">Contact</a>
                  </li>
                  <?php }if(in_array('create_and_edit',$adm_accounts)){?>
                   <li>
                  	<a class="<?php if($query1ans=="add_account"){echo "current";}?>" href="<?php echo $link->link('add_account',user);?>">New Account</a>
                  </li>
                  <?php }if(in_array('edit',$adm_tax_settings)){?>
                   <li>
                  	<a class="<?php if($query1ans=="tax_setting_add_tax"){echo "current";}?>" href="<?php echo $link->link('tax_setting_add_tax',user);?>">Tax</a>
                  </li>
                  <?php  }?>
                   -->

                </ul>

              </li>
           <!-- <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="lnr lnr-envelope"></span>
                </a>
              </li>

              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="lnr lnr-users"></span>
                </a>
              </li> -->

              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="lnr lnr-cog"></span>
                </a>
                	<ul class="dropdown-menu">
	                  <li>
	                  	<a href="<?php echo $link->link('accounts',user);?>"> Chart of accounts</a>
	                  </li>
	                  <?php if ($_SESSION['user_type']=='admin'){?>
	                  <li>
	                  	<a href="<?php echo $link->link('users',user);?>"> User and roles</a>
	                  </li>
	                  <?php }?>
	                  <li>
	                  	<a href="<?php echo $link->link('sale_purchase_prefrence',user);?>"> General settings</a>
	                  </li>
	                  <li>
	                  	<a href="<?php echo $link->link('taxes',user);?>"> Tax settings</a>
	                  </li>
	                   <li>
	                  	<a href="<?php echo $link->link('linked_accounts',user);?>">Linked Accounts</a>
	                 </li>
	                    <li>
	                  	<a href="<?php echo $link->link('activity_log',user);?>">Activity Logs</a>
	                 </li>

	                 <!--  <li>
	                  	<a href="#"> Payroll settings</a>
	                  </li>
	                  <li style="background:#e5f7f0;">
	                  	<a href="#"> Change book</a>
	                  </li>
	                  <li style="background:#e5f7f0;">
	                  	<a href="#"> Log out</a>
	                  </li>-->
                  </ul>
              </li>

            <li class="dropdown user hidden-xs">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <?php if(file_exists(SERVER_ROOT.'/uploads/users/'.$_SESSION['user_id'].'/'.$user_details['user_photo_file']) && (($user_details['user_photo_file'])!=''))
            {
            ?>
             <img width="34" height="34" src="<?php echo SITE_URL.'/uploads/users/'.$_SESSION['user_id'].'/'.$user_details['user_photo_file'];?>"/> <?php echo $user_details['firstname'];?><b class="caret"></b>

                <?php }else{
                	?>
                 <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" width="34" height="34"/><?php echo $user_details['firstname'];?><b class="caret"></b>
                <?php }?>   </a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo $link->link('profile',user)?>">
             		<i class="lnr lnr-mustache"></i>Profile</a>
                  </li>
                  <?php if ($_SESSION['user_type']=='admin'){?>
                  <li><a href="<?php echo $link->link('site_setting',user)?>">
             			<i class="lnr lnr-cog"></i>Site setting </a>
                  </li><?php }?> 

              <li><a href="<?php echo $link->link('changepassword',user)?>">
               	<i class="lnr lnr-lock"></i>Change Password</a>
              </li>

              <li><a href="<?php echo $link->link('logout',user);?>">
                    <i class="lnr lnr-power-switch"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a  class="logo" href="<?php echo $link->link('home',user);?>">
       <?php echo $settings['name'];?></a>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
          <ul class="nav">

              <li>
                <a class="<?php if($query1ans=="home"){echo "current";}?>" href="<?php echo $link->link('home',user);?>">
                <span aria-hidden="true" class="lnr lnr-home"></span>Dashboard</a>
              </li>

			 <li class="dropdown">
			 	<a data-toggle="dropdown" href="#" class="<?php if($query1ans=="selling_estimates"|| $query1ans=="add_selling_estimate"
			 	    || $query1ans=="selling_invoice"
			 	    || $query1ans=="add_selling_invoice" || $query1ans=="selling_can" || $query1ans=="add_selling_can"
			 	    || $query1ans=="selling_receive_money" || $query1ans=="add_selling_receive_money" || $query1ans=="buying_bills"
			 	    || $query1ans=="add_buying_bill" || $query1ans=="buying_san" || $query1ans=="add_buying_san" || $query1ans=="buying_mk"
			 	    || $query1ans=="add_buying_mk" || $query1ans=="project" || $query1ans=="add_project" || $query1ans=="item"
			 	    || $query1ans=="add_item"
                    || $query1ans=="banking_bank_account" || $query1ans=="add_banking_bank_account"
			 	    || $query1ans=="transfer_money" || $query1ans=="transfer_money_detail" || $query1ans=="add_transfer_money"
			 	    || $query1ans=="transaction_rules" || $query1ans=="add_transaction_rules"
			 	    || $query1ans=="add_quotation_without_tax"|| $query1ans=="bank_transactions"
			 			){echo "current";}?>">
                <span aria-hidden="true" class="lnr lnr-store"></span>Accounts<b class="caret"></b></a>
                <ul class="dropdown-menu">
             	  <li>
                    <a class="<?php if($query1ans=="banking_bank_account" || $query1ans=="add_banking_bank_account" || $query1ans=="transfer_money" || $query1ans=="transfer_money_detail" || $query1ans=="add_transfer_money" || $query1ans=="transaction_rules" || $query1ans=="add_transaction_rules"){echo "current";}?>" href="<?php echo $link->link('banking_bank_account',user);?>">Banking</a>
                  </li>
                  <li>
                    <a class="<?php if($query1ans=="selling_estimates" || $query1ans=="add_selling_estimate"  || $query1ans=="selling_invoice" || $query1ans=="add_selling_invoice" || $query1ans=="selling_can" || $query1ans=="add_selling_can" || $query1ans=="selling_receive_money" || $query1ans=="add_selling_receive_money"){echo "current";}?>" href="<?php echo $link->link('selling_estimates',user);?>">Selling</a>
                  </li>
                  <li>
                    <a class="<?php if($query1ans=="buying_bills" || $query1ans=="add_buying_bill" || $query1ans=="buying_san" || $query1ans=="add_buying_san" || $query1ans=="buying_mk" || $query1ans=="add_buying_mk"){echo "current";}?>" href="<?php echo $link->link('buying_bills',user);?>">Buying</a>
                  </li>
                  <li>
                    <a class="<?php if($query1ans=="project" || $query1ans=="add_project"){echo "current";}?>" href="<?php echo $link->link('project',user);?>">Projects</a>
                  </li>
                  <li>
                    <a class="<?php if($query1ans=="item" || $query1ans=="add_item"){echo "current";}?>" href="<?php echo $link->link('item',user);?>">Items</a>
                  </li>

                </ul>
              </li>




            <li>
                <a class="<?php if($query1ans=="reports"
                		|| $query1ans=="generate_report"
                    || $query1ans=="report_profit_loss"
                    || $query1ans=="report_balance_sheet"
                    || $query1ans=="report_trial_bal"
                    || $query1ans=="report_account_enquiry"
                    || $query1ans=="report_gst_summary"
                    || $query1ans=="report_gstf5"
                    || $query1ans=="report_tax_code_transaction"
                    || $query1ans=="report_invoice_list"
                    || $query1ans=="report_customer_transaction"
                    || $query1ans=="report_unpaid_invoice"
                    || $query1ans=="report_bill_list"
                    || $query1ans=="report_supplier_transaction"
                    || $query1ans=="report_unpaid_bills"
                    || $query1ans=="report_account_list"
                    || $query1ans=="report_bank_account_list"
                    || $query1ans=="report_item_list"
                    || $query1ans=="report_project_list"
                    || $query1ans=="report_customer_list"
                    || $query1ans=="report_supplier_list"
                    || $query1ans=="report_payment_list"
                    || $query1ans=="report_receipt_list"
                    || $query1ans=="report_journal_list"
                    || $query1ans=="report_bank_reconciliation"

                		){echo "current";}?>" href="<?php echo $link->link('reports',user);?>">
                <span aria-hidden="true" class="lnr lnr-printer"></span>Reporting</a>
            </li>




     <li>
                <a class="<?php if($query1ans=="journal" || $query1ans=="add_journal" || $query1ans=="advisor_activity" || $query1ans=="advisor_tpar_report"){echo "current";}?>" href="<?php echo $link->link('journal',user);?>">
                <span aria-hidden="true" class="lnr lnr-magnifier"></span>Journals</a>
            </li>
            <li>
                <a class="<?php if($query1ans=="contacts" || $query1ans=="add_contact" || $query1ans=="suppliers"){echo "current";}?>" href="<?php echo $link->link('contacts',user,'&contact_type=customers');?>">
                <span aria-hidden="true" class="lnr lnr-phone"></span>Contacts</a>
            </li>
            <li>
                <a class="<?php if($query1ans=="companies" || $query1ans=="add_company" || $query1ans=="suppliers"){echo "current";}?>" href="<?php echo $link->link('companies',user,'');?>">
                <span aria-hidden="true" class="lnr lnr-store"></span>Companies</a>
            </li>
            <li class="hidden-lg hidden-md hidden-sm">
                <a  href="<?php echo $link->link('logout',user);?>">
                <span aria-hidden="true" class="lnr lnr-power-switch"></span>Logout</a>
            </li>



            </ul>
          </div>
        </div>
      </div>
      </div>