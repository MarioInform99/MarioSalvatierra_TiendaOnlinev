<?php
if(session_status()==PHP_SESSION_NONE){session_start();}


if(count(Categoria::getCategorias())>0){
            if(isset($_REQUEST["categorias"]) && !empty($_REQUEST["categorias"]) && !isset($_REQUEST["cestaCompra"]))
            {
                $_SESSION["categorias"]=$_REQUEST["categorias"];
            }else if(!isset($_REQUEST["cestaCompra"]) && !isset ($_SESSION["categorias"])){
                $_SESSION["categorias"]="CAM";
            }
            $arCategorias= Categoria::getCategorias();
            foreach ($arCategorias as $key=>$valor1) 
            {
                if(isset($_SESSION["categorias"]) && $_SESSION["categorias"]==$valor1["CODCAT"]){
        ?>
            <option value="<?=$valor1["CODCAT"]?>"  selected="true"><?=$valor1["NOMCAT"]?></option>
            <?php
                }else  {?>
            <option value="<?=$valor1["CODCAT"]?>"><?=$valor1["NOMCAT"]?></option>
            <?php
                }
            }
}
