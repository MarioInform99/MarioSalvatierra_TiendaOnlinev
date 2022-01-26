<?php
include_once './controllers/Cesta.php';
$ArCesta=Cesta::cargarCesta();

if(isset($_SESSION["cestaCompra"])){

    foreach ($ArCesta["Productos"] as $indice=>$value)
    {
        foreach ($ArCesta["Cesta"] as $key=>$valores)
        {
            foreach($valores as $valor=>$v)
            {
                if($value["CODPRO"]==$valor){
                    echo "Cesta:".$key."->".$valor."->Cantidad:".$v."<br/>";
                }
            }
        }
    }
    
}else{
    echo "Cesta vacia";
}

