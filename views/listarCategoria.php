<?php
if(session_status()==PHP_SESSION_NONE){session_start();}
foreach ($arCategorias as $key=>$valor1) 
{
    if(isset($_SESSION["categorias"]) && $_SESSION["categorias"]==$valor1["CODCAT"]){
        echo '<br/>'
    .'<option value="'.$valor1["CODCAT"].'"  selected="true">'.$valor1["NOMCAT"].'</option>';
    } else {
         echo '<br/>'
    .'<option value="'.$valor1["CODCAT"].'">'.$valor1["NOMCAT"].'</option>';
    }

}
?>