<?php
$status=$_REQUEST['tab'];
if ($status=='active'){
    $db->order_by="id DESC";
	$items=$db->get_all('items',array('visibility_status'=>'active'));
}
elseif ($status=='inactive'){
    $db->order_by="id DESC";
	$items=$db->get_all('items',array('visibility_status'=>'inactive'));
}
else{
    $db->order_by="id DESC";
	$items=$db->get_all('items');
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
        $item_name=$db->get_var('items',array('id'=>$_POST['del_id']),'item_name');
        $event="Delete item (" . $item_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('items',array('id'=>$_POST['del_id']));

        $delete_item_project=$db->delete('assign_item_project',array('item'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    item Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("item",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('item',user);
    }

}
elseif (isset($_REQUEST['action_active']))
{
    $action_id=$_REQUEST['action_active'];
    $update=$db->update('items',array('visibility_status'=>'active'),array('id'=>$action_id));
    if ($update)
    {
        $item_name=$db->get_var('items',array('id'=>$action_id),'item_name');
        $event="Status change to active of item  (" . $item_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));

        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    item Active Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("item",user)."'
        	                },3000);</script>";
    }
}
elseif (isset($_REQUEST['action_inactive']))
{
    $action_id=$_REQUEST['action_inactive'];
    $update=$db->update('items',array('visibility_status'=>'inactive'),array('id'=>$action_id));
    if ($update)
    {
        $item_name=$db->get_var('items',array('id'=>$action_id),'item_name');
        $event="Status change to inactive of item  (" . $item_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    item Inactive Successfully.
                		</div>';
        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("item",user)."'
        	                },3000);</script>";
    }
}
?>


<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>ITEMS</h3>
				</div>

				<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">



               <div class="row">
	<?php  $current_tab=$_REQUEST['tab'];?>
	<?php if(in_array('create_and_edit',$dtd_items)){?>
   <a href="<?php echo $link->link('add_item',user);?>" class="btn btn-default pull-right"> Add Item </a>
   <?php }?>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li class="<?php if ($current_tab=="active" || $current_tab==""){echo"active";}?>">
	                        <a  href="<?php echo $link->link('item',user,'&tab=active');?>"><i class="icon-comments"></i><span>Active</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="inactive"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('item',user,'&tab=inactive');?>"><i class="icon-user"></i><span>Inactive</span></a>
	                      </li>
	                      <li class="<?php if ($current_tab=="All"){echo"active";}?>">
	                        <a  href="<?php echo $link->link('item',user,'&tab=All');?>"><i class="icon-user"></i><span>All</span></a>
	                      </li>
	                     </ul>
	                  </div>

					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">
									<div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr>
					                    <th width="5%">S.no</th>
					                    <th width="15%">Name</th>
					                    <th width="10%">Type</th>
					                    <th width="15%">Sale price</th>
					                    <th width="15%">Sale account</th>
					                     <th width="15%">Purchase price</th>
					                     <th width="10%">Purchase account</th>
					                     <th width="15%">Action</th>
					                     </tr>
					                  </thead>
					                  <tbody>
					                  <?php if (is_array($items)){
					                      $sn=1;
										foreach ($items as $item){ ?>
					                    <tr>
					                      <td class="check hidden-xs">
					                        <?php echo $sn;?>
					                      </td>
					                      <td><?php echo $item['item_name'];?></td>
					                      <td><?php echo $item['item_type'];?></td>
                                           <td><?php if($item['selling_price']!=""){ echo CURRENCY ." ".number_format($item['selling_price'],2,'.',',');}?></td>
					                      <td><?php echo $sia=$db->get_var('accounts',array('id'=>$item['sell_item_account']),'account_name');?></td>
					                      <td><?php if($item['buying_price']!=""){ echo CURRENCY ." ".number_format($item['buying_price'],2,'.',',');}?></td>
					                       <td><?php echo $bia=$db->get_var('accounts',array('id'=>$item['buy_item_account']),'account_name');?></td>
					                        <td>
					                          <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                 <?php if(in_array('create_and_edit',$dtd_items)){?>
                                          <li>
                                            <a href="<?php echo $link->link('edit_item',user,'&action_edit='.$item['id'].'&item_to='.$item['item_to']);?>"><i class="fa fa-edit"></i>Edit</a>
                                              </li>
                                              <?php }if(in_array('delete',$dtd_items)){?>
                                            <li>
                                            <a href="<?php echo $link->link('item',user,'&action_delete='.$item['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                              </li>
                                              <?php }?>
                                                <li>
                                                <?php if ($item['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('item',user,'&action_active='.$item['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('item',user,'&action_inactive='.$item['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
                                              </li>
                                            </ul>
                                          </div>    <?php if ($item['visibility_status']=="active"){?>
                                                <span class="label label-success" ><?php echo $item['visibility_status'];?></span>
                                                <?php }else{?>
                                                <span class="label label-warning"><?php echo $item['visibility_status'];?></span>
                                                <?php }?></td>
					                    </tr>
					                  <?php $sn++; }}?>
                                  </tbody>
					                </table>
					              </div>

					            </div>
					          </div>
					        </div>



            </div>
        </div>
    </div>
</div>