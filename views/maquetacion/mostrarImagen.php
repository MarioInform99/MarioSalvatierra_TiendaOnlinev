<?php
if(session_status()==PHP_SESSION_NONE){session_start();}
foreach($arImg as $indice=>$valor)
{
    
    if($valor["NOMPRO"]==$_SESSION["nombreProducto"])
    {?>
    <h2><?=$valor["NOMPRO"]?></h2>
                        <img src="./img/<?=$valor["FOTO"]?>" width="300px"/><br/>
                        <div id="descp">Descripcion:<?=$valor["DESCPRO"]?></div>
                        <br/><b>Precio:</b>&nbsp;<?=$valor["PRECIO"]?>
       <?php 
    }
}
