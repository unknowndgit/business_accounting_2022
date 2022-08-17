
<!DOCTYPE html>
<html>
<head>
    <title>
    <?php echo $setting['name'];?>
    </title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/bootstrap.min.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    
    <link href="<?php echo SITE_URL.'/assets/frontend/css/fullcalendar.css';?>" media="all" rel="stylesheet" type="text/css" />

    <link href="<?php echo SITE_URL.'/assets/frontend/css/datatables.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/datepicker.css';?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL.'/assets/frontend/css/timepicker.css';?>" media="all" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo SITE_URL.'/assets/frontend/css/style.css';?>" media="all" rel="stylesheet" type="text/css" />
    
    
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="login2">
    <!-- Login Screen -->
    <div class="login-wrapper">
    <a href="<?php echo SITE_URL;?>">
    <?php if(file_exists(SERVER_ROOT.'/uploads/logo/'.$setting['logo']) && $setting['logo']!='')
              { ?>
		<img width="150px" height="150px" src="<?php echo SITE_URL.'/uploads/logo/'.$setting['logo'];?>"/>
			 <?php }else{?>
              	<img src="<?php echo SITE_URL.'/assets/frontend/images/-text.png';?>"  width="150px" height="150px"/>
             <?php } ?>
        </a>
      <h2>Forgot Password</h2>
      <?php echo $display_msg;?>
    
     <?php if($exists==1 && isset($_REQUEST['random']) && $_REQUEST['random']!='' ){?>
      <form method="post" action="">
         <input class="form-control"  type="hidden" placeholder="token" name="token"  value="<?php echo $_REQUEST['random'];?>">
      <!-- <input type="hidden" name="setting_ip" value="<?php echo $password->stringbreak($_SERVER['REMOTE_ADDR']);?>"> -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="lnr lnr-lock"></i></span>
            <input class="form-control"  type="password" placeholder="Password" name="password">
          </div>
        
        <div class="input-group">
            <span class="input-group-addon"><i class="lnr lnr-lock"></i></span>
            <input class="form-control"  type="password" placeholder="Retype Password" name="retypepassword">
          </div>
        </div>
       <!-- <input class="btn btn-lg btn-primary btn-block" name="forgot_pass" type="submit" value="Submit"> -->
       <button class="btn btn-lg btn-primary btn-block" name="change_pass"><i class="lnr lnr-checkmark-circle"></i> Submit</button>
        </form>
        
        <?php }else{?>
         <form method="post" action="">
      <!-- <input type="hidden" name="setting_ip" value="<?php echo $password->stringbreak($_SERVER['REMOTE_ADDR']);?>"> -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="lnr lnr-envelope"></i></span>
            <input class="form-control" placeholder="Email" type="text" name="email">
          </div>
        </div>
       <!-- <input class="btn btn-lg btn-primary btn-block" name="forgot_pass" type="submit" value="Submit"> -->
       <button class="btn btn-lg btn-primary btn-block" name="forgot_pass"><i class="lnr lnr-checkmark-circle"></i> Submit</button>
        </form>
                
        <?php }?>
        
        
     <div class="text-left checkbox">
				<a class="pull-right" href="<?php echo $link->link('login',user);?>">Back To Login</a>
			</div></div>
    <!-- End Login Screen -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript">  </script>
    <script src="http://shiftsystems.net/nikitashift/assets/frontend/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
