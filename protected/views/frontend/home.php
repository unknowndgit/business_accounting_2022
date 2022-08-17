<style>
.number1 {
    font-size: 1.5em;
    font-weight: 100;
    color: #007aff;
    line-height: 1.4em;
    padding-top: 8px;
    letter-spacing: -0.06em;
}
.number1 a {

    color: #999;

}
.widget-container .heading {
   font-size: 25px;
   color: #ff4c00;

}

.text_new{
    font-weight: 600;

}
</style>
<div class="container-fluid main-content">




  <div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
		<div class="row">
		 <div class="col-lg-12">
          <div class="col-lg-6">
            <div class="widget-container stats-container" >
              <div class="heading">
                <i class="fa fa-calendar"></i>Invoices


              </div>


               <div class="col-md-4">

                <div  class="number1 number_font" style="font-family: serif;">
             <a href="<?php echo $link->link("selling_invoice",user);?>">  Total Amount</a>
                </div>
                  <div class="text_new">
               <?php
                $sql="SELECT SUM(total_amount) FROM invoices WHERE visibility_status='active'";
                 $total_invoice_amount=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_invoice_amount,2,'.',',');?>
                                  </div>
              </div>
              <div class="col-md-4">

                <div class="number1 number_font" style="font-family: serif;">
              <a href="<?php echo $link->link("selling_invoice",user);?>"> Amount Paid</a>
                </div>
                 <div class="text_new">
                <?php
                $sql="SELECT SUM(paid_amount) FROM invoices WHERE visibility_status='active'";
                 $total_paid_amount=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_paid_amount,2,'.',',');?>
                    </div>
              </div>
              <div class="col-md-4">
              <div  class="number1 number_font" style="font-family: serif;">
              <a href="<?php echo $link->link("selling_invoice",user);?>">  Amount Due</a>
                </div>
                  <div  class="text_new">
                 <?php
                $sql="SELECT SUM(balance_remaining) FROM invoices WHERE visibility_status='active'";
                 $total_balance_remaining=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_balance_remaining,2,'.',',');?>
                                </div>
              </div>
            </div>
          </div>
         <div class="col-lg-6">
            <div class="widget-container stats-container" >
              <div class="heading">
                <i class="fa fa-calendar"></i>Bills
              </div>
            <div class="col-md-4">

                <div class="number1 number_font" style="font-family: serif;">
             <a href="<?php echo $link->link("buying_bills",user);?>">  Total Amount</a>
                </div>
                 <div class="text_new" >
               <?php
                $sql="SELECT SUM(total_amount) FROM bills WHERE visibility_status='active'";
                 $total_invoice_amount=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_invoice_amount,2,'.',',');?>
                                  </div>
              </div>
              <div class="col-md-4">
               <div class="number1 number_font" style="font-family: serif;">
              <a href="<?php echo $link->link("buying_bills",user);?>"> Amount Paid</a>
                </div>
                  <div  class="text_new">
                <?php
                $sql="SELECT SUM(paid_amount) FROM bills WHERE visibility_status='active'";
                 $total_paid_amount=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_paid_amount,2,'.',',');?>
                    </div>
              </div>
              <div class="col-md-4">
               <div class="number1 number_font" style="font-family: serif;">
               <a href="<?php echo $link->link("buying_bills",user);?>"> Amount Due</a>
                </div>
                 <div class="text_new" >
                 <?php
                $sql="SELECT SUM(balance_remaining) FROM bills WHERE visibility_status='active'";
                 $total_balance_remaining=$db->run($sql)->fetchColumn();
                 echo CURRENCY." ".number_format($total_balance_remaining,2,'.',',');?>
                  </div>
              </div>
            </div>
          </div>

          </div>
        </div>
        	<div class="row">
     <div class="col-lg-6">
         <div class="widget-container stats-container" >
              <div class="heading">
                <i class="fa fa-calendar"></i>Contacts
              </div>
             <div class="col-md-6">
               <div class="number1 number_font" style="font-family: serif;">
              <a href="<?php echo $link->link("contacts",user,'&contact_type=customers');?>">  Total No. of Customers</a>
                </div>
                 <div class="text_new" >
                 <?php
               $contact_detail=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
             echo  count($contact_detail);
                ?>
                  </div>
              </div>
             <div class="col-md-6">
               <div class="number1 number_font" style="font-family: serif;">
           <a href="<?php echo $link->link("suppliers",user);?>">   Total No. of Suppliers</a>
                </div>
                 <div class="text_new" >
                 <?php
               $supplier_detail=$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
                 echo  count($supplier_detail);?>
                  </div>
              </div>

            </div>

            </div>
            <div class="col-lg-3">
            <div class="widget-container " >
            <div class="col-lg-12">
              <div class="heading" style="text-align:center">
               Activities

              </div>
              <?php echo date(DATE_FORMAT);?> (Today)<small><a class="pull-right" href="<?php echo $link->link("activity_log",user);?>">view all</a></small><hr>

    <?php

        $db->order_by='id DESC';
        $db->limit = "0,5";
         $all_timeline=$db->get_all('activity_logs',array('user_id'=>$_SESSION['user_id'],'created_date'=>date('Y-m-d')));
        if (is_array($all_timeline)){
            foreach ($all_timeline as $all_t){
            $time=strtotime($all_t['timestamp']);
					                     ?>

           <i class="lnr lnr-plus-circle text-success"></i>
            <strong><?php echo date('M d',$time)." ".date('h:i A',$time);?></strong>
                <p>
           <?php echo $all_t['event'];?>
              </p>


          <?php }}?>
</div>
</div>
        </div>
         <div class="col-lg-3">
            <div class="widget-container " >
            <div class="col-lg-12">
              <div class="heading" style="text-align:center">
               Bank Accounts

              </div>
              <small><a class="pull-right" href="<?php echo $link->link("add_banking_bank_account",user);?>" >Create new</a></small><hr>

    <?php

        $db->order_by='id DESC';
        $db->limit = "0,5";
         $all_account=$db->get_all('accounts',array('visibility_status'=>'active','account_type'=>'bank'));
        if (is_array($all_account)){
            foreach ($all_account as $all_ba){

					                     ?>


            <strong><?php echo $all_ba['account_name']?></strong>
                <p>
           <?php echo CURRENCY." ".number_format($all_ba['current_balance'],2,'.',',');?>
              </p>


          <?php }}?>
</div>
</div>
        </div>



        </div>
        </div>
        </div>
       <script src="//code.jquery.com/jquery-1.9.1.js"></script>
					</div>

        <!-- Statistics -->
<!--
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-4">
                <div class="number">
                  <div class="lnr lnr-apartment homeicons"></div>
                 12
                </div>
                <div class="text_new">
                 <a href="">Total Values 1</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="number">
                  <div class="lnr lnr-users homeicons"></div>
                34
                </div>
                <div class="text_new">
                 <a href="#">Total Values 2</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="number">
                  <div class="lnr lnr-heart homeicons"></div>
                33
                </div>
                <div class="text_new">
                 <a href="#"> Total Values 3 </a>
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="lnr lnr-pushpin homeicons"></div>
               33
                </div>
                <div class="text_new">
                 <a href="">Total Tasks</a>
                </div>
              </div>
            </div>
          </div>
        </div> -->


      </div>
