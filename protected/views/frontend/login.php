<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="assets/admin/favicon.png">
    <title>
      <?php echo $setting['name'];?>
    </title>
      <link href="<?php echo SITE_URL.'/assets/frontend/css/bootstrap.min.css';?>" media="all" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="//cdn.linearicons.com/free/1.0.0/icon-font.min.css">

     <link href="<?php echo SITE_URL.'/assets/frontend/css/style.css';?>" media="all" rel="stylesheet" type="text/css" />

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">


  </head>
<body class="login2">
	<!-- Login Screen -->
	<div class="login-wrapper">
		<a href="<?php echo SITE_URL;?>">
		<?php if(file_exists(SERVER_ROOT.'/uploads/logo/'.$setting['logo']) && $setting['logo']!='' )
              {?>
		<img
			src="<?php echo SITE_URL.'/uploads/logo/'.$setting['logo'];?>" width="150px" />
			 <?php }else{?>
              	<img src="<?php echo SITE_URL.'/assets/frontend/images/-text.png';?>"  width="150px" height="150px"/>
             <?php } ?></a>
            <h2>Login</h2>

			<?php echo $display_msg;?>
		<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-envelope"></i></span><input
						class="form-control" placeholder="Username or Email" type="text" name="email">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="lnr lnr-lock"></i></span><input
						class="form-control" placeholder="Password" type="password" name="password">
				</div>
			</div>

			<div class="text-left ">
				<a class="pull-right" href="<?php echo $link->link('forgot_password',user);?>">Forgot password?</a>
			<div class="text-left">
          <label class="checkbox">
          <input type="checkbox" name="cookie_set" value="true"><span>Keep me logged in</span></label>
        </div>
			</div>

			<input class="btn btn-lg btn-primary btn-block" type="submit"
				value="Log in" name="submit_login">

		</form>


	</div>
 <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript">  </script>
	<script src="http://shiftsystems.net/nikitashift/assets/frontend/js/bootstrap.min.js" type="text/javascript"></script>


</body>

</html>