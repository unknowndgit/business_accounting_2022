<?php $current_tab=$_COOKIE['current_tab'];

if ($current_tab!=="active" && $current_tab!=="inactive")
{
    $current_tab="";
}

if ($current_tab=="inactive")
{
    $alltax=$db->get_all('tax',array('visibility_status'=>'inactive'));
}
else
{
    $alltax=$db->get_all('tax',array('visibility_status'=>'active'));
}


?>


<?php
if (isset($_REQUEST['action_active']))
	{
	    $action_id=$_REQUEST['action_active'];
	    $update=$db->update('tax',array('visibility_status'=>'active'),array('id'=>$action_id));
	    if ($update)
	    {
	        $tax_name=$db->get_var('tax',array('id'=>$action_id),'tax_name');
	        $event="Status Change to active of tax " .$tax_name ;
	        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	            'event'=>$event,
	            'created_date'=>date('Y-m-d'),
	            'ip_address'=>$_SERVER['REMOTE_ADDR']

	        ));
	        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Active Successfully.
                		</div>';
	        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";
	    }
	}
	elseif (isset($_REQUEST['action_inactive']))
	{
	    $action_id=$_REQUEST['action_inactive'];
	    $update=$db->update('tax',array('visibility_status'=>'inactive'),array('id'=>$action_id));
	    if ($update)
	    {
	        $tax_name=$db->get_var('tax',array('id'=>$action_id),'tax_name');
	        $event="Status Change to inactive of tax " .$tax_name ;
	        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	            'event'=>$event,
	            'created_date'=>date('Y-m-d'),
	            'ip_address'=>$_SERVER['REMOTE_ADDR']

	        ));
	        $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Inactive Successfully.
                		</div>';
	        echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";
	    }
	}
?>

<?php
/*
if (isset($_REQUEST['make_tax_default']))
{
    $actionid=$_REQUEST['make_tax_default'];
    $db->run("update `tax` set `default_tax_code` = case when `id` != '$actionid' then '0' when `id`= '$actionid' then '1' end");

    $tax_name=$db->get_var('tax',array('id'=>$actionid),'tax_name');
    $event="Tax " . $tax_name . " Set as default tax";
    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
        'event'=>$event,
        'created_date'=>date('Y-m-d'),
        'ip_address'=>$_SERVER['REMOTE_ADDR']

    ));
    $session->redirect('taxes',user);

}


if(isset($_REQUEST['tax_delete']))
{
    $delete_id=$_REQUEST['tax_delete'];

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
        $delete=$db->delete('tax',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('taxes',user);
    }

}
*/
?>


<div class="row">

	<div class="col-lg-12">
	<?php echo $display_msg;?>
	<div class=" padded" >
					<h3>TAX SETTINGS</h3>
				</div>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">



               <div class="row">
	<div class="col-lg-12">

<a href="<?php echo $link->link('taxes',user);?>" class="btn <?php if ($query1ans=="taxes"){echo "btn-primary";}else{echo "btn-default";}?>">Tax Codes</a>
<a href="<?php echo $link->link('tax_setting',user);?>" class="btn <?php if ($query1ans=="tax_setting"){echo "btn-primary";}else{echo "btn-default";}?>">Tax Settings</a>



       	<?php if(in_array('edit',$adm_tax_settings)){?>
       <a href="<?php echo $link->link('add_tax',user);?>" class="btn btn-default pull-right"> Add Tax </a>
         <?php }?>
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li  tab="active"  class="set_cookie <?php if ($current_tab=="active" || $current_tab==""){echo"active";}?>">
	                        <a  href="#"><i class="icon-comments"></i><span>Active</span></a>
	                      </li>
	                      <li tab="inactive"  class="set_cookie <?php if ($current_tab=="inactive"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Inactive</span></a>
	                      </li>
	                     </ul>
	                  </div>

					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">

					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
										<th>S.No</th>
					                    <th>Name</th>
					                    <th>Section</th>
					                   <th>Description</th>
					                   <th>Tax rate</th>
                                       <th></th>
                              </tr>
					                  </thead>
					                  <tbody>
					                  <?php if (is_array($alltax)){
					                  		$sn=1;
					                      foreach ($alltax as $allt){
					                  ?>
					                    <tr>
					                        <td><?php echo $sn; $sn++;?></td>
                                            <td><?php echo $allt['tax_name'];?></td>
                                            <td><?php echo $allt['what_trans_is_used'];?></td>
					                        <td><?php echo $allt['tax_description'];?></td>
					                        <td><?php echo $allt['tax_rate'];?>%</td>
                                            <td>


                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                            	<?php if(in_array('edit',$adm_tax_settings)){?>
                                            	 <li>
                                            <a href="<?php echo $link->link('edit_tax',user,'&tax_id='.$allt['id'].'&tax_type='.$allt['tax_type']);?>"><i class="fa fa-edit"></i>Edit</a>
                                              </li>
                                              <?php }?>
                                               <!-- <li>
                                                <a href="<?php echo $link->link('taxes',user,'&tax_delete='.$allt['id']);?>"><i class="fa fa-edit"></i>Delete</a>
                                                  </li>-->
                                                <li>
                                                <?php if ($allt['visibility_status']=="inactive"){?>
                                                <a href="<?php echo $link->link('taxes',user,'&action_active='.$allt['id']);?>"><i class="fa fa-edit"></i>Active</a>
                                                <?php }else{?>
                                                <a href="<?php echo $link->link('taxes',user,'&action_inactive='.$allt['id']);?>"><i class="fa fa-edit"></i>Inactive</a><?php }?>
                                              </li>

                                            </ul>
                                          </div></td>


					                    </tr>
					                    <?php }}?>


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

<script>
      $(".set_cookie").click(function(){
          var tab=$(this).attr('tab');
        //  alert(tab);

          var ct=document.cookie = "current_tab="+tab;
          window.location.href="";

          });</script>

