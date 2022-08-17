<div class="container-fluid main-content">
<div class="page-title">
        <h1>Settings</h1>
  <?php if($display_msg!=''){?>
    <div class="col-md-12">
      <?php echo $display_msg;?>
      </div><?php }?>
</div>
 <div class="row">
 <div class="col-md-12">
 <div class="widget-container fluid-height clearfix">
 <div class="widget-content padded">
 <form method="post" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
 <div class="row">
 <div class="col-md-12">
 <div class="col-md-4">
   <div class="form-group">
            <label class="control-label col-md-4">Company-Name</label>
            <div class="col-md-8">
              <input class="form-control"  name="name" type="text" value="<?php echo $settings['name'];?>">
            </div>
          </div>
   <div class="form-group">
            <label class="control-label col-md-4">Company-Email</label>
            <div class="col-md-8">
              <input class="form-control"  name="email" type="text" value="<?php echo $settings['email'];?>">
            </div>
   </div>
    <div class="form-group">
 <label class="control-label col-md-4">Company-Website</label>
     <div class="col-md-8">
                <input class="form-control" type="text" name="website" value="<?php echo $settings['website'];?>">
              </div></div>
  <div class="form-group">
                   <label class="control-label col-md-4">Address</label>
                  <div class="col-md-8">
              <textarea class="form-control" name="address"><?php echo html_entity_decode($settings['address']);?>
              </textarea>
            </div>
          </div>

          <div class="form-group">
          <label class="control-label col-md-4">Countries</label>
          <div class="col-md-8">
