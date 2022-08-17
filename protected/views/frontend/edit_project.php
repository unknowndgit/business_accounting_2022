<?php
if (isset($_REQUEST['action_edit'])){
	$project_id=$_REQUEST['action_edit'];
	$project_row=$db->get_row('projects',array('id'=>$project_id));

	$project_customer=$db->get_all('assign_customer_project',array('project_id'=>$project_id));
	$all_customer=$db->get_all('contacts',array('visibility_status'=>'active','is_customer'=>'yes'));

	$project_supplier=$db->get_all('assign_supplier_project',array('project_id'=>$project_id));
	$all_supplier =$db->get_all('contacts',array('visibility_status'=>'active','is_supplier'=>'yes'));
}


if (isset($_POST['add_project_submit']))
{
	//print_r($_POST);

    //$project_name=$_POST['project_name'];
    $start_date=$_POST['start_date'];
    $visibility_status=$_POST['visibility_status'];
    $end_date=$_POST['end_date'];
    $description=$_POST['description'];
    $created_date=date('Y-m-d');
    $ip_address=$_SERVER['REMOTE_ADDR'];

    /*if ($fv->emptyfields(array('project_name'=>$project_name),NULL))
    {
        $display_msg= '<div class="alert alert-danger">        		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Project name can not be Blank.
                		</div>';

    }
    else*/if ($start_date > $end_date)
    {
        $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Start date must be less than End date
                		</div>';

    }
    /*elseif ($db->exists('projects',array('project_name'=>$project_name))){
    	$display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Project name must be unique.
                		</div>';
    }*/
  else
    {
        $update=$db->update("projects",array(//'project_name'=>$project_name,
                                        'start_date'=>$start_date,
                                        'visibility_status'=>$visibility_status,
                                        'end_date'=>$end_date,
                                        'project_status'=>'running',
                                        'description'=>$description,
                                        'created_date'=>$created_date,
                                        'ip_address'=>$ip_address),array('id'=>$project_id));

       // $last_id=$db->lastInsertId();
      /*  if(is_array($_POST['items'])){
			foreach ($_POST['items'] as $key=>$value){
				$items=$_POST['items'][$key];
				$item_description=$_POST['item_description'][$key];
				$ir=$_POST['ir'][$key];
				$pr=$_POST['pr'][$key];

				$insert=$db->insert('assign_item_project',array('project_id'=>$last_id, 'item'=>$items, 'description'=>$item_description, 'regular_rate'=>$ir, 'project_rate'=>$pr, 'created_date'=>$created_date, 'ip_address'=>$ip_address ));
			}
        }*/

        $db->delete('assign_customer_project',array('project_id'=>$project_id));
        $db->delete('assign_supplier_project',array('project_id'=>$project_id));

        if(is_array($_POST['customer'])){
        	foreach ($_POST['customer'] as $key=>$value){
        		$customer=$_POST['customer'][$key];
        		$customer_weighting=$_POST['customer_weighting'][$key];
        		$insert=$db->insert('assign_customer_project',array('project_id'=>$project_id, 'customer'=>$customer, 'weighting'=>$customer_weighting, 'created_date'=>$created_date, 'ip_address'=>$ip_address ));
        	}
        }
        if(is_array($_POST['supplier'])){
        	foreach ($_POST['supplier'] as $key=>$value){
        		$supplier=$_POST['supplier'][$key];
        		$supplier_weighting=$_POST['supplier_weighting'][$key];
        		$insert=$db->insert('assign_supplier_project',array('project_id'=>$project_id, 'supplier'=>$supplier, 'weighting'=>$supplier_weighting, 'created_date'=>$created_date, 'ip_address'=>$ip_address ));
        	}
        }

	// $db->debug();
      if ($update){
          $event="Update project  (".$project_name.")";
          $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
              'event'=>$event,
              'created_date'=>date('Y-m-d'),
              'ip_address'=>$_SERVER['REMOTE_ADDR']

          ));
                $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    Project Updated Successfully.
                		</div>';
               echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("project",user)."'
        	                },3000);</script>";
      }
   }
}
?>
<div class="row">
   <div class="col-lg-12">
   <?php echo $display_msg;?>
      <div class=" padded" >
         <h3>PROJECTS</h3>
      </div>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
          <form action="#" class="form-horizontal" method="post">
                 <div class="row">
               <div class="col-lg-12">
               <h3>Add project &nbsp;&nbsp;&nbsp;<span class="label label-info">Status : Active</span>
                 <a href="<?php echo $link->link('project',user);?>" class="btn btn-default pull-right">Back to List</a>

                   <a href="<?php echo $link->link('project',user);?>" class="btn btn-default pull-right">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit" name="add_project_submit"> Update </button>

                  </h3>


                 <div class="widget-content padded">

                        <div class="row">
                          	<div class="col-lg-3">
                          	    <div class="form-group">
                              <label>Project name<font color="red">*</font></label>
                            <input class="form-control" placeholder="" type="text" name="project_name" value="<?php echo $project_row['project_name'];?>" readonly>
                            </div>
							</div>
						    <div class="col-lg-3"></div>
					        <div class="col-lg-3">
					        	<div class="form-group">
                              <label></label>
                             <div class="col-md-12"></div>
                            </div>
                            <br>
                            <br>
					     	<div class="form-group">
                              <label>Start date</label>
                             <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="start_date" value="<?php echo $project_row['start_date'];?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                      </div>
                            </div>
                               </div>
					        	<div class="col-lg-3">
					        <div class="form-group">
                              <label>Status</label>
                             <select class="form-control" name="visibility_status">
                                 <option value="active" <?php if ($project_row['active']=='active'){echo 'selected';}?>>Active</option>
                                 <option value="inactive" <?php if ($project_row['inactive']=='inactive'){echo 'selected';}?>>Inactive</option>
                              </select>
                            </div>

                           <div class="form-group">
                              <label>End date</label>
                             <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       	 <input class="form-control" type="text" name="end_date" value="<?php echo $project_row['end_date'];?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>

                                      </div>
                            </div>
							</div>
                       </div>
                      <!--<h5><strong>SUBPROJECT</strong></h5>  -->
                       <div class="row">
                          	<div class="col-lg-3">
                          	  <!--  <div class="form-group">
                              <label>This is a subproject of</label>
                             <select class="form-control" >
                                 <option value="">Active</option>
                                 <option value="">Inactive</option>
                              </select>
                            </div>-->
							</div>
						    <div class="col-lg-3"></div>
					        <div class="col-lg-6">

					     	<div class="form-group">
                              <label>Description</label>
                            <input class="form-control" placeholder="" type="text" name="description" value="<?php echo $project_row['description'];?>">
                            </div>
                               </div>

                       </div>
                      <div class="row">
             <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">

                    <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Customers</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>Suppliers</span></a>
                      </li>
                      <!-- <li>
                        <a data-toggle="tab" href="#tab3"><i class="fa fa-paper-clip"></i><span>Items</span></a>
                      </li> -->
                    </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active" id="tab1">
                       <p>
                      Assigning customers to a project allows the costs of the project to be shared between them. <br>
