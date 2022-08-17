
<div class="row">
	<div class="col-lg-12">
<div class=" padded" >

<a class="btn btn-default pull-right" href="<?php echo $link->link('reports',user,'&report_type=list');?>">Back to list</a>
<a class="pdf btn btn-primary pull-right"  href="<?php echo $link->link("pdfgenerate",user,'&report_type=Item_list');?>"

>&nbsp;PDF Generate</a>
</div>
<br>
<br>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">

        	<?php
        	$html="<table style='width:100%;text-align:center;'>
                       <tr><td><h3 style='text-align:center;'>Item list<br>
				<small>".strtoupper(SITE_NAME)."<br>
					As at ".date(DATE_FORMAT)."</small>
                   </td></tr>
                    </table>";


$html.="<table style='width:100%'>

<tr>
                        <td>NAME</td>
                        <td style='width:10%'>TYPE</td>
                        <td>CODE</td>
                        <td>SALE PRICE (NET)</td>
                        <td>SALE ACCOUNT</td>
                        <td>SALE TAX CODE</td>
                         <td>PURCHASE PRICE (NET)</td>
                        <td>PURCHASE ACCOUNT</td>
                          <td>PURCHASE TAX CODE</td>
                      </tr>
                      
                 <tr>
                    <td><strong>ACTIVE</strong></td>
               <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                       <td></td>
                        <td></td>
                         <td></td>
                        <td></td>
                    </tr>";       
                      
       $all_item_list=$db->get_all('items',array('visibility_status'=>'active'));
       if (is_array($all_item_list)){
           foreach($all_item_list as $al_item){
               $item_sale_acname=$db->get_var('accounts',array('id'=>$al_item['sell_item_account']),'account_name');
               $item_purchase_acname=$db->get_var('accounts',array('id'=>$al_item['buy_item_account']),'account_name');
               $item_sale_tax_code=$db->get_var('tax',array('id'=>$al_item['sell_item_tax_code']),'tax_name');
               $item_purcharse_tax_code=$db->get_var('tax',array('id'=>$al_item['buy_item_tax_code']),'tax_name');
               if($al_item['selling_price']==""){ $selling_price=0; }else{ $selling_price=$al_item['selling_price'];}
               if($al_item['buying_price']==""){ $buying_price=0; }else{ $buying_price=$al_item['buying_price'];}
                $html.="<tr>
                        <td>".$al_item['item_name']."</td>
                        <td>".$al_item['item_type']."</td>
                        <td>".$al_item['item_code']."</td>
                       <td>".CURRENCY." ".number_format($selling_price,2,'.',',')."</td>
                      <td>".$item_sale_acname."</td>
                         <td>".$item_sale_tax_code."</td>
                   <td>".CURRENCY." ".number_format($buying_price,2,'.',',')."</td>
                         <td>".$item_purchase_acname."</td>
                        <td>".$item_purcharse_tax_code."</td>
                      </tr>";
 
}}
 
$html.="
    </table>";


$filename = SERVER_ROOT . '/uploads/pdf/Item_list.html';
file_put_contents ( $filename, $html );
echo $html;?>

  </div>
        </div>  
    </div>
</div>