<?php 
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
if(isset($_SESSION["login"]) && $_SESSION["login"]==true)
{
    
}else{
    die("No ejecutes este archivo, primero es mejor index");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
      <link href="./libs/css/style.css" type="text/css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <h1>Buenas </h1>
        <form method="post" action="index.php">
        <div id="desconectar">
            <?php  include_once './views/maquetacion/boton_desconectar.php';?>
        </div>
            </form>
        <div id="despliegueProducto">
            <?php CatProController::viewImgProdc();?>
        </div>
        <a href="?delSeImg=true">Volver atras</a>
    </body>
</html>