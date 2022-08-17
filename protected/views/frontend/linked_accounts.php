<?php  $all_account=$db->get_all('accounts',array('visibility_status'=>'active'));

$linked_account_detail=$db->get_row('linked_accounts',array('id'=>1));
if (isset($_POST['submit_tax_account']))
{
    $account_tax_collect=$_POST['account_tax_collect'];
    $account_tax_paid=$_POST['account_tax_paid'];


    $empt_fields = $fv->emptyfields(array('Linked account for tax collected '=>$account_tax_collect,
                                          'Linked account for tax paid '=>$account_tax_paid
    ));

    if ($empt_fields)
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
    }else{



    $update=$db->update('linked_accounts',array('account_tax_collect'=>$account_tax_collect,
                                                'account_tax_paid'=>$account_tax_paid),array('id'=>1));

    if ($update){


        $event="Update in linked account menu for tax account section";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Account is added Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("linked_accounts",user)."'
        	                },3000);</script>";


          }
    }
}
elseif (isset($_POST['submit_purchase_account']))
{
    //print_r($_POST);
    $purchase_bafpb=$_POST['purchase_bafpb'];
    $purchase_lafir=$_POST['purchase_lafir'];
    $purchase_ecosaff=$_POST['purchase_ecosaff'];
    $purchase_aafsd=$_POST['purchase_aafsd'];
    $purchase_eafd=$_POST['purchase_eafd'];
    $purchase_eaflc=$_POST['purchase_eaflc'];


    $update=$db->update('linked_accounts',array('purchase_bafpb'=>$purchase_bafpb,
                                        'purchase_lafir'=>$purchase_lafir,
                                        'purchase_ecosaff'=>$purchase_ecosaff,
                                        'purchase_aafsd'=>$purchase_aafsd,
                                        'purchase_eafd'=>$purchase_eafd,
                                        'purchase_eaflc'=>$purchase_eaflc),array('id'=>1));
                                    //$db->debug();

    if ($update){


    $event="Update in linked account menu for Purchase section";
    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
        'event'=>$event,
        'created_date'=>date('Y-m-d'),
        'ip_address'=>$_SERVER['REMOTE_ADDR']

    ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Purchase Account is added Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("linked_accounts",user)."'
        	                },3000);</script>";


    }
}
elseif (isset($_POST['submit_sale_account']))
{
 //print_r($_POST);
    $sale_aaftr=$_POST['sale_aaftr'];
    $sale_bafcr=$_POST['sale_bafcr'];
    $sale_iaff=$_POST['sale_iaff'];
    $sale_lafcd=$_POST['sale_lafcd'];
    $sale_ecosafd=$_POST['sale_ecosafd'];



    $update=$db->update('linked_accounts',array('sale_aaftr'=>$sale_aaftr,
                                        'sale_bafcr'=>$sale_bafcr,
                                        'sale_iaff'=>$sale_iaff,
                                        'sale_lafcd'=>$sale_lafcd,
                                        'sale_ecosafd'=>$sale_ecosafd),array('id'=>1));
                                    //$db->debug();

    if ($update){
        $event="Update in linked account menu for Sale section";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Sale Account is added Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("linked_accounts",user)."'
        	                },3000);</script>";


    }
}
elseif (isset($_POST['submit_banking_account']))
{
 //print_r($_POST);
    $banking_eafce=$_POST['banking_eafce'];
    $banking_eafre=$_POST['banking_eafre'];
    $banking_eafhb=$_POST['banking_eafhb'];
    $banking_bafuf=$_POST['banking_bafuf'];
    $banking_gcafbd=$_POST['banking_gcafbd'];
    $banking_tgrca=$_POST['banking_tgrca'];


    $update=$db->update('linked_accounts',array('banking_eafce'=>$banking_eafce,
                                        'banking_eafre'=>$banking_eafre,
                                        'banking_eafhb'=>$banking_eafhb,
                                        'banking_bafuf'=>$banking_bafuf,
                                        'banking_gcafbd'=>$banking_gcafbd,
                                        'banking_tgrca'=>$banking_tgrca),array('id'=>1));
                                  //  $db->debug();

    if ($update){
        $event="Update in linked account menu for Bank  section";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Banking Account is added Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("linked_accounts",user)."'
        	                },3000);</script>";


    }


}

