
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=advisor');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=journal_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Journals list<br>
							<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td style='width:20%'>DATE</td>
                        <td style='width:15%'>NUMBER</td>
                        <td style='width:15%'>TYPE</td>
                        <td style='width:25%'>SUMMARY</td>
                        <td style='width:30%'>DESCRIPTION</td>

                      </tr>";

       $journal_list=$db->get_all('journal');
       if (is_array($journal_list)){
           foreach($journal_list as $journal){

                $html.="<tr>
                        <td>".date(DATE_FORMAT,strtotime($journal['journal_date']))."</td>
                        <td>".$journal['journal_no']."</td>
                         <td>".ucfirst($journal['journal_type'])."</td>
                        <td>".$journal['summary']."</td>
                         <td>".$journal['description']."</td>
                      </tr>";

}}

$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/journal_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>
    </div>
</div>