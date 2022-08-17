
<div id="dvFile" >
<button class="btn btn-success" onclick="add_more()">+add more</button><br>
</div>
<script>
							function  add_more() {
								  var txt = "<br><input type=\"radio\" style=\"position:relative\"><br><input id=\"dvFile\" type=\"file\" name=\"propertyimage[]\">";
								  document.getElementById("dvFile").innerHTML += txt;
								}
					</script>



					<html>
<head>
<title>jQuery add / remove textbox example</title>

<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script src="<?php echo SITE_URL.'/assets/frontend/js/jquery-1.9.1.js'?>"></script>

<style type="text/css">
	div{
		padding:8px;
	}
</style>

</head>

<body>

<h1>jQuery add / remove textbox example</h1>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {

	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}

	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);

	newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
	      '<input type="text" name="textbox' + counter +
	      '" id="textbox' + counter + '" value="" >');

	newTextBoxDiv.appendTo("#TextBoxesGroup");


	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }

	counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     $("#getButtonValue").click(function () {

	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
</head><body>

<div id='TextBoxesGroup'>
	<div id="TextBoxDiv1">
		<label>Textbox #1 : </label><input type='textbox' id='textbox1' >
	</div>
</div>
<input type='button' value='Add Button' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
<input type='button' value='Get TextBox Value' id='getButtonValue'>

</body>
</html>
<!-- ------------------------------------------------------------- -->
<div class="input_fields_wrap">

    <div><input type="text" name="mytext[]"></div>

    <br>

</div>

<button class="add_field_button">Add More Fields</button>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/>'+
                              '<a href="#" class="remove_field">x</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


</script>