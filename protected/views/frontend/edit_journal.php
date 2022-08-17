<?php
	$journal_id=$_REQUEST['action_edit'];
	if (isset($_REQUEST['action_edit']) && $_REQUEST['action_edit']!=''){
		$get_row_data = $db->get_row('journal',array('id'=>$journal_id));
	}else {
		//$session->redirect('journal',user);
	}
	$get_row_data = $db->get_row('journal',array('id'=>$journal_id));
	$uns_account=unserialize($get_row_data['account']);
	$total_account=count($uns_account);
	$uns_type=unserialize($get_row_data['type']);
	$uns_debit=unserialize($get_row_data['debit']);
	$uns_credit=unserialize($get_row_data['credit']);
	$uns_tax_code=unserialize($get_row_data['tax_code']);
	$uns_tax=unserialize($get_row_data['tax']);
	$uns_narration=unserialize($get_row_data['narration']);
	$uns_contact=unserialize($get_row_data['contact']);
	$uns_trans_type=unserialize($get_row_data['trans_type']);
	$uns_project=unserialize($get_row_data['project']);

	$all_account=$db->get_all('accounts',array('visibility_status'=>'active'));
	$all_tax=$db->get_all('tax',array('visibility_status'=>'active'));
	$all_contact=$db->get_all('contacts',array('visibility_status'=>'active'));
	$all_project=$db->get_all('projects',array('visibility_status'=>'active'));


if (isset($_POST['submit'])){
   // print_r($_POST);
	if ($_POST['cr']!=$_POST['dr'])
	{
	    $diffrence=$_POST['cr']-$_POST['dr'];
	    $display_msg= '<div class="alert alert-danger"><i class="lnr lnr-smile"></i>
        				<button class="close" data-dismiss="alert" type="button">×</button>
        				The journal does not balance. (SGD '.$_POST['dr'].' DR vs SGD '.$_POST['cr'].' CR = difference of SGD '.$diffrence.'DR). </div>';
	}
	else{
		$journal_date=$_POST['journal_date'];
		$journal_summery=$_POST['journal_summery'];
		$amounts=$_POST['amounts'];
		$description=$_POST['description'];

		$account=serialize($_POST['account']);
		$type=serialize($_POST['type']);
		$debit=serialize($_POST['debit']);
		$credit=serialize($_POST['credit']);
		$tax_code=serialize($_POST['tax_code']);
		$tax=serialize($_POST['tax']);
		$narration=serialize($_POST['narration']);
		$contact=serialize($_POST['contact']);
		$trans_type=serialize($_POST['trans_type']);
		$project=serialize($_POST['project']);

		$create_date=date('Y-m-d');
		$ip_address=$_SERVER['REMOTE_ADDR'];

		$empt_fields = $fv->emptyfields(array('Journal Date'=>$journal_date,
		    'Summary'=>$journal_summery,
		));

		if ($empt_fields)
		{
		    $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
		}
		else{
		$update=$db->update('journal',array('journal_date'=>$journal_date,
		                                    'journal_type'=>'journal',
                                		   /* 'amounts'=>$amounts,*/
		                                    //'journal_no'=>$journal_number,
                                		    'summary'=>$journal_summery,
                                		    'description'=>$description,
                                		    'account'=>$account,
                                		    'type'=>$type,
                                		    'debit'=>$debit,
                                		    'credit'=>$credit,
                                		    'tax_code'=>$tax_code,
                                		    'tax'=>$tax,
                                		    'narration'=>$narration,
                                		    'contact'=>$contact,
                                		    'trans_type'=>$trans_type,
                                		    'project'=>$project,
                                		    'visibility_status'=>'active',
                                		    'create_date'=>$create_date,
                                		    'ip_address'=>$ip_address,
											'ladger_generate'=>$journal_id,
											'generated_from'=>'journal',
											'gst_registered'=>'yes',
		 ),array('id'=>$journal_id));
		//$db->debug();
		//$last_id=$db->lastInsertId();
       // $db->update('daytoday_report_settings',array('journal_start_from'=>$jsf),array('id'=>1));

		if ($insert){
		    $event="Update journal  (" . $journal_number . ")";
		    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
		        'event'=>$event,
		        'created_date'=>date('Y-m-d'),
		        'ip_address'=>$_SERVER['REMOTE_ADDR']

		    ));
			$display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
        				<button class="close" data-dismiss="alert" type="button">×</button>
        				Save successfully. </div>';
           echo "<script>
                          setTimeout(function(){
        	    		  window.location = '".$link->link("journal",user)."'
        	                },3000);</script>";
		}

	}
	}

}
?>

