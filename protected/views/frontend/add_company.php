<?php
// Get company id


if (isset($_POST['add_company_form_submit'])) {
  // print_r($_POST);
  $company_unique_id = $_POST['company_unique_id'];
  $company_name = $_POST['company_name'];
  $visibility_status = $_POST['visibility_status'];
  $contact_person = $_POST['contact_person'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $country = $_POST['country'];
  $phone1 = $_POST['phone1'];
  $phone2 = $_POST['phone2'];
  $fax = $_POST['fax'];
  $email = $_POST['email'];
  $ein = $_POST['ein'];
  $entity_type = $_POST['entity_type'];
  $fiscal_year_start = !empty($_POST['fiscal_year_start']) ? date('Y-m-d',strtotime($_POST['fiscal_year_start'])) : '0000-00-00';
  $fiscal_year_end = !empty($_POST['fiscal_year_end']) ? date('Y-m-d',strtotime($_POST['fiscal_year_end'])) : '0000-00-00';

  $created_date = date('Y-m-d');
  $ip_address = $_SERVER['REMOTE_ADDR'];


  $fields_arr['Company Name'] = $company_name;
  $fields_arr['Fiscal Year Start'] = $fiscal_year_start;
  $fields_arr['Fiscal Year End'] = $fiscal_year_end;

  $empt_fields = $fv->emptyfields($fields_arr);

  if ($empt_fields) {
    $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">�</button>
          Oops! Following fields are empty<br>' . $empt_fields . '</div>';
  } elseif ($db->exists('companies', array('company_unique_id' => $company_unique_id))) {
    $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">�</button>
            This Company ID is already exist.
		</div>';
  } else {
    $insert = $db->insert("companies", array(
        'company_unique_id' => $company_unique_id,
        'company_name' => $company_name,
        'visibility_status' => $visibility_status,
        'created_date' => $created_date,
        'ip_address' => $ip_address,
        'contact_person' => $contact_person,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
        'country' => $country,
        'phone1' => $phone1,
        'phone2' => $phone2,
        'fax' => $fax,
        'email' => $email,
        'ein' => $ein,
        'entity_type' => $entity_type,
        'fiscal_year_start' => $fiscal_year_start,
        'fiscal_year_end' => $fiscal_year_end
    ));
    //  $db->debug();
    if ($insert) {
      $event = "Create a new Company  (" . $company_name . ")";
      $db->insert('activity_logs', array('user_id' => $_SESSION['user_id'],
          'event' => $event,
          'created_date' => date('Y-m-d'),
          'ip_address' => $_SERVER['REMOTE_ADDR']
      ));
      $display_msg = '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">�</button> Company save successfully.
                    		</div>';


      echo "<script>
                         setTimeout(function(){
        	    		  window.location = '" . $link->link("companies", user) . "'
        	                },1500);</script>";
    }
  }
}
?>

<div class="row">
    <div class="col-lg-12">
        <?php echo $display_msg; ?>
        <div class=" padded" >
            <h3>Add Company </h3>
        </div>
        <div class="widget-container fluid-height">
            <div class="widget-content padded">
                <form id="add_contact_form12" action="" method="post" class="form-horizontal">


                    <div class="row">
                        <div class="col-lg-12">
                            <a onclick="goBack()" class="btn btn-default pull-right">Back to List</a>
                            <button class="btn btn-primary pull-right " name="add_company_form_submit"  id="add_company_form_submit_id12121" type="submit">Save</button>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group" >
                                <label class="control-label col-md-3">Company ID<font color="red">*</font></label>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="" type="text" name="company_unique_id" value="<?php echo $_POST['company_unique_id']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Company Name<font color="red">*</font></label>
                                <div class="col-md-9">
                                    <input class="form-control" placeholder="" type="text" name="company_name" value="<?php echo $_POST['company_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Contact Person</label>
                                <div class="col-md-6">
                                    <input class="form-control" placeholder="" type="text" name="contact_person" value="<?php echo $_POST['contact_person']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9">
                                    <input class="form-control" placeholder="" type="text" name="address" value="<?php echo $_POST['address']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">City, State, Zip</label>
                                <div class="col-md-4">
                                    <input class="form-control" placeholder="" type="text" name="city" value="<?php echo $_POST['city']; ?>">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="" type="text" name="state" value="<?php echo $_POST['state']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="" type="text" name="zip" value="<?php echo $_POST['zip']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Country</label>
                                <div class="col-md-4">
                                    <input class="form-control" placeholder="" type="text" name="country" value="<?php echo $_POST['country']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-9">
                                    <hr/>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Telephone 1</label>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="" type="text" name="phone1" value="<?php echo $_POST['phone1']; ?>">
                                </div>
                                <label class="control-label col-md-3">Phone 2</label>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="" type="text" name="phone2" value="<?php echo $_POST['phone2']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Fax</label>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="" type="fax" name="fax" value="<?php echo $_POST['fax']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input class="form-control" placeholder="" type="email" name="email" value="<?php echo $_POST['email']; ?>">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-9">
                                    <hr/>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-md-3">EIN</label>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="" type="ein" name="ein" value="<?php echo $_POST['ein']; ?>">
                                </div>
                            </div>

                            <div class="form-group" >
                                <label class="control-label col-md-3">Entity Type</label>
                                <div class="col-md-4">
                                    <select class="form-control" placeholder="" type="entity_type" name="entity_type">
                                        <?php foreach ($entity_array as $key => $value) { ?>
                                          <option value="<?php echo $key; ?>" <?php echo ($key == $_POST['entity_type']) ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>                                    
                                </div>
                            </div>

                            <div class="form-group" >
                                <label class="control-label col-md-3">Fiscal Year Start</label>
                                <div class="col-md-3">
                                    <div class="input-group date datepicker " data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                        <input class="form-control" type="text" name="fiscal_year_start" value="<?php echo $_POST['fiscal_year_start']; ?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                    </div>
                                </div>
                                <label class="control-label col-md-3">Fiscal Year End</label>
                               <div class="col-md-3">
                                    <div class="input-group date datepicker " data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                        <input class="form-control" type="text" name="fiscal_year_end" value="<?php echo $_POST['fiscal_year_end']; ?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="visibility_status">
                                        <option value="active" <?php
                                        if ($_POST['visibility_status'] == 'active') {
                                          echo 'selected';
                                        }
                                        ?>>Active</option>
                                        <option value="inactive" <?php
                                        if ($_POST['visibility_status'] == 'inactive') {
                                          echo 'selected';
                                        }
                                        ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>              
                    <div class="row" style="margin-top: 20%;"></div>
                </form>
            </div>
        </div>
    </div>
</div>