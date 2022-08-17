
 <?php
  if (file_exists(SERVER_ROOT . '/protected/views/frontend/modal_box.php')) {

    require SERVER_ROOT . '/protected/views/frontend/modal_box.php';
}
 ?>


</body></html>

  <!-- used for show calendar -->
   <script src="<?php echo SITE_URL.'/assets/frontend/js/bootstrap.min.js';?>" type="text/javascript"></script>
  <script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.bootstrap.wizard.js';?>" type="text/javascript"></script>
 <!-- ****************************** -->

   <script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.dataTables.min.js';?>" type="text/javascript"></script>
  <script src="<?php echo SITE_URL.'/assets/frontend/js/datatable-editable.js';?>" type="text/javascript"></script>
  <!-- used for calendar -->
 <script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.easy-pie-chart.js';?>" type="text/javascript"></script>
 <!-- ******************************* -->

  <script src="<?php echo SITE_URL.'/assets/frontend/js/bootstrap-fileupload.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/bootstrap-datepicker.js';?>" type="text/javascript"></script>

  <script src="<?php echo SITE_URL.'/assets/frontend/js/bootstrap-timepicker.js';?>" type="text/javascript"></script>
   <script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.fancybox.pack.js';?>" type="text/javascript"></script>
<script>
/*  for mobile navigation
     $('.navbar-toggle').click(function() {
         return $('body, html').toggleClass("nav-open");
       });
*/
</script>

<!-- --- Date Pick --- -->
<script src="<?php echo SITE_URL.'/assets/frontend/js/main.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.sparkline.min.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.inputmask.min.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.validate.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/jquery.isotope.min.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/isotope_extras.js';?>" type="text/javascript"></script>
 <script src="<?php echo SITE_URL.'/assets/frontend/js/select2.js';?>" type="text/javascript"></script>
 <script src="<?php echo SITE_URL.'/assets/frontend/js/fullcalendar.min.js';?>" type="text/javascript"></script>

<!-- --------Time Picker----- -->
<script src="<?php echo SITE_URL.'/assets/frontend/js/daterange-picker.js';?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/date.js';?>" type="text/javascript"></script>

<!-- --------Mask ----- -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js" type="text/javascript"></script>

	<!-- --- Script for Loader --- -->
	<script>
		$(window).load(function() {
			$(".se-pre-con").fadeOut("slow");
		});
	</script>
	<!-- --- close Script for Loader --- -->

<!-- mobile screen k liye  -->

<?php if ($query1ans=="add_contact"){?>
<script type="text/javascript">


//$("#supplier_fields").click(function(){
//	$("#verifie_id, #strp_id").toggle();
//    });

    $("#individual_id").click(function(){
    	$("#super_fund_id").removeAttr("checked");
    	$("#label_super_fund_id").hide();
        $("#first_name_id, #last_name_id").show();
        $("#business_name_id, #branch_id").hide();
        });
    $("#business_id").click(function(){
    	$("#label_super_fund_id").show();
        $("#first_name_id, #last_name_id").hide();
        $("#business_name_id, #branch_id").show();
        });
</script>
<?php }?>


 <?php if ($query1ans=="add_buying_mk"){?>
<script>
$(".transaction_yesCheck").click(function(){
    $(".transaction_ifyes_div").toggle();
    });


</script>
<?php }?>




<script>
//---------- Checksheet (Job Type Details) ----------
//$("#add_contact_form_submit_id").click(function(){
//	alert("dfdfdsf");
//$("#add_contact_form").submit();

//});

</script>


<script>
$("#add_payment_form_submit").click(function(){
	$.ajax({
	      type: 'POST',
	      url: "<?php echo $link->link('ajax',userend);?>",
	      data: $("add_payment_form_submit").serialize(),
	      success: function(data)
	       { $("#after_post_message").html(data);
	       setTimeout(function(){
	    		  window.location = '<?php echo $link->link("sale_purchase_prefrence",user);?>';
	                },3000);}
	});

});
</script>
<script>
$("#tax_type_id").change(function(){
	var tax_type=$(this).val();
	//var tax_id=$("#tax_id").val();
	location.href=window.location.pathname+'?user=add_tax&tax_type='+tax_type;
});


</script>
<script>
<?php  $tax_id=$_REQUEST['tax_id'];?>

$("#tax_type_edit_id").change(function(){
	var tax_type_id=$(this).val();
  var tax_id='<?php echo $tax_id;?>';
	//alert("sssssssssssssssssssssssssss");
	location.href=window.location.pathname+'?user=edit_tax&tax_id='+tax_id+'&tax_type='+tax_type_id;
});
</script>


<script>
function goBack() {
    window.history.back();
}
</script>
<script>
$('#select_all').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});
</script>
<script type="text/javascript">
      
    $("#yesCheck").click(function(){
  
      $("#ifYes").toggle();
      });
    
    $('input[name="postal_address_postcode"]').keyup(function(){

      var url = "<?php echo $link->link('ajax',frontend);?>";
      var data = {get_base_on_zip : 'city_state',zip: $(this).val()}

          $.ajax({
                url:url,
                data:data,
                type:'POST', 
                dataType:'json',               
                success:function(response){                    
                  console.log(response);
                    city = response.city;
                    state = response.state;
                    country = response.country;
                    $('input[name="postal_address_town"]').val(city);
                    $('input[name="postal_address_state"]').val(state);          
                    //$('#country').val(country);          
          }});
    });

    $('input[name="physical_address_postcode"]').keyup(function(){

      var url = "<?php echo $link->link('ajax',frontend);?>";
      var data = {get_base_on_zip : 'city_state',zip: $(this).val()}

          $.ajax({
                url:url,
                data:data,
                type:'POST', 
                dataType:'json',               
                success:function(response){                    
                  console.log(response);
                    city = response.city;
                    state = response.state;
                    country = response.country;
                    $('input[name="physical_address_town"]').val(city);
                    $('input[name="physical_address_state"]').val(state);          
                    //$('#country').val(country);          
          }});
    });
    
  
  </script>
<script type="text/javascript">  
        $('input[name="phone_number"]').mask('999-999-9999');
        $('input[name="mobile_number"]').mask('999-999-9999');
        $('input[name="telephone1"]').mask('999-999-9999');
        $('input[name="telephone2"]').mask('999-999-9999');
        $('input[name="phone1"]').mask('999-999-9999');
        $('input[name="phone2"]').mask('999-999-9999');
  
</script>