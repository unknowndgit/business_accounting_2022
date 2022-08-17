<?php
if (isset($_REQUEST['tax_type']))
{
 $tt=$_REQUEST['tax_type'];
}
if (isset($_POST['add_tax_submit']))
{
//print_r($_POST);

     $tax_name=$_POST['tax_name'];
     $tax_description=$_POST['tax_description'];
     $visibility_status=$_POST['visibility_status'];
     $tax_rate=$_POST['tax_rate'];
     $tax_type=$_POST['tax_type'];
     $account_tax_gst_paid=$_POST['account_tax_gst_paid'];
     $account_tax_gst_collected=$_POST['account_tax_gst_collected'];
     $iras_for_gst_code=$_POST['iras_for_gst_code'];
     $account_tax_import_duty=$_POST['account_tax_import_duty'];
     $account_tax_sale_tax=$_POST['account_tax_sale_tax'];
     if($tax_rate==''){
      $tax_rate=0;
     }
     $tax_purpose=$_POST['what_trans_is_used'];
     $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $pattern = '/^(?:0|[0-9]\d*)(?:\.\d{2})?$/';



     if ($tax_type=="gst")
     {
         $tax_purpose=$db->get_var('iras_gst_codes',array('code'=>$iras_for_gst_code),'purpose');
         $empt_fields = $fv->emptyfields(array('Tax Type'=>$tax_type,
                                               'Tax Name'=>$tax_name,
                                               'Tax Description'=>$tax_description,
                                               'Tax Rate'=>$tax_rate,
                                               'Account for Tax Paid'=>$account_tax_gst_paid,
                                               'Account for Tax Collected'=>$account_tax_gst_collected,
                                               'IRAS GST code'=>$iras_for_gst_code,
                                      ));

        if ($empt_fields)
        {
              $display_msg= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
        }
        elseif (preg_match($pattern, $tax_rate) == '0'){
            $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Tax rate must be numeric.</strong></div>';
        }
        else{

            $insert=$db->insert("tax",array('tax_name'=>$tax_name,
                                            'tax_type'=>$tax_type,
                                            'tax_description'=>$tax_description,
                                            'tax_rate'=>$tax_rate,
                                            'what_trans_is_used'=>$tax_purpose,
                                            'tax_account_for_gst_paid'=>$account_tax_gst_paid,
                                            'tax_account_for_gst_collected'=>$account_tax_gst_collected,
                                            'iras_for_gst_code'=>$iras_for_gst_code,
                                            'visibility_status'=>$visibility_status,
                                           'created_date'=>$created_date,
                                            'ip_address'=>$ip_address));
            //$db->debug();

            if ($insert){
                $event="Add new tax (" .$tax_name. ") of tax type " . $tax_type;
                $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                    'event'=>$event,
                    'created_date'=>date('Y-m-d'),
                    'ip_address'=>$_SERVER['REMOTE_ADDR']

                ));
                $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax is added Successfully.
                		</div>';
               echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";


            }
 }

 }
     elseif ($tax_type=="import_duty")
     {
         $what_trans_is_used=$_POST['what_trans_is_used'];

         $empt_fields = $fv->emptyfields(array('Tax Type'=>$tax_type,
                                               'Tax Name'=>$tax_name,
                                               'Tax Description'=>$tax_description,
                                               'Tax Rate'=>$tax_rate,
                                               'Account for Accrued duty'=>$account_tax_import_duty,
                                               'What transactions will this be used for'=>$what_trans_is_used));

         if ($empt_fields)
         {
             $display_msg= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
         }  elseif (preg_match($pattern, $tax_rate) == '0'){
        $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Tax rate must be numeric.</strong></div>';
    }
         else{

             $insert=$db->insert("tax",array('tax_name'=>$tax_name,
                                             'tax_type'=>$tax_type,
                                             'tax_description'=>$tax_description,
                                             'tax_rate'=>$tax_rate,
                                             'what_trans_is_used'=>$tax_purpose,
                                             'account_tax_import_duty'=>$account_tax_import_duty,
                                             'visibility_status'=>$visibility_status,
                                             'created_date'=>$created_date,
                                             'ip_address'=>$ip_address));
            // $db->debug();

             if ($insert){
                 $event="Add new tax (" .$tax_name. ") of tax type " . $tax_type;
                 $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                     'event'=>$event,
                     'created_date'=>date('Y-m-d'),
                     'ip_address'=>$_SERVER['REMOTE_ADDR']

                 ));
                 $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax is added Successfully.
                		</div>';
                 echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";


             }
     }
   }
     elseif ($tax_type=="sale_tax")
     {
         $what_trans_is_used=$_POST['what_trans_is_used'];

         $empt_fields = $fv->emptyfields(array('Tax Type'=>$tax_type,
                                               'Tax Name'=>$tax_name,
                                               'Tax Description'=>$tax_description,
                                               'Account for Tax Collected'=>$account_tax_sale_tax,
                                               'What transactions will this be used for'=>$what_trans_is_used
         ));

         if ($empt_fields)
         {
             $display_msg= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
         }
         elseif (preg_match($pattern, $tax_rate) == '0'){
        $display_message='<div class="alert alert-danger">
						  <button class="close" data-dismiss="alert" type="button">×</button>
						  <strong>Tax rate must be numeric.</strong></div>';
    }
         else{

             $insert=$db->insert("tax",array('tax_name'=>$tax_name,
                                             'tax_type'=>$tax_type,
                                             'tax_description'=>$tax_description,
                                             'tax_rate'=>$tax_rate,
                                             'what_trans_is_used'=>$tax_purpose,
                                             'account_tax_sale_tax'=>$account_tax_sale_tax,
                                             'visibility_status'=>$visibility_status,
                                             'created_date'=>$created_date,
                                             'ip_address'=>$ip_address));
           //  $db->debug();

             if ($insert){
                 $event="Add new tax (" .$tax_name. ") of tax type " . $tax_type;
                 $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                     'event'=>$event,
                     'created_date'=>date('Y-m-d'),
                     'ip_address'=>$_SERVER['REMOTE_ADDR']

                 ));
                 $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax is added Successfully.
                		</div>';
                 echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";


             }
      }
  }
     elseif ($tax_type=="input_tax")
     {
      $what_trans_is_used=$_POST['what_trans_is_used'];

         $empt_fields = $fv->emptyfields(array('Tax Type'=>$tax_type,
                                               'Tax Name'=>$tax_name,
                                               'Tax Description'=>$tax_description,
                                               'What transactions will this be used for'=>$what_trans_is_used
         ));

         if ($empt_fields)
         {
             $display_msg= '<div class="alert alert-danger">
        		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
                  Oops! Following fields are empty<br>'.$empt_fields.'</div>';
         }
          elseif (preg_match($pattern, $tax_rate) == '0'){
                $display_message='<div class="alert alert-danger">
        						  <button class="close" data-dismiss="alert" type="button">×</button>
        						  <strong>Tax rate must be numeric.</strong></div>';
            }
         else{
            $insert=$db->insert("tax",array('tax_name'=>$tax_name,
                 'tax_type'=>$tax_type,
                 'tax_description'=>$tax_description,
                 'tax_rate'=>$tax_rate,
                'what_trans_is_used'=>$tax_purpose,
                'visibility_status'=>$visibility_status,
                 'created_date'=>$created_date,
                 'ip_address'=>$ip_address));
            // $db->debug();

             if ($insert){
                 $event="Add new tax (" .$tax_name. ") of tax type " . $tax_type;
                 $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                     'event'=>$event,
                     'created_date'=>date('Y-m-d'),
                     'ip_address'=>$_SERVER['REMOTE_ADDR']

                 ));
                 $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Tax is added Successfully.
                		</div>';
                 echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("taxes",user)."'
        	                },3000);</script>";


             }}
       }

 }
