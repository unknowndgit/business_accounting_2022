
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=customer_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Customer list<br>
							<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td>REFERENCE</td>
                        <td>TYPE</td>
                        <td>FIRST NAME</td>
                        <td>BRANCH/SURNAME</td>
                        <td>PHONE</td>
                        <td >FAX</td>
                        <td>MOBILE</td>
                        <td>EMAIL</td>
                         <td>WEB</td>
                         <td>PHYSICAL ADDRESS</td>
                         <td>ADDRESS</td>
                      </tr>";

     $active_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));
       if (is_array($active_customer)){
           foreach($active_customer as $customer){
               if($customer['branch']==''){ $branch="-";}else{ $branch=$customer['branch'];}
               if($customer['phone_pre_code']=='' && $customer['phone_number']==''){ $phone_number="-";}else{ $phone_number=$customer['phone_pre_code']." ".$customer['phone_number'];}
               if($customer['fax_pre_code']=='' && $customer['fax_number']==''){ $fax_number="-";}else{ $fax_number=$customer['fax_pre_code']." ".$customer['fax_number'];}
               if($customer['mobile_pre_code']=='' && $customer['mobile_number']==''){ $mobile_number="-";}else{ $mobile_number=$customer['mobile_pre_code']." ".$customer['mobile_number'];}
               if($customer['website']==''){ $website="-";}else{ $website=$customer['website'];}

               if($customer['postal_address']!='')
               {
                   $postal= "Address : " .$customer['postal_address'] ."<br>";
               }
               if($customer['postal_address_town']!='')
               {
                   $town= "City : " .$customer['postal_address_town'] ."<br>";
               }
               /*if($customer['postal_address_suburb']!='')
               {
                   $suburb= "Suburb : " .$customer['postal_address_suburb'] ."<br>";
               }*/
               if($customer['postal_address_state']!='')
               {
                   $state= "State : " .$customer['postal_address_state'] ."<br>";
               }
               if($customer['postal_address_postcode']!='')
               {
                   $postcode= "Zip : " .$customer['postal_address_postcode'] ."<br>";
               }
             /*  physical_address   */
               if($customer['physical_address']!='')
               {
                   $physical_postal= "Address : " .$customer['physical_address'] ."<br>";
               }
               if($customer['physical_address_town']!='')
               {
                   $physical_town= "City : " .$customer['physical_address_town'] ."<br>";
               }
               /*if($customer['physical_address_suburb']!='')
               {
                   $physical_suburb= "Suburb : " .$customer['physical_address_suburb'] ."<br>";
               }*/
               if($customer['physical_address_state']!='')
               {
                   $physical_state= "State : " .$customer['physical_address_state'] ."<br>";
               }
               if($customer['physical_address_postcode']!='')
               {
                   $physical_postcode= "Zip : " .$customer['physical_address_postcode'] ."<br>";
               }

                $html.="<tr style='border-top:1px solid #ccc;'>
                        <td>".$customer['display_name']."</td>
                        <td>".ucfirst($customer['contact_is'])."</td>
                        <td>".$customer['display_name']."</td>
                       <td>".$branch."</td>
                        <td>".$phone_number."</td>
                        <td> ".$fax_number."</td>
                      <td> ".$mobile_number."</td>
                             <td>".$customer['email']."</td>
                             <td>".$website."</td>
                          <td>".$postal." ".$town." ".$state." ".$postcode."</td>
                        <td>".$physical_postal." ".$physical_town." ".$physical_state." ".$physical_postcode."</td>
                      </tr>";


}}

$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/customer_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>
    </div>
</div>