


<?php if (isset($_POST['account_type_add_submit']))
{
   $account_type_name=$_POST['account_type_name'];
    $account_nature=$_POST['account_nature'];
    $account_type_description=$_POST['account_type_description'];

    $visibility_status=$_POST['visibility_status'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];


    if ($fv->emptyfields(array('Account type name'=>$account_type_name,'Account nature'=>$account_nature),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account name can not be Blank.
                		</div>';

    }

 else
    {
    $insert=$db->insert("accounts_type",array('account_type_name'=>$account_type_name,
                                         'account_nature'=>$account_nature,
                                         'account_type_description'=>$account_type_description,
                                         'visibility_status'=>$visibility_status,
                                         'created_date'=>$created_date,
                                         'ip_address'=>$ip_address));


      if ($insert){
                $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Account type added successfully.
                		</div>';
                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts_type",user)."'
        	                },3000);</script>";


      }

    }


}
?>
<?php
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
        $delete=$db->delete('accounts_type',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                     Account type Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts_type",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('accounts_type',user);
    }

}
elseif (isset($_REQUEST['action_active']))
{
    $action_id=$_REQUEST['action_active'];
    $update=$db->update('accounts_type',array('visibility_status'=>'active'),array('id'=>$action_id));
    if ($update)
    {
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                     Account type Active Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts_type",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_inactive']))
{
    $action_id=$_REQUEST['action_inactive'];
    $update=$db->update('accounts_type',array('visibility_status'=>'inactive'),array('id'=>$action_id));
    if ($update)
    {
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                     Account type Inactive Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts_type",user)."'
        	                },3000);</script>";
    }
}
?>

<div class="row">
	<div class="col-lg-12">
	<?php echo $display_msg;?>
	<div class=" padded" >
					<a href="<?php echo $link->link('accounts',user);?>" class="btn btn-default pull-right"> <strong>< Back to list</strong></a>
					<h3>CHART OF ACCOUNT</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<form action="#" class="form-horizontal" method="post">
        		<div class="row">
					<div class="col-lg-12">
						<button class="btn btn-success pull-right" type="submit" name="account_type_add_submit"> Save </button>
						<button class="btn btn-default pull-right"> Cancel </button>
						<h3>New Account type</h3>
					</div>
				</div>

				<div class="row">

						<div class="col-lg-8">
						   <table class="table table-bordered table-striped" id="dataTable1">
                              <thead>
                                <tr>
                                     <th>S.no</th>
                                     <th>Type </th>
                                     <th>Nature</th>
                                     <th>Description</th>
                                     <th>Status</th>
                                     <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $db->order_by='id DESC';
                                 $all_account_type=$db->get_all('accounts_type');
                                  if (is_array($all_account_type)){
                                      $sn=1;
                                    foreach ($all_account_type as $alla){?>
                                 <tr>
                                    <td class="check hidden-xs"><?php echo $sn;?></td>
                                    <td><?php echo $alla['account_type_name'];?></td>
                                    <td><?php echo $alla['account_nature'];?></td>
                                    <td><?php echo $alla['account_type_description'];?></td>
                                    <td><span class="label label-<?php if ($alla['visibility_status']=='active'){echo "success";}else{echo "warning";};?>"><?php echo $alla['visibility_status'];?></span></td>
                                      <td>  <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                            <li>
                                            <a href="<?php echo $link->link('accounts_type',user,'&action_delete='.$alla['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>
                                                <li>
                                                <?php if ($alla['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('accounts_type',user,'&action_active='.$alla['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('accounts_type',user,'&action_inactive='.$alla['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
                                              </li>
                                            </ul>
                                          </div></td>
                                 </tr>
                                 <?php  $sn++;}}?>
                              </tbody>
                           </table>



						</div>
						<div class="col-lg-4">
							<div class="form-group">
					            <label class="control-label col-md-4">Account type name <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_type_name">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Account Nature <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="account_nature">
					              <option value="">Select</option>
					                <option value="income">Income</option>
									<option value="expense">Expense</option>
									<option value="assets">Assets</option>
									<option value="liabilities">Liabilities</option>
									<option value="equity">Equity</option>
									<option value="cogs">cogs</option>
								  </select>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Description</label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_type_description">
					            </div>
					        </div>

					              <div class="form-group">
					            <label class="control-label col-md-4">Status</label>
					            <div class="col-md-7">
					               <select class="form-control" name="visibility_status">
    					              	<option value="active">Active</option>
    					              	<option value="inactive">Inactive</option>
					              </select>
					              </div>
					            </div>

					        </div>

					</div>
					</form>
				</div>


            </div>
        </div>
    </div>




