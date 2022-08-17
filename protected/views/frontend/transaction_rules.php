<?php
$transfer_rule=$db->get_all('transaction_rule');


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
		$delete=$db->delete('transaction_rule',array('id'=>$delete_id));
		
		if($delete)
		{

			$display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Transaction rule Delete Successfully.
                		</div>';
			echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("transaction_rules",user)."'
        	                },3000);</script>";
		}
	}
	elseif(isset($_POST['no']))
	{
		$session->redirect('transaction_rules',user);
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
	<a href="<?php echo $link->link('transfer_money',user);?>" class="btn btn-default">Transfer money</a>
	<a href="<?php echo $link->link('transaction_rules',user);?>" class="btn btn-primary">Transaction rules</a>
<a href="<?php echo $link->link('receive_money',user);?>" class="btn btn-default">Receive money </a>
        		<?php if(in_array('create_and_edit',$dtd_bank_payment)){?>
        			<a href="<?php echo $link->link('add_transaction_rules',user);?>" class="btn btn-default pull-right">Add Transaction rule</a>
					<?php }?>
					<h3>Transaction rules</h3>
					<!-- DataTables Example -->
			        <div class="row">
			          <div class="col-lg-12">
			            <div class="widget-container fluid-height clearfix">
			              <div class="widget-content padded clearfix">
			                <table class="table table-bordered table-striped" id="dataTable1">
			                  <thead>
			                    <th>
			                      Priority
			                    </th>
			                    <th>
			                      Name
			                    </th>
			                    <th class="hidden-xs">
			                      Applies to
			                    </th>
			                    <th class="hidden-xs">
			                      Action
			                    </th>
			                    <th class="hidden-xs">
			                      Contact
			                    </th>
			                    <th></th>
			                  </thead>
			                  <tbody>
						<?php if (is_array($transfer_rule)){
							$sn=1;
							foreach ($transfer_rule as $rule){?>
			                    <tr>
			                      <td>
			                        <?php echo $sn; $sn++;//echo $rule[''];?>
			                      </td>
			                      <td>
			                        <?php echo $rule['rule'];?>
			                      </td>
			                      <td class="hidden-xs">
			                        <?php echo $rule['applies_to'];?>
			                      </td>
			                      <td class="hidden-xs">
									<?php echo $rule['do_following'];?>
			                      </td>
			                     <td><?php echo $contact_name=$db->get_var('contacts',array('id'=>$rule['id']),'display_name');?></td>
			                    
			                      <td class="actions">
			                        <div class="action-buttons">
			                           <?php if(in_array('view',$dtd_bank_payment)){?>
			                          <!-- <a class="table-actions" href="<?php echo $link->link('',user,'&action_view='.$rule['id']);?>"><i class="lnr lnr-eye" style="color:green;"></i></a> -->
			                          <a class="table-actions" href="<?php echo $link->link('edit_transaction_rules',user,'&edit_transaction_rules='.$rule['id']);?>"><i class="lnr lnr-pencil"></i></a>
			                           <?php }if(in_array('delete',$dtd_bank_payment)){?>
			                          <a class="table-actions" href="<?php echo $link->link('transaction_rules',user,'&action_delete='.$rule['id']);?>"><i class="lnr lnr-trash" style="color:red;"></i></a>
			                        	<?php }?>
			                        </div>
			                      </td>
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