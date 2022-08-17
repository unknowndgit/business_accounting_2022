<?php
if (isset($_REQUEST['contact_id'])){
	$contact_id=$_REQUEST['contact_id'];
	$contact_detail=$db->get_row('contacts',array('id'=>$contact_id));
	//print_r($contact_detail);
}

if (isset($_POST['add_contact_form_submit']))
{
   // print_r($_POST);
    $contact_type=$_POST['contact_type'];
    $contact_is=$_POST['contact_is'];
   // $first_name=$_POST['first_name'];
  //  $last_name=$_POST['last_name'];
    $business_name=$_POST['business_name'];
    $company_name=$_POST['company_name'];
    $display_name=$_POST['display_name'];
    $branch=$_POST['branch'];
    $business_number=$_POST['business_number'];
    $notes=$_POST['notes'];
    $visibility_status=$_POST['visibility_status'];
    $phone_pre_code=$_POST['phone_pre_code'];
    $phone_number=$_POST['phone_number'];
    $mobile_pre_code=$_POST['mobile_pre_code'];
    $mobile_number=$_POST['mobile_number'];
    $fax_pre_code=$_POST['fax_pre_code'];
    $fax_number=$_POST['fax_number'];
    //$email=$_POST['email'];
    $website=$_POST['website'];
    $office_number=$_POST['office_number'];
    $hp_number=$_POST['hp_number'];
    $postal_address_is=$_POST['postal_address_is'];
    $postal_address=$_POST['postal_address'];
    $postal_address_town=$_POST['postal_address_town'];
    //$postal_address_suburb=$_POST['postal_address_suburb'];
    $postal_address_state=$_POST['postal_address_state'];
    $postal_address_postcode=$_POST['postal_address_postcode'];
    if (isset($_POST['differtnt_physical_address']))
    {
        $physical_address_is=$_POST['physical_address_is'];
        $physical_address=$_POST['physical_address'];
        $physical_address_town=$_POST['physical_address_town'];
        //$physical_address_suburb=$_POST['physical_address_suburb'];
        $physical_address_state=$_POST['physical_address_state'];
        $physical_address_postcode=$_POST['physical_address_postcode'];
    }
    else
    {
        $physical_address_is=$_POST['postal_address_is'];
        $physical_address=$_POST['postal_address'];
        $physical_address_town=$_POST['postal_address_town'];
        //$physical_address_suburb=$_POST['postal_address_suburb'];
        $physical_address_state=$_POST['postal_address_state'];
        $physical_address_postcode=$_POST['postal_address_postcode'];
    }
    if (isset($_POST['istpr']))
    {
        $istpr=$_POST['istpr'];
    }
    else
    {
        $istpr=0;
    }
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];

$fields_arr['Contact type'] = $contact_type;
if($contact_is == 'business'){
  $fields_arr['Company Name'] = $company_name;
}
if($contact_is == 'individual'){
  $fields_arr['Business name/First Name'] = $business_name;
  $fields_arr['Display name/Last Name'] = $display_name;  
}
$empt_fields = $fv->emptyfields($fields_arr);