<div class="row">
   <div class="col-lg-12">
      <div class=" padded" >
         <h3>JOURNALS</h3>
      </div>
      <?php echo $display_msg;?>
      <div class="widget-container fluid-height">
         <div class="widget-content padded">
            <form action="" class="form-horizontal" method="post">
                  <div class="row">
                  <?php  $tab_name=$_REQUEST['advisor_type'];?>
               <div class="col-lg-12">
               <h3>Journal entry
                  <a href="<?php echo $link->link('journal',user);?>" class="btn btn-default pull-right">Back to List</a>
                  <a href="<?php echo $link->link('edit_journal',user);?>" class="btn btn-default pull-right">Cancel</a>
                   <button class="btn btn-primary pull-right" type="submit" name="submit">Save</button>

                  </h3>
               <div class="widget-content padded">
                 <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3"></label>
                              </div>
                              <br>
                              <div class="form-group">
                                 <label class="control-label col-md-3">Journal Date<font color="red">*</font></label>
                                 <div class="col-md-7">
                                    <div class="input-group date datepicker col-md-12" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                                       <input class="form-control" type="text" name="journal_date" value="<?php echo $get_row_data['journal_date']; ?>"><span class="input-group-addon"><i class="lnr lnr-calendar-full "></i></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="control-label col-md-3">Summary<font color="red">*</font></label>
                                 <div class="col-md-7">
                                    <input class="form-control" placeholder="" type="text" name="journal_summery" value="<?php echo $get_row_data['summary'];?>">
                                 </div>
                              </div>
                              <br>
                           </div>
                           <div class="col-md-6">
                             <div class="form-group">
                                    <label class="control-label col-md-3">Journal number</label>
                                    <div class="col-md-7">
                                   <label class="control-label col-md-3"><?php echo $get_row_data['journal_no']; ?></label>
                                    </div>
                                 </div>
                              <div class="form-group">
                                 <label class="control-label col-md-3">Adjusting journal</label>
                                 <div class="col-md-7">
                                    <label class="checkbox-inline">
                                    <input type="checkbox" name="journal_adjust">
                                    </label>
                                 </div>
                                 <i class="fa fa-fw fa-question-circle"></i>
                              </div>
                            <!--   <div class="form-group">
                                 <label class="control-label col-md-3">Amounts<font color="red">*</font></label>
                                 <div class="col-md-7">
                                    <select class="form-control" name="amounts" required>
                                       <option value="">Non-Taxed</option>
                                       <option value="">Net (Tax Exclusive)</option>
                                       <option value="">Gross (Tax Inclusive)</option>
                                    </select>
                                 </div>
                              </div> -->
                              <div class="form-group">
                                 <label class="control-label col-md-3">Description</label>
                                 <div class="col-md-7">
                                    <textarea class="form-control" rows="5" name="description" ><?php echo $get_row_data['description'];?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <br>


                        <div class="row">
							<div class="row tabs">
							    <div class="col-md-1">Account<font color="red">*</font></div>
							    <div class="col-md-1">Type<font color="red">*</font></div>
							    <div class="col-md-1">Debit</div>
							    <div class="col-md-1">Credit</div>
							    <div class="col-md-1">Tax code</div>
							    <div class="col-md-1">Tax</div>
							    <div class="col-md-1">Narration</div>
							    <div class="col-md-1">Contact<font color="red">*</font></div>
							    <div class="col-md-1">Trans Type</div>
							    <div class="col-md-2">Project</div>
							    <div class="col-md-1"></div>
						    </div><br>

							<div class="input_fields_wrap_selling_can">
					  			<div class="row">


					  			<?php if (is_array($uns_account)){
					  				foreach ($uns_account as $key => $jr_account){ ?>
								    <div class="col-md-1">
								    	<select class="form-control" name="account[]" id="account<?php echo $key;?>" required>
								    		<option value="">select</option>
								    		<?php
								    			if (is_array($all_account)){
								    				foreach ($all_account as $accounts){ ?>
								    					<option value="<?php echo $accounts['id'];?>" <?php if ($accounts['id']==$uns_account[$key]){echo 'selected';}?>><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option>
								    		<?php }} ?>
								    	</select>
								    </div>
								    <div class="col-md-1">
								    	<select class="form-control" name="type[]" id="type<?php echo $key;?>" required>
								    		<option value=""></option>
								    		<option value="debit" <?php if ($uns_type[$key]=='debit'){echo 'selected';}?>>Debit</option>
								    		<option value="credit"  <?php if ($uns_type[$key]=='credit'){echo 'selected';}?>>Credit</option>
								    	</select>
								    </div>
								    <div class="col-md-1"><input class="form-control" type="text" name="debit[]" value="<?php echo $uns_debit[$key];?>" id="debit<?php echo $key;?>" readonly></div>
								    <div class="col-md-1"><input class="form-control" type="text" name="credit[]" value="<?php echo $uns_credit[$key];?>" id="credit<?php echo $key;?>" readonly></div>
								    <div class="col-md-1">
								    	<select class="form-control aa" name="tax_code[]" id="tax_code<?php echo $key;?>">
											<option value=""></option>
											<?php if (is_array($all_tax)){
												foreach ($all_tax as $taxs){?>
													<option value="<?php echo $taxs['id'];?>" <?php if ($taxs['id']==$uns_tax_code[$key]){echo 'selected';}?> ><?php echo $taxs['tax_name'];?></option>
											<?php }
											}?>
								    	</select><input class="form-control" type="hidden" name="tax_code1[]" id="tax_code1" >
								    </div>
								    <div class="col-md-1"><input class="form-control" type="text" name="tax[]" id="tax1" value="<?php echo $uns_tax[$key];?>"></div>
								    <div class="col-md-1"><input class="form-control" type="text" name="narration[]" value="<?php echo $uns_narration[$key];?>"></div>
								    <div class="col-md-1">
								    	<select class="form-control" name="contact[]" id="contact<?php echo $key;?>" required>
											<option value=""></option>
											<?php if (is_array($all_contact)){
												foreach ($all_contact as $contacts){?>
													<option value="<?php echo $contacts['id']?>" <?php if ($contacts['id']==$uns_contact[$key]){echo 'selected';}?>><?php echo $contacts['display_name']?></option>
												<?php }
											}?>
								    	</select>
								    </div>
								    <div class="col-md-1">
								    	<select class="form-control" name="trans_type[]" id="trans_type<?php echo $key;?>">
                                            <option value="sale" <?php if ($uns_trans_type[$key]=='sale'){echo 'selectd';}?>>Sale</option>
								    		<option value="purchase" <?php if ($uns_trans_type[$key]=='purchase'){echo 'selectd';}?>>Purchase</option>
								    	</select>
								    </div>
								    <div class="col-md-2">
								    	<select class="form-control" name="project[]" required>
								    		<option value=""></option>
								    		<?php if(is_array($all_project)){
								    			foreach ($all_project as $project){ ?>
													<option value="<?php echo $project['id'];?>" <?php if ($project['id']==$uns_project[$key]){echo 'selectd';}?>><?php echo $project['project_name'];?></option>
								    		<?php }
								    		}?>
								    	</select>
								    </div>
								    <div class="col-md-1"></div><br><br>
								     <?php }
					  			}?>
					    		</div>



							<br>
						</div>
						<div class="tabs" style="height:30px;">
							<div class="col-md-2"></div>
							<div class="col-md-1"><div id="dr"><?php echo CURRENCY;?> &nbsp; <?php echo array_sum($uns_debit);?> </div><input type="hidden" name="dr" id="dr_hidden"></div>
							<div class="col-md-1"><div id="cr"><?php echo CURRENCY;?> &nbsp; <?php echo array_sum($uns_credit);?> </div><input type="hidden" name="cr" id="cr_hidden"></div>
						</div>
						<button class="btn btn-default add_field_button_selling_can">Add</button>
					</div>



                  </div>
                  </div>
               </div>
               </form>

         </div>
      </div>
   </div>