You do not have to assign customers to a project.
<br>
<a title="Add New Contact" class="text-danger btn" data-toggle="modal" href="#add_contact_modal"><i class="lnr lnr-plus-circle"></i> Add New Customer</a>
                      </p>
             <div class="row">


			    <div class="row">
    <div class="col-md-4">Customer</div>
    <div class="col-md-4">Weighting</div>
    <div class="col-md-4"></div>
    </div>

	<div class="input_fields_wrap_customer">
	<?php if (is_array($project_customer)){
		$tot_coust=count($project_customer);
		foreach ($project_customer as $pr_customer){?>
		<div class="row">
        <div class="col-md-4">
        	<select class="form-control" name="customer[]">
        		<?php if (is_array($all_customer)){
        			foreach ($all_customer as $cumtomer){?>
        			<option value="<?php echo $cumtomer['id'];?>" <?php if ($pr_customer['customer']==$cumtomer['id']){echo 'selected';}?>><?php echo $cumtomer['business_name'].' '.$cumtomer['display_name'];?></option>
        		<?php }}?>
        	</select>
        </div>
        <div class="col-md-4"><input class="form-control" type="text" name="customer_weighting[]" value="<?php echo $pr_customer['weighting'];?>"></div>
        <a href="#" class="remove_field_customer btn btn-default">x</a></div>
	<?php }
	}?>

	</div>

<button class="btn btn-default add_field_button_customer">Add</button>
</div>
                    </div>
                    <div class="tab-pane" id="tab2">
                    <p>Assigning suppliers to a project allows you to track suppliers in the project.<br>
You do not have to assign suppliers to a project.<br>
<a title="Add New Contact" class="text-danger btn" data-toggle="modal" href="#add_contact_modal"><i class="lnr lnr-plus-circle"></i> Add New Supplier</a>
                      </p>
                                         <div class="row">


			    <div class="row">
    <div class="col-md-4">Supplier</div>
    <div class="col-md-4">Weighting</div>
    <div class="col-md-4"></div>
    </div>

	<div class="input_fields_wrap_supplier">
	<?php if (is_array($project_supplier)){
		$tot_suppl=count($project_supplier);
		foreach ($project_supplier as $pr_supplier){?>
		<div class="row">
        <div class="col-md-4">
        	<select class="form-control"  name="supplier[]">
        		<?php if(is_array($all_supplier)){foreach ($all_supplier as $al_supplier){?>
        			<option value="<?php echo $al_supplier['id'];?>" <?php if ($pr_supplier['supplier']==$al_supplier['id']){echo 'selected';}?>><?php echo $al_supplier['business_name'].' '.$al_supplier['display_name'];?></option>
        		<?php }}?>
        	</select>
        </div>
        <div class="col-md-4"><input class="form-control" type="text" name="supplier_weighting[]" value="<?php echo $pr_supplier['weighting'];?>"></div>
        <a  href="#" class="remove_field_supplier btn btn-default">x</a>
        </div>
        <?php }}?>
	</div>

