<?php
if (isset($_POST['activity_filter_submit']))
{
    $start_date=$_POST['start'];
    $last_date=$_POST['end'];

    if ($start_date=="" || $last_date=="")
    {
        $display_message='<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button"><i class="fa fa-times"></i></button>
                       <h1 class="pull-center">Select dates</h1><br>

                      </div>';
    }
    elseif (strtotime($start_date)>strtotime($last_date))
    {
        $display_message='<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button"><i class="fa fa-times"></i></button>
                       <h1 class="pull-center">Start Date should Less than End Date!</h1><br>

                      </div>';
    }

    elseif (strtotime($start_date)>strtotime(date('Y-m-d')))
    {
        $display_message='<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button"><i class="fa fa-times"></i></button>
                       <h1 class="pull-center">Start Date should less than Today Date!</h1><br>

                      </div>';
    }
    elseif (strtotime($last_date)>strtotime(date('Y-m-d')))
    {
        $display_message='<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button"><i class="fa fa-times"></i></button>
                       <h1 class="pull-center">=End Date should less or Equal to Today Date!</h1><br>

                      </div>';
    }
    else{
          $start_date=date('Y-m-d',strtotime($start_date));
          $last_date=date('Y-m-d',strtotime($last_date));


    if($_SESSION['user_type']=='admin'){
        $db->order_by='id desc';
        //$activity_logs=$db->get_all('activity_logs',array('created_date'=>date('Y-m-d')));
       $query="SELECT * FROM `activity_logs` WHERE `created_date` BETWEEN '$start_date' AND '$last_date'";
        $activity_logs=$db->run($query)->fetchAll();
    }
    else{
        $db->order_by='id desc';
       // $activity_logs=$db->get_all('activity_logs',array('user_id'=>$_SESSION['user_id']));
        $uid=$_SESSION['user_id'];
        $query="SELECT * FROM `activity_logs` WHERE `user_id`='$uid' `created_date` BETWEEN '$start_date' AND '$last_date'";
        $activity_logs=$db->run($query)->fetchAll();
    }
}
}else
{
    if($_SESSION['user_type']=='admin'){
        $db->order_by='id desc';
        $activity_logs=$db->get_all('activity_logs',array('created_date'=>date('Y-m-d')));

    }
    else{
        $db->order_by='id desc';
        $activity_logs=$db->get_all('activity_logs',array('user_id'=>$_SESSION['user_id'],'created_date'=>date('Y-m-d')));

    }

}





?>


<div class="row">
<?php echo $display_message; ?>
<div class="col-lg-3"><h3>Activity Logs</h3></div>
<div class="col-lg-9">

					              <form method="post" action="">
   <div class="form-group">
            <label class="control-label col-md-2">Select Range </label>
            <div class="col-sm-3">
              <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd1" placeholder="Start date" type="text" name="start" value="">
            </div>
            <div class="col-sm-3">
              <input class="form-control" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd2" placeholder="End date" type="text" name="end" value="">
            </div>
              <div class="col-sm-3">
               <button  class="btn btn-default" type="submit" name="activity_filter_submit"><i class="fa fa-edit"></i> Show</button>
            </div>
          </div>

</form>
</div>
</div>
<div class="row">
					          <div class="col-lg-12">
					            <div class="widget-container fluid-height clearfix">

					              <div class="widget-content padded clearfix">


					                <table class="table table-bordered table-striped" id="dataTable1">
					                  <thead>
					                  <tr row="">
					                    <th class="check-header hidden-xs" width="5%">
					                      S.no
					                    </th>
					                    <th width="15%">Date</th>
					                    <th width="15%">User</th>
					                    <th width="30%">Event</th>
					                    <th width="30%">Ip address or country</th>

					                  </tr>
					                  </thead>
					                  <tbody>
					                  <?php if (is_array($activity_logs)){
					                      $sn=1;
					                      foreach ($activity_logs as $log){?>
                                       <tr>
					                      <td class="check hidden-xs">
					                       <?php echo $sn;?>
					                      </td>
					                     <td><?php $time=strtotime($log['timestamp']);
					                     echo date('d-m-Y h:i A',$time)?></td>
					                      <td>
					                      <?php $user_name=$db->get_row('users',array('user_id'=>$log['user_id']));
					                      echo $user_name['firstname']." ".$user_name['lastname']; ?></td>
					                      <td><?php echo $log['event']; ?></td>
					                      <td><?php echo $log['ip_address']; ?><br>
					                      <?php //echo $feature->getLocationInfoByIp($log['ip_address']);?></td>

					                    </tr>
					                    <?php $sn++; }}?>

                                  </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>