<select  class="form-control" name="country" >
    <option value="0" label="Select a country ... " selected="selected">Select a country ... </option>
    <?php if(is_array($countryList))foreach($countryList as $key=>$value){?>
    <option value="<?php echo $key;?>" <?php if($key==$settings['country']) echo "selected";?> ><?php echo $value;?></option>
<?php }?>
</select>
          </div>
          </div>
          <div class="form-group">
                   <label class="control-label col-md-4">State</label>
                  <div class="col-md-8">
              <input class="form-control" name="state" type="text" value="<?php echo $settings['state'];?>">
            </div>
          </div>
          <div class="form-group">
                   <label class="control-label col-md-4">City</label>
                  <div class="col-md-8">
             <input class="form-control" name="city" type="text" value="<?php echo $settings['city'];?>">
            </div>
          </div>

           <div class="form-group">
                   <label class="control-label col-md-4">Zip</label>
                  <div class="col-md-8">
              <input class="form-control"  name="zip" type="text" value="<?php echo $settings['zip'];?>">
            </div>
          </div>

          <div class="form-group">
                   <label class="control-label col-md-4">Telephone 1</label>
                  <div class="col-md-8">
              <input class="form-control"  name="telephone1" type="text" value="<?php echo $settings['telephone1'];?>">
            </div>
          </div>
          <div class="form-group">
                   <label class="control-label col-md-4">Telephone 2</label>
                  <div class="col-md-8">
              <input class="form-control"  name="telephone2" type="text" value="<?php echo $settings['telephone2'];?>">
            </div>
          </div>
            <div class="form-group">
                   <label class="control-label col-md-4">Fax</label>
                  <div class="col-md-8">
              <input class="form-control"  name="fax_number" type="text" value="<?php echo $settings['fax_number'];?>">
            </div>
          </div>







 </div>
  <div class="col-md-4">
   <div class="form-group">
    <label class="control-label col-md-4">UEN No</label>
                     <div class="col-md-8">
              <input class="form-control" name="com_uen_no" placeholder="unique entity number" type="text" value="<?php echo $settings['com_uen_no'];?>" >
              </div>
            </div>
            <div class="form-group">
    <label class="control-label col-md-4">UEN type</label>
                     <div class="col-md-8">
              <select class="form-control" name="com_uen_type" >
                     <option   value="">Select</option>
                     <option <?php if ($settings['com_uen_type']=="LP")echo 'selected="selected"';?>  value="LP">Limited Partnership(LP)</option>
                     <option <?php if ($settings['com_uen_type']=="LL")echo 'selected="selected"';?>  value="LL">Limited Liability Partnerships(LL)</option>
                     <option <?php if ($settings['com_uen_type']=="FC")echo 'selected="selected"';?>  value="FC">Foreign Companies(FC)</option>
                     <option <?php if ($settings['com_uen_type']=="PF")echo 'selected="selected"';?>  value="PF">Public Accounting Firms(LL)</option>
                     <option <?php if ($settings['com_uen_type']=="UL")echo 'selected="selected"';?>  value="UL">Unregistered Local Entities(UL)</option>
                     <option <?php if ($settings['com_uen_type']=="UF")echo 'selected="selected"';?>  value="UF">Unregistered Foreign Entities(UF)</option>
               </select>
              </div>
            </div>
   <div class="form-group">
    <label class="control-label col-md-4">Are you GST Registered</label>
                     <div class="col-md-8">
             <select class="form-control" name="is_gst_registered" >
                     <option <?php if ($settings['is_gst_registered']=="no")echo 'selected="selected"';?> value="no">No</option>
                     <option <?php if ($settings['is_gst_registered']=="yes")echo 'selected="selected"';?> value="yes">Yes</option>

                 </select>
              </div>
            </div>
              <div class="form-group">
    <label class="control-label col-md-4">GST No</label>
                     <div class="col-md-8">
         <input class="form-control" type="text" name="com_gst_no" placeholder="GST No (if gst registered)" value="<?php echo $settings['com_gst_no'];?>">
              </div>
            </div>

                          <div class="form-group">
    <label class="control-label col-md-4">GST reporting period</label>
                     <div class="col-md-8">
          <select class="form-control" name="gst_reporting_period">
              <option <?php if ($settings['gst_reporting_period']=="3")echo 'selected="selected"';?> value="3">3 monthly</option>
              <option <?php if ($settings['gst_reporting_period']=="6")echo 'selected="selected"';?> value="6">6 monthly</option>

         </select>
              </div>
            </div>

                                    <div class="form-group">
    <label class="control-label col-md-4">Start date of financial year</label>
    <div class="col-md-8">
   <select class="form-control" name="start_date_financial_year">
      <?php $date_range=range(1, 31);
       if (is_array($date_range)){
          foreach ($date_range as $dr)
          {?>
              <option <?php if ($settings['start_date_financial_year']==$dr)echo 'selected="selected"';?> value="<?php echo $dr;?>"><?php echo $dr;?></option>
       <?php }
      }?>



              </select>
    </div>

            </div>

                         <div class="form-group">
    <label class="control-label col-md-4">Start month of financial year</label>

                     <div class="col-md-8">
       <select class="form-control" name="start_month_financial_year">
      <?php if (is_array($months_array)){
          foreach ($months_array as $number=>$month_name)
          {?>
              <option <?php if ($settings['start_month_financial_year']==$month_name)echo 'selected="selected"';?>  value="<?php echo $month_name;?>"><?php echo $month_name;?></option>
       <?php }
      }?>



              </select>
              </div>
            </div>

 </div>
 <div class="col-md-4">





 <div class="form-group">
    <label class="control-label col-md-4">Currency symbol</label>
                     <div class="col-md-8">
              <input class="form-control" name="currencysymbol" type="text" value="<?php echo $settings['currency_symbol'];?>" >
              </div>
            </div>
             <input type="hidden" name="db_timezone" id="db_timezone" value="<?php echo $settings['timezone'];?>">
           <div class="form-group">
                   <label class="control-label col-md-4">Time Zone</label>
                  <div class="col-md-8">
                  <select class="form-control" name="timezone" id="timezone">
