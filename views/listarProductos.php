<?php
if(session_status()==PHP_SESSION_NONE){session_start();}
foreach ($arProductos as $key=>$valor2)
{
    echo "<ul>";
    echo '<li><a href="./paginaProducto.php?nombreProducto='.$valor2["NOMPRO"].'&cod='.$valor2["CODCAT"].'">'.$valor2["NOMPRO"].'</a>'
            . '&nbsp;&nbsp;<input type="submit" name="cestaCompra['.$valor2["CODCAT"].']['.$valor2["CODPRO"].']" value="Añadir"/></li>';

    echo "</ul>";
}