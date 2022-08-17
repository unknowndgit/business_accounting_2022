<?php
$db->order_by="id DESC";
$transfer_money=$db->get_all('transfer_money');


if(isset($_REQUEST['action_delete']))
{
	$delete_id=$_REQUEST['action_delete'];

	$display_msg='<form method="POST" action="">
    <div class="alert alert-danger">
    <button class="close" data-dismiss="alert" type="button">×</button>
	Are you sure ? You want to delete this .
	<input type="hidden" name="del_id" value="'.$delete_id.'" >
	<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="lnr lnr-checkmark-circle"></i></button>
	<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="lnr lnr-cross-circle"></i></button>
	</div>
	</form>';
	if(isset($_POST['yes']))
	{

	    $event="Delete entry no ( " . $_POST['del_id'] . " ) from money transfer";
	    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	        'event'=>$event,
	        'created_date'=>date('Y-m-d'),
	        'ip_address'=>$_SERVER['REMOTE_ADDR']

	    ));
		$delete=$db->delete('transfer_money',array('id'=>$_POST['del_id']));
		if($delete)
		{

			$display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Transfer  Money Delete Successfully.
                		</div>';
			echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("transfer_money",user)."'
        	                },3000);</script>";
		}
	}
	elseif(isset($_POST['no']))
	{
		$session->redirect('transfer_money',user);
	}
}

?>
<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
			<h3>BANKING</h3>
		</div>
		<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        		<form action="" class="form-horizontal" method="post">

<a href="<?php echo $link->link('banking_bank_account',user);?>" class="btn btn-default ">Bank accounts</a>
	<a href="<?php echo $link->link('transfer_money',user);?>" class="btn btn-primary">Transfer money</a>
	<!-- <a href="<?php echo $link->link('transaction_rules',user);?>" class="btn btn-default">Transaction rules</a> -->
	<a href="<?php echo $link->link('receive_money',user);?>" class="btn btn-default">Receive money </a>
	<?php if(in_array('create_and_edit',$dtd_transfer_money)){?>
                <a href="<?php echo $link->link('add_transfer_money',user);?>" class="btn btn-default pull-right">Add Transfer Money</a>
			<?php }?>
					<h3>Transfer Money</h3>
					<!-- DataTables Example -->
			        <div class="row">
			          <div class="col-lg-12">
			            <div class="widget-container fluid-height clearfix">
			              <div class="widget-content padded clearfix">
			                <table class="table table-bordered table-striped" id="dataTable1">
			                  <thead>
			                  <th class="hidden-xs">
			                      Transfer From
			                    </th>
			                    <th class="hidden-xs">
			                     Transfer To
			                    </th>
			                     <th>
			                      Date
			                    </th>
			                      <th class="hidden-xs">
			                      Transfer amount
			                     </th>
			                     <th class="hidden-xs">
			                     Bank Fees
			                     </th>
			                    <th class="hidden-xs">
			                    Reference
			                     </th>
			                    <th>
			                      Description
			                    </th>
			                    <?php if (!empty($dtd_transfer_money)){?>
			                   		<th>Action</th>
			                   	<?php }?>
			                  </thead>
			                  <tbody>
						<?php if (is_array($transfer_money)){
							foreach ($transfer_money as $money){?>
			                    <tr>
			                    <td class="hidden-xs">
			                        <?php
			                        	$acc1=$db->get_var('accounts',array('id'=>$money['transfer_money']),'account_name');
			                        	echo $acc1;
			                        ?>
			                      </td>
			                      <td class="hidden-xs">
			                      	<?php
			                        	$acc2=$db->get_var('accounts',array('id'=>$money['transfer_to']),'account_name');
			                        	echo $acc2;
			                        ?>
			                      </td>
			                      <td>
			                        <?php echo $money['transfer_date'];?>
			                      </td>
			                       <td class="hidden-xs">
			                        <?php echo CURRENCY." ".number_format($money['amount'],2,'.',',');?>
			                      </td>
			                      <td>
			                        <?php echo $money['bank_fees'];?>
			                      </td>
			                      <td>
			                        <?php echo $money['reference'];?>
			                      </td>

			                      <td>
			                      	<?php echo $money['description'];?>
			                      </td>

								<?php if (!empty($dtd_transfer_money)){?>
			                      <td class="actions">
			                        <div class="action-buttons">
			                          <?php if(in_array('view',$dtd_transfer_money)){?>
			                          <a class="table-actions" href="<?php echo $link->link('transfer_money_detail',user,'&action_view='.$money['id']);?>"><i class="lnr lnr-eye" style="color:green;"></i></a>
			                         <?php }if(in_array('delete',$dtd_transfer_money)){?>
			                          <!-- <a class="table-actions" href="#"><i class="lnr lnr-pencil"></i></a> -->
			                          <a class="table-actions" href="<?php echo $link->link('transfer_money',user,'&action_delete='.$money['id']);?>"><i class="lnr lnr-trash" style="color:red;"></i></a>
			                        <?php }?>
			                        </div>
			                      </td>
			                   <?php }?>

			                    </tr>
			               <?php }
							}?>

			                  </tbody>
			                </table>
			              </div>
			            </div>
			          </div>
			        </div>
			        <!-- end DataTables Example -->

        		</form>

			</div>
		</div>
	</div>
</div>