</div>



<script>

var x = 1; //initlal text box count
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_selling_can"); //Fields wrapper
    var add_button      = $(".add_field_button_selling_can"); //Add button ID

   // var x = 1; //initlal text box count
    var x = <?php echo $total_account-1;?>;
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row">'+
            		'<div class="col-md-1"><select class="form-control" name="account[]" id="account'+x+'" required><option value="">select</option><?php if (is_array($all_account)){ foreach ($all_account as $accounts){ ?><option value="<?php echo $accounts['id'];?>"><?php echo $accounts['account_name'].' - '.$accounts['account_type'];?></option><?php }}?></select></div>'+
           		 '<div class="col-md-1"><select class="form-control" name="type[]" id="type'+x+'" required><option value=""></option><option value="debit">Debit</option><option value="credit">Credit</option></select></div>'+
				    '<div class="col-md-1"><input class="form-control" type="text" name="debit[]" id="debit'+x+'" readonly></div>'+
				    '<div class="col-md-1"><input class="form-control" type="text" name="credit[]"id="credit'+x+'" readonly></div>'+
				    '<div class="col-md-1"><select class="form-control" name="tax_code[]" id="tax_code'+x+'"><option value=""></option><?php if (is_array($all_tax)){foreach ($all_tax as $taxs){?><option value="<?php echo $taxs['id'];?>"><?php echo $taxs['tax_name'];?></option><?php }}?></select><input class="form-control" type="hidden" name="tax_code1[]" id="tax_code1'+x+'"></div>'+
				    '<div class="col-md-1"><input class="form-control" type="text" name="tax[]" id="tax'+x+'"></div>'+
				    '<div class="col-md-1"><input class="form-control" type="text" name="narration[]"></div>'+
				    '<div class="col-md-1"><select class="form-control" name="contact[]" id="contact'+x+'" required><option value=""></option><?php if (is_array($all_contact)){foreach ($all_contact as $contacts){?><option value="<?php echo $contacts['id']?>"><?php echo $contacts['display_name']?></option><?php }}?></select></div>'+
				    '<div class="col-md-1"><select class="form-control" name="trans_type[]" id="trans_type'+x+'"><option value="">select</option><option value="sale">Sale</option><option value="purchase">purchase</option></select></div>'+
				    '<div class="col-md-2"><select class="form-control" name="project[]"><option value=""></option><?php if(is_array($all_project)){ foreach ($all_project as $project){ ?><option value="<?php echo $project['id'];?>"><?php echo $project['project_name'];?></option><?php }}?></select></div>'+
            		'<a  href="#" class="remove_field_selling_can btn btn-default">x</a></div>'); //add input box


            //========== Dynamic Row Script ==========

            //------------- Change Account ----------
            $("#account"+x).change(function(){
            	var account_id=$(this).val();
            	var id=$(this).attr('id');   // get x val from this id

            	var res=id.split("account");
            	var x_val=res[1];
            	$.ajax({
            		  type: "POST",
            		  url: "<?php echo $link->link('ajax',frontend);?>",
            		  data: 'account_id='+account_id,
            		  success: function (data) {
            			  var res=data.split("__");
            			  $("#tax_code"+x_val).val(res[0]);
            			  $("#tax_code1"+x_val).val(res[1]);
            			//------ Blank Previous data -------
            			  $("#debit"+x_val).val('');
            			  $("#credit"+x_val).val('');
            			  $("#tax"+x_val).val('');
            		 }
            	});
            });

            //------------- Change contact ----------
            $("#contact"+x).change(function(){
            	var contact_id=$(this).val();
            	var id=$(this).attr('id');   // get x val from this id
            	var res=id.split("contact");
            	var x_val=res[1];
            	$.ajax({
            		  type: "POST",
            		  url: "<?php echo $link->link('ajax',frontend);?>",
            		  data: 'contact_id='+contact_id,
            		  success: function (data) {
            			  var res=data.split("__");
            			  if(res[0]=='yes'){
            				  $("#trans_type"+x_val).val('sale');
            			  }
            			  if(res[1]=='yes'){
            				  $("#trans_type"+x_val).val('purchase');
            			  }
            		 }
            	});
            });

            //------- Debit value change -----------
            $("#debit"+x).keyup(function(){
            	var id=$(this).attr('id');   // get x val from this id
            	var res=id.split("debit");
            	var x_val=res[1];

            	$("#credit"+x_val).val(''); //calculate tax
            	var dr=$(this).val();
            	var tx=$('#tax_code1'+x_val).val();
            	var tax=(dr*tx)/100;
            	if(tax=='Infinity'){tax=0;}
            	$('#tax'+x_val).val(tax);

            	var temp=parseFloat(0);      // Calculate all debit
				for(var i=0; i<=x; i++){
					var deb=parseFloat($("#debit"+i).val());
					if(!isNaN(deb) && deb!='NaN'){
						var taxx=parseFloat($("#tax"+i).val());
						if(isNaN(taxx)){taxx=0;}
						temp=temp + deb + taxx;
					}
				}
				$("#dr").html('SGD '+temp);
				$("#dr_hidden").val(temp);

				var temp1=parseFloat(0);    // Calculate credit boxex
				for(var i=0; i<=x; i++){
					var crd=parseFloat($("#credit"+i).val());
					if(!isNaN(crd) && crd!='NaN'){
						var taxx1=parseFloat($("#tax"+i).val());
						if(isNaN(taxx1)){taxx1=0;}
						temp1=temp1 + crd + taxx1;
					}
				}
				$("#cr").html('SGD '+temp1);
				$("#cr_hidden").val(temp1);

            });

            //------- Credit value change -----------
            $("#credit"+x).keyup(function(){
            	var id=$(this).attr('id');   // get x val from this id
            	var res=id.split("credit");
            	var x_val=res[1];

            	$("#debit"+x_val).val('');
            	var cr=$(this).val();
            	var tx=$('#tax_code1'+x_val).val();
            	var tax=(cr*tx)/100;
            	if(tax=='Infinity'){tax=0;}
            	$('#tax'+x_val).val(tax);

            	var temp=parseFloat(0);    // Calculate credit boxex
				for(var i=0; i<=x; i++){
					var crd=parseFloat($("#credit"+i).val());
					if(!isNaN(crd) && crd!='NaN'){
						var taxx=parseFloat($("#tax"+i).val());
						if(isNaN(taxx)){taxx=0;}
						temp=temp + crd + taxx;
					}
				}
				$("#cr").html('SGD '+temp);
				$("#cr_hidden").val(temp);

				var temp1=parseFloat(0);      // Calculate all debit
				for(var i=0; i<=x; i++){
					var deb=parseFloat($("#debit"+i).val());
					if(!isNaN(deb) && deb!='NaN'){
						var taxx1=parseFloat($("#tax"+i).val());
						if(isNaN(taxx1)){taxx1=0;}
						temp1=temp1 + deb + taxx1;
					}
				}
				$("#dr").html('SGD '+temp1);
				$("#dr_hidden").val(temp1);
            });

            //------- Taxcode value change -----------
            $("#tax_code"+x).change(function(){
            	var tax_code_id=$(this).val();
            	var id=$(this).attr('id');   // get x val from this id
            	var res=id.split("tax_code");
            	var x_val=res[1];

            	$.ajax({
            		  type: "POST",
            		  url: "<?php echo $link->link('ajax',frontend);?>",
            		  data: 'tax_code_id='+tax_code_id,
            		  success: function (data) {
            			var tx=$('#tax_code1'+x_val).val(data);
            			var dr=parseInt($("#debit"+x_val).val());
            			var cr=parseInt($("#credit"+x_val).val());
            			if(isNaN(dr)){dr=0;}
            			if(isNaN(cr)){cr=0;}
            			var total=dr + cr;
            			var tax=(total * data)/100;
            			$('#tax'+x_val).val(tax);

            			var temp=parseFloat(0);  // Calculate Credid boxex
            			for(var i=0; i<=x; i++){
            				var crd=parseFloat($("#credit"+i).val());
            				if(!isNaN(crd) && crd!='NaN'){
            					var taxx=parseFloat($("#tax"+i).val());
            					if(isNaN(taxx)){taxx=0;}
            					temp=temp + crd + taxx;
            				}
            			}
            			$("#cr").html('SGD '+temp);
            			$("#cr_hidden").val(temp);

            			var temp1=parseFloat(0);   // Calculate debit boxex
            			for(var i=0; i<=x; i++){
            				var deb=parseFloat($("#debit"+i).val());
            				if(!isNaN(deb) && deb!='NaN'){
            					var taxx1=parseFloat($("#tax"+i).val());
            					if(isNaN(taxx1)){taxx1=0;}
            					temp1=temp1 + deb + taxx1;
            				}
            			}
            			$("#dr").html('SGD '+temp1);
            			$("#dr_hidden").val(temp1);
            		 }
            	});
            });


            //----------- Script for change type enable/ disable debit/credit --------
            $("#type"+x).change(function(){
                var id=$(this).attr('id');
            	var res=id.split("type");
				//alert(res[1]);

            	var type=$(this).val();
            	if(type == 'debit'){
            		$("#debit"+res[1]).removeAttr('readonly');
            		$("#credit"+res[1]).attr('readonly','false');
            		$("#debit"+res[1]).attr('required','false');
            	}
            	if(type == 'credit'){
            		$("#credit"+res[1]).removeAttr('readonly');
            		$("#credit"+res[1]).attr('required','false');
            		$("#debit"+res[1]).attr('readonly','false');
            	}
            });

            //========= Close Dynamic Row Script =========


         }
    });

    $(wrapper).on("click",".remove_field_selling_can", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

//========== Advisor Jurnal First Row Script ==========

//------------- Change Account ----------
$("#account").change(function(){
	var account_id=$(this).val();
	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'account_id='+account_id,
		  success: function (data) {
			  var res=data.split("__");
			  $("#tax_code").val(res[0]);
			  $("#tax_code1").val(res[1]);
			//------ Blank Orevious data -------
			  $("#debit1").val('');
			  $("#credit1").val('');
			  $("#tax1").val('');
		 }
	});
});

