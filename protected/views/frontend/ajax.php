<?php
if(isset($_POST['GroupString']))
{
	$full_data = urldecode($_REQUEST['content']);
	$expl = explode("&", $full_data);
	$a=0;
	foreach ($expl as $val)
	{
		if($a==0)
		{
			$string['created_date']=date("Y-m-d");
			$string['ipaddress']=$_SERVER['REMOTE_ADDR'];
			$string['type']='group';
		}
		$expl1 = explode("=", $val);
		$string[$expl1['0']]=$expl1['1'];
		$a++;
	}
	$array=$string;
	$db->insert("suppliers",$array);
}



if (isset($_REQUEST['item_id'])){
    $item_td=$_REQUEST['item_id'];
	$items=$db->get_row('items',array('id'=>$item_td, 'visibility_status'=>'active'));

		$itm2=$items['selling_price'];              //$itm.'__'.$itms;

	$tax_code=$db->get_row('tax',array('id'=>$items['sell_item_tax_code']));
	$itm=$itm2.'__'.$tax_code['tax_name'].'__'.$tax_code['tax_rate'];
	echo $itm;
}
//---- Select rate by Tax Code -------
$item_code_name=$_REQUEST['item_code_name'];
if(isset($item_code_name)){
    $tax_rate=$db->get_var('tax',array('tax_name'=>$item_code_name),array('tax_rate'));
    echo $tax_rate;
}

if (isset($_REQUEST['buy_item_id'])){
    $item_td=$_REQUEST['buy_item_id'];
    $items=$db->get_row('items',array('id'=>$item_td, 'visibility_status'=>'active'));

    $itm2=$items['buying_price'];              //$itm.'__'.$itms;

    $tax_code=$db->get_row('tax',array('id'=>$items['buy_item_tax_code']));
    $itm=$itm2.'__'.$tax_code['tax_name'].'__'.$tax_code['tax_rate'];
    echo $itm;
}

/*$item_td=$_REQUEST['item_id'];
if (isset($item_td)){
	$items=$db->get_row('items',array('id'=>$item_td));
	foreach ($items as $itms){
		$itm=$itm.'__'.$itms;
	}
	$tax_code=$db->get_row('tax',array('id'=>$items['sell_item_tax_code']));
	$itm=$itm.'__'.$tax_code['tax_name'].'__'.$tax_code['tax_rate'];
	echo $itm;
}*/


//-----=========******** Advisor Jurnal *******=======---------

//------ Select Account--------
$account_id=$_REQUEST['account_id'];
if(isset($account_id)){
	$accounts=$db->get_row('accounts',array('id'=>$account_id, 'visibility_status'=>'active'));
	$tax=$db->get_row('tax',array('id'=>$accounts['default_tax_code'], 'visibility_status'=>'active'));
	echo $tax['id'].'__'.$tax['tax_rate'];
}

//---- Select Contact -------
$contact_id=$_REQUEST['contact_id'];
if(isset($contact_id)){
	$contacts=$db->get_row('contacts',array('id'=>$contact_id, 'visibility_status'=>'active'));
	echo $contacts['is_customer'].'__'.$contacts['is_supplier'];
}

//---- Select TaxCode -------
$tax_code_id=$_REQUEST['tax_code_id'];
if(isset($tax_code_id)){
	$tax_code=$db->get_row('tax',array('id'=>$tax_code_id, 'visibility_status'=>'active'));
	echo $tax_code['tax_rate'];
}
?>

<?php
$return = array();
$return['msg'] = '';
$return['error'] = false;