?>
<div class="row">
   <div class="col-lg-12">
<?php echo $display_msg;?>
      <div class="padded" >
         <h3>Add tax code</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">

          <!--  <a href="" class="btn btn-primary"> General </a>
             <a href="" class="btn btn-primary">BAS details</a>-->
             <form action="#" class="form-horizontal" method="post">
        		<div class="row">
					<div class="col-lg-12">
						 <a href="<?php echo $link->link('taxes',user);?>" class="btn btn-default pull-right"> Back to List</a>

						<button class="btn btn-primary pull-right" type="submit" name="add_tax_submit"> Save </button>

					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6">
						  <div class="form-group">
					            <label class="control-label col-md-4" >Tax type<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="tax_type" id="tax_type_id">
					              <option  value="">Select</option>
					               <option <?php if ($tt=="gst"){echo "selected='selected'";}?>  value="gst">Goods & service tax</option>
					             <!--   <option <?php if ($tt=="Consolidated"){echo "selected='selected'";}?>  value="Consolidated">Consolidated</option> -->
					               <option <?php if ($tt=="import_duty"){echo "selected='selected'";}?>  value="import_duty">Import duty</option>
					               <option <?php if ($tt=="sale_tax"){echo "selected='selected'";}?>  value="sale_tax">Sale tax</option>
					               <option <?php if ($tt=="input_tax"){echo "selected='selected'";}?>  value="input_tax">Input tax</option>

					              </select>
					            </div>
					        </div>

							<div class="form-group">
					            <label class="control-label col-md-4">Name<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="text" name="tax_name" >
					            </div>
					        </div>
					        <div class="form-group">
                                        <label class="control-label col-md-4">Description<span style="color:red;">*</span></label>
                                        <div class="col-md-7">
                                          <textarea class="form-control" rows="5" name="tax_description" ></textarea>
                                        </div>
                                      </div>
                              <div class="form-group">
					            <label class="control-label col-md-4">Tax Rate<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <input class="form-control" placeholder="" type="number" name="tax_rate" min="0" max="100" value="0">
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
						<div class="col-lg-6">
						<?php if ($tt=="gst"){?>
						  <div class="form-group">
					            <label class="control-label col-md-4" >IRAS GST code<span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="iras_for_gst_code">
					              <option  value="">Select</option>
					              <?php $all_iras_code=$db->get_all('iras_gst_codes');
					              if (is_array($all_iras_code))
					              {
					                  foreach ($all_iras_code as $alliras)
					                  {?>
					                  <option  value="<?php echo $alliras['code'];?>"><?php echo $alliras['code'] . "- " . $alliras['description'];?></option>
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
					              <select class="form-control" name="account_tax_gst_collected" readonly="">
					              <option  value="<?php echo ACCOUNT_FOR_TAX_COLLECTED;?>"><?php echo $account_gst_collected=$db->get_var('accounts',array('id'=>ACCOUNT_FOR_TAX_COLLECTED),'account_name');?></option>


					              </select>
					            </div>
					        </div>
					       <div class="form-group">
					            <label class="control-label col-md-4" >Linked Account for Tax Paid <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="account_tax_gst_paid" readonly="">

					              <option  value="<?php echo ACCOUNT_FOR_TAX_PAID;?>"><?php echo $account_gst_collected=$db->get_var('accounts',array('id'=>ACCOUNT_FOR_TAX_PAID),'account_name');?></option>



					              </select>
					            </div>
					        </div>
					        <?php }elseif ($tt=="import_duty"){?>
					         <div class="form-group">
					            <label class="control-label col-md-4" >Linked Account for Accrued duty <span style="color:red;">*</span></label>
					            <div class="col-md-7">
					              <select class="form-control" name="account_tax_import_duty" >
					              <option  value="">Select</option>
					              <?php $all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
					              if (is_array($all_accounts))
					              {
					                  foreach ($all_accounts as $alla)
					                  {?>
					                  <option  value="<?php echo $alla['id'];?>"><?php echo $alla['account_name'];?></option>
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
					              <select class="form-control" name="account_tax_sale_tax">
					              <option  value="">Select</option>
					              <?php $all_accounts=$db->get_all('accounts',array('visibility_status'=>'active'));
					              if (is_array($all_accounts))
					              {
					                  foreach ($all_accounts as $alla)
					                  {?>
					                  <option <?php if ($alla['id']==ACCOUNT_FOR_TAX_COLLECTED){echo "selected='selected'";}?>  value="<?php echo $alla['id'];?>"><?php echo $alla['account_name'];?></option>
					                  <?php }
					              }
					              ?>

					              </select>
					            </div>
					        </div>
					        <?php }?>
					        <?php if ($tt!="gst"){?>
					         <div class="form-group">
					            <label class="control-label col-md-4">What transactions will this be used for<span style="color:red;">*</span></label>
					           <div class="col-md-7">
					     <label class="checkbox-inline" >
                              <input  type="radio" name="what_trans_is_used" value="supply" class="transaction_sale" >
                              <span> supply</span>
                              </label>
                              <label class="checkbox-inline">
                              <input type="radio" name="what_trans_is_used" value="purchase" class="transaction_purchases">
                              <span> purchase</span>
                              </label>

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

