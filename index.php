<?php
if(session_status()==PHP_SESSION_NONE){session_start();}
if(isset($_SESSION["identificado[tipUser]"]) && $_SESSION["identificado[tipUser]"]=='admin'){
    $_SESSION["login"]=TRUE;
    include_once './controllers/adminController.php';
    adminController::mainAdmin();
}else{
    $_SESSION["login"]=true;
    include_once './controllers/MainControllerUser.php';
    MainControllerUsers::main();
}