if (isset($_POST['add_bank_account_form_submit']))/*****************add bank account modal box submit****************/
{
   	$account_name=$_POST['account_name'];
	$account_nature=$_POST['account_nature'];
	$account_opening_date=$_POST['account_opening_date'];
	$opening_balance=$_POST['opening_balance'];
	$visibility_status='active';
	$created_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];


 if ($fv->emptyfields(array('Account name'=>$account_name),NULL))
    {

        $return['msg']='<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>Account name can not be Blank.
                		</div>';
        $return['error']=true;
        echo json_encode($return);

    }
    elseif ($db->exists('accounts',array('account_name'=>$account_name)))
    {


        $return['msg']='<div class="alert alert-danger"><i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Bank account name already exist!.
    					</div>';
        $return['error']=true;
        echo json_encode($return);
    }
else
{



	$insert=$db->insert('accounts',array('account_name'=>$account_name,
	                                     'nature'=>$account_nature,
	                                     'account_type'=>'bank',
	                                     'visibility_status'=>$visibility_status,
                                	    'account_opening_date'=>$account_opening_date,
                                    	    'opening_balance'=>$opening_balance,
                                    	    'current_balance'=>$opening_balance,
                                         'created_date'=>$created_date,
                                         'ip_address'=>$ip_address

	));

  //  $db->debug();
    if ($insert){
        $event="Create a new bank account (" . $account_name . ")";
        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
            'event'=>$event,
            'created_date'=>date('Y-m-d'),
            'ip_address'=>$_SERVER['REMOTE_ADDR']

        ));
              $return['msg']='<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">
                    <i class="lnr lnr-cross-circle"></i></button> Save successfully.
                    		</div>';
               $return['error']=false;
              echo json_encode($return);





    }
}
}
elseif (isset($_POST['get_base_on_zip'])) {
    if($_POST['zip']){
        $zip_city_state_country = $db->get_row('zip_city_state_country',array('zip'=>$_POST['zip']));
        $result = array();
        $result['city'] = $zip_city_state_country['city'];
        $result['state'] = $zip_city_state_country['state'];
        $result['country'] = $zip_city_state_country['country'];
        echo json_encode($result);
    }
}
elseif (isset($_POST['add_project_form_submit']))//add project modal box submit
{
    $project_name=$_POST['project_name'];
    $start_date=$_POST['start_date'];
    $visibility_status=$_POST['visibility_status'];
    $end_date=$_POST['end_date'];
    $description=$_POST['description'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];

    if ($fv->emptyfields(array('project name'=>$project_name),NULL))
    {
        $return['msg']='<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>Project name can not be Blank.
                		</div>';


        $return['error']=true;
        echo json_encode($return);

    }
    elseif ($start_date > $end_date)
    {


        $return['msg']='<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                           Start date must be less than End date
                		</div>';


        $return['error']=true;
        echo json_encode($return);

    }

    elseif (empty($_POST['customer']))
    {
        $return['msg']='<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
       Select Customer to assign this project.
                		</div>';


        $return['error']=true;
        echo json_encode($return);

    }
    elseif (empty($_POST['supplier']))
    {
        $return['msg']='<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
       Select Supplier to assign this project.
                		</div>';


        $return['error']=true;
        echo json_encode($return);

    }
    elseif ($db->exists('projects',array('project_name'=>$project_name))){

        $return['msg']='<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>Project name must be unique.
                		</div>';


        $return['error']=true;
        echo json_encode($return);
    }
    else{
        $insert=$db->insert("projects",array('project_name'=>$project_name,
                                            'start_date'=>$start_date,
                                            'visibility_status'=>$visibility_status,
                                            'end_date'=>$end_date,
                                            'project_status'=>'running',
                                            'description'=>$description,
                                            'created_date'=>$created_date,
                                            'ip_address'=>$ip_address));

        $last_id=$db->lastInsertId();
       /* if(is_array($_POST['items'])){
            foreach ($_POST['items'] as $key=>$value){
                $items=$_POST['items'][$key];
               $insert=$db->insert('assign_item_project',array('project_id'=>$last_id,
                                                                'item'=>$items,
                                                                'created_date'=>$created_date,
                                                                'ip_address'=>$ip_address ));
            }
        }*/
        if(is_array($_POST['customer'])){

            foreach ($_POST['customer'] as $key=>$value){
                $customer=$_POST['customer'][$key];
              //  $customer_weighting=$_POST['customer_weighting'][$key];

                $insert=$db->insert('assign_customer_project',array('project_id'=>$last_id,
                                                                     'customer'=>$customer,
                                                                     'created_date'=>$created_date,
                												'visibility_status'=>$visibility_status,
                                                                     'ip_address'=>$ip_address ));
            }
        }
        if(is_array($_POST['supplier'])){
            foreach ($_POST['supplier'] as $key=>$value){
                $supplier=$_POST['supplier'][$key];
                $insert=$db->insert('assign_supplier_project',array('project_id'=>$last_id,
                                                                     'supplier'=>$supplier,
                                                                     'created_date'=>$created_date,
                											'visibility_status'=>$visibility_status,
                                                                     'ip_address'=>$ip_address ));
            }
        }

        // $db->debug();
        if ($insert){
            $event="Create a new project (" . $project_name . ")";
            $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                'event'=>$event,
                'created_date'=>date('Y-m-d'),
                'ip_address'=>$_SERVER['REMOTE_ADDR']

            ));
            $return['msg']= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Project is added Successfully.
                    		</div>';
          $return['error']=false;
          echo json_encode($return);

        }
    }

    }
    elseif (isset($_POST['add_item_form_submit']))//add item modal box submit
    {
        $item_name=$_POST['item_name'];
        $item_code=$_POST['item_code'];

        $item_status=$_POST['item_status'];
        $item_type=$_POST['item_type'];

        $item_to=$_POST['item_to'];

        $sell_item_price=$_POST['sell_item_price'];
        $sell_item_account=$_POST['sell_item_account'];
        $sell_item_tax_code=$_POST['sell_item_tax_code'];
        $sell_item_description=$_POST['sell_item_description'];

        $buy_item_price=$_POST['buy_item_price'];
        $buy_item_account=$_POST['buy_item_account'];
        $buy_item_tax_code=$_POST['buy_item_tax_code'];
        $buy_item_description=$_POST['buy_item_description'];

        $date=date('Y-m-d');
        $ip=$_SERVER['REMOTE_ADDR'];




        $empt_fields = $fv->emptyfields(array('item name'=>$item_name,
                                              'Cost of Sales Account'=>$buy_item_account,
                                              'Account for tracking Sales'=>$sell_item_account));

        if ($empt_fields)
        {




            $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Oops! Following fields are empty<br>'.$empt_fields.'
                    		</div>';
            $return['error']=true;
            echo json_encode($return);



        }

        elseif ($db->exists('items',array('item_name'=>$item_name))){


            $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Item name already exist must be unique.
                    		</div>';
            $return['error']=true;
            echo json_encode($return);



        }
        elseif (is_float($sell_item_price) || is_integer($sell_item_price)){


            $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Selling Price must be numeric
                    		</div>';
            $return['error']=true;
            echo json_encode($return);
        }
        elseif (is_float($buy_item_price) || is_integer($buy_item_price)){


            $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                       Buying Price must be numeric
                    		</div>';
            $return['error']=true;
            echo json_encode($return);
        }

        else{





                    $insert=$db->insert('items',array('item_name'=>$item_name,
                                                        'visibility_status'=>$item_status,
                                                        'item_type'=>$item_type,
                                                        'item_to'=>$item_to,
                                                        'sell_item_account'=>$sell_item_account,
                                                        'sell_item_tax_code'=>$sell_item_tax_code,
                                                        'buy_item_account'=>$buy_item_account,
                                                        'buy_item_tax_code'=>$buy_item_tax_code,
                                                       'create_date'=>$date,
                                                        'ip_address'=>$ip,
                                                        'selling_price'=>$sell_item_price,
                                                        'buying_price'=>$buy_item_price
                    ));
                    //$db->debug();

                    if ($insert){
                        $event="Create a new item  (" . $item_name . ")";
                        $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                            'event'=>$event,
                            'created_date'=>date('Y-m-d'),
                            'ip_address'=>$_SERVER['REMOTE_ADDR']

                        ));
                      $return['msg']= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Item is added Successfully.
                    		</div>';
                              $return['error']=false;
                              echo json_encode($return);



                    }




        }
    }
