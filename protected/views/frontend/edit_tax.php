<?php
if (isset($_REQUEST['tax_type']))
{
    $tt=$_REQUEST['tax_type'];
}
if (isset($_REQUEST['tax_id'])){
  $tax_id=$_REQUEST['tax_id'];
    $tax_detail=$db->get_row('tax',array('id'=>$tax_id));

}
if (isset($_POST['edit_tax_submit']))
{
//print_r($_POST);
  $tax_id=$_REQUEST['tax_id'];
   //$tax_name=$_POST['tax_name'];
    $tax_description=$_POST['tax_description'];
     $visibility_status=$_POST['visibility_status'];
     $created_date=date('Y-m-d');
     $ip_address=$_SERVER['REMOTE_ADDR'];

    if ($fv->emptyfields(array('Tax Description'=>$tax_description),NULL))
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Tax description cannot be empty.
                		</div>';

    }
    else{
        $update=$db->update("tax",array(//'tax_name'=>$tax_name,
            //'tax_type'=>$tax_type,
            'tax_description'=>$tax_description,
            //'tax_rate'=>$tax_rate,
            'visibility_status'=>$visibility_status,
            'created_date'=>$created_date,
            'ip_address'=>$ip_address),array('id'=>$tax_id));
        //$db->debug();

        if ($update){
            $tax_name=$db->get_var('tax',array('id'=>$tax_id),'tax_name');
            $event="Edit tax " .$tax_name ;
            $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                'event'=>$event,
                'created_date'=>date('Y-m-d'),
                'ip_address'=>$_SERVER['REMOTE_ADDR']

            ));
            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax is Updated Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";


        }



  }
 }

?>

<div class="row">
   <div class="col-lg-12">
