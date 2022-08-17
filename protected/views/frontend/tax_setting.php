<?php
$query="select * from accounts where `visibility_status`='active' AND  `account_type`!='bank' AND `account_type`!='account_receivable' AND ( `nature`='assets' || `nature`='liabilities')";
$account=$db->run($query)->fetchAll();

if (isset($_POST[submit])){
	//print_r($_POST);



	$default_tax_sale=$_POST['default_tax_for_sale'];
	$default_tax_purchase=$_POST['default_tax_for_purchase'];

	$create_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];

	//$insert=$db->insert('tax_setting',array('register_for_tax'=>$register_for_tax, 'reporting_basis'=>$reporting_basis, 'default_sale_figure'=>$default_sale_figure, 'default_tax_sale'=>$default_tax_sale, 'default_tax_purchase'=>$default_tax_purchase, 'allow_user_edit_tax'=>$allow_user_edit_tax, 'allow_user_include_tax'=>$allow_user_include_tax, 'create_date'=>$create_date, 'ip_address'=>$ip_address ));

	$update=$db->update('tax_setting',array('default_tax_for_sale'=>$default_tax_sale,
	                                        'default_tax_for_purchase'=>$default_tax_purchase,
	                                        'ip_address'=>$ip_address),array('id'=>1));

	if ($update){
		$display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax setting saved successfully.
                		</div>';
		echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("tax_setting",user)."'
        	                },3000);</script>";
	}
}

$tax_setting=$db->get_row('tax_setting',array('id'=>'1'));
?>

 <div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>TAX SETTINGS</h3></div>
					<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">
	         <div class="row">

	<div class="col-lg-12">


<a href="<?php echo $link->link('taxes',user);?>" class="btn <?php if ($query1ans=="taxes"){echo "btn-primary";}else{echo "btn-default";}?>">Tax Codes</a>
<a href="<?php echo $link->link('tax_setting',user);?>" class="btn <?php if ($query1ans=="tax_setting"){echo "btn-primary";}else{echo "btn-default";}?>">Tax Settings</a>
<br>
 </div>
	</div>


					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">
          <form  action="" method="post" class="form-horizontal">

           <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">


                         <div class="form-group" >
                           <label class="control-label col-md-5">Default tax for sales<font color="red">*</font></label>
                           <div class="col-md-7">
                                 <select class="form-control" name="default_tax_for_sale">
									<?php
									$sale_tax=$db->get_all('tax',array('tax_type'=>'gst','what_trans_is_used'=>'supply','visibility_status'=>'active'));

									 if (is_array($sale_tax)){
										foreach ($sale_tax as $ts){?>
											<option value="<?php echo $ts['id']?>" <?php if ($tax_setting['default_tax_for_sale']==$ts['id']){echo 'selected';}?>><?php echo $ts['tax_name']?>@<?php echo $ts['tax_rate']?></option>
									<?php }
									}?>
                              </select>
                           </div>
                        </div>
                         <div class="form-group" >
                           <label class="control-label col-md-5">Default tax for purchases<font color="red">*</font></label>
                           <div class="col-md-7">
                                 <select class="form-control" name="default_tax_for_purchase">
                           <?php
									$purchase_tax=$db->get_all('tax',array('tax_type'=>'gst','what_trans_is_used'=>'purchase','visibility_status'=>'active'));

									 if (is_array($purchase_tax)){
										foreach ($purchase_tax as $tp){?>
											<option value="<?php echo $tp['id']?>" <?php if ($tax_setting['default_tax_for_purchase']==$tp['id']){echo 'selected';}?>><?php echo $tp['tax_name']?>@<?php echo $ts['tax_rate']?></option>
									<?php }
									}?>
									 </select>
                           </div>
                        </div>



                              <div class="form-group">
                           <label class="control-label col-md-5"></label>
                           <div class="col-md-7">
                           <button class="btn btn-default btn-block" type="submit" name="submit">Save</button>

                           </div>
                        </div>







                     </div>
                     <div class="col-md-6"></div>
</div>
               <br>
               <br>
               <br>
               </div>

            </form>
					            </div>
					          </div>
					        </div>
					                    </div>
        </div>
    </div>
</div>