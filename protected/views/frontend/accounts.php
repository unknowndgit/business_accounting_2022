<?php

$current_tab=$_COOKIE['current_tab'];
   if($current_tab=="income")
   {
    $all_account=$db->get_all('accounts',array('nature'=>'income'));
   }
   elseif($current_tab=="cogs")
   {
   	$all_account=$db->get_all('accounts',array('nature'=>'cogs'));
   }
   elseif($current_tab=="expense")
   {
   	$all_account=$db->get_all('accounts',array('nature'=>'expense'));
   }
   elseif($current_tab=="assets")
   {
   	$all_account=$db->get_all('accounts',array('nature'=>'assets'));
   }
   elseif($current_tab=="liabilities")
   {
   	$all_account=$db->get_all('accounts',array('nature'=>'liabilities'));
   }
   elseif($current_tab=="equity")
   {
      	$all_account=$db->get_all('accounts',array('nature'=>'equity'));
   }
   else
   {
       $all_account=$db->get_all('accounts');
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
        $delete=$db->delete('accounts',array('id'=>$_POST['del_id']));
        $account_name=$db->get_var('accounts',array('id'=>$_POST['del_id']),'account_name');
        /*entry in activity log table*/
        $event="Delete Account (" . $account_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Account Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('accounts',user);
    }

}
elseif (isset($_REQUEST['action_active']))
{
    $action_id=$_REQUEST['action_active'];
    $update=$db->update('accounts',array('visibility_status'=>'active'),array('id'=>$action_id));
    if ($update)
    {
        $account_name=$db->get_var('accounts',array('id'=>$action_id),'account_name');
        /*entry in activity log table*/
        $event="Change status to active of Account (" . $account_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Account Active Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_inactive']))
{
    $action_id=$_REQUEST['action_inactive'];
    $update=$db->update('accounts',array('visibility_status'=>'inactive'),array('id'=>$action_id));
    if ($update)
    {

 /***********************entry in activity log table***************************************/
        $account_name=$db->get_var('accounts',array('id'=>$action_id),'account_name');

        $event="Change status to inactive of Account (" . $account_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Accounts Inactive Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("accounts",user)."'
        	                },3000);</script>";
    }
}
?>

<div class="row">
   <div class="col-lg-12">
      <div class=" padded" >
         <h3>CHART OF ACCOUNT</h3>
      </div>
      <?php echo $display_msg;?>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
            <div class="row">
               <div class="col-lg-12">
                <!-- <a href="<?php echo $link->link('accounts_type',user);?>" class="btn btn-default"> Accounts type </a>
                <a href="<?php echo $link->link('default_account_setting',user);?>" class="btn btn-default pull-right"> Account Setting </a>-->
                <?php if(in_array('create_and_edit',$adm_accounts)){?>
                  <a href="<?php echo $link->link('add_account',user);?>" class="btn btn-default pull-right"> Add Accounts</a>
                  <?php }?>
               </div>
            </div>
            <div class="heading tabs">
               <i class="icon-sitemap"></i>
               <ul class="nav nav-tabs pull-left" data-tabs="tabs">
               <li tab="all"  class="set_cookie <?php if ($current_tab=='' || $current_tab=='all'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>All</span></a>
                  </li>
                  <li tab="income"  class="set_cookie <?php if ($current_tab=='income'){echo 'active';}?>">
                     <a  href="#"><i class="icon-comments"></i><span>Income</span></a>
                  </li>
                  <li tab="cogs"  class="set_cookie <?php if ($current_tab=='cogs'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>COGS</span></a>
                  </li>
                  <li tab="expense"  class="set_cookie <?php if ($current_tab=='expense'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>Expenses</span></a>
                  </li>
                  <li tab="assets"  class="set_cookie <?php if ($current_tab=='assets'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>Assets</span></a>
                  </li>
                  <li tab="liabilities"  class="set_cookie <?php if ($current_tab=='liabilities'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>Liabilities</span></a>
                  </li>
                  <li tab="equity"  class="set_cookie <?php if ($current_tab=='equity'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>Equity</span></a>
                  </li>

               </ul>
            </div>
            <div class="tab-content padded">
            <div class="row">
                  <div class="col-lg-12">
                     <div class="widget-container fluid-height clearfix">
                      <div class="widget-content padded clearfix">
                           <table class="table table-bordered table-striped" id="dataTable1">
                              <thead>
<tr>
                                    <th class="check-header hidden-xs">
                                      S.no
                                    </th>
                                    <th>Type </th>
                                    <th>Name</th>
                                    <th class="hidden-xs">Code</th>
                                    <th class="hidden-xs">Description</th>

                                    <th class="hidden-xs">Status</th>
                                    <th>Action</th>
                                    </tr>

                              </thead>
                              <tbody>
                                 <?php if (is_array($all_account)){
                                 	$sn=1;
                                    foreach ($all_account as $alla){?>
                                 <tr>
                                    <td class="check hidden-xs">
                                      <?php echo $sn;?>
                                    </td>
                                    <td><?php echo ucfirst(str_replace("_", " ", $alla['account_type']));?></td>
                                    <td><?php echo $alla['account_name'];?></td>
                                    <td class="hidden-xs"><?php echo $alla['account_code'];?></td>
                                    <td class="hidden-xs"><?php echo $alla['account_description'];?></td>

                                    <td class="hidden-xs">
                                       <span class="label label-<?php if ($alla['visibility_status']=='active'){echo "success";}else{echo "warning";};?>"><?php echo $alla['visibility_status'];?></span>
                                    </td>

                                    <td>
                                    <?php if ($alla['account_type']!="bank" && $alla['account_type']!="account_receivable" && $alla['account_type']!="account_payble"){?> <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                            <?php if(in_array('create_and_edit',$adm_accounts)){?>
                                            <li>
                                            <a href="<?php echo $link->link('edit_account',user,'&account_id='.$alla['id']);?>"><i class="fa fa-edit"></i>Edit</a>
                                          </li>
                                          <?php } /*if(in_array('delete',$adm_accounts)){?>
                                            <li>
                                            <a href="<?php echo $link->link('accounts',user,'&action_delete='.$alla['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>
                                              <?php }*/ ?>
                                                <li>
                                                <?php if ($alla['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('accounts',user,'&action_active='.$alla['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
						
						<?php if (Asset_Account_for_Tracking_Receivables!=$alla['id']
                                                          && Bank_Account_for_Customer_Receipts!=$alla['id']
                                                          && Bank_Account_for_Paying_Bills!=$alla['id']
                                                          && Liability_Account_for_Item_Receipts!=$alla['id']
                                                          && ACCOUNT_FOR_TAX_COLLECTED!=$alla['id']
                                                          && ACCOUNT_FOR_TAX_PAID!=$alla['id']){?>


                                                <a href="<?php echo $link->link('accounts',user,'&action_inactive='.$alla['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }}?>
                                              </li>
                                            </ul>
                                          </div><?php }?>
                                          </td>

                                 </tr>
                                 <?php $sn++; }}?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end DataTables Example -->
               </p>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
      $(".set_cookie").click(function(){
          var tab=$(this).attr('tab');
        //  alert(tab);

          var ct=document.cookie = "current_tab="+tab;
          window.location.href="";

          });</script>