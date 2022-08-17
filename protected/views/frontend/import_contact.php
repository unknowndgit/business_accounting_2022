<?php if (isset($_POST['add_contact_form_submit_import']))
{
    if ($_FILES['contact_file']!="")
    {
        $file=$_FILES['contact_file'];
        $check=strpos($file['name'], 'csv');

    if($check=== FALSE)
    {
        $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="ion-sad"></i>  Oops! This is not a valid CSV file.
                </div>';
    }else
    {

        $filename=$file['name'];

        $ret= move_uploaded_file($_FILES["contact_file"]["tmp_name"], SERVER_ROOT.'/uploads/location_files/'.$filename );
        $handle12 = fopen("uploads/location_files/".$filename, "r");
        $firstRow = true;
$count=0;
        while (($data = fgetcsv($handle12,"", ",")) !== FALSE)
        {

             $contact_type=$_POST['contact_type'];
            $contact_is=$_POST['contact_is'];
            if(in_array("customer", $contact_type)){$is_customer="yes";}else{$is_customer="no";}
            if(in_array("supplier", $contact_type)){$is_supplier="yes";}else{$is_supplier="no";}
        if (!$db->exists('contacts',array('email'=>$data['4']))){
            if ($fv->check_email($data['4']) || $data['0']!="" && $data['1']!=""){
           $insert=$db->insert("contacts",array('is_customer'=>$is_customer,
                                                'is_supplier'=>$is_supplier,
                                                'contact_is'=>$contact_is,
                                                'business_name'=>$data['0'],//first name
                                                'display_name'=>$data['1'],//last name
                                                'company_name'=>$data['2'],
                                                'branch'=>$data['3'],

                                                'email'=>$data['4'],
                                                'website'=>$data['5'],
                                                'office_number'=>$data['6'],
                                                'hp_number'=>$data['7'],
                                                'postal_address_is'=>'national',
                                                'postal_address'=>$data['8'],
                                                'postal_address_town'=>$data['9'],
                                                //'postal_address_suburb'=>$data['10'],
                                                'postal_address_state'=>$data['10'],
                                                'postal_address_postcode'=>$data['11'],
                                                'visibility_status'=>'active',
                                                'created_date'=>date('Y-m-d'),
                                                'ip_address'=>$_SERVER['REMOTE_ADDR']));


            $count++;
            }}}
        fclose($handle12);
        $path=SERVER_ROOT.'/uploads/location_files/'.$filename;
        if(file_exists($path))
        {
            unlink($path);
        }
        $display_msg='<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-happy"></i> File Export Successfully and export ' . $count . ' records
                </div>';
       /* echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("import_contact",userend)."'
	                },3000);</script>";*/


    }
 }else{
     $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-sad"></i> Select .csv file to upload
                </div>';
 }
}?>

<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>Add contact </h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
            <a onclick="goBack()" class="btn btn-default pull-right">Back to List</a>
           <div class="heading">
               <i class="fa fa-bars"></i>Import contact
            </div>
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="add_contact_form_submit_import" value="add_contact_form_submit_import">
               <div class="row">

                     <div class="col-lg-6">
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
                        <div class="form-group">
                                <label class="control-label col-md-3">File</label>
                                 <div class="col-md-7">
                                <input class="form-control" type="file" class="filestyle" data-size="sm" name="contact_file">
                                <span class="help-block"><small>Please upload only .csv file.</small></span>
                             </div>
                             </div>
                             <button class="btn btn-default btn-block"  type="submit">Upload</button>

                        </div>
                     </div>


            </form>
         </div>
      </div>
   </div>
</div>