//------------- Change contact ----------
$("#contact").change(function(){
	var contact_id=$(this).val();
	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'contact_id='+contact_id,
		  success: function (data) {
			  var res=data.split("__");
			  if(res[0]=='yes'){
				  $("#trans_type").val('sale');
			  }
			  if(res[1]=='yes'){
				  $("#trans_type").val('purchase');
			  }
		 }
	});
});

//------- Debit value change -----------
$("#debit1").keyup(function(){
	$("#credit1").val('');
	var dr=$(this).val();
	var tx=$('#tax_code1').val();
	var tax=(dr*tx)/100;
	if(tax=='Infinity'){tax=0;}
	$('#tax1').val(tax);

	var temp=parseFloat(0);   // Calculate debit boxex
	for(var i=0; i<=x; i++){
		var deb=parseFloat($("#debit"+i).val());
		if(!isNaN(deb) && deb!='NaN'){
			var taxx=parseFloat($("#tax"+i).val());
			if(isNaN(taxx)){taxx=0;}
			temp=temp + deb + taxx;
		}
	}
	$("#dr").html('SGD '+temp);
	$("#dr_hidden").val(temp);

	var temp1=parseFloat(0);   // Calculate credit boxex
	for(var i=0; i<=x; i++){
		var crd=parseFloat($("#credit"+i).val());
		if(!isNaN(crd) && crd!='NaN'){
			var taxx1=parseFloat($("#tax"+i).val());
			if(isNaN(taxx1)){taxx1=0;}
			temp1=temp1 + crd + taxx1;
		}
	}
	$("#cr").html('SGD '+temp1);
	$("#cr_hidden").val(temp1);

});