<button class="btn btn-default add_field_button_supplier">Add</button>
</div>
                    </div>
                    <div class="tab-pane" id="tab3">
                     <p>Assigning items to a project means they will appear at the top of the item list when entering transactions.<br>
It also allows you to customise the sale rate for this particular project.<br>
<a title="Add New Item" class="text-danger btn" data-toggle="modal" href="#add_item_modal"><i class="lnr lnr-plus-circle"></i> Add New Item</a>
                      </p>
                      <div class="row">


			    <div class="row">

    <div class="col-md-2">Item</div>
    <div class="col-md-3">Description</div>
    <div class="col-md-2">Regular rate</div>
    <div class="col-md-2">Project rate</div>
    <div class="col-md-1"></div>
    </div>

    <div class="input_fields_wrap_item">
    </div>

<button class="btn btn-default add_field_button_item">Add</button>
</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
             </div>
           </div>
            </form>
         </div>
      </div>
   </div>
</div>

<?php
/*$query="SELECT* FROM `items` WHERE `visibility_status`='active' AND (`item_to`='buy' OR `item_to`='both')";
$all_item=$db->run($query)->fetchAll();
//$all_item=$db->get_all('items',array('visibility_status'=>'active'));?>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_item"); //Fields wrapper
    var add_button      = $(".add_field_button_item"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

            $(wrapper).append('<div class="row">'+

            	    '<div class="col-md-2"><select id="'+x+'" class="form-control items_select'+x+'" name="items[]"><option value="">Select Item</option><?php if (is_array($all_item)){foreach ($all_item as $itms){?><option  class="item_cost_<?php echo $itms['id'];?>"  id="<?php if(!empty($itms['selling_price'])){echo $itms['selling_price'];}else{echo $itms['buying_price'];};?>" value="<?php echo $itms['id'];?>"><?php echo $itms['item_name'].' - '.$itms['item_type'];?></option><?php }}?></select></div>'+
            	    '<div class="col-md-3"><input class="form-control" type="text" name="item_description[]"></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" id="ir_'+x+'" name="ir[]"></div>'+
            	    '<div class="col-md-2"><input class="form-control" type="text" name="pr[]"></div>'+
            	    '<a  href="#" class="remove_field_item btn btn-default">x</a></div>'); //add input box

            $(".items_select"+x).change(function(){

            	var item_id = $(this).val();
        		var idd=$(this).attr('id');
        		//alert(idd);
        		var prc=$(".item_cost_"+item_id).attr('id');
        		$("#ir_"+idd).val(prc);
        		//alert(prc);

/*        		$res=item_id.split("__");
        		//alert($res);
				var rate=$res[1];
				//alert(rate);
				$("#ir_"+x).val(rate);
				alert(x);
*/

        /*	});
            x++;
    });

    $(wrapper).on("click",".remove_field_item", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();

    })
});

*/
</script>

<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_supplier"); //Fields wrapper
    var add_button      = $(".add_field_button_supplier"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            	    '<div class="col-md-4"><select class="form-control"  name="supplier[]"><?php if(is_array($supl)){foreach ($supl as $suplr){?> <option value="<?php echo $suplr['id'];?>"><?php echo $suplr['business_name'].' '.$suplr['display_name'];?></option>?><?php }}?></select></div>'+
            	    '<div class="col-md-4"><input class="form-control" type="text" name="supplier_weighting[]" value="100"></div>'+
            	    '<a  href="#" class="remove_field_supplier btn btn-default">x</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field_supplier", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_customer"); //Fields wrapper
    var add_button      = $(".add_field_button_customer"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            	    '<div class="col-md-4"><select class="form-control" name="customer[]"><?php if (is_array($all_customer)){ foreach ($all_customer as $cumtomer){?> <option value="<?php echo $cumtomer['id'];?>"><?php echo $cumtomer['business_name'].' '.$cumtomer['display_name'];?></option> <?php }}?></select></div>'+
            	    '<div class="col-md-4"><input class="form-control" type="text" name="customer_weighting[]" value="100"></div>'+
            	    '<a  href="#" class="remove_field_customer btn btn-default">x</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field_customer", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>



<!-- ------------ Send Item Type ----------- -->
<script type="text/javascript">

</script>
