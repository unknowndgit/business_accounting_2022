<?php $current_tab=$_COOKIE['current_tab'];

if ($current_tab!=="allocated" && $current_tab!=="new")
{
    $current_tab="";
}


?>

<?php if (isset($_POST['add_bank_transaction_form_submit_import']))
{
    $bank_account_id=$_POST['bank_account_id'];
    if ($_FILES['statement_file']!="")
    {
        $file=$_FILES['statement_file'];
        $check=strpos($file['name'], 'csv');
if ($bank_account_id=="")
{
    $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="ion-sad"></i>  Select a bank account .
                </div>';
}
    elseif($check=== FALSE)
    {
        $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="ion-sad"></i>  Oops! This is not a valid CSV file.
                </div>';
    }else
    {

        $filename=$file['name'];

        $ret= move_uploaded_file($_FILES["statement_file"]["tmp_name"], SERVER_ROOT.'/uploads/location_files/'.$filename );
        $handle12 = fopen("uploads/location_files/".$filename, "r");
        $firstRow = true;
$count=0;
        while (($data = fgetcsv($handle12,"", ",")) !== FALSE)
        {
            if ($count!=0){

                    $date=date('Y-m-d',strtotime($data['0']));
                    $description=$data['1'];
                    $reference=$data['2'];
                    $withdrawals=$data['3'];
                    $deposits=$data['4'];

      //  if (!$db->exists('bank_statments',array('bank_id'=>$bank_account_id,'transaction_date'=>$data['0']))){

           $insert=$db->insert("bank_statement",array('bank_id'=>$bank_account_id,
                                                      'transaction_date'=>$date,
                                                      'description'=>$description,
                                                      'reference'=>$reference,//first name
                                                      'withdrawals'=>$withdrawals,//last name
                                                      'deposits'=>$deposits,
                                                      'created_date'=>date('Y-m-d'),
                                                      'ip_address'=>$_SERVER['REMOTE_ADDR']));

             //   $db->debug();
            }
            $count++;
        }
        //}
        fclose($handle12);
        $path=SERVER_ROOT.'/uploads/location_files/'.$filename;
        if(file_exists($path))
        {
            unlink($path);
        }
        $display_msg='<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-happy"></i> File Import Successfully
                </div>';
       echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("bank_transactions",userend,'&bank_account='.$_REQUEST[bank_account])."'
	                },3000);</script>";


    }
 }else{
     $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-sad"></i> Select .csv file to upload
                </div>';
 }
}
elseif(isset($_REQUEST['action_reconcile']))
{
    $transaction_id=$_REQUEST['action_reconcile'];
    $transaction_deatil=$db->get_row('account_transaction',array('id'=>$transaction_id));
    $journal_deatil=$db->get_row('journal',array('id'=>$transaction_deatil['type_id']));
    $generated_from=$journal_deatil['generated_from'];
    $generated_from_id=$journal_deatil['generated_from_id'];






    //Check in bank statement table
    if ($transaction_deatil['transaction_type']=='debit'){

                if ($db->exists('bank_statement',array('bank_id'=>$transaction_deatil['account_id'],
                                                        'transaction_date'=>$transaction_deatil['transaction_date'],
                                                        'withdrawals'=>$transaction_deatil['amount'] )))
                {
                    $hai=$db->update('account_transaction',array('reconcile'=>'yes'),array('id'=>$transaction_id));
                    if ($hai){

                        $bank_account=$transaction_deatil[account_id];
                        $query="SELECT SUM(`amount`) FROM `account_transaction` WHERE `account_id`='$bank_account' AND `reconcile`='yes'";
                        $amount_sum_recon=$db->run($query)->fetchColumn();

                         $db->update('accounts',array('last_reconciliation_amount'=>$amount_sum_recon,
                                                      'last_reconciliation_date'=>date('Y-m-d')),array('id'=>$bank_account));



                            if ($generated_from=="receive_money")
                            { //update reconcile ="yes" in receive money table
                                $db->update('receive_money',array('reconcile'=>'yes'),array('id'=>$generated_from_id));

                            }
                            if ($generated_from=="make_payment")
                            {
                                //update reconcile ="yes" in receive money table
                                $db->update('make_payment',array('reconcile'=>'yes'),array('id'=>$generated_from_id));
                             }



                        echo "<script>
                     setTimeout(function(){
    	    		  window.location = '".$link->link("bank_transactions",userend,'&bank_account='.$_REQUEST[bank_account])."'
    	                },1000);</script>";
                    }
                }
                else{

                    $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-sad"></i> No such transaction exist in bank statement
                </div>';

                  echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("bank_transactions",userend,'&bank_account='.$_REQUEST[bank_account])."'
	                },1000);</script>";}
    }else
    {
        $hai=$db->exists('bank_statements',array('bank_id'=>$transaction_deatil['account_id'],
            'transaction_date'=>$transaction_deatil['transaction_date'],
            'deposits'=>$transaction_deatil['amount']
        ));
        if ($hai){
            $db->update('account_transaction',array('reconcile'=>'yes'),array('id'=>$transaction_id));

            $bank_account=$transaction_deatil[account_id];
            $query="SELECT SUM(`amount`) FROM `account_transaction` WHERE `account_id`='$bank_account' AND `reconcile`='yes'";
            $amount_sum_recon=$db->run($query)->fetchColumn();

            $db->update('accounts',array('last_reconciliation_amount'=>$amount_sum_recon,
                                         'last_reconciliation_date'=>date('Y-m-d')),array('id'=>$bank_account));



            if ($generated_from=="receive_money")
            { //update reconcile ="yes" in receive money table
            $db->update('receive_money',array('reconcile'=>'yes'),array('id'=>$generated_from_id));

            }
            if ($generated_from=="make_payment")
            {
                //update reconcile ="yes" in receive money table
                $db->update('make_payment',array('reconcile'=>'yes'),array('id'=>$generated_from_id));
            }
          echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("bank_transactions",userend,'&bank_account='.$_REQUEST[bank_account])."'
	                },1000);</script>";}
         else{
             $display_msg='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="lnr lnr-sad"></i> No such transaction exist in bank statement
                </div>';

           echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("bank_transactions",userend,'&bank_account='.$_REQUEST[bank_account])."'
	                },1000);</script>";}
    }

}elseif(isset($_REQUEST['action_unreconcile']))
{
    $transaction_id=$_REQUEST['action_unreconcile'];
    $transaction_deatil=$db->get_row('account_transaction',array('id'=>$transaction_id));
    $journal_deatil=$db->get_row('journal',array('id'=>$transaction_deatil['type_id']));
    $generated_from=$journal_deatil['generated_from'];
    $generated_from_id=$journal_deatil['generated_from_id'];

      $db->update('account_transaction',array('reconcile'=>'no'),array('id'=>$transaction_id));
      if ($generated_from=="receive_money")
      { //update reconcile ="yes" in receive money table
      $db->update('receive_money',array('reconcile'=>'yes'),array('id'=>$generated_from_id));

      }
      if ($generated_from=="make_payment")
      {
          //update reconcile ="yes" in receive money table
          $db->update('make_payment',array('reconcile'=>'yes'),array('id'=>$generated_from_id));
      }
                    echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("bank_transactions",userend,'&bank_account='.$_REQUEST[bank_account])."'
	                },1000);</script>";


}
?>
<div class="row">
   <div class="col-lg-12">
      <div class=" padded" >
         <h3>Bank Transactions</h3>
      </div>
      <?php echo $display_msg;?>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
            <div class="row">
            <div class="col-lg-6">
             <div class="form-group" >
                           <label class="control-label col-md-2">Transction for</label>
                           <div class="col-md-7">
                              <select class="form-control" name="bank_id" id="b_id">
                              <?php $bank_accounts=$db->get_all('accounts',array('visibility_status'=>'active','account_type'=>'bank'));
                              if (is_array($bank_accounts)){
                                  foreach ($bank_accounts as $allb){?>
                                      <option <?php if ($_REQUEST['bank_account']==$allb['id']){echo "selected='selected'";}?>  value="<?php echo $allb['id'];?>"><?php echo $allb['account_name'];?></option>
                                  <?php }
                              }?>
                              </select>
                           </div>
                        </div>

               </div>
               <div class="col-lg-6">
               <a href="<?php echo $link->link('banking_bank_account',user);?>" class="btn btn-default pull-right"> Back to list </a>
               <!--  <a href="<?php echo $link->link('default_account_setting',user);?>" class="btn btn-default pull-right"> Account Setting </a>-->

               </div>
            </div>
            <div class="heading tabs">
               <i class="icon-sitemap"></i>
               <ul class="nav nav-tabs pull-left" data-tabs="tabs">
				<?php if(in_array('view',$dtd_bank_account)){?>
               	  <li tab="allocated"  class="set_cookie <?php if ($current_tab=='' || $current_tab=='allocated'){echo 'active';}?>">
                     <a  href="#"><i class="icon-user"></i><span>Allocated</span></a>
                  </li>
                <?php }if(in_array('create_and_edit',$dtd_bank_account)){?>
                  <li tab="new"  class="set_cookie <?php if ($current_tab=='new'){echo 'active';}?>">
                     <a  href="#"><i class="icon-comments"></i><span>New</span></a>
                  </li>
                <?php }?>
               </ul>
            </div>
            <div class="tab-content padded">
            <div class="row">
                  <div class="col-lg-12">
                     <div class="widget-container fluid-height clearfix">
                      <div class="widget-content padded clearfix">
                      <?php if ($current_tab=='new'){?>
                      <h3>Upload Bank Statement file</h3>

          <div class="row">

                     <div class="col-lg-4">
               <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="add_bank_transaction_form_submit_import" value="add_bank_transaction_form_submit_import">
                  <input type="hidden" name="bank_account_id" value="<?php echo $_REQUEST['bank_account'];?>">


                        <div class="form-group">
                                <label class="control-label col-md-3">File</label>
                                 <div class="col-md-7">
                                <input class="form-control" type="file" class="filestyle" data-size="sm" name="statement_file">
                                <span class="help-block"><small>Please upload only .csv file.</small></span>
                             </div>
                             </div>
                             <button class="btn btn-default btn-block"  type="submit">Upload</button>
                    </form>
                        </div>
                        <div class="col-lg-8">

                         <table class="table table-bordered table-striped" id="dataTable1">
                              <thead>
<tr>
                                    <th class="check-header hidden-xs">
                                      Date
                                    </th>
                                    <th>Reference </th>
                                    <th>Description</th>
                                    <th class="hidden-xs">Money Out / deposits</th>
                                    <th class="hidden-xs">Money in / withdrawals</th>

                                    </tr>

                              </thead>
                              <tbody>
                                 <?php
                                 $db->order_by="id DESC";
                                 $all_transctions=$db->get_all('bank_statement',array('bank_id'=>$_REQUEST['bank_account']));
                                  if (is_array($all_transctions)){
                                 	$sn=1;
                                    foreach ($all_transctions as $alla){
                               ?>
                                 <tr>
                                    <td><?php echo date(DATE_FORMAT,strtotime($alla['transaction_date']));?></td>
                                    <td><?php echo $alla['description'];?></td>
                                    <td><?php echo $alla['reference'];?></td>
                                    <td><?php echo $alla['deposits'];?></td>
                                     <td><?php echo $alla['withdrawals'];?></td>




                                 </tr>
                                 <?php $sn++; }}?>
                              </tbody>
                           </table>



                        </div>
                     </div>







                      <?php }else{?>
                           <table class="table table-bordered table-striped" id="dataTable1">
                              <thead>
<tr>
                                    <th width="5%">S.no </th>
                                    <th width="10%">Date</th>
                                    <th width="15%">Reference </th>
                                    <th width="20%">Description</th>
                                    <th width="10%">Money Out</th>
                                    <th width="10%">Money in</th>
                                    <th width="15%">Contact</th>
                                    <th width="15%">Action</th>
                                    </tr>

                              </thead>
                              <tbody>
                                 <?php
                                 $db->order_by="id DESC";
                                 $all_transctions=$db->get_all('account_transaction',array('account_id'=>$_REQUEST['bank_account']));
                                  if (is_array($all_transctions)){
                                 	$sn=1;
                                    foreach ($all_transctions as $alla){
                                        $transaction_id=$alla['id'];

                                        $transaction_deatil=$db->get_row('account_transaction',array('id'=>$transaction_id));
                                        $journal_deatil=$db->get_row('journal',array('id'=>$transaction_deatil['type_id']));
                                        $generated_from=$journal_deatil['generated_from'];
                                        $generated_from_id=$journal_deatil['generated_from_id'];
                                        $journal_number=$journal_deatil['journal_no'];
                                        $journal_summary=$journal_deatil['summary'];
                                        if ($generated_from=="receive_money")
                                        {
                                            $t_details=$db->get_row('receive_money',array('id'=>$generated_from_id));
                                            $reference=$t_details['reference'];
                                            $details=$t_details['details'];
                                            $remark=$journal_number;



                                        }
                                        elseif ($generated_from=="make_payment")
                                        {
                                            $t_details=$db->get_row('make_payment',array('id'=>$generated_from_id));
                                            $reference=$t_details['reference'];
                                            $details=$t_details['details'];
                                            $remark=$journal_number;


                                        }
                                     elseif ($generated_from=="Transfer_money")
                                        {
                                            $t_details=$db->get_row('transfer_money',array('id'=>$generated_from_id));
                                            $reference=$t_details['reference'];
                                            $details=$t_details['description'];
                                            $remark=$journal_number;


                                        }else{$remark=$journal_number;}



                                        ?>
                                 <tr>
                                 <td><?php echo $sn;?></td>
                                    <td><?php echo date(DATE_FORMAT,strtotime($alla['transaction_date']));?></td>
                                    <td><?php echo $reference;?></td>
                                    <td><?php echo $details ."<br> (".$journal_summary."-".$remark.")";?></td>
                                    <td><?php if ($alla['transaction_type']=="credit"){echo $alla['amount'];}?></td>
                                     <td><?php if ($alla['transaction_type']=="debit"){echo $alla['amount'];}?></td>
                                    <td ></td>


                                    <td class="actions">
                                    <a data-toggle="modal" href="#transaction_details" class="tid" data="<?php echo $alla['id'];?>"><i class="lnr lnr-pencil"></i> Details</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <?php if ($alla['reconcile']=="no"){?>
                                                <a class="btn btn-success" href="<?php echo $link->link('bank_transactions',user,'&bank_account='.$_REQUEST[bank_account].'&action_reconcile='.$alla['id']);?>">Reconcile</a>
                                                <?php }else{?>
                                                <a class="btn btn-warning" href="<?php echo $link->link('bank_transactions',user,'&bank_account='.$_REQUEST[bank_account].'&action_unreconcile='.$alla['id']);?>">Unreconcile</a>
                                                <?php }?>

                                          </td>

                                 </tr>
                                 <?php $sn++; }}?>
                              </tbody>
                           </table>
                           <?php }?>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end DataTables Example -->
               </p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ------ Modal To view transaction details ------ -->
				<div class="modal fade" id="transaction_details">
                  <div class="modal-dialog" id="after_post_message">

                  </div>
                </div>
<script>
      $(".set_cookie").click(function(){
          var tab=$(this).attr('tab');
        //  alert(tab);

          var ct=document.cookie = "current_tab="+tab;
          window.location.href="";

          });</script>
          <script>
          //----------- Send Customer Id To Header --------------
          $("#b_id").change(function(){
          	var id=$(this).val();
          	location.href=window.location.pathname+'?user=bank_transactions&bank_account='+id;
          });
          </script>
          <script>
$(".tid").click(function(){
	var data_id=$(this).attr('data');
	//alert(data_id);

	$.ajax({
	      type: 'POST',
	      url: "<?php echo $link->link('ajax',user);?>",
	      data: 'transaction_id=' + data_id,
	      success: function(data)
	       {
              $("#after_post_message").html(data);
	       }
	});

});




          </script>