//------- Credit value change -----------
$("#credit1").keyup(function(){
	$("#debit1").val('');
	var cr=$(this).val();
	var tx=$('#tax_code1').val();
	var tax=(cr*tx)/100;
	if(tax=='Infinity'){tax=0;}
	$('#tax1').val(tax);

	var temp=parseFloat(0);  // Calculate Credid boxex
	for(var i=0; i<=x; i++){
		var crd=parseFloat($("#credit"+i).val());
		if(!isNaN(crd) && crd!='NaN'){
			var taxx=parseFloat($("#tax"+i).val());
			if(isNaN(taxx)){taxx=0;}
			temp=temp + crd + taxx;
		}
	}
	$("#cr").html('SGD '+temp);
	$("#cr_hidden").val(temp);

	var temp1=parseFloat(0);   // Calculate debit boxex
	for(var i=0; i<=x; i++){
		var deb=parseFloat($("#debit"+i).val());
		if(!isNaN(deb) && deb!='NaN'){
			var taxx1=parseFloat($("#tax"+i).val());
			if(isNaN(taxx1)){taxx1=0;}
			temp1=temp1 + deb + taxx1;
		}
	}
	$("#dr").html('SGD '+temp1);
	$("#dr_hidden").val(temp1);
});

//------- Taxcode value change -----------
$("#tax_code").change(function(){
	var tax_code_id=$(this).val();
	$.ajax({
		  type: "POST",
		  url: "<?php echo $link->link('ajax',frontend);?>",
		  data: 'tax_code_id='+tax_code_id,
		  success: function (data) {
			var tx=$('#tax_code1').val(data);
			var dr=parseInt($("#debit1").val());
			var cr=parseInt($("#credit1").val());
			if(isNaN(dr)){dr=0;}
			if(isNaN(cr)){cr=0;}
			var total=dr + cr;
			var tax=(total * data)/100;
			$('#tax1').val(tax);

			var temp=parseFloat(0);  // Calculate Credid boxex
			for(var i=0; i<=x; i++){
				var crd=parseFloat($("#credit"+i).val());
				if(!isNaN(crd) && crd!='NaN'){
					var taxx=parseFloat($("#tax"+i).val());
					if(isNaN(taxx)){taxx=0;}
					temp=temp + crd + taxx;
				}
			}
			$("#cr").html('SGD '+temp);
			$("#cr_hidden").val(temp);

			var temp1=parseFloat(0);   // Calculate debit boxex
			for(var i=0; i<=x; i++){
				var deb=parseFloat($("#debit"+i).val());
				if(!isNaN(deb) && deb!='NaN'){
					var taxx1=parseFloat($("#tax"+i).val());
					if(isNaN(taxx1)){taxx1=0;}
					temp1=temp1 + deb + taxx1;
				}
			}
			$("#dr").html('SGD '+temp1);
			$("#dr_hidden").val(temp1);
		 }
	});
});

//----------- Script for change type enable/ disable debit/credit --------
$("#type1").change(function(){

	var type=$(this).val();
	if(type == 'debit'){
		$("#debit1").removeAttr('readonly');
		$("#credit1").attr('readonly','false');
		$("#debit1").attr('required','false');
	}
	if(type == 'credit'){
		$("#credit1").removeAttr('readonly');
		$("#credit1").attr('required','false');
		$("#debit1").attr('readonly','false');
	}
});

//========= Close Advisor Jurnal First Row Script =========

</script>
