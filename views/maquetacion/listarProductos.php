<?php
if(session_status()==PHP_SESSION_NONE){session_start();}
define("NUM",5);
$pag=new Paginacion("PRODUCTOS");
if(isset($_GET["codeCat"]) && !empty($_GET["codeCat"]))
{
    $_SESSION["categorias"]=$_GET["codeCat"];
}
$numeroTotal=$pag->getTotalElementos(NUM,$_SESSION["categorias"]??"CAM");
if(isset($_GET["paginaProd"]) && is_numeric($_GET["paginaProd"]))
{
    $numPagina=($_GET["paginaProd"]>$numeroTotal)?$numeroTotal:($_GET["paginaProd"]>1)?$_GET["paginaProd"]:1;
}else{
    $numPagina=1;
}
$arConsultas=$pag->getBloqueReservas($numPagina, NUM, $_SESSION["categorias"]??"CAM");
$pag->dibujarBloquePaginacionReservas($numPagina, $numeroTotal);
if(isset( $_SESSION["modificar"])){
    ?>
    <table class="table table-striped">
                    <tr>
                        <th>Codigo Producto</th>
                        <th>Nombre producto</th>
                        <th>Descripcion </th>
                        <th>Precio</th>
                        <th>Cantidad Stock</th>
                    </tr>
        <?php
    foreach ($arConsultas as $key=>$valor2)
    {?>
        <tr>
            <input  type="hidden" name="oculto[<?=$valor2["codpro"]?>][CODPRO]" value="<?=$valor2["codpro"]?>"/>
                <input  type="hidden" name="oculto[<?=$valor2["codpro"]?>][STOCK]" value="<?=$valor2["stock"]?>"/>
                <input  type="hidden" name="oculto[<?=$valor2["codpro"]?>][PRECIO]" value="<?=$valor2["precio"]?>"/>
                <input  type="hidden" name="oculto[<?=$valor2["codpro"]?>][DESCPRO]" value="<?=$valor2["descpro"]?>"/>
                <input  type="hidden" name="oculto[<?=$valor2["codpro"]?>][NOMPRO]"  value="<?=$valor2["nompro"]?>"/>
                <td>
                    <input  type="text" name="modif[<?=$valor2["codpro"]?>][CODPRO]" value="<?=$valor2["codpro"]?>"/>
                </td>
            <td>
                <input  type="text" name="modif[<?=$valor2["codpro"]?>][NOMPRO]" value="<?=$valor2["nompro"]?>"/>
            </td>
            <td>
                <input  type="text" name="modif[<?=$valor2["codpro"]?>][DESCPRO]" value="<?=$valor2["descpro"]?>"/>
            </td>
            <td>
                <input  type="number" name="modif[<?=$valor2["codpro"]?>][PRECIO]" value="<?=$valor2["precio"]?>"/>
            </td>
            <td>
                <input  type="number" name="modif[<?=$valor2["codpro"]?>][STOCK]" value="<?=$valor2["stock"]?>"/>
            </td>            
        </tr>
        <?php
    }?>
    </table>
        <?php
}elseif(isset ($_SESSION["borrar"])){
    ?>
<table class="table table-striped">
                    <tr>
                        <th>Seleccion producto</th>
                        <th>Codigo del producto</th>
                        <th>Nombre producto</th>
                        <th>Descripcion </th>
                        <th>Precio</th>
                        <th>Cantidad Stock</th>
                    </tr>
        <?php
    foreach ($arConsultas as $key=>$valor2)
    {?>
        <tr>
            <td>
                <input id="<?=$valor2["codpro"]?>" type="checkbox" name="codProd[<?=$valor2["codpro"]?>]" />
            </td>
            <td>
                <p><?=$valor2["codpro"]?></p>
            </td>
            <td>
                <p><?=$valor2["nompro"]?></p>
            </td>
            <td>
                <p><?=$valor2["descpro"]?></p>
            </td>
            <td>
                <p><?=$valor2["precio"]?></p>
            </td>
            <td>
                <p><?=$valor2["stock"]?></p>
            </td>            
        </tr>
        <?php
    }?>
    </table>
<?php
}
else if(isset($_SESSION["identificado[tipUser]"]) && $_SESSION["identificado[tipUser]"]=='admin'){
   ?>
    <ul>
    <?php
    foreach ($arConsultas as $key=>$valor2)
    {?>
    
        <li>
                <a href="?nombreProducto=<?=$valor2["nompro"]?>&cod=<?=$valor2["codcat"]?>"><?=$valor2["nompro"]?></a>
        </li>
        <?php
    }?>
    </ul>
<?php
}else{?>
    <ul>
    <?php
    foreach ($arConsultas as $key=>$valor2)
    {?>
    
        <li>
            <a href="?nombreProducto=<?=$valor2["nompro"]?>&cod=<?=$valor2["codcat"]?>"><?=$valor2["nompro"]?></a>
                &nbsp;&nbsp;<input type="submit" name="cestaCompra[<?=$valor2["codcat"]?>][<?=$valor2["codpro"]?>]" value="Añadir"/>
        </li>
        <?php
    }?>
    </ul>
        <?php
}