if ($empt_fields)
{
      $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
}
/*elseif (!$fv->check_email($email))
{
        $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
            Oops! Wrong Email Format.
		</div>';
}*/
else
{
   if(in_array("customer", $contact_type)){$is_customer="yes";}else{$is_customer="no";}
   if(in_array("supplier", $contact_type)){$is_supplier="yes";}else{$is_supplier="no";}
   if(in_array("super fund", $contact_type)){$is_superfund="yes";}else{$is_superfund="no";}
    $update=$db->update("contacts",array('contact_type'=>implode(",", $contact_type),
                                        'is_customer'=>$is_customer,
                                        'is_supplier'=>$is_supplier,
                                        'is_superfund'=>$is_superfund,
                                        'contact_is'=>$contact_is,
                                       'company_name'=>$company_name,
                                        'business_name'=>$business_name,
                                      //  'first_name'=>$first_name,
                                      //  'last_name'=>$last_name,
                                        'display_name'=>$display_name,
                                        'branch'=>$branch,
                                        'notes'=>$notes,
                                        'business_number'=>$business_number,
                                        'visibility_status'=>$visibility_status,
                                        'phone_pre_code'=>$phone_pre_code,
                                        'phone_number'=>$phone_number,
                                        'mobile_number'=>$mobile_number,
                                        'mobile_pre_code'=>$mobile_pre_code,
                                        'fax_pre_code'=>$fax_pre_code,
                                        'fax_number'=>$fax_number,
                                        'email'=>$email,
                                        'website'=>$website,
                                        'office_number'=>$office_number,
                                        'hp_number'=>$hp_number,
                                        'postal_address_is'=>$postal_address_is,
                                        'postal_address'=>$postal_address,
                                        'postal_address_town'=>$postal_address_town,
                                        //'postal_address_suburb'=>$postal_address_suburb,
                                        'postal_address_state'=>$postal_address_state,
                                        'postal_address_postcode'=>$postal_address_postcode,
                                        'physical_address_is'=>$physical_address_is,
                                        'physical_address'=>$physical_address,
                                        'physical_address_town'=>$physical_address_town,
                                        //'physical_address_suburb'=>$physical_address_suburb,
                                        'physical_address_state'=>$physical_address_state,
                                        'physical_address_postcode'=>$physical_address_postcode,
                                        'created_date'=>$created_date,
                                        'ip_address'=>$ip_address),array('id'=>$contact_id));
  //  $db->debug();
    if ($update){

        $event="Edit Contact  (" . $display_name . ") with id no (".$contact_id.")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
                 $display_msg= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">×</button> Contact saved successfully.
                    		</div>';
      if($is_customer=='yes'){
                echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("contacts",user)."'
        	                },3000);</script>";
          }else
          {
              echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("suppliers",user)."'
        	                },3000);</script>";

          }
}
}
}?>




