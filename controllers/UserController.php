<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Mario
 */
include_once './models/User.php';
class UserController {
    
    protected $found;
    public static function loginController(){
        if(session_status()==PHP_SESSION_NONE){session_start();}
        
        if(isset($_REQUEST["usuario"]) && !empty($_REQUEST["usuario"]))
        {
            if(isset($_REQUEST["password"]) && !empty($_REQUEST['password']))
            {
                $usuario=$_REQUEST['usuario'];
                $password=$_REQUEST['password'];
                $_SESSION["identificado[user]"]=$usuario;
                $objUser=new User($usuario,$password);
                if($objUser->login())
                {
                    if($_SESSION["identificado[user]"]=='admin'){
                        $_SESSION["identificado[tipUser]"]="admin";
                    }else{
                        $_SESSION["identificado[tipUser]"]="user";
                    }
                    return true;
                }else{
                    echo "<p style='color:red'>Usuario incorrecto</p>";
                    return false;
                }           
            }
        }
    }
    
}
