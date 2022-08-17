<?php
if (isset($_REQUEST['account_id'])){
	$account_id=$_REQUEST['account_id'];
	$account_detail=$db->get_row('accounts',array('id'=>$account_id));
	//print_r($contact_detail);
}

if (isset($_POST['account_edit_submit']))
{

   $account_name=$_POST['account_name'];
    $account_type=$_POST['account_type'];
    $account_code=$_POST['account_code'];
    $export_code=$_POST['export_code'];
    $account_description=$_POST['account_description'];
   // $sub_account_of=$_POST['sub_account_of'];
  //  $default_tax_code=$_POST['default_tax_code'];
    $visibility_status=$_POST['visibility_status'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];



   $sql=" SELECT account_name FROM `accounts` WHERE `account_name`='$account_name' AND `id`!='$account_id'";
   $exist_account_name_check=$db->run($sql)->fetchAll();
   $sql1=" SELECT account_name FROM `accounts` WHERE `account_code`='$account_name' AND `id`!='$account_id'";
   $exist_account_code_check=$db->run($sql1)->fetchAll();


if ($fv->emptyfields(array('Account name'=>$account_name),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account name can not be Blank.
                		</div>';

    }
   elseif ($exist_account_name_check)
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account name already exits.
                		</div>';

    }
    elseif ($fv->emptyfields(array('Account type'=>$account_type),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Select Account Type.
                		</div>';

    }
    elseif ($fv->emptyfields(array('Account Code'=>$account_code),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Account code can not be Blank.
                		</div>';

    }
    elseif ($exist_account_code_check)
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>This Account code already exits.
                		</div>';

    }


else
    {
    if ($account_type!="")
        {
            //$nature=$db->get_var('accounts_type',array('id'=>$account_type),'account_nature');
            if ($account_type=='income' || $account_type=='other_income'){
            	$nature='income';
            }
            if ($account_type=='cost_of_good-sold'){
                $nature='cogs';
            }
            if ($account_type=='expense'|| $account_type=='other_expense' ){
            	$nature='expense';
            }
            if ($account_type=='current_asset' || $account_type=='non_current_asset'){
            	$nature='assets';
            }
            if ($account_type=='bank'){
            	$nature='assets';
            }
            if ($account_type=='fixed_asset'){
            	$nature='assets';
            }
            if ($account_type=='other_non-current_asset'){
            	$nature='assets';
            }
            if ($account_type=='credit_card'){
            	$nature='liabilities';
            }
            if ($account_type=='other_current_liability'){
            	$nature='liabilities';
            }
            if ($account_type=='equity'){
            	$nature='equity';
            }
            if ($account_type=='non-current_liability'){
            	$nature='liabilities';
            }
            if ($account_type=='account_receivable'){
            	$nature='assets';
            }
            if ($account_type=='account_payble'){
            	$nature='liabilities';
            }

        }
       $update=$db->update("accounts",array('account_name'=>$account_name,
                                             'account_type'=>$account_type,
                                             'account_code'=>$account_code,
                                             'export_code'=>$export_code,
                                             'account_description'=>$account_description,
                                          //   'sub_account_of'=>$sub_account_of,
                                          //   'default_tax_code'=>$default_tax_code,
                                             'nature'=>$nature,
                                             'opening_balance'=>0,
                                             'visibility_status'=>$visibility_status,
                                             'created_date'=>$created_date,
                                             'ip_address'=>$ip_address),array('id'=>$account_id));

//$db->debug();
      if ($update){
          /*entry in activity log table*/
          $event="Edit Account (" . $account_name . ")";
          $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
              'event'=>$event,
              'created_date'=>date('Y-m-d'),
              'ip_address'=>$_SERVER['REMOTE_ADDR']

          ));
                $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Account Updated successfully.
                		</div>';
                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("edit_account&account_id=".$account_id,user)."'
        	                },3000);</script>";


      }

    }


}
?>




