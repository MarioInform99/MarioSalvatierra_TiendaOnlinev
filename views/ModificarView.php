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
        <link href="./libs/css/style.css" type="text/css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="./libs/js/Paginacion.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Bienvenido Admin</h1>
         <div>
                <?php include_once './views/maquetacion/opcioneAdmin.php';?>
         </div>
        <form action="" method="POST">
        <h2>Modificar productos</h2>
              <div id="desconectar" ><?php include_once './views/maquetacion/boton_desconectar.php';?></div>
            <div>
                <select name="categorias" onchange="mostrarSelect(this.value)">
                    <?php include_once './views/maquetacion/listarCategoria.php';?>
                </select>
            </div>
            <div id="imgInicio">
                <?php include_once './views/maquetacion/listarProductos.php';?>
            </div>
            <input type="submit" name="modificar" value="Modificar"/>
        </form>
            <div><?php if(isset($mensajeFeedback)){echo $mensajeFeedback;}?></div>
    </body>
</html>
