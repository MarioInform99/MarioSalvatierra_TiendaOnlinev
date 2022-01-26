<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminController
 *
 * @author Mario
 */
include_once './controllers/UserController.php';
include_once './models/Categoria.php';
include_once './controllers/CatProController.php';
include_once './controllers/Cesta.php';
include_once './models/Producto.php';
include_once './models/Paginacion.php';
class adminController {
    
    
    static function mainAdmin(){
        
        if(session_status()==PHP_SESSION_NONE){session_start();}
        if(isset($_REQUEST["add_producto"]))
        {
            $mensajeFeedback=adminController::add_ProductoController();
            include './views/NuevoView.php';
            die();
        }else if(isset ($_REQUEST["codePro"]))
        {
            include './views/maquetacion/listarProductos.php';
            die();
        }
        else if(isset ($_REQUEST["paginaProd"]))
        {
            include_once './views/maquetacion/listarProductos.php';
            die();
        }else if(isset ($_REQUEST["codeCat"]))
        {
            include_once './views/maquetacion/listarProductos.php';
            die();
        }else if(isset ($_REQUEST["modificar"]))
        {
            $mensajeFeedback=adminController::mod_productosController();
            include_once './views/ModificarView.php';
            die();
        }elseif (isset ($_REQUEST["borrarProd"])) {
            
            $mensajeFeedback=adminController::delete_ProductController();
            include_once './views/BorrarView.php';
            die();
        }
        
        if (isset ($_REQUEST["new"])) {
            
            include './views/NuevoView.php';
            die();
        }elseif(isset ($_REQUEST["list"]) && !isset ($_REQUEST["desconectar"])){
        if(isset($_SESSION["modificar"])){unset($_SESSION["modificar"]);}
        if(isset($_SESSION["borrar"])){unset($_SESSION["borrar"]);}
            include './views/ListarView.php';
            die();
        }elseif (isset ($_REQUEST["modif"]) && !isset ($_REQUEST["desconectar"])) {
        if(isset($_SESSION["borrar"])){unset($_SESSION["borrar"]);}
            $_SESSION["modificar"]=true;
            include './views/ModificarView.php';
            die();
        }elseif (isset ($_REQUEST["delt"]) && !isset ($_REQUEST["desconectar"])) {
            if(isset($_SESSION["modificar"])){unset($_SESSION["modificar"]);}
            $_SESSION["borrar"]=true;
            include './views/BorrarView.php';
            die();
        }else if(isset($_REQUEST["nombreProducto"]) && isset ($_REQUEST["cod"])){
            if(isset($_SESSION["nombreProducto"])){unset($_SESSION["nombreProducto"]);}
            if(isset($_SESSION["cod"])){unset($_SESSION["cod"]);}
            $_SESSION["list"]=true;
            include_once './views/paginaProductoView.php';
            die();
        }
        
        if(isset($_REQUEST["desconectar"]))
        {
            include './views/loginView.php';
            unset($_SESSION);
            session_destroy();
            die();            
        }else{
            include_once './views/NuevoView.php';
            die();
        }
    }
    
    
    public static function add_ProductoController()
    {
        $obj=new Producto();
        if(isset($_REQUEST["categorias"]) && !empty($_REQUEST["categorias"]))
        {
            
            if(isset($_REQUEST["new_codeProd"]) && !empty($_REQUEST["new_codeProd"]))
            {
                if(Producto::codeProduct($_REQUEST["new_codeProd"])){
                    if(isset($_REQUEST["desc_prod"]))
                    {
                        if(isset($_REQUEST["new_precio"]) && !empty($_REQUEST["new_precio"]))
                        {
                            if($_REQUEST["new_precio"]>0 && $_REQUEST["new_precio"]<10){
                                $imagenMOvido=false;
                                if(isset($_FILES['imagen']) && !empty($_FILES['imagen']) && $_FILES['imagen']['name']!='')
                                {
                                    $nombreImagen=$_FILES['imagen']['name'];
                                    $nomTemp=$_FILES['imagen']['tmp_name'];
                                    $dircTmp=$_FILES['imagen']['tmp_name'];
                                    $nuevoDirectorio="./img/".$nombreImagen;
                                    if(move_uploaded_file($nomTemp, $nuevoDirectorio))
                                    {
                                       $imagenMOvido=true;
                                    }
                                }  
                                    //Asigno el con el metodo el codigo del producto
                                    $obj->setCodpro(strtoupper($_REQUEST["new_codeProd"]));
                                    $condicion=$obj->getSelectSQL($obj);//Le paso como varible un objeto de Producto
                                    //y este me devuelve un array de la condicion  
                                    $arProd= Producto::getProductos($condicion);//Paso por array la condicion
                                    //Devuelve un array con la consulta si es igual a 1 el codigo existe
                                    if(count($arProd)==0){
                                        $obj->setCodcat(strtoupper($_REQUEST["categorias"]));
                                        $obj->setFoto($nombreImagen??"");
                                        $obj->setDescpro($_REQUEST["desc_prod"]);
                                        $obj->setPrecio($_REQUEST["new_precio"]);
                                        $arCampos=array();
                                        $arPropiedadesObj= get_object_vars($obj);
                                        foreach($arPropiedadesObj as $nombre=>$valor)
                                        {
                                            //Verifico que las propiedades que tengo en el objeto no tenga valor null o vacio
                                            if(!is_null($valor) && !empty($valor)){
                                                   $arCampos[$nombre]=$valor;
                                            }
                                        }
                                        if(Producto::add_NewProduct($arCampos))
                                        {
                                            if(isset($_FILES['imagen']) && !empty($_FILES['imagen']) && $_FILES['imagen']['name']!='')
                                            {
                                                if(isset($imagenMOvido) && $imagenMOvido==true){
                                                    $mensajeFeedback="<p style='color:green'>Se han añadido todo correctamente</p>";
                                                }else{
                                                    $mensajeFeedback="Se han añadido los datos pero no se ha podido mover la imagen";
                                                }
                                            }else{
                                                $mensajeFeedback="<p style='color:green'>Los datos se han añadido correctamente</p>";
                                            }
                                        }else{
                                            $mensajeFeedback="<p style='color:red'>Lo siento no se ha podido añadir los datos</p>";
                                        }

                                    }else{
                                        $mensajeFeedback="<p style='color:red'>Codigo del producto ya existe eligue otro</p>";
                                    }
                            }else{
                                $mensajeFeedback="<p style='color:red'>Por favor el precio debe de ser entre 1 y 10</p>";
                            }
                        }else{
                            $mensajeFeedback="<p style='color:red'>Por favor asigne un precio al producto</p>";
                        }
                    }
                }else{
                    $mensajeFeedback="<p style='color:red'>Por favor mantenga el formato del codigo</p>";
                }
            }else{
                $mensajeFeedback="<p style='color:red'>Por favor escriba un codigo para el producto</p>";
            }
        }else{
            $mensajeFeedback="<p style='color:red'>Por favor seleccione una categoria</p>";
        }
        return $mensajeFeedback??'';
    }
    
    public static function mod_productosController()
    {
        $arModProd=array();
        if(isset($_REQUEST["oculto"]) && !empty($_REQUEST["oculto"]))
        {
            if(isset($_REQUEST["modif"]) && !empty($_REQUEST["modif"]))
            {
                foreach($_REQUEST["oculto"] as $codCatOcul=>$nombresOcul)
                {
                    foreach ($nombresOcul as $nombreOcul=>$valorOcult)
                    {
                        foreach ($_REQUEST["modif"] as $codCat=>$nombres)
                        {
                            foreach ($nombres as $nombre=>$valor)
                            {
                                if($codCatOcul==$codCat)
                                {
                                    if($nombreOcul==$nombre)
                                    {
                                        if($valor!=$valorOcult)
                                        {
                                            $arModProd[$codCat][$nombre]=$valor;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $todoCorrecto=true;
            if(isset($arModProd) && count($arModProd)>0)
            {
                foreach($arModProd as $codPro=>$nombres){
                    foreach ($nombres as $nombre=>$valor){
                        if($nombre=="NOMPRO"){
                            if(empty($valor))
                            {
                                $mensajeFeedback="<p style='color:red'>Campo modificado vacio en ->".$nombre." con Codigo producto".$codPro."</p><br/>"; 
                                $todoCorrecto=FALSE;
                                break;
                            }
                        }else if($nombre=="PRECIO"){
                            if(!empty($valor))
                            {
                                if($valor<=0 || $valor>=10)
                                {
                                    $todoCorrecto=FALSE;
                                    $mensajeFeedback= "<p style='color:red'>Precio debe de estar entre 1 y 10, campo->".$nombre." Codigo->".$codPro."</p>";
                                    break;
                                }
                            } else {
                                $todoCorrecto=FALSE;
                                $mensajeFeedback= "<p style='color:red'>Precio no puede ir vacio, campo->".$nombre." Codigo->".$codPr."</p>";
                                break;
                            }
                        }elseif ($nombre=="STOCK") {
                            if(!empty($valor))
                            {
                                if($valor<0 || $valor>20)
                                {
                                    $todoCorrecto=FALSE;
                                    $mensajeFeedback="<p style='color:red'>Cantidad de stock debe de estar entre 1 y 20, campo->".$nombre." Codigo->".$codPro."</p>";
                                    break;
                                }
                            }else{
                                $todoCorrecto=FALSE;
                                $mensajeFeedback="<p style='color:red'>El stock no puede estar vacio comparado con la cantidad anterior</p>";
                                break;
                            }
                            
                        }elseif($nombre=="CODPRO")
                        {
                            if(Producto::codeProduct($valor))
                            {
                                $objePro=new Producto();
                                $objePro->setCodpro($valor);
                                $condi=$objePro->getSelectSQL($objePro);
                                $cantidadEncontrada= Producto::getProductos($condi);
                               if(count($cantidadEncontrada)>0)
                               {
                                   $todoCorrecto=FALSE;
                                   $mensajeFeedback="<p style='color:red'>Lo siento codigo repetido</p>";
                                   break;
                               }
                            }else{
                                $mensajeFeedback="<p style='color:red'>Lo siento el codigo erroneo en el campo->".$nombre." del codigo ->".$valor."</p>";
                                $todoCorrecto=false;
                                break;
                            }
                        }
                        if($todoCorrecto){
                            if($nombre=="CODPRO"){$valor= strtoupper($valor);}
                                if(Producto::modifyProduct($nombre,$valor,$codPro))
                                {
                                    $mensajeFeedback="<p style='color:green'>Los cambios sean ejecutado correctamente</p>";
                                }else{
                                    $mensajeFeedback="<p style='color:red'>Lo siento algunos campos no se ha podido modificar</p>";
                                    break;
                                }
                            }
                    }
                }
                
                return $mensajeFeedback;
            }
        }
    }
    
    public static function delete_ProductController(){
        $validar=true;
        $mensajeFeedback="Todo correcto";
        if(isset($_REQUEST["borrarProd"]))
        {
            if(isset($_REQUEST["codProd"]) && !empty($_REQUEST["codProd"])){
                foreach ($_REQUEST["codProd"] as $codePro=>$valor)
                {
                    if(!Producto::delete_Product($codePro))
                    {
                        $mensajeFeedback="<p style='color:red'>Error a la hora de borrar un producto</p>";
                        $validar=FALSE;
                        break;
                    }
                }
            }else{
                $mensajeFeedback="<p style='color:red'>Debes de seleccionar al menos una de las casillas para eliminar</p>";
            }
            return $mensajeFeedback;
        }
    }

}