<div class="row">
	<div class="col-lg-12">
	 <?php echo $display_msg;?>
	<div class=" padded" >

					<h3>CHART OF ACCOUNT</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<form action="#" class="form-horizontal" method="post">
        		<div class="row">
					<div class="col-lg-12">
					<a href="<?php echo $link->link('accounts',user);?>" class="btn btn-default pull-right"> <strong> < Back to list</strong></a>

						<button class="btn btn-default pull-right"> Cancel </button>
						<button class="btn btn-primary pull-right" type="submit" name="account_edit_submit"> Save </button>
						<h3><strong>Edit Account</strong></h3>
						<!--  <div class="pull-right">
							<a href="#">View Transactions</a> |
							<a href="#">Delete</a> |
							<a data-toggle="modal" href="#myModal">View History</a>
						</div>-->
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6">

							<div class="form-group">
					            <label class="control-label col-md-4">Account name <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_name" value="<?php echo $account_detail['account_name'];?>">
					            </div>
					        </div>
					        <div class="form-group">
					           <input type="hidden" name="account_type" value="<?php echo $account_detail['account_type'];?>">
					            <label class="control-label col-md-4">Account type</label>
					             <div class="col-md-7">
					             <label class="control-label"><?php
					              $remove_underscore=str_replace(_, " ", $account_detail['account_type']);
					                 echo ucfirst($remove_underscore);?></label>
					              <!-- <select class="form-control" name="account_type">
					                <option value="">Select</option>
					                <?php $account_type=$db->get_all('accounts_type',array('visibility_status'=>'active'));
					                if (is_array($account_type)){
					                    foreach ($account_type as $at)
					                    {?>
                                      <option value="<?php echo $at['id']?>"><?php echo $at['account_type_name'];?></option>
					               <?php  }} ?>

								  </select> -->
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Account code<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_code" value="<?php echo $account_detail['account_code'];?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Export code</label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" name="export_code" type="text" value="<?php echo $account_detail['export_code'];?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label col-md-4">Current balance</label>
					            <div class="col-md-7">
					              <label class="control-label"><?php echo CURRENCY."". number_format($account_detail['current_balance'],2);?></label>
					            </div>
					        </div>

						</div>
						<div class="col-lg-6">
							<div class="form-group">
					            <label class="control-label col-md-4">Description</label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="account_description" value="<?php echo $account_detail['account_description'];?>">
					            </div>
					        </div>
					   <!--   <div class="form-group">
					            <label class="control-label col-md-4">Default tax code</label>
					            <div class="col-md-7">
					              <select class="form-control" name="default_tax_code">
					              	<option value="1">None</option>
					              	 <?php $all_tax_name=$db->get_all('tax',array('visibility_status'=>'active'));
                         if (is_array($all_tax_name)){
                    foreach ($all_tax_name as $tn){?>
					              <option  <?php if ($account_detail['default_tax_code']===$tn['id']){echo 'selected';}?> value="<?php echo $tn['id']?>"><?php echo $tn['tax_name']." - ".$tn['tax_description']."(".$tn['tax_rate'].")";?></option>
					                 <?php }}?>
					               </select>
					            </div>
					        </div> -->
					        <div class="form-group">
					            <label class="control-label col-md-4">Status</label>
					            <div class="col-md-7">
					               <select class="form-control" name="visibility_status">
					              	<option <?php if ($account_detail['visibility_status']=='active'){echo 'selected';}?> value="active">Active</option>
					              	<option <?php if($account_detail['visibility_status']=='inactive'){echo 'selected';}?> value="inactive">Inactive</option>
					              </select>
					            </div>
					            </div>
					        </div>
						</div>
					</div>

			</form>

            </div>
        </div>
    </div>
</div>




<!-- --------- Modal History/Add note--------- -->
		<div class="modal fade" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Account History
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
                        	<div class="row"><div class="col-md-12"><a href="#" class="btn btn-success pull-right">Add note</a></div></div>

						<!-- DataTables Example -->
					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">
					              <div class="heading">
					                <i class="icon-table"></i>
					              </div>
					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                    <th>
					                      Date
					                    </th>
					                    <th>
					                      Full name
					                    </th>
					                    <th class="hidden-xs">
					                      Description
					                    </th>
					                  </thead>
					                  <tbody>
					                  	<tr>
					                      <td>
					                        18 Jun 2016 5:45:47 p.m.
					                      </td>
					                      <td>
					                        eugene tang
					                      </td>
					                      <td class="hidden-xs">
					                        Account created
					                      </td>
					                    </tr>
					                    <tr>
					                      <td>
					                        18 Jun 2016 5:45:47 p.m.
					                      </td>
					                      <td>
					                        eugene tang
					                      </td>
					                      <td class="hidden-xs">
					                        Status changed to Active.
					                      </td>
					                    </tr>

					                  </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>
					        <!-- end DataTables Example -->


                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>



