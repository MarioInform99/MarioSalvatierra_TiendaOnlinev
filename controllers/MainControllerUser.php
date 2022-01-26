<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainController
 *
 * @author Mario
 */
include_once './controllers/UserController.php';
include_once './models/Categoria.php';
include_once './controllers/CatProController.php';
include_once './controllers/Cesta.php';
include_once './models/Paginacion.php';
class MainControllerUsers {
    public static function main(){
        if(session_status()==PHP_SESSION_NONE){session_start();}
        
        /*---------------------------------------------------*/
        /*Accion aqui pueden entrar el administrador y el usuario, en la primera condicional */
        /*En el resto el administrador no debera de tener acceso a este controllador*/
        if(isset($_REQUEST["entrar"])){
            if(UserController::loginController()){
                $_SESSION["login"]=true;
                if(isset($_SESSION["identificado[tipUser]"]) && $_SESSION["identificado[tipUser]"]=="user"){
                    include_once './views/productosView.php';
                }else if(isset($_SESSION["identificado[tipUser]"]) && $_SESSION["identificado[tipUser]"]=='admin'){
                    include_once './controllers/adminController.php';
                    adminController::mainAdmin();
                }
            }else{
                include_once './views/loginView.php';
                die();
            }
            die();
            /*-----------------------------------------------------*/
            /*Condicional para mostrar los productos seleccionando la categoria*/
        }else if(isset($_REQUEST["mostrar"]))
        {
            include_once './views/productosView.php';
            die();
            
        }elseif (isset ($_REQUEST["paginaProd"])) {
            include_once './views/maquetacion/listarProductos.php';
            die();
        }
        else if (isset($_REQUEST["cestaCompra"])) {
            include_once './views/productosView.php';
            die();
        }else if(isset($_REQUEST["nombreProducto"]) && isset ($_REQUEST["cod"])){
            
            include_once './views/paginaProductoView.php';
            die();
           }else if(isset ($_REQUEST["comprar"]))
           {
               include_once './views/pagarView.php';
              die();
           }elseif (isset($_REQUEST["pagar"]) || isset($_REQUEST["anularComprar"])) {
               
               if(isset($_REQUEST["pagar"]))
               {
                   Producto::updateStock(Cesta::controladorStock());
                   $mensaje='Gracias por su compra <a href="">¿Quieres comenzar de nuevo?</a>';
               }else{
                   $mensaje='Compra anulada <a href="">¿Quiere comenzar de nuevo?</a>';
               }
               unset($_SESSION["cestaCompra"]);
               include_once './views/pagarView.php';
               die();
        }else if(isset ($_REQUEST["vaciarCesta"]))
        {
            unset($_SESSION["cestaCompra"]);
            include_once './views/productosView.php';
            die();
        }elseif (!isset($_REQUEST["desconectar"])) {
            if(isset($_SESSION["identificado[tipUser]"]) || isset ($_REQUEST["delSeImg"])){
               unset($_SESSION["nombreProducto"]);
               unset($_SESSION["cod"]);
               include_once './views/productosView.php';
               die();
            }
           }
        if(isset($_REQUEST["desconectar"]))
        {
            include './views/loginView.php';
            unset($_SESSION);
            session_destroy();
            die();
        }else{
            include './views/loginView.php';
            die();
        }
    }
}