?>
<div class="row">
   <div class="col-lg-12">
<?php echo $display_msg;?>
      <div class="padded" >
       <h3>Linked Accounts</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">

          <!--  <a href="" class="btn btn-primary"> General </a>
             <a href="" class="btn btn-primary">BAS details</a>-->
<div class="row">
                    <div class="col-md-12">
   <div class="col-md-4">
 <form method="post" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
 <div class="row">
  <div class="col-md-12">
    <h4><strong>Tax Accounts</strong></h4>
   <div class="form-group">
            <label class="control-label col-md-5">Linked account for tax collected (For Sales):</label>
            <div class="col-md-7">
              <select class="form-control" name="account_tax_collect">
    		<option value="">select</option>
    		<?php

    		$aaftr=Asset_Account_for_Tracking_Receivables;
    		$lafir=Liability_Account_for_Item_Receipts;
    		$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='liabilities' AND `account_type`!='bank' AND  `id`!='$aaftr' AND  `id`!='$lafir'";
    		$all_laibility_accounts=$db->run($sql)->fetchAll();
    			if (is_array($all_laibility_accounts)){
    				foreach ($all_laibility_accounts as $accounts){ ?>
    					<option <?php if ($linked_account_detail['account_tax_collect']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
    </div>
              <div class="form-group">
                   <label class="control-label col-md-5">Linked account for tax paid (For Purchase):</label>
                  <div class="col-md-7">
               <select class="form-control" name="account_tax_paid">
    		<option value="">select</option>
    		<?php
    		$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND (`nature`='liabilities' OR `nature`='assets') AND `account_type`!='bank' AND  `id`!='$aaftr' AND  `id`!='$lafir'";
    		$all_laibility_accounts=$db->run($sql)->fetchAll();
    			if (is_array($all_laibility_accounts)){
    				foreach ($all_laibility_accounts as $accounts){ ?>
    					<option <?php if ($linked_account_detail['account_tax_paid']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>




  <div class="form-group">
                   <label class="control-label col-md-5"></label>
                  <div class="col-md-7">
              <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_tax_account"><i class="lnr lnr-chevron-up-circle"></i> Save</button>
            </div>
          </div>


</div>
<!--
 <div class="col-md-12">
    <h4><strong>Accounts & Banking Accounts</strong></h4>
   <div class="form-group">
            <label class="control-label col-md-5">Equity Account for Current Earnings:</label>
            <div class="col-md-7">
              <select class="form-control" name="banking_eafce">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['banking_eafce']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
    </div>
              <div class="form-group">
                   <label class="control-label col-md-5">Equity Account for Retained Earnings:</label>
                  <div class="col-md-7">
               <select class="form-control" name="banking_eafre">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['banking_eafre']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
          <div class="form-group">
                   <label class="control-label col-md-5">Equity Account for Historical Balancing:</label>
                  <div class="col-md-7">
               <select class="form-control" name="banking_eafhb">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['banking_eafhb']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
  <div class="form-group">
                   <label class="control-label col-md-5">Bank Account for Undeposited Funds:</label>
                  <div class="col-md-7">
               <select class="form-control" name="banking_bafuf">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['banking_bafuf']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
            <div class="form-group">
                   <label class="control-label col-md-5">GST Claimed Account for Bad Debts:</label>
                  <div class="col-md-7">
               <select class="form-control" name="banking_gcafbd">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['banking_gcafbd']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
           <div class="form-group">
                   <label class="control-label col-md-5">Tourist GST Refund Claimed Account:</label>
                  <div class="col-md-7">
               <select class="form-control" name="banking_tgrca">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['banking_tgrca']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
  <div class="form-group">
                   <label class="control-label col-md-5"></label>
                  <div class="col-md-7">
              <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_banking_account"><i class="lnr lnr-chevron-up-circle"></i> Save</button>
            </div>
          </div>


</div>
 -->




















</div>


 </form>
 </div>
 <div class="col-md-4">
 <form method="post" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
 <div class="row">
 <div class="col-md-12">
    <h4><strong>Sales Accounts</strong></h4>
   <div class="form-group">
            <label class="control-label col-md-5">Asset Account for Tracking Receivables:</label>
            <div class="col-md-7">
              <select class="form-control" name="sale_aaftr">
    		<option value="">select</option>
    		<?php

    		$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='assets' AND `account_type`!='bank'";
    		$all_account=$db->run($sql)->fetchAll();
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['sale_aaftr']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
    </div>

          <div class="form-group">
                   <label class="control-label col-md-5">Bank Account for Customer Receipts:</label>
                  <div class="col-md-7">
               <select class="form-control" name="sale_bafcr">
    		<option value="">select</option>
    		<?php
    		$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='assets' AND `account_type`='bank'";
    		$all_account=$db->run($sql)->fetchAll();
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['sale_bafcr']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
          <!--
  <div class="form-group">
                   <label class="control-label col-md-5">Income Account for Freight:</label>
                  <div class="col-md-7">
               <select class="form-control" name="sale_iaff">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['sale_iaff']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>

           <div class="form-group">
                   <label class="control-label col-md-5">Liability Account for Customer Deposits:</label>
                  <div class="col-md-7">
               <select class="form-control" name="sale_lafcd">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['sale_lafcd']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
           <div class="form-group">
                   <label class="control-label col-md-5">Expense or Cost of Sales Account for Discounts:</label>
                  <div class="col-md-7">
               <select class="form-control" name="sale_ecosafd">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['sale_ecosafd']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
         -->




  <div class="form-group">
                   <label class="control-label col-md-5"></label>
                  <div class="col-md-7">
              <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_sale_account"><i class="lnr lnr-chevron-up-circle"></i> Save</button>
            </div>
          </div>


</div>
</div>


 </form>
 </div>
<div class="col-md-4">
 <form method="post" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
 <div class="row">
 <div class="col-md-12">
    <h4><strong>Purchase Accounts</strong></h4>
      <div class="form-group">
                   <label class="control-label col-md-5">Liability Account for Item Receipts:</label>
                  <div class="col-md-7">
               <select class="form-control" name="purchase_lafir">
    		<option value="">select</option>
    		<?php
    		$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='liabilities' AND `account_type`!='bank'";
    		$all_account=$db->run($sql)->fetchAll();
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['purchase_lafir']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
   <div class="form-group">
            <label class="control-label col-md-5">Bank Account for Paying Bills:</label>
            <div class="col-md-7">
              <select class="form-control" name="purchase_bafpb">
    		<option value="">select</option>
    		<?php
    		$sql="SELECT* FROM `accounts` WHERE `visibility_status`='active' AND `nature`='liabilities' AND `account_type`='bank'";
    		$all_account=$db->run($sql)->fetchAll();
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['purchase_bafpb']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
    </div>

<!--
  <div class="form-group">
                   <label class="control-label col-md-5">Expense or Cost of Sales Account for Freight:</label>
                  <div class="col-md-7">
               <select class="form-control" name="purchase_ecosaff">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['purchase_ecosaff']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>

           <div class="form-group">
                   <label class="control-label col-md-5">Asset Account for Supplier Deposits:</label>
                  <div class="col-md-7">
               <select class="form-control" name="purchase_aafsd">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['purchase_aafsd']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
           <div class="form-group">
                   <label class="control-label col-md-5">Expense(or Contra) Account for Discounts:</label>
                  <div class="col-md-7">
               <select class="form-control" name="purchase_eafd">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['purchase_eafd']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>
            <div class="form-group">
                   <label class="control-label col-md-5">Expense Account for Late Charges:</label>
                  <div class="col-md-7">
               <select class="form-control" name="purchase_eaflc">
    		<option value="">select</option>
    		<?php
    			if (is_array($all_account)){
    				foreach ($all_account as $accounts){ ?>
    					<option <?php if ($linked_account_detail['purchase_eaflc']==$accounts['id']){echo 'selected';}?> value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
    			<?php }
    			}
    		?>
    	</select>
            </div>
          </div>-->
  <div class="form-group">
                   <label class="control-label col-md-5"></label>
                  <div class="col-md-7">
              <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_purchase_account"><i class="lnr lnr-chevron-up-circle"></i> Save</button>
            </div>
          </div>


</div>
</div>


 </form>
 </div>
 </div>
 </div>
         </div>
      </div>
   </div>
</div>