<?php echo $display_msg;?>
      <div class="padded" >
         <h3>Edit tax code</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">

          <!--  <a href="" class="btn btn-primary"> General </a>
             <a href="" class="btn btn-primary">BAS details</a>-->

            <a href="<?php echo $link->link('taxes',user);?>" class="btn btn-default pull-right"> < Back to List</a>


           <form action="#" class="form-horizontal" method="post">
        		<div class="row">
					<div class="col-lg-12">
						<button class="btn btn-success pull-right" type="submit" name="edit_tax_submit"> Save </button>

                </div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6">
						  <div class="form-group">
					            <label class="control-label col-md-4" >Tax type<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					               <select class="form-control" name="tax_type" id="tax_type_edit_id" disabled>
					              <option  value="">Select</option>
					               <option <?php if ($tt=="gst"){echo "selected='selected'";}?>  value="gst" >Goods & service tax</option>
					              <option <?php if ($tt=="import_duty"){echo "selected='selected'";}?>  value="import_duty">Import duty</option>
					               <option <?php if ($tt=="sale_tax"){echo "selected='selected'";}?>  value="sale_tax">Sale tax</option>
					               <option <?php if ($tt=="input_tax"){echo "selected='selected'";}?>  value="input_tax">Input tax</option>
                           <!--   <option <?php if ($tt=="Consolidated"){echo "selected='selected'";}?>  value="Consolidated">Consolidated</option> -->
					              </select>
					            </div>
					        </div>

							<div class="form-group">
					            <label class="control-label col-md-4">Name<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="tax_name" value="<?php echo $tax_detail['tax_name'];?>" disabled>
					            </div>
					        </div>
					        <div class="form-group">
                                        <label class="control-label col-md-4">Description<span style="color:red;">*</span></label>
                                        <div class="col-md-7">
                                          <textarea class="form-control" rows="5" name="tax_description" ><?php echo $tax_detail['tax_description'];?></textarea>
                                        </div>
                                      </div>
                              <div class="form-group">
					            <label class="control-label col-md-4">Tax Rate<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="number" name="tax_rate" min="0" max="100" value="<?php echo $tax_detail['tax_rate'];?>" disabled>
					            </div>
					        </div>
 <!--     <div class="form-group">
					            <label class="control-label col-md-4">What transactions will this be used for<span style="color:red;">*</span></label>
					           <div class="col-md-7">
					     <label class="checkbox-inline" >
                              <input  type="checkbox" name="what_trans_is_used" value="sales" class="transaction_sale">
                              <span> Sales</span>
                              </label>
                              <label class="checkbox-inline">
                              <input type="checkbox" name="what_trans_is_used" value="purchases" class="transaction_purchases"><span> Purchases</span>
                              </label>

                              </div>

					        </div> -->
					        		  <div class="form-group">
					            <label class="control-label col-md-4">Status</label>
					            <div class="col-md-7">
					               <select class="form-control" name="visibility_status">
					              	<option <?php if ($tax_detail['visibility_status']=='active'){echo "selected='selected'";}?> value="active">Active</option>
					              	<option <?php if ($tax_detail['visibility_status']=='inactive'){echo "selected='selected'";}?> value="inactive">Inactive</option>
					              </select>
					            </div>
					            </div>




						</div>
						<div class="col-lg-6">
						<?php if ($tt=="gst"){?>
						  <div class="form-group">
					            <label class="control-label col-md-4" >IRAS GST code<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="iras_for_gst_code" disabled>
					              <option  value="">Select</option>
					              <?php $all_iras_code=$db->get_all('iras_gst_codes');
					              if (is_array($all_iras_code))
					              {
					                  foreach ($all_iras_code as $alliras)
					                  {?>
					                  <option  <?php if ($tax_detail['iras_for_gst_code']==$alliras['code']){echo 'selected';}?> value="<?php echo $alliras['code'];?>"><?php echo $alliras['code'] . "- " . $alliras['description'];?></option>
					                  <?php }
					              }
					              ?>

					             </select>
					            </div>
					             <div class="col-md-1"><a href="<?php echo $link->link("iras_gst_codes",user);?>"><span style="color:red;"><i class="lnr lnr lnr-magnifier"></i></span></a></div>

					        </div>
					          <div class="form-group">
					            <label class="control-label col-md-4" >Linked Account for Tax Collected <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="tax_account_for_gst_collected" disabled>
					              <option  value="">Select</option>
					              <?php $all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
					              if (is_array($all_accounts))
					              {
					                  foreach ($all_accounts as $alla)
					                  {?>
					                  <option  <?php if ($tax_detail['tax_account_for_gst_collected']==$alla['id']){echo 'selected';}?> value="<?php echo $alla['id'];?>"><?php echo $alla['account_name'];?></option>
					                  <?php }
					              }
					              ?>

					              </select>
					            </div>
					        </div>
					       <div class="form-group">
					            <label class="control-label col-md-4" >Linked Account for Tax Paid <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="tax_account_for_gst_paid" disabled>
					              <option  value="">Select</option>
					              <?php $all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
					              if (is_array($all_accounts))
					              {
					                  foreach ($all_accounts as $alla)
					                  {?>
					                  <option  <?php if ($tax_detail['tax_account_for_gst_paid']==$alla['id']){echo 'selected';}?> value="<?php echo $alla['id'];?>"><?php echo $alla['account_name'];?></option>
					                  <?php }
					              }
					              ?>

					              </select>
					            </div>
					        </div>
					        <?php }elseif ($tt=="import_duty"){?>
					         <div class="form-group">
					            <label class="control-label col-md-4" >Linked Account for Accrued duty <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="account_tax_import_duty" disabled>
					              <option  value="">Select</option>
					              <?php $all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
					              if (is_array($all_accounts))
					              {
					                  foreach ($all_accounts as $alla)
					                  {?>
					                  <option  <?php if ($tax_detail['account_tax_import_duty']==$alla['id']){echo 'selected';}?> value="<?php echo $alla['id'];?>"><?php echo $alla['account_name'];?></option>
					                  <?php }
					              }
					              ?>

					              </select>
					            </div>
					        </div>
					           <?php }elseif ($tt=="sale_tax"){?>
					         <div class="form-group">
					            <label class="control-label col-md-4" >Linked Account for Tax Collected <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="account_tax_sale_tax" disabled>
					              <option  value="">Select</option>
					              <?php $all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
					              if (is_array($all_accounts))
					              {
					                  foreach ($all_accounts as $alla)
					                  {?>
					                  <option <?php if ($tax_detail['account_tax_sale_tax']==$alla['id']){echo 'selected';}?> value="<?php echo $alla['id'];?>"><?php echo $alla['account_name'];?></option>
					                  <?php }
					              }
					              ?>

					              </select>
					            </div>
					        </div>
					        <?php }?>

 </div>
						</div>
					</div>
					</form>
         </div>
      </div>
   </div>
</div>
<script>
</script>