<?php
$timezones=$feature->get_timezones();
if(is_array($timezones)) foreach ($timezones as $key=>$value){?>
                  <option value="<?php echo $value['zone'];?>" <?php if($settings['timezone']==$value['zone'])echo "selected";?>><?php echo $value['zone']." ( ".$value['diff_from_GMT']." )";?></option>
                  <?php }?>
 </select>
            </div>
          </div>
           <div class="form-group">
              <input type="hidden" name="date_format" id="date_format" value="<?php echo $settings['date_format'];?>">
                   <label class="control-label col-md-4">Date Format</label>
                  <div class="col-md-8">
             <select class="form-control" name="dateformat" id="dateformat">
                     <option <?php if ($settings['date_format']=="d/m/Y")echo 'selected="selected"';?> value="d-m-Y">dd/mm/yyyy</option>
                     <option <?php if ($settings['date_format']=="Y/m/d")echo 'selected="selected"';?> value="Y-m-d">yyyy/mm/dd</option>
                     <option <?php if ($settings['date_format']=="m/d/Y")echo 'selected="selected"';?> value="m-d-Y">mm/dd/yyyy</option>
                     <option <?php if ($getdata['date_format']=="d-m-Y")echo 'selected="selected"';?> value="d-m-Y">dd-mm-yyyy</option>
                     <option <?php if ($settings['date_format']=="Y-m-d")echo 'selected="selected"';?> value="Y-m-d">yyyy-mm-dd</option>
                     <option <?php if ($settings['date_format']=="m-d-Y")echo 'selected="selected"';?> value="m-d-Y">mm-dd-yyyy</option>
                     <option <?php if ($settings['date_format']=="d-M-Y")echo 'selected="selected"';?> value="d-M-Y">dd-MM-yyyy  (Ex.<?php echo date('d-M-Y');?>)</option>
              </select></div></div>


 <div class="form-group">
 <label class="control-label col-md-4">No of days(Remember me)</label>
 <div class="col-md-8">
 <input class="form-control"  type="text" name="cookie_expire" value="<?php echo $settings['cookie_expire'];?>">
 </div>
 </div>
      <div class="form-group">
            <label class="control-label col-md-4">Upload Logo</label>
            <div class="col-md-8">
              <div class="fileupload fileupload-new" data-provides="fileupload">
              <input type="hidden" value="" name="">
                <div class="fileupload-new img-thumbnail" >
                  <?php if(file_exists(SERVER_ROOT.'/uploads/logo/'.$settings['logo']) && (($settings['logo'])!=''))
              { ?>
    <img src="<?php echo SITE_URL.'/uploads/logo/'.$settings['logo'].'?id='.rand(0, 89);?>" width="50%">
   <?php } else{?>
              	<img src="<?php echo SITE_URL.'/assets/frontend/images/-text.png';?>"  width="50%">
             <?php } ?>

                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file">
                  <span class="fileupload-new">Select image</span>
                  <span class="fileupload-exists">Change</span>
                  <input type="file" name="logo" id="logo"></span>
                  <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>

                </div>
             <small>Only jpg , png & jpeg  (Max : <?php echo $upload_max_size;?>)</small>
              </div>
            </div>
          </div>
     <!--       <div class="form-group">
            <label class="control-label col-md-4">Pdf/Print Logo</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
              <input type="hidden" value="" name="">
                <div class="fileupload-new img-thumbnail" >
                  <?php if(file_exists(SERVER_ROOT.'/uploads/pdflogo/'.$settings['pdflogo']) && (($settings['pdflogo'])!=''))
              { ?>
    <img src="<?php echo SITE_URL.'/uploads/pdflogo/'.$settings['pdflogo'].'?id='.rand(0, 9);?>" width="100%">
   <?php } else{?>
              	<img src="<?php echo SITE_URL.'/assets/frontend/images/-text.png';?>"  width="100%">
             <?php } ?>

                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" ></div>
                <div>
                  <span class="btn btn-default btn-file">
                  <span class="fileupload-new">Select image for pdf</span>
                  <span class="fileupload-exists">Change</span>
                  <input type="file" name="pdf_logo" id="pdflogo"></span>
                  <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                </div>           <small>Only jpg, png & jpeg (Max : <?php echo $upload_max_size;?>)</small>
              </div>
            </div>
          </div>-->
 <input type="hidden" name="logosize" id="logosize" >
 <input type="hidden" name="pdflogosize" id="pdflogosize" >

 </div></div></div>
   <div class="form-group">
  <div class="col-md-1"></div>
   <div class="col-md-10">
    <button class="btn btn-lg btn-block btn-success" type="submit" name="submit_settings"><i class="lnr lnr-chevron-up-circle"></i> Update</button>
   </div>
   <div class="col-md-1"></div>
 </div>

 </form></div></div></div></div></div>

<script>
  $('#logo').bind('change', function() {
  $('#logosize').val(this.files[0].size);
  var a = this.files[0].size;
  var b= <?php echo ($upload_max_size*1024*1024);?>;
if(a>b)
  alert("File size must be less than <?php echo $upload_max_size;?>");
});
          $('#pdflogo').bind('change', function() {

        	  $('#pdflogosize').val(this.files[0].size);
        	  var a = this.files[0].size;
        	  var b= <?php echo ($upload_max_size*1024*1024);?>;
        	if(a>b)
        	  alert("File size must be less than <?php echo $upload_max_size;?>");

        	});

          </script>
