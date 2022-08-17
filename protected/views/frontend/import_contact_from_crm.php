<?php 

if (isset($_POST['is_submit']) && isset($_POST['add_import_form_crm_submit_import']))
{
    
        if(isset($_POST['groupid']) && !empty($_POST['groupid'])){
        $groupid = $_POST['groupid'];           
        $contact_type = $_POST['contact_type'];
        $contact_is = $_POST['contact_is'];

        if(in_array("customer", $contact_type)){
          $is_customer="yes";
        }else{
          $is_customer="no";
        }
        if(in_array("supplier", $contact_type)){
          $is_supplier="yes";
        }else{
          $is_supplier="no";
        }
        $exist_client = [];
        //Get client list based on group id from CRM
        $clients = $db2->get_all('accounts',array('groupid'=>$groupid));
        if(isset($clients) && !empty($clients)){
          $count = 0;
          foreach ($clients as $key => $client) {
              //check if client exist 
              $is_exist = $db->get_row('contacts',array('email'=>$client['email']));
              if(!$is_exist){                
                  $insert=$db->insert("contacts",
                    array(
                      'is_customer'=>$is_customer,
                      'is_supplier'=>$is_supplier,
                      'contact_is'=>$contact_is,
                      'business_name'=>$client['name'],//first name
                      'display_name'=>$client['lname'],//last name
                      'company_name'=>$client['company'],
                      'email'=>$client['email'],
                      'phone_number'=>$client['phone'],                      
                      'postal_address_is'=>'national',
                      'postal_address'=>$client['address1'],
                      'postal_address_town'=>$client['city'],
                      'postal_address_state'=>$client['state'],
                      'postal_address_postcode'=>$client['postcode'],
                      'physical_address_is'=>'national',
                      'physical_address'=>$client['address2'],
                      'visibility_status'=>'active',
                      'created_date'=>date('Y-m-d'),
                      'ip_address'=>$_SERVER['REMOTE_ADDR']
                    )
                  );
                  $count++;
              }else{
                $exist_client[] = $client['email'];
                continue;
              }
          }         
        }  
        
        if($count == 0 ){
           $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-sad"></i> No any clients to import from CRM.
                </div>';
        }else{

          $msg = 'CRM ('.$count.') clients imported Successfully.';
          if(!empty($exist_client)){
            $msg .= ' This email address ' . join(', ',$exist_client) . ' clients are skipped because of already exists.';
          }

          $display_msg='<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <i class="lnr lnr-happy"></i> '.$msg.' </div>';      
        }
        $_POST = array();    
 }else{
     $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-sad"></i> Please select any group of CRM.
                </div>';
 }
}
?>

<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>Import contact From CRM</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
            <a href="<?php echo $link->link('contacts',user);?>" class="btn btn-default pull-right">Back to List</a>
           <div class="heading">
               <i class="fa fa-bars"></i>Import contact From CRM
            </div>
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="add_import_form_crm_submit_import" value="add_import_form_crm_submit_import">
               <div class="row">

                     <div class="col-lg-6">
                      <?php 
                        $crm_groups = $db2->get_all('accgroups'); 
                        if(!empty($crm_groups)){
                      ?> 
                      <div class="form-group">
                           <label class="control-label col-md-3">Select Group from CRM<font color="red">*</font></label>
                           <div class="col-md-7">
                            <select name="groupid" class="form-control">
                              <option value="">-- Select Group --</option>
                            <?php foreach($crm_groups as $key => $group) { ?>
                              <option value="<?php echo $group['id'];?>"><?php echo $group['groupname'];?></option>                              
                            <?php } ?>
                            </select>
                            </div>
                        </div>
                      <?php } ?>
                        <div class="form-group">
                           <label class="control-label col-md-3">Type of contact<font color="red">*</font></label>
                           <div class="col-md-7">
                              <label class="checkbox-inline" >
                              <input checked="" type="checkbox" name="contact_type[]" value="customer">
                              <span>Customer</span>
                              </label>
                              <label class="checkbox-inline">
                              <input id="supplier_fields" type="checkbox" name="contact_type[]" value="supplier"><span>Supplier</span>
                              </label>
                        <!--       <label class="checkbox-inline" id="label_super_fund_id">
                              <input id="super_fund_id" type="checkbox" name="contact_type[]" value="super fund"><span>Super Fund</span></label> -->
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">This contact is</label>
                           <div class="col-md-7">
                              <label class="radio-inline">
                              <input checked=""  type="radio" name="contact_is" value="business" id="business_id--">
                              <span> A business</span>
                              </label>
                              <label class="radio-inline">
                              <input  type="radio" name="contact_is" value="individual" id="individual_id--">
                              <span> An individual</span>
                              </label>
                           </div>
                        </div>
                        
                             <button class="btn btn-default btn-block"  type="submit" name="is_submit" value="1">Upload</button>

                        </div>
                     </div>


            </form>
         </div>
      </div>
   </div>
</div>

