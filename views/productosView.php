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
        <script src="./libs/js/Paginacion.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Bienvenido <?php if(isset($_SESSION["identificado[user]"])){echo $_SESSION["identificado[user]"];} ?></h1>
        <form action="index.php" method="post">
            <div id="desconectar" ><?php include_once './views/maquetacion/boton_desconectar.php';?></div>
            <div id="zonaProductos">
                <select name="categorias" >
                       <?php include_once './views/maquetacion/listarCategoria.php';?>
                </select>
                <input type="submit" value="Mostrar" name="mostrar"/><br/><br/>
                <div id="imgInicio">
                <?php include_once './views/maquetacion/listarProductos.php';?></div>
            </div>
            <div id="cestaCompra" class="">
                <!--zona de compras-->
                <?php include_once './views/maquetacion/listaCesta.php';?>
                <input type="submit" name="vaciarCesta" value="Vaciar Cesta"/>&nbsp;&nbsp;
                <input type="submit" name="comprar" value="Comprar"/>
            </div>
        </form>        
    </body>
</html>