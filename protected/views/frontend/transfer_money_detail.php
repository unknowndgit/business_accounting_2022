<?php
if (!isset($_REQUEST['action_view'])){
	$session->redirect('transfer_money',user);
}
$transaction_id=$_REQUEST['action_view'];
$transaction_details=$db->get_row('transfer_money',array('id'=>$transaction_id));
?>


<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
			<h3>BANKING</h3>
		</div>
		<?php echo $display_msg;?>
    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
        		<a href="<?php echo $link->link('transfer_money',user);?>" class="btn btn-default pull-right">Back to List</a>

				<!-- <br><br><div class="tabs padded"><i class="lnr lnr-warning"></i> The transfer from/transfer to account has been locked off until bank account lock off date. Transactions can't be added, edited or deleted.</div> -->

				<form action="#" class="form-horizontal">
				<h3>Transfer money</h3>
				<br>
				 <div class="form-group">
		            <label class="control-label col-md-2">Transfer From :</label>
		            <div class="col-md-8">
		            	<div class="col-md-4">
			             <label class="control-label"><?php
				              $acc1=$db->get_var('accounts',array('id'=>$transaction_details['transfer_money']),'account_name');
				              echo $acc1;
				          ?></label>
				         </div>
				         <div class="col-md-4">
				         <label class="control-label"><?php
				              $aid1=$transaction_details['transfer_money'];
				             // $query1="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid1";
				             // $amount1=$db->run($query1)->fetchColumn();
				              $current_balance1=$db->get_var('accounts',array('id'=>$transaction_details['transfer_money']),'current_balance');
                          if($current_balance1==''){ echo "";}else{  echo CURRENCY." ".number_format(($current_balance1),2,'.',',');}
				             
				          ?></label>
				         </div>
		            </div>
		        </div>
		        <div class="form-group">
		            <label class="control-label col-md-2">Transfer to :</label>
		            <div class="col-md-8">
		            	<div class="col-md-4">
			              <label class="control-label"><?php
				              $acc2=$db->get_var('accounts',array('id'=>$transaction_details['transfer_to']),'account_name');
				              echo $acc2;
				          ?></label>
				         </div>
				         <div class="col-md-4">
					          <label class="control-label"><?php
					              $aid2=$transaction_details['transfer_money'];
					              $query2="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid2";
					            //  $amount2=$db->run($query2)->fetchColumn();
					              $current_balance2=$db->get_var('accounts',array('id'=>$transaction_details['transfer_to']),'current_balance');
					              if($current_balance2==''){ echo "";}else{echo CURRENCY." ".number_format(($current_balance2),2,'.',',');}
					             
				              ?></label>
				         </div>
		            </div>
		        </div>
				<div class="form-group">
		            <label class="control-label col-md-2">Date :</label>
		            <div class="col-md-7">
		              <label class="control-label"><?php echo $transaction_details['transfer_date'];?></label>
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="control-label col-md-2">Amount :</label>
		            <div class="col-md-7">
		              <label class="control-label"> <?php echo CURRENCY." ".number_format($transaction_details['amount'],2,'.',',');?></label>
		            </div>
		        </div>
		         <div class="form-group">
		            <label class="control-label col-md-2">Bank Fees :</label>
		            <div class="col-md-7">
		              <label class="control-label"><?php echo $transaction_details['bank_fees'];?></label>
		            </div>
		        </div>
		         <div class="form-group">
		            <label class="control-label col-md-2">Reference :</label>
		            <div class="col-md-7">
		              <label class="control-label"><?php echo $transaction_details['reference'];?></label>
		            </div>
		        </div>
		       
		        <div class="form-group">
		            <label class="control-label col-md-2">Description :</label>
		            <div class="col-md-7">
		            <label class="control-label">   <?php echo $transaction_details['description'];?></label>
		            </div>
		        </div>
		        </form>


        	</div>
		</div>
	</div>
</div>