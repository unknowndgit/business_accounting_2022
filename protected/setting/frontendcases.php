<?php
if (! isset($query1ans) || $query1 == '' || $query1ans == '') {
    $query1 = user;
    $query1ans = 'home';
}
$fcontroller = SERVER_ROOT . '/protected/controller/frontend/' . $query1ans . '_controller.php';
$fview = SERVER_ROOT . '/protected/views/frontend/' . $query1ans . ".php";
if ($query1ans == "login" || $query1ans == 'signup' ||
    $query1ans == 'forgot_password'  || $query1ans == 'ajax' || $query1ans == 'installation_final' || $query1ans == 'pdfgenerate' || $query1ans == 'modal_box' ) {
    if (file_exists($fview)) {
  if (file_exists($fcontroller))

            require $fcontroller;
        require $fview;
    }
}


elseif ($query1ans == "logout") {
    /*entry in activity log table*/
    $event="Logout";
    $db->insert('activity_logs',array('user_id'=>$_SESSION['user_id'],
        'event'=>$event,
        'created_date'=>date('Y-m-d'),
        'ip_address'=>$_SERVER['REMOTE_ADDR']

    ));
    setcookie('remember_me', "", time() - 3600);
    $session->destroy('login', fview);
}
elseif (!file_exists($fview) || $query1ans == 'installation_final' || $query1ans == 'installation') {

    header("HTTP/1.0 404 Not Found");
    require SERVER_ROOT . '/protected/views/frontend/404.php';
}
else {
    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/assign_roles.php')) {

        require SERVER_ROOT . '/protected/setting/frontend/assign_roles.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/common_data.php')) {

        require SERVER_ROOT . '/protected/setting/frontend/common_data.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/header.php')) {
        if($query1ans!='pdfgenerate')
        require SERVER_ROOT . '/protected/setting/frontend/header.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/sidebar.php')) {
        require SERVER_ROOT . '/protected/setting/frontend/sidebar.php';
    }
    if (file_exists($fview)) {
        if (file_exists($fcontroller))
            require $fcontroller;
        require $fview;
    }

    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/footer.php')) {
        require SERVER_ROOT . '/protected/setting/frontend/footer.php';
    }
}
?>