elseif (isset($_POST['add_contact_form_submit']))
{



    // print_r($_POST);
    $contact_type=$_POST['contact_type'];
    $contact_is=$_POST['contact_is'];

    $business_name=$_POST['business_name'];
    $company_name=$_POST['company_name'];
    $display_name=$_POST['display_name'];
    $visibility_status="active";
    $phone_pre_code=$_POST['phone_pre_code'];
    $phone_number=$_POST['phone_number'];
    $mobile_pre_code=$_POST['mobile_pre_code'];
    $mobile_number=$_POST['mobile_number'];
    $fax_pre_code=$_POST['fax_pre_code'];
    $fax_number=$_POST['fax_number'];
    $email=$_POST['email'];
    $website=$_POST['website'];
    $office_number=$_POST['office_number'];
    $hp_number=$_POST['hp_number'];
    $postal_address_is=$_POST['postal_address_is'];
    $postal_address=$_POST['postal_address'];
    $postal_address_town=$_POST['postal_address_town'];
    //$postal_address_suburb=$_POST['postal_address_suburb'];
    $postal_address_state=$_POST['postal_address_state'];
    $postal_address_postcode=$_POST['postal_address_postcode'];


    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];


    $empt_fields = $fv->emptyfields(array('Contact type' =>$contact_type,
                                            'First Name'=>$business_name,
                                            'Last Name'=>$display_name,
                                            'Email Address'=>$email,
    ));

    if ($empt_fields)
    {
        $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                         Oops! Following fields are empty<br>'.$empt_fields.'</div>';
        $return['error']=true;
        echo json_encode($return);
    }
    elseif (!$fv->check_email($email))
    {


        $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Oops! Wrong Email Format.
                    		</div>';
        $return['error']=true;
        echo json_encode($return);



    }
    elseif ($db->exists('contact',array('email'=>$email)))
    {


        $return['msg']= '<div class="alert alert-danger">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Email already exist.
                    		</div>';
        $return['error']=true;
        echo json_encode($return);



    }
    else
    {
        if(in_array("customer", $contact_type)){$is_customer="yes";}else{$is_customer="no";}
        if(in_array("supplier", $contact_type)){$is_supplier="yes";}else{$is_supplier="no";}

        $insert=$db->insert("contacts",array('contact_type'=>implode(",", $contact_type),
                                                'is_customer'=>$is_customer,
                                                'is_supplier'=>$is_supplier,

                                                'contact_is'=>$contact_is,
                                                'company_name'=>$company_name,
                                                'business_name'=>$business_name,
                                                //   'first_name'=>$first_name,
                                                //  'last_name'=>$last_name,
                                                'display_name'=>$display_name,

                                                'visibility_status'=>$visibility_status,
                                                'phone_pre_code'=>$phone_pre_code,
                                                'phone_number'=>$phone_number,
                                                'mobile_number'=>$mobile_number,
                                                'mobile_pre_code'=>$mobile_pre_code,
                                                'fax_pre_code'=>$fax_pre_code,
                                                'fax_number'=>$fax_number,
                                                'email'=>$email,
                                                'website'=>$website,
                                                'office_number'=>$office_number,
                                                'hp_number'=>$hp_number,
                                                'postal_address_is'=>$postal_address_is,
                                                'postal_address'=>$postal_address,
                                                'postal_address_town'=>$postal_address_town,
                                               // 'postal_address_suburb'=>$postal_address_suburb,
                                                'postal_address_state'=>$postal_address_state,
                                                'postal_address_postcode'=>$postal_address_postcode,

                                                'created_date'=>$created_date,
                                                'ip_address'=>$ip_address));
        //  $db->debug();
        if ($insert){
            $event="Create a new Contact  (" . $business_name . ")";
            $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
                'event'=>$event,
                'created_date'=>date('Y-m-d'),
                'ip_address'=>$_SERVER['REMOTE_ADDR']

            ));
              $return['msg']= '<div class="alert alert-success">
                    		<i class="lnr lnr-smile"></i>
                        <button class="close" data-dismiss="alert" type="button"><i class="lnr lnr-cross-circle"></i></button>
                        Contact added Successfully.
                    		</div>';
    $return['error']=false;
    echo json_encode($return);




        }
    }
}

