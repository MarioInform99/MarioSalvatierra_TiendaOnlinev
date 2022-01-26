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
        <meta charset="utf-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <form method="post" action="">
            <fieldset>
                <h1>ZONA DE PAGO</h1>
                <div><?php include_once './views/maquetacion/boton_desconectar.php';?></div>
            <?php if(isset($mensaje)){echo $mensaje;
            }else{include_once './views/maquetacion/listaCesta.php';}?><br/>
         <input type="submit" name="anularComprar" value="Anular Comprar"/>&nbsp;&nbsp;
         <input type="submit" name="pagar" value="Pagar"/>
        </fieldset>
    </form>
    </body>
</html>
