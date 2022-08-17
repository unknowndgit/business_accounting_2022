<!DOCTYPE html>
<html>
<head>
<title><?php echo $settings['name'];?></title>
<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700"
	media="all" rel="stylesheet" type="text/css" />
<link href="<?php echo SITE_URL.'/assets/frontend/css/bootstrap.min.css';?>" media="all" rel="stylesheet"
	type="text/css" />
   <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link href="<?php echo SITE_URL.'/assets/frontend/css/style.css';?>" media="all" rel="stylesheet"
	type="text/css" />

<meta
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
	name="viewport">
</head>
<body class="fourofour">
	<!-- Login Screen -->
	<div class="fourofour-container">
		<h1>404</h1>
		<h2>It looks like you're lost.</h2>
		<a class="btn btn-lg btn-default-outline" href="<?php echo $link->link('home',user);?>"><i class="lnr lnr-home"></i> Go to the homepage</a>
	</div>
	<!-- End Login Screen -->
</body>
</html>