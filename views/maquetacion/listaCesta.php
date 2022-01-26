<?php
include_once './controllers/Cesta.php';
$ArCesta=Cesta::cargarCesta();
$arControlStock= Cesta::controladorStock();
if(isset($_SESSION["cestaCompra"])){

    foreach ($ArCesta["Productos"] as $indice=>$value)
    {
        foreach ($ArCesta["Cesta"] as $key=>$valores)
        {
            foreach($valores as $valor=>$v)
            {
                if(isset($_REQUEST["comprar"])){
                    if($value["CODPRO"]==$valor){
                        if(isset($arControlStock["Sin_stock"])){
                            foreach($arControlStock["Sin_stock"] as $indice=>$codProds)
                            {
                                if($indice==$value["CODPRO"])
                                {?>
                                    <p>Nombre Producto: <?=$value["NOMPRO"]?>->Cantidad: <?=$codProds?>->Precio: <?=$value["PRECIO"]?>(*)<pre>Este producto se ha ajustado a la 
cantidad máxima de stock debido a que has añadido
 más unidades de las que hay en el almacén</pre> </p>
                               <?php }else{
                                   ?>
                                    <p>Nombre Producto: <?=$value["NOMPRO"]?>->Cantidad: <?=$v?>->Precio: <?=$value["PRECIO"]?></p>
                                       <?php
                               }
                            }
                        }else{
                        ?> 
                        <p>Nombre Producto: <?=$value["NOMPRO"]?>->Cantidad: <?=$v?>->Precio: <?=$value["PRECIO"]?></p>
                    <?php
                        }
                    }
                }else{
                    if($value["CODPRO"]==$valor){
                        ?>
                        <p>Codigo Categoria:<b><?=$value["CODCAT"]?></b>->Nombre Producto: <b><?=$value["NOMPRO"]?></b> Cantidad: <b><?=$v?></b>->Precio: <b><?=$value["PRECIO"]?></b></p>
                            <?php
                    }
                }
            }
        }
    }
    if(isset($arControlStock["SUMATOTAL"]) && isset($_REQUEST["comprar"]))
    {
        ?><hr/><p>Suma total: <?=$arControlStock["SUMATOTAL"];?></p>
            <?php
    }
?>
    
    <?php    
}else{?>
                    <p>Cesta vacía</p>
<?php
}