<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>Edit contact </h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
           <form id="add_contact_form12" action="" method="post" class="form-horizontal">
             <div class="row">
                   <div class="col-lg-12">
                    <a href="<?php echo $link->link('contacts',user,'&contact_type=customers');?>" class="btn btn-default pull-right">Back to List</a>
                     <button class="btn btn-primary pull-right " type="submit"  name="add_contact_form_submit" value="add_contact_form_submit">Save</button>
                   </div>
                     </div>

               <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="control-label col-md-3">Type of contact<font color="red">*</font></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input type="checkbox" name="contact_type[]" <?php if ($contact_detail['is_customer']=='yes'){echo 'checked';}?> value="customer">
                              <span>Customer</span>
                              </label>
                              <label class="checkbox-inline">
                              <input id="supplier_fields" type="checkbox" name="contact_type[]" value="supplier" <?php if ($contact_detail['is_supplier']=='yes'){echo 'checked';}?>><span>Supplier</span>
                              </label>
                              <label class="checkbox-inline" id="label_super_fund_id">
                              <input id="super_fund_id" type="checkbox" name="contact_type[]" value="super fund" <?php if ($contact_detail['is_superfund']=='yes'){echo 'checked';}?>><span>Super Fund</span></label>
                       </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">This contact is</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input type="radio" name="contact_is" value="business" id="business_id--" <?php if ($contact_detail['contact_is']=='business'){echo 'checked';}?>>
                              <span> A business</span>
                              </label>
                              <label class="radio-inline">
                              <input  type="radio" name="contact_is" value="individual" id="individual_id--" <?php if ($contact_detail['contact_is']=='individual'){echo 'checked';}?>>
                              <span> An individual</span>
                              </label>
                           </div>
                        </div>
                      <!-- <div class="form-group" style="display:none;" id="first_name_id">
                           <label class="control-label col-md-3">First name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="first_name" value="">
                           </div>
                        </div>
                            <div class="form-group" style="display:none;" id="last_name_id">
                           <label class="control-label col-md-3">Last name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="last_name" value="">
                           </div>
                        </div> -->

                        <div class="form-group" id="business_name_id">
                           <label class="control-label col-md-3">First name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="business_name" value="<?php echo $contact_detail['business_name'];?>">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Last name<font color="red">*</font></label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="display_name" value="<?php echo $contact_detail['display_name'];?>">
                           </div>
                        </div>
                           <div class="form-group" >
                           <label class="control-label col-md-3">Company Name</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="company_name" value="<?php echo $contact_detail['company_name'];?>">
                           </div>
                        </div>
                        <div class="form-group" id="branch_id">
                           <label class="control-label col-md-3">Branch</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="branch" value="<?php echo $contact_detail['branch'];?>">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">ABN</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="business_number" <?php echo $contact_detail['business_number'];?>>
                           </div>
                        </div>
                        <div class="form-group" id="verifie_id" style="display:none;">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">
                              <a class="btn btn-default">Verify ABN</a><span>Last verified: Never</span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Notes</label>
                           <div class="col-md-7">
                              <textarea class="form-control" rows="5" name="notes"><?php echo $contact_detail['notes'];?></textarea>
                           </div>
                        </div>
                        <br>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-3">Status</label>
                           <div class="col-md-7">
                              <select class="form-control" name="visibility_status">
                                 <option <?php if ($contact_detail['visibility_status']=='active'){echo 'selected';}?>value="active">Active</option>
                                 <option <?php if($contact_detail['visibility_status']=='inactive'){echo 'selected';}?> value="inactive">Inactive</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group" id="strp_id" style="display:none;">
                           <label class="control-label col-md-3">Subject to TPAR<font color="red">*</font></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline">
                              <input type="checkbox" name="istpr" value="1">
                              </label>
                           </div>
                           <i class="fa fa-fw fa-question-circle"></i>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Phone</label>
                           <div class="col-md-2">
                              <input class="form-control" placeholder="" type="text" name="phone_pre_code" value="<?php echo $contact_detail['phone_pre_code'];?>">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="phone_number" value="<?php echo $contact_detail['phone_number'];?>">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Mobile</label>
                           <div class="col-md-2">
                              <input class="form-control" placeholder="" type="text" name="mobile_pre_code" value="<?php echo $contact_detail['mobile_pre_code'];?>">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="mobile_number" value="<?php echo $contact_detail['mobile_number'];?>">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Fax</label>
                           <div class="col-md-2">
                              <input class="form-control" placeholder="" type="text" name="fax_pre_code" value="<?php echo $contact_detail['fax_pre_code'];?>">
                           </div>
                           <div class="col-md-5">
                              <input class="form-control" placeholder="" type="text" name="fax_number" value="<?php echo $contact_detail['fax_number'];?>">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Email</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="name@address.com" type="text" name="email" value="<?php echo $contact_detail['email'];?>" readonly>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Website</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="www.name.com" type="text" name="website" value="<?php echo $contact_detail['website'];?>">
                           </div>
                        </div>
                           <div class="form-group">
                           <label class="control-label col-md-3">Office number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="office_number"  value="<?php echo $contact_detail['office_number'];?>">
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-3">HP number</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="hp_number"  value="<?php echo $contact_detail['hp_number'];?>">
                           </div>
                        </div>
                     </div>

               </div>
               <br>
               <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-7">
                              <label><strong>BILLING ADDRESS</strong></label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Address is</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input  name="postal_address_is" type="radio" value="national" <?php if ($contact_detail['postal_address_is']=="national"){echo 'checked';}?> >
                              <span> National</span>
                              </label>
                              <label class="radio-inline">
                              <input name="postal_address_is" type="radio" value="international" <?php if ($contact_detail['postal_address_is']=="international"){echo 'checked';}?> >
                              <span>International</span>
                              </label>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Address</label>
                           <div class="col-md-7">
                              <textarea class="form-control" name="postal_address"><?php echo $contact_detail['postal_address'];?></textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">City</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="postal_address_town" value="<?php echo $contact_detail['postal_address_town'];?>">
                           </div>
                        </div>
                        <!-- <div class="form-group">
                           <label class="control-label col-md-3">Suburb</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="postal_address_suburb" value="<?php //echo $contact_detail['postal_address_suburb'];?>" >
                           </div>
                        </div> -->
                        <div class="form-group">
                           <label class="control-label col-md-3">State</label>
                           <div class="col-md-7">
                           <input class="form-control" placeholder="" type="text" name="postal_address_state" value="<?php echo $contact_detail['postal_address_state'];?>" >
                               <!--   <select class="form-control" name="">
                                    <option value=""></option>
                                    <option value="">Australian Capital Territory</option>
                                    <option value="1">New South Wales</option>
                                    <option value="2">Northern Territory</option>
                                    <option value="3">Queensland</option>
                                    <option value="3">South Australia</option>
                                    <option value="4">Tasmania</option>
                                    <option value="5">Victoria</option>
                                    <option value="6">Western Australia</option>
                                 </select>-->

                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Zip</label>
                           <div class="col-md-7">
                              <input class="form-control" placeholder="Text" type="text" name="postal_address_postcode" value="<?php echo $contact_detail['postal_address_postcode'];?>">
                              <br>
                              <label class="checkbox-inline">
                              <input type="checkbox" name="differtnt_physical_address" value="1"  id="yesCheck">
                              <span>Physical address is different</span><br>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div id="ifYes" style="display:none;">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="control-label col-md-3"></label>
                              <div class="col-md-7">
                                 <label></label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3">Address is</label>
                              <div class="col-md-7">
                                 <label class="radio-inline">
                                 <input name="physical_address_is" type="radio" value="national" <?php if ($contact_detail['physical_address_is']=="national"){echo 'checked';}?> >
                                 <span> National</span>
                                 </label>
                                 <label class="radio-inline">
                                 <input name="physical_address_is" type="radio" value="international" <?php if ($contact_detail['physical_address_is']=="international"){echo 'checked';}?> >
                                 <span>International</span>
                                 </label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3">Address</label>
                              <div class="col-md-7">
                                 <textarea class="form-control"  name="physical_address"><?php echo $contact_detail['physical_address'];?></textarea>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3">City</label>
                              <div class="col-md-7">
                                 <input class="form-control" placeholder="" type="text" name="physical_address_town" value="<?php echo $contact_detail['physical_address_town'];?>" >
                              </div>
                           </div>
                           <!-- <div class="form-group">
                              <label class="control-label col-md-3">Suburb</label>
                              <div class="col-md-7">
                                 <input class="form-control" placeholder="" type="text" name="physical_address_suburb"  value="<?php //echo $contact_detail['physical_address_suburb'];?>">
                              </div>
                           </div> -->
                           <div class="form-group">
                              <label class="control-label col-md-3">State</label>
                              <div class="col-md-7">
                              <input class="form-control" placeholder="" type="text" name="physical_address_state" value="<?php echo $contact_detail['physical_address_state'];?>">
                               <!--   <select class="form-control" name="">
                                    <option value=""></option>
                                    <option value="">Australian Capital Territory</option>
                                    <option value="1">New South Wales</option>
                                    <option value="2">Northern Territory</option>
                                    <option value="3">Queensland</option>
                                    <option value="3">South Australia</option>
                                    <option value="4">Tasmania</option>
                                    <option value="5">Victoria</option>
                                    <option value="6">Western Australia</option>
                                 </select>-->

                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3">Zip</label>
                              <div class="col-md-7">
                                 <input class="form-control" placeholder="Text" type="text" name="physical_address_postcode" value="<?php echo $contact_detail['physical_address_postcode'];?>">
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