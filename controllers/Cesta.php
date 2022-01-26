<?php

/**
 * Description of Cesta
 *
 * @author Mario
 */

include_once './models/Producto.php';
class Cesta {
    
    

    public static function cargarCesta()
    {
        if(session_status()==PHP_SESSION_NONE){session_start();}
        $objProducto=new Producto();
        $arProductos=$objProducto->getProductos(null);
        $arCesta=array();
        $arCesta["Productos"]=$arProductos;
        if(isset($_REQUEST["cestaCompra"])){
                foreach($_REQUEST["cestaCompra"] as $codCat=>$CodProds)
                {
                    foreach($CodProds as $CodPro=>$value){

                        if(isset($_SESSION["cestaCompra"]["$codCat"]["$CodPro"])){
                            $_SESSION["cestaCompra"]["$codCat"]["$CodPro"]++;
                        }else{
                            $_SESSION["cestaCompra"]["$codCat"]["$CodPro"]=1;
                        }
                    }
                }
        }
        if(isset($_SESSION["cestaCompra"]))
        {
             $arCesta["Cesta"]=$_SESSION["cestaCompra"];
             return $arCesta;
        }
    }
    //Devuelve un array con el precio total y las cantidades para actulizar en la base de datos
    public static function controladorStock()
    {
        if(session_status()==PHP_SESSION_NONE){session_start();}
        $arCesta=array();
        $objProd=new Producto();
        $arCesta["Productos"]=$objProd->getProductos(null);
        $arCesta["Cesta"]=$_SESSION["cestaCompra"]??'';
        $arProdStock=array();
        $sumaTotal=0;
        if(isset($arCesta["Productos"]) && isset($arCesta["Cesta"]) && isset($_SESSION["cestaCompra"])){
                foreach ($arCesta["Productos"] as $nombre=>$value){
                    foreach($arCesta["Cesta"] as $indice=>$codigosPro)
                    {
                        foreach($codigosPro as $codPro=>$cantidad){
                            if($value["CODPRO"]==$codPro)
                            {
                                if($value["STOCK"]>=$cantidad){
                                        $arProdStock["New_Stock"][$value["CODPRO"]]=$cantidad;
                                        $arProdStock["cantidadTotalBBDD"][$value["CODPRO"]]=$value["STOCK"]-$cantidad;
                                        $sumaTotal=$sumaTotal+($value["PRECIO"]*$cantidad);
                                }else{
                                    $arProdStock["cantidadTotalBBDD"][$value["CODPRO"]]=0;
                                    $arProdStock["Sin_stock"][$value["CODPRO"]]=$value["STOCK"];
                                    $sumaTotal=$sumaTotal+($value["PRECIO"]*$value["STOCK"]);
                                }
                            }
                        }
                    }
                }
        }
        $arProdStock["SUMATOTAL"]=$sumaTotal;
        return $arProdStock;
    }
}
