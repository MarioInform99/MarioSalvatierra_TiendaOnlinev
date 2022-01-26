<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaController
 *
 * @author Mario
 */
include_once './models/Categoria.php';
include_once './models/Producto.php';
class CatProController {

    
    public static function viewImgProdc()
    {
       if(session_status()==PHP_SESSION_NONE){session_start();}
       if(isset($_SESSION["nombreProducto"]) && isset($_SESSION["cod"]))
       {
           $_SESSION["nombreProducto"]=$_SESSION["nombreProducto"];
           $_SESSION["cod"]=$_SESSION["cod"];
       }else{
            $_SESSION["nombreProducto"]=$_REQUEST["nombreProducto"];
            $_SESSION["cod"]=$_REQUEST["cod"];
       }
       
       $objProducto=new Producto();
       $objProducto->setNompro($_SESSION["nombreProducto"]);
       $objProducto->setCodcat($_SESSION["cod"]);
       $condicion=$objProducto->getSelectSQL($objProducto);
      $arImg= Producto::getProductos($condicion);
      require './views/maquetacion/mostrarImagen.php';
    }
}
