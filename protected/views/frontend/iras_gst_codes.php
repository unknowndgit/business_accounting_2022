<?php

if (isset($_POST['submit'])){
	
    $code=$_POST['code'];
	$purpose=$_POST['purpose'];
	$description=$_POST['description'];
	$create_date=date('Y-m-d');
	$ip_address=$_SERVER['REMOTE_ADDR'];


	$empt_fields = $fv->emptyfields(array('Code'=>$code,
                                	    'Purpose'=>$purpose,
                                	    'Description'=>$description,
	 ));
	
	if ($empt_fields)
	{
	    $display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">×</button>
          Oops! Following fields are empty<br>'.$empt_fields.'</div>';
	}
	elseif ($db->exists('iras_gst_codes',array('code'=>$code)))
	{
	    $display_msg= '<div class="alert alert-danger">
                		<i class="lnr lnr-sad"></i>
            <button class="close" data-dismiss="alert" type="button">×</button>Code name already exits.
                		</div>';
	
	}
   else{
    $insert=$db->insert('iras_gst_codes',array('code'=>strtoupper($code),
											'purpose'=>$purpose,
											'description'=>$description,
											'create_date'=>$create_date,
											'ip_address'=>$ip_address,
	));
    
	if ($insert){
		$display_msg= '<div class="alert alert-success"><i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    IRAS GST code added successfull.</div>';
		echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("iras_gst_codes",user)."'
        	                },3000);</script>";
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
        $delete=$db->delete('iras_gst_codes',array('id'=>$_POST['del_id']));
        if($delete)
        {

            $display_msg= '<div class="alert alert-success">
                		<i class="lnr lnr-smile"></i>
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    IRAS GST code Delete Successfully.
                		</div>';
            echo "<script>
                         setTimeout(function(){
        	    		  window.location = '".$link->link("iras_gst_codes",user)."'
        	                },3000);</script>";
        }
    }
    elseif(isset($_POST['no']))
    {
        $session->redirect('iras_gst_codes',user);
    }

}
?>
<div class="row">
	<div class="col-lg-12">
		<div class=" padded" >
		
			<h3>IRAS GST Code
			<a onclick="goBack()"  type="submit" class="btn btn-default pull-right">  Back to Tax</a>	
			</h3>
			
		</div>
		<?php echo $display_msg;?>
 <div class="widget-container fluid-height">
        	<div class="widget-content padded">
        
<div class="row">
<div class="col-lg-12">
<br>
<br>
<h3>IRAS GST codes</h3>

   <table class="table table-bordered table-striped">
			                  <thead>
			                   <th>S.no</th>
			                    <th>
			                    Code
			                    </th>
			                    <th class="hidden-xs">
			                     Purpose
			                    </th>
			                    <th>
			                      Description
			                    </th>
			                  <!--  <th>Action</th> --> 
			                  </thead>
			                  <tbody>
						<?php  $all_gst_code=$db->get_all('iras_gst_codes');
						if (is_array($all_gst_code)){
						    $sn=1;
							foreach ($all_gst_code as $gst_code){?>
			                    <tr>
			                     <td><?php echo $sn;?></td>
			                      <td>
			                        <?php echo $gst_code['code'];?>
			                      </td>
			                       <td>
			                      	<?php echo ucfirst($gst_code['purpose']);?>
			                      </td>
			                      <td>
			                      	<?php echo $gst_code['description'];?>
			                      </td>
			                    <!-- <td class="actions">
			                        <div class="action-buttons">
			                         
			                          <a class="table-actions" href="<?php echo $link->link('iras_gst_codes',user,'&action_delete='.$gst_code['id']);?>"><i class="lnr lnr-trash" style="color:red;"></i></a>
			                        </div>
			                      </td>  -->
			                    </tr>
			               <?php $sn++;}}?>

			                  </tbody>
			                </table>
</div>

<!--<div class="col-lg-4">
<form action="" class="form-horizontal" method="post">
        			<button class="btn btn-success pull-right" name="submit" type="submit">Save</button>
					<br>
					<br>
					<h3>Add IRAS GST codes</h3>
               <div class="form-group">
			            <label class="control-label col-md-4">Code<span style="color:red;">*</span></label>
			            <div class="col-md-7">
			                <input class="form-control" type="text" name="code">
			            </div>
			        </div>
        		  <div class="form-group">
			            <label class="control-label col-md-4">Purpose<span style="color:red;">*</span></label>
			            <div class="col-md-7">
			              <select class="form-control" name="purpose">
			               <option value="">Select</option>
			              	 <option value="purchase">Purchase</option>
			              	  <option value="supply">Supply</option>
			              </select>
			            </div>
			        </div>
             <div class="form-group">
			            <label class="control-label col-md-4">Description<span style="color:red;">*</span></label>
			            <div class="col-md-7">
			              <textarea class="form-control" name="description" maxlength="70"></textarea>
			            </div>
			        </div>

        		</form>

</div>-->
</div>


			</div>
		</div>
	</div>
</div>