if (isset($_POST['transaction_id']))
{
if ($_POST['transaction_id']!="")
{
    $transaction_id=$_POST['transaction_id'];
    $transaction_deatil=$db->get_row('account_transaction',array('id'=>$transaction_id));
    $journal_deatil=$db->get_row('journal',array('id'=>$transaction_deatil['type_id']));

    $generated_from=$journal_deatil['generated_from'];
    $generated_from_id=$journal_deatil['generated_from_id'];
    if ($generated_from=="receive_money"){
    $receive_money_details=$db->get_row('receive_money',array('id'=>$generated_from_id));
            if($receive_money_details['receive_money_for']=="invoice")
            {
                $receive_money_for_details=$db->get_row('invoices',array('id'=>$receive_money_details['receive_money_for_id']));
                $date=$receive_money_for_details['invoice_date'];
                $number=$receive_money_for_details['invoice_number'];
                $type=$receive_money_details['receive_money_for'];
            }
            elseif($receive_money_details['receive_money_for']=="san")
            {
                $receive_money_for_details=$db->get_row('supplier_adjustment_notes',array('id'=>$receive_money_details['receive_money_for_id']));
                $date=$receive_money_for_details['adjustment_date'];
                $number=$receive_money_for_details['adjustment_number'];
                $type=$receive_money_details['receive_money_for'];
            }
    }
    elseif ($generated_from=="make_payment"){
            $receive_money_details=$db->get_row('make_payment',array('id'=>$generated_from_id));
            if($receive_money_details['payment_for']=="bill")
            {
                $receive_money_for_details=$db->get_row('bills',array('id'=>$receive_money_details['payment_for_id']));
                $date=$receive_money_for_details['bill_date'];
                $number=$receive_money_for_details['bill_number'];
                $type=$receive_money_details['payment_for'];
            }
            elseif($receive_money_details['payment_for']=="can")
            {
                $receive_money_for_details=$db->get_row('customer_adjustment_notes',array('id'=>$receive_money_details['payment_for_id']));
                $date=$receive_money_for_details['adjustment_date'];
                $number=$receive_money_for_details['adjustment_number'];
                $type=$receive_money_details['payment_for'];
            }
    }
    elseif ($generated_from=="Transfer_money"){
        $transfer_money_money_details=$db->get_row('transfer_money',array('id'=>$generated_from_id));

    }
}

    ?>
      <div class="modal-content" <?php if ($generated_from=="" || $generated_from=="make_payment" || $generated_from=="receive_money"){?>style="width: 800px;"<?php }?>>
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Transaction Details
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>
<?php if ($generated_from=="Transfer_money"){

                            ?>
                            <form action="#" class="form-horizontal">
				<h3>Transfer money</h3>
				<br>
				 <div class="form-group">
		            <label class="control-label col-md-4">Transfer From :</label>
		            <div class="col-md-8">
		            	<div class="col-md-4">
			             <label class="control-label"><?php
				              $acc1=$db->get_var('accounts',array('id'=>$transfer_money_money_details['transfer_money']),'account_name');
				              echo $acc1;
				          ?></label>
				         </div>
				         <div class="col-md-4">
				         <label class="control-label"><?php
				              $aid1=$transfer_money_money_details['transfer_money'];
				             // $query1="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid1";
				             // $amount1=$db->run($query1)->fetchColumn();
				              $current_balance1=$db->get_var('accounts',array('id'=>$transfer_money_money_details['transfer_money']),'current_balance');
                          if($current_balance1==''){ echo "";}else{  echo CURRENCY." ".number_format(($current_balance1),2,'.',',');}

				          ?></label>
				         </div>
		            </div>
		        </div>
		        <div class="form-group">
		            <label class="control-label col-md-4">Transfer to :</label>
		            <div class="col-md-8">
		            	<div class="col-md-4">
			              <label class="control-label"><?php
				              $acc2=$db->get_var('accounts',array('id'=>$transfer_money_money_details['transfer_to']),'account_name');
				              echo $acc2;
				          ?></label>
				         </div>
				         <div class="col-md-4">
					          <label class="control-label"><?php
					              $aid2=$transfer_money_money_details['transfer_money'];
					              $query2="SELECT SUM(amount) FROM `account_transaction` where `account_id`=$aid2";
					            //  $amount2=$db->run($query2)->fetchColumn();
					              $current_balance2=$db->get_var('accounts',array('id'=>$transfer_money_money_details['transfer_to']),'current_balance');
					              if($current_balance2==''){ echo "";}else{echo CURRENCY." ".number_format(($current_balance2),2,'.',',');}

				              ?></label>
				         </div>
		            </div>
		        </div>
				<div class="form-group">
		            <label class="control-label col-md-4">Date :</label>
		            <div class="col-md-8">
		              <label class="control-label"><?php echo $transfer_money_money_details['transfer_date'];?></label>
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="control-label col-md-4">Amount :</label>
		            <div class="col-md-8">
		              <label class="control-label"> <?php echo CURRENCY." ".number_format($transfer_money_money_details['amount'],2,'.',',');?></label>
		            </div>
		        </div>
		         <div class="form-group">
		            <label class="control-label col-md-4">Bank Fees :</label>
		            <div class="col-md-8">
		              <label class="control-label"><?php echo $transfer_money_money_details['bank_fees'];?></label>
		            </div>
		        </div>
		         <div class="form-group">
		            <label class="control-label col-md-4">Reference :</label>
		            <div class="col-md-8">
		              <label class="control-label"><?php echo $transfer_money_money_details['reference'];?></label>
		            </div>
		        </div>

		        <div class="form-group">
		            <label class="control-label col-md-4">Description :</label>
		            <div class="col-md-8">
		            <label class="control-label">   <?php echo $transfer_money_money_details['description'];?></label>
		            </div>
		        </div>
		        </form>
<?php }elseif($generated_from=="make_payment" || $generated_from=="receive_money"){?>
  <form action="#" class="form-horizontal" method="post">
<h3><?php echo ucwords(str_replace("_", " ", $generated_from));?></h3>
                              <div class="row">
                            <div class="col-lg-12">

              <div class="widget-content padded">
                            <div class="row">
                     <div class="col-lg-6">
                      <div class="form-group">
                           <label class="control-label col-md-3">Contact<font color="red">*</font></label>
                           <div class="col-md-9">
                          <select class="form-control" name="contact_id" id=contact_id required readonly>
                                          <?php $all_contact_name=$db->get_all('contacts',array('visibility_status'=>'active'));
                                 			if (is_array($all_contact_name)){
                            					foreach ($all_contact_name as $cn){?>
			                                       <option <?php if ($receive_money_details['contact_id']==$cn['id']){echo "selected='selected'";}?> value="<?php echo $cn['id'];?>"><?php echo $cn['display_name']."-:&nbsp;&nbsp;&nbsp;&nbsp;".$cn['contact_type'];?></option>
                                          <?php }}?>
                                 </select>
                           </div>
                        </div>

                            <div class="form-group">
                           <label class="control-label col-md-3">Date<font color="red">*</font></label>
                           <div class="col-md-9">
                           <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="date_selling" value="<?php echo $receive_money_details['date'];?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                      </div></div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Receivable/payable type</label>
                           <div class="col-md-9">
                             	<select class="form-control" name="receivable_type" >

                                          <?php
                                          $all_account=$db->run("SELECT * FROM `accounts` WHERE `visibility_status`='active' and `account_type`!='bank' ")->fetchAll();

                                 if (is_array($all_account)){
                            foreach ($all_account as $acc){?>
                                       <option <?php if ($acc['id']==$receive_money_details['receivable_type'] || $acc['id']==$receive_money_details['payable_type'] ){echo "selected='selected'";}?> value="<?php echo $acc['id']?>"><?php echo $acc['account_name']."-:&nbsp;&nbsp;&nbsp;&nbsp;".$acc['nature'];?></option>
                                          <?php }}?>
                                  </select>
                           </div>
                        </div>

                               <div class="form-group">
                           <label class="control-label col-md-3">Payment method</label>
                           <div class="col-md-9">
                              <select class="form-control" name="payment_method">
                                 <option><?php echo $receive_money_details['payment_method'];?></option>


                              </select>
                           </div>
                        </div>
                         <div class="form-group">
                           <label class="control-label col-md-3">Reference</label>
                           <div class="col-md-9">
                              <input class="form-control" placeholder="" type="text" name="reference" value="<?php echo $receive_money_details['reference'];?>">
                           </div>
                        </div>
                          <div class="form-group">
                           <label class="control-label col-md-3">Details</label>
                           <div class="col-md-9">
                              <input class="form-control" placeholder="" type="text" name="details" value="<?php echo $receive_money_details['details'];?>">
                           </div>
                        </div>

                        <br>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label col-md-3">Bank account<font color="red">*</font></label>
                           <div class="col-md-9">
                              <select class="form-control" name="bank_account" required>
                              	<?php $bank_account=$db->get_all('accounts',array('account_type'=>'bank', 'visibility_status'=>'active'));
									if (is_array($bank_account)){
										foreach ($bank_account as $account){ ?>
											<option <?php if($account['id']==$receive_money_details['bank_account']){echo "selected='selected'";}?> value="<?php echo $account['id'];?>"><?php echo $account['account_name'];?></option>
								<?php 	}
									}?>
                              </select>
                           </div>
                        </div>

                        <br>

                        <div class="form-group">
                           <label class="control-label col-md-3">Amount</label>

                         <div class="col-md-9">
                              <input class="form-control" placeholder="$0" type="text" name="remaining_amount" id="amount" value="<?php echo $receive_money_details['transaction_amount'];?>" readonly>
                           </div>

                        </div>
                           <div class="form-group">
                           <label class="control-label col-md-3"></label>
                           <div class="col-md-9">

                           </div>
                        </div>
                         <div class="form-group">
                                        <label class="control-label col-md-3">Allocation notes</label>
                                        <div class="col-md-9">
                                          <textarea class="form-control" rows="5"  name="allocation_notes"><?php echo $receive_money_details['allocation_notes'];?></textarea>
                                        </div>
                                      </div>
                        <br>

                     </div>

               </div>

                      <br>
                       <div class="row">
             <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">

                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Allocate</span></a>
                      </li>
                    <!--   <li>
                        <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>New</span></a>
                      </li> -->
                     </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                    <br>
                       <h5><strong>ALLOCATE THIS MONEY TO AN EXISTING TRANSACTION</strong></h5>
             <div class="row">
   <table class="table table-bordered table-striped" id="dataTable112">
					                  <thead>
					                  <tr row="">

					                    <th>Date</th>
					                    <th>Id</th>
					                    <th>Type</th>
					                    <th>Total amount</th>
					                    <th>Balance remaining</th>
                                        <th>How much to allocate</th>
					                    </tr></thead>
					                  <tbody>


					                    <tr>

					                      <td><?php echo $date;?></td>
					                      <td><?php echo $number;?></td>
					                      <td><?php echo $type;?></td>
					                      <td><?php echo $receive_money_details['transaction_amount'];?></td>
					                      <td><?php echo $receive_money_details['transaction_amount'];?></td>
                                          <td><?php echo $receive_money_details['transaction_amount'];?></td>

					                    </tr>


					                  </tbody>
					                </table></div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            </div>
                </div>
</div>

                                    </form>
                                    <?php }else{?><h3>General Journal</h3>
                                     <div class="invoice" id="div_print">
          <div class="row">
            <div class="col-lg-12">
              <div class="row invoice-header">
                <div class="col-md-6">
                  <!-- <img width="183" src="images/sn-logo%402x.png" /> -->
                </div>
                <div class="col-md-6 text-right">
                  <h2>
                    <?php echo "#".$journal_deatil['journal_no'];?>
                  </h2>
                 <p>
                  Journal Date:
                  <?php echo $journal_deatil['journal_date'];?>
                  </p>
                   <p>
                   journal Type :
                    <?php

                      echo $journal_deatil['journal_type'];

                   ?>
                  </p>
                     <p>
                   Reference code :
                    <?php
                   if($journal_deatil['reference_code']==""){
                       echo "N/A";
                   }
                   else
                   {
                      echo $journal_deatil['reference_code'];
                   }
                   ?>

                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                  <table class="table table-striped invoice-table">
                    <thead>
                    <tr>

                      <th>Account</th>
                      <th>Type</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Tax code</th>
                     <th>Tax</th>

                     <th>Contact</th>

                     <th>Project</th>
                     <tr>
                    </thead>
                    <tbody>

                    <?php
                    $account=unserialize($journal_deatil['account']);
                    $type=unserialize($journal_deatil['type']);
                    $debit=unserialize($journal_deatil['debit']);
                    $credit=unserialize($journal_deatil['credit']);
                    $item_taxcode=unserialize($journal_deatil['tax_code']);

                    $item_tax=unserialize($journal_deatil['tax']);
                    $narration=unserialize($_POST['narration']);
                    $contact=unserialize($journal_deatil['contact']);
                    $trans_type=unserialize($journal_deatil['trans_type']);

                    $project=unserialize($journal_deatil['project']);


                    $a=1;
                    if (is_array($account)){
                     foreach ($account as $key=>$value)
                     {

                         $account1=$account[$key];
                         $account_name=$db->get_var('accounts',array('id'=>$account1),'account_name');
                         $type1=$type[$key];
                         $debit1=$debit[$key];
                         $credit1=$credit[$key];
                         $item_taxcode1=$item_taxcode[$key];
                         $tax_name=$db->get_var('tax',array('id'=>$item_taxcode1),'tax_name');
                         $item_tax1=$item_tax[$key];
                         $narration1=$narration[$key];
                         $contact1=$contact[$key];
                         $contact_name=$db->get_var('contacts',array('id'=>$contact1),'display_name');
                         $trans_type1=$trans_type[$key];
                         $project1=$project[$key];
                         $project_name1=$db->get_var('projects',array('id'=>$project1),'project_name');


                        ?>
                    <tr>
                   <td><?php echo $account_name;?></td>
                    <td><?php echo $type1;?></td>
                    <td><?php echo $debit1;?></td>
                    <td><?php echo $credit1;?></td>
                    <td><?php echo $tax_name;?></td>
                    <td><?php echo $item_tax1;?></td>

                    <td><?php echo $contact_name;?></td>

                    <td><?php echo $project_name1;?></td>

                    </tr>
                      <?php  $a++;} }?>
                    </tbody>
                     <tfoot>

                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>Summary</strong>
                <p>
                 <?php echo $journal_deatil['summary'];?>
                </p>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-12">
              <div class="well">
                <strong>Description:</strong>
                <p>
                 <?php echo $journal_deatil['description'];?>
                </p>
              </div>
            </div>
          </div>


        </div>





                                    <?php }?>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default-outline" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
<?php }

?>
