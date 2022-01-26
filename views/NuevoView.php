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
    </head>
    <body>
        <h1>Bienvenido Admin</h1>
        <div>
            <?php include_once './views/maquetacion/opcioneAdmin.php';?>
        </div>
        <div><?php if(isset($mensajeFeedback)){echo $mensajeFeedback;}?></div>
        <form action="" method="post"><div id="desconectar" ><?php include_once './views/maquetacion/boton_desconectar.php';?></div></form>
        <form action="" method="POST" enctype="multipart/form-data" id="nuevo" style="position: absolute; width: 40%; left: 3%;">
            <h2>Añadir nuevo producto</h2>
            <label for="categoria_select">Seleccione Categoria(*)</label>
            <select name="categorias" id="categoria_select">
                <?php include_once './views/maquetacion/listarCategoria.php';?>
            </select>
            <div class="form-group">
                <label for="id_producto">Codigo del producto(*)</label>
                <input type="text" name="new_codeProd" id="id_producto" class="form-control" placeholder="1ROP" style="width: 20%;"/>
            </div>
            <label for="descp_new">Descripcion del producto:</label>
            <textarea placeholder="Escribe sobre el producto" name="desc_prod" id="descp_new" rows="2" cols="40"></textarea>
            <div class="form-group">
                <label for="precio">Precio(*):</label>
                &nbsp;&nbsp;<input type="text" name="new_precio" id="precio" class="form-control" style="width: 10%;"/>
            </div>
                <label for="imagen">Sube imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg, image/jpg"/>
            <br/><br/><input type="submit" name="add_producto" value="Añadir Producto"/>
        </form>
        
            
    </body>
</html>
