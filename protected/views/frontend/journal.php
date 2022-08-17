

<?php
$current_tab=$_COOKIE['current_tab'];
if ($current_tab!="posted" && $current_tab!="reserved" && $current_tab!="all")
{	$current_tab="all";
}



if ($current_tab=="posted"){
    $db->order_by = "`id` DESC";
    $all_journal=$db->get_all('journal',array('visibility_status'=>'active','ladger_generate'=>'no'));
}
elseif ($current_tab=="reserved"){
    $db->order_by = "`id` DESC";
    $all_journal=$db->get_all('journal',array('visibility_status'=>'active','ladger_generate'=>'yes'));
}elseif($current_tab=="all"){
    $db->order_by = "`id` DESC";
    $all_journal=$db->get_all('journal',array('visibility_status'=>'active'));
}
//echo $current_tab;

if(isset($_REQUEST['action_generate_ledger']))
{
    $journal_id=$_REQUEST['action_generate_ledger'];
    $journal_details=$db->get_row('journal',array('id'=>$journal_id));
    //print_r($journal_details);
    $journal_date=date('Y-m-d',strtotime($journal_details['journal_date']));
    $project=unserialize($journal_details['project']);
    $accounts=unserialize($journal_details['account']);
    $typee=unserialize($journal_details['type']);
    $debitt=unserialize($journal_details['debit']);
    $creditt=unserialize($journal_details['credit']);
    $tax_codet=unserialize($journal_details['tax_code']);
    $taxt=unserialize($journal_details['tax']);
    $contactt=unserialize($journal_details['contact']);
    $trans_typet=unserialize($journal_details['trans_type']);


    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];

 	//print_r($contactt);
  	//print_r($type);
    if (is_array($accounts))
    {
        foreach ($accounts as $key=>$acc)
        {
        	$account_id=$acc;
            $account_nature=$db->get_var('accounts',array('id'=>$account_id),'nature');
           	$type=$typee[$key];
            $debit=$debitt[$key];
            $credit=$creditt[$key];

            if ($journal_details['generated_from']=="receive_money")
            {
                $contact=$db->get_var('receive_money',array('id'=>$journal_details['generated_from_id']),'contact_id');
            }
            elseif($journal_details['generated_from']=="make_payment")
            {
                $contact=$db->get_var('make_payment',array('id'=>$journal_details['generated_from_id']),'contact_id');
            }
            else
            {
            	$contact=$contactt[$key];
            }

            $tax=$taxt[$key];
            $tax_code=$tax_codet[$key];
            if ($tax_code=="")
            {
                $tax_code=$db->get_var('tax',array('default_tax_code'=>'1'),'id');
            }

            $trans_type=$trans_typet[$key];
           // $sign=$acc_object->getsign($account_nature, $type);
     	 if ($type=="debit"){

     	 	/*	    if ($account_nature=="assets" || $account_nature=="expense" || $account_nature=="cogs")
     	 	    {
     	 	        $sign="";
     	 	    }else
     	 	    {
     	 	       $sign="-";

     	 	    }
     	 	    $debit=trim($sign.$debit);
                     */
                       $insert=$db->insert('account_transaction',array('type'=>'journal',
                                                                        'type_id'=>$journal_id,
                                                                        'contact'=>$contact,
                                                                        'tax_code'=>$tax_code,
                                                                        'account_id'=>$account_id,
                                                                        'amount'=>$debit,
                        												'transaction_type'=>'debit',
                                                                        'transaction_date'=>$journal_date,
                                                                        'create_date'=>$created_date,
                                                                        'ip_address'=>$ip_address));
       		}
            elseif ($type=="credit"){

              /*  if ($account_nature=="assets" || $account_nature=="expense" || $account_nature=="cogs")	             {
                     $sign="-";
                }else {
                     $sign="";
                }
                $credit=trim($sign.$credit);
              */
                $insert=$db->insert('account_transaction',array('type'=>'journal',
                            			                    'type_id'=>$journal_id,
                            			                    'contact'=>$contact,
                            			                    'tax_code'=>$tax_code,
                            			                    'account_id'=>$account_id,
                            			                    'amount'=>$credit,
                            			                	'transaction_type'=>'credit',
                                                            'transaction_date'=>$journal_date,
                            			                    'create_date'=>$created_date,
                            			                    'ip_address'=>$ip_address));

            }
     }
	 if ($insert){
	     /**********************************update current balance of accounts******************************************/
	     $new_account=$accounts;
	     $new_type=$typee;
	     $new_debit=$debitt;
	     $new_credit=$creditt;
	     foreach ($new_account as $key=>$value)
	     {
	         $account_current_balance=$db->get_var('accounts',array('id'=>$value),'current_balance');
	         $account_nature=$db->get_var('accounts',array('id'=>$value),'nature');
	         $type_new1=$new_type[$key];

	         if ($type_new1=="debit")
	         {
	             $new_debit1=$new_debit[$key];
	             if ($account_nature=="assets" || $account_nature=="expense" || $account_nature=="cogs")
	             {
	                 $account_current_balance_new=$account_current_balance+$new_debit1;
	             }else
	             {
	                 $account_current_balance_new=$account_current_balance-$new_debit1;
	             }

	         }
	         else
	         {
	             $new_credit1=$new_credit[$key];
	             if ($account_nature=="assets" || $account_nature=="expense" || $account_nature=="cogs")	             {
	                 $account_current_balance_new=$account_current_balance-$new_credit1;
	             }else {
	                 $account_current_balance_new=$account_current_balance+$new_credit1;
	             }
	         }
	         $db->update('accounts',array('current_balance'=>$account_current_balance_new),array('id'=>$value));
	     }
		/********************************* entry in activity log****************************************************/
	     $event="general journal  (" . $journal_details['journal_no'] . ") convert to general ledger";
	     $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
	               'event'=>$event,
	               'created_date'=>date('Y-m-d'),
	               'ip_address'=>$_SERVER['REMOTE_ADDR']

	     ));
		/********************************* update 'ladger_generate'=>'yes' in journal table****************************************************/
	    $update=$db->update('journal',array('ladger_generate'=>'yes'),array('id'=>$journal_id));
	    if ($update){
	    	$display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
			                    <button class="close" data-dismiss="alert" type="button">×</button>
			                     Journal ladger created Successfully.</div>';
	        echo "<script>
				setTimeout(function(){
			    window.location = '".$link->link("journal",user)."'
			    },3000);</script>";
	    }
	}
}

}
elseif(isset($_REQUEST['action_delete']))
{
    $delete_id=$_REQUEST['action_delete'];

    $display_msg='<form method="POST" action="">
                 <div class="alert alert-danger">
                 <button class="close" data-dismiss="alert" type="button">×</button>
            	  Are you sure ? You want to delete this .
            	 <input type="hidden" name="del_id" value="'.$delete_id.'" >
            	 <button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="lnr lnr-checkmark-circle"></i></button>
            	 <button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="lnr lnr-cross-circle"></i></button>
            	 </div>
            	 </form>';
    if(isset($_POST['yes']))
    {
        $journal_no=$db->get_var('journal',array('id'=>$_POST['del_id']),'journal_no');
        $event="Delete General Journal (" . $journal_no . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
        $delete=$db->delete('journal',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                     Journal Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("journal",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('journal',user);
    }

}?>
<div class="row">
	<div class="col-lg-12">
	<div class=" padded" >
					<h3>JOURNALS</h3>
				</div>
				<?php echo $display_msg;?>

    	<div class="widget-container fluid-height">
        	<div class="widget-content padded">



               <div class="row">
	<div class="col-lg-12">

	<!--<a href="<?php echo $link->link('journal',user);?>" class="btn btn-primary"> Journals </a>
	 <a href="<?php echo $link->link('advisor_activity',user);?>" class="btn btn-default"> Activity statements </a>
	<a href="<?php echo $link->link('advisor_tpar_report',user);?>" class="btn btn-default">TPAR reports </a> -->

 <?php if(in_array('create_and_edit',$adv_journal)){?>
 	<?php if (IS_GST_REGISTERED=='yes'){?>
		<a href="<?php echo $link->link('add_journal',user);?>" class="btn btn-default pull-right"> Add Journal </a>
	<?php }if (IS_GST_REGISTERED=='no'){ ?>
		<a href="<?php echo $link->link('add_journal_without_tax',user);?>" class="btn btn-default pull-right"> Add Journal </a>
	<?php }?>
<?php }?>
	</div>
	</div>
	                  <div class="heading tabs">
	                    <i class="icon-sitemap"></i>
	                    <ul class="nav nav-tabs pull-left" data-tabs="tabs">
	                      <li tab="all"  class="set_cookie <?php if ($current_tab=="all" || $current_tab==""){echo"active";}?>">
	                        <a  href="#"><i class="icon-comments"></i><span>All</span></a>
	                      </li>
	                      <li tab="posted"  class="set_cookie <?php if ($current_tab=="posted"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Posted</span></a>
	                      </li>
	                      <li tab="reserved"  class="set_cookie <?php if ($current_tab=="reserved"){echo"active";}?>">
	                        <a  href="#"><i class="icon-user"></i><span>Reserved</span></a>
	                      </li>
	                     </ul>
	                  </div>

					        <div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">

					              <div class="widget-content padded clearfix">
					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr>
					                    <th>S.no</th>
					                    <th>Date</th>
					                    <th>Journal no.</th>
					                    <th>Journal type</th>
					                    <th>Accounts</th>
					                    <th>Debit</th>
					                    <th>Credit</th>
					                    <th>Summary</th>

					                    <th>Action</th>
					                     </tr>
					                  </thead>
					                  <tbody>
    					                  <?php

    					                  if (is_array($all_journal)){
    					                      $sn=1;
    					                      foreach ($all_journal as $allj){?>
    					                    <tr>
    					                      <td><?php echo $sn;?></td>
    					                      <td><?php
    					                   if ($allj['journal_date']!=""){ echo date(DATE_FORMAT,strtotime($allj['journal_date']));}?></td>
    					                      <td><?php echo $allj['journal_no'];?></td>
    					                      <td><?php echo $allj['journal_type'];?></td>
    					                      <td><?php $accounts=unserialize($allj['account']);
    					                      if (is_array($accounts)){
    					                          foreach ($accounts as $acc)
    					                          {$acc_name=$db->get_var('accounts',array('id'=>$acc),'account_name');
    					                          echo"<span class='text-danger'>".$acc_name."</span><br>";

    					                          }
    					                      }?></td>
    					                      <td><?php $debit_amounts=unserialize($allj['debit']);
    					                      if (is_array($debit_amounts)){
    					                          foreach ($debit_amounts as $debit)
    					                          {
    					                             if ($debit!=""){
    					                          echo"<span>".number_format($debit,2,'.',',')."</span><br>";
    					                             }else{echo"<br>";}

    					                          }
    					                      }?></td>
    					                      <td><?php $credit_amount=unserialize($allj['credit']);
    					                      if (is_array($credit_amount)){
    					                          foreach ($credit_amount as $credit)
    					                          {
    					                              if ($credit!=""){
    					                              echo"<span>".number_format($credit,2,'.',',')."</span><br>";
    					                              }else{echo"<br>";}
    					                          }
    					                      }

    					                      ?></td>
    					                      <td><?php echo $allj['summary'];?></td>

    					                    <td>
    					                    <?php if ($allj['ladger_generate']=='no'){?>
    					                     <div class="btn-group">
                                             <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                             <?php if(in_array('view',$adv_journal)){?>
                                            <li> <a href="<?php echo $link->link('view_journal_details',user,'&journal_view_id='.$allj['id']);?>"><i class="fa fa-edit"></i>View</a></li>
                                             <?php }
                                             if ($allj['ladger_generate']=='no'){
	                                             if(in_array('delete',$adv_journal) && $allj['generated_from']=='journal'){?>
	                                             <li> <a href="<?php echo $link->link('journal',user,'&action_delete='.$allj['id']);?>"><i class="fa fa-edit"></i>Delete</a></li>
	                                             <?php }
	                                             if(in_array('create_and_edit',$adv_journal) && $allj['generate_from']=='journal'){?>
	                                             	<?php if (IS_GST_REGISTERED=='yes'){?>
	                                             		<li> <a href="<?php echo $link->link('edit_journal',user,'&action_edit='.$allj['id']);?>"><i class="fa fa-edit"></i>Edit</a></li>
	                                             	<?php }if (IS_GST_REGISTERED=='no'){?>
	                                             		<li> <a href="<?php echo $link->link('edit_journal_without_tax',user,'&action_edit='.$allj['id']);?>"><i class="fa fa-edit"></i>Edit</a></li>
	                                             	<?php }?>
	                                             <?php }
                                             }
                                             if(in_array('approve',$adv_journal)){?>
                                           	<?php if ($allj['ladger_generate']=='no'){?>
                                           <li> <a href="<?php echo $link->link('journal',user,'&action_generate_ledger='.$allj['id']);?>"><i class="fa fa-edit"></i>Generate Ledger</a></li>
											<?php }?>
											<?php }?>
                                            </ul><br>

                                          </div>
                                          <?php }?>
<?php if ($allj['ladger_generate']=='yes'){?>
                                            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-xs">Ledger Generated</button>
                                            <?php }?>
                                          </td>
                                            </tr>
    					                    <?php  $sn++; }}?>
                                     </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>
                  </div>
        </div>
    </div>
</div>
<script>
      $(".set_cookie").click(function(){
          var tab=$(this).attr('tab');
        //  alert(tab);

          var ct=document.cookie = "current_tab="+tab;
          window.location.href="";

          });</script>