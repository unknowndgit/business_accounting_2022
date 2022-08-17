
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=project_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Project list<br>
						<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

                        <tr>
                        <td style='width:30%'>NAME</td>
                        <td style='width:30%'>DESCRIPTION</td>
                        <td style='width:30%'>START DATE</td>
                        <td style='width:20%'>END DATE</td>
                       </tr>
    
                   <tr>
                    <td><strong>ACTIVE/RUNNING</strong></td>
               <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                       
                       
                    </tr>"; 
$running_project_list=$db->get_all('projects',array('project_status'=>'running'));
if (is_array($running_project_list)){
    foreach($running_project_list as $pr){
     
        $html.="<tr>
                        <td>".$pr['project_name']."</td>
                        <td>".$pr['description']."</td>
                       <td>".$pr['start_date']."</td>
                        <td>".$pr['end_date']."</td>
                     </tr>";

    }}

     $html.="<tr>
    <td><strong>COMPLETED</strong></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
   

    </tr>";
    
     $com_project_list=$db->get_all('projects',array('project_status'=>'completed'));
if (is_array($com_project_list)){
    foreach($com_project_list as $cm){
       $html.="<tr>
                        <td>".$cm['project_name']."</td>
                        <td>".$cm['description']."</td>
                       <td>".$cm['start_date']."</td>
                        <td>".$cm['end_date']."</td>
                      
                      </tr>";


             }}


$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/project_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>