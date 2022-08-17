
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=supplier_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Supplier list<br>
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
                        <td>FAX</td>
                        <td>MOBILE</td>
                        <td>EMAIL</td>
                         <td>WEB</td>
                         <td>PHYSICAL ADDRESS</td>
                         <td>ADDRESS</td>
                      </tr>";

     $active_supplier=$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
       if (is_array($active_supplier)){
           foreach($active_supplier as $supplier){
               if($supplier['branch']==''){ $branch="-";}else{ $branch=$supplier['branch'];}
               if($supplier['phone_pre_code']=='' && $supplier['phone_number']==''){ $phone_number="-";}else{ $phone_number=$supplier['phone_pre_code']." ".$supplier['phone_number'];}
               if($supplier['fax_pre_code']=='' && $supplier['fax_number']==''){ $fax_number="-";}else{ $fax_number=$supplier['fax_pre_code']." ".$supplier['fax_number'];}
               if($supplier['mobile_pre_code']=='' && $supplier['mobile_number']==''){ $mobile_number="-";}else{ $mobile_number=$supplier['mobile_pre_code']." ".$supplier['mobile_number'];}
               if($supplier['website']==''){ $website="-";}else{ $website=$supplier['website'];}
               
               if($supplier['postal_address']!='')
               {
                   $postal= "Address : " .$supplier['postal_address'] ."<br>";
               }
               if($supplier['postal_address_town']!='')
               {
                   $town= "City : " .$supplier['postal_address_town'] ."<br>";
               }
               /*if($supplier['postal_address_suburb']!='')
               {
                   $suburb= "Suburb : " .$supplier['postal_address_suburb'] ."<br>";
               }*/
               if($supplier['postal_address_state']!='')
               {
                   $state= "State : " .$supplier['postal_address_state'] ."<br>";
               }
               if($supplier['postal_address_postcode']!='')
               {
                   $postcode= "Zip : " .$supplier['postal_address_postcode'] ."<br>";
               }
               /*  physical_address   */
               if($supplier['physical_address']!='')
               {
                   $physical_postal= "Address : " .$supplier['physical_address'] ."<br>";
               }
               if($supplier['physical_address_town']!='')
               {
                   $physical_town= "City : " .$supplier['physical_address_town'] ."<br>";
               }
               /*if($supplier['physical_address_suburb']!='')
               {
                   $physical_suburb= "Suburb : " .$supplier['physical_address_suburb'] ."<br>";
               }*/
               if($supplier['physical_address_state']!='')
               {
                   $physical_state= "State : " .$supplier['physical_address_state'] ."<br>";
               }
               if($supplier['physical_address_postcode']!='')
               {
                   $physical_postcode= "Zip : " .$supplier['physical_address_postcode'] ."<br>";
               }
                $html.="<tr style='border-top:1px solid #ccc;'>
                        <td>".$supplier['display_name']."</td>
                        <td>".ucfirst($supplier['contact_is'])."</td>
                        <td>".$supplier['business_name']."</td>
                       <td>".$branch."</td>
                        <td>".$phone_number."</td>
                        <td> ".$fax_number."</td>
                      <td> ".$mobile_number."</td>
                             <td>".$supplier['email']."</td>
                             <td>".$website."</td>
                          <td>".$postal." ".$town." ".$state." ".$postcode."</td>    
                       <td>".$physical_postal." ".$physical_town." ".$physical_state." ".$physical_postcode."</td>      
                      </tr>";
 
}}
 
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/supplier_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>