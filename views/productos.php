<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
/*
if(isset($_SESSION['login']) && $_SESSION['login']==true && isset($_SESSION['userVerificado']))
{
    $user=$_SESSION['userVerificado'];
}else{
    require_once './login.php';
    die();
}

include_once './Consultas.php';
$arCategorias=MostrarCategoria();
if(isset($_SESSION["categorias"]) && $_SESSION['login']==TRUE)
{
   $arProductos= MostrarProductos($_SESSION["categorias"]);
}

if(isset($_COOKIE["nombreProducto"]) && isset($_COOKIE["codProducto"]))
{
    
    setcookie("nombreProducto","", time()-6000);
    setcookie("codProducto","", time()-6000);
}*/

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../css/estilo.css" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <h1>Bienvenido <?php if(isset($_SESSION["identificado[user]"])){echo $_SESSION["identificado[user]"];} ?></h1>
        <form action="index.php" method="post">
            <div id="desconectar" ><?php include_once './views/boton_desconectar.php';?></div>
            <div id="zonaProductos">
                <select name="categorias">
                       <?php CatProController::listarCategorias();?>
                </select>
                <input type="submit" value="Mostrar" name="mostrar"/><br/><br/>
                <?php CatProController::listarProductos();?>
            </div>
            <div id="cestaCompra" class="">
                <!--zona de compras-->
                <?php include_once './views/listaCesta.php';?>
                <input type="submit" name="vaciarCesta" value="Vaciar Cesta"/>&nbsp;&nbsp;
                <input type="submit" name="comprar" value="Comprar"/>
            </div>
           
            </form>        
    </body>
</html>