<?php
/*Productos de la tienda*/
include_once './models/BD.php';
class Producto extends BD{
    public $codpro;
    public $nompro;
    public $descpro;
    public $precio;
    public $codcat;
    public $foto;
    public $stock;
    
    function getCodpro() {
        return $this->codpro;
    }

    function getNompro() {
        return $this->nompro;
    }

    function getDescpro() {
        return $this->descpro;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getCodcat() {
        return $this->codcat;
    }

    function getFoto() {
        return $this->foto;
    }

    function getStock() {
        return $this->stock;
    }

    function setCodpro($codpro) {
        $this->codpro = $codpro;
    }

    function setNompro($nompro) {
        $this->nompro = $nompro;
    }

    function setDescpro($descpro) {
        $this->descpro = $descpro;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setCodcat($codcat) {
        $this->codcat = $codcat;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

        
    public function getSelectSQL($objt)
    {
        $arPropiedades= get_object_vars($objt);
        $condicionalesSql='';
        foreach($arPropiedades as $nombrePropiedad=>$valor)
        {
            if(!is_null($valor))
            {
                $condicionalesSql.= strtoupper($nombrePropiedad)."='".$valor."' AND ";
            }
        }
        $condicionalesSql= substr($condicionalesSql, 0,-4); //Elimio el ultimo AND 
        return $condicionalesSql;
    }
    public static function getProductos($condicional){
        
        if(empty($condicional) && is_null($condicional)){
            $condicional= 1;
        }
        try{
            $sql="SELECT CODPRO,NOMPRO,DESCPRO,PRECIO,CODCAT,FOTO,STOCK FROM"
                    . " PRODUCTOS WHERE $condicional";
            $con= parent::conectar();
            $sent=$con->query($sql, PDO::FETCH_ASSOC);
            if($sent)
            {
                return $sent->fetchAll();
            }
        } catch (PDOException $ex)
        {
            echo "Error ".$ex->getMessage();
        }
    }
    
    public static function updateStock($array)
    {
        if(count($array)>0 && isset($array["cantidadTotalBBDD"])){
            try{
                foreach ($array["cantidadTotalBBDD"] as $codPro=>$cantidadStock)
                {
                    $sql="UPDATE PRODUCTOS SET STOCK=:stock WHERE CODPRO=:codPro";
                    $conexion= parent::conectar();
                    $sent=$conexion->prepare($sql);
                    $sent->bindParam(":stock", $cantidadStock);
                    $sent->bindParam(":codPro", $codPro);
                    $sent->execute();
                }

            } catch (PDOException $ex)
            {
                echo "Error en ".$ex->getMessage();
            }
        }
        return FALSE;
    }
    
    public static function add_NewProduct($array)
    {
        try{
            $conexion= parent::conectar();
            if(isset($array["foto"])){$foto=$array["foto"];}else{$foto='';}
            if(isset($array["descpro"])){$despc=$array["descpro"];}else{$despc='';}
            $sql="INSERT INTO PRODUCTOS(CODPRO, DESCPRO, PRECIO, CODCAT, FOTO, STOCK) VALUES "
                    . " ('".$array["codpro"]."','".$despc."','".$array["precio"]."','".$array["codcat"]."',"
                    . " '".$foto."','0')";
            $sent=$conexion->exec($sql);
            if($sent)
            {
                return true;
            }else{
                return FALSE;
            }
           echo "Hola va bien?";
        } catch (PDOException $ec)
        {
            echo 'Error->'.$ec->getMessage();
        }
    }
    
    public static function codeProduct($code)
    {
        $code= strtoupper($code);
        $valido=true;
        if(strlen($code)==4)
        {
            if(is_numeric(substr($code,0,1)))
            {
                if(is_string(substr($code, 1,3)))
                {
                    for($i=0; $i<strlen($code); $i++)
                    {
                        if($i!=0){
                            if(is_numeric(substr($code, $i,1)))
                            {
                                $valido=false;
                            }
                        }
                    }
                }
            }else{
                $valido=FALSE;
            }
        }else{
            $valido=false;
        }
        return $valido;
    }
    
    public static function modifyProduct($nombre,$valor,$codPro)
    {
        try{
            $conexion= parent::conectar();
            $verify=FALSE;
                $sql="UPDATE PRODUCTOS SET $nombre='$valor' WHERE CODPRO='$codPro'";
                $sent=$conexion->exec($sql);
                    if($sent)
                    {
                        $verify=true;
                    }else{
                        $verify=FALSE;
                    }
            return $verify;
            
        } catch (PDOException $ex)
        {
            echo "Error ->".$ex->getMessage();
        }
    }
    public static function  delete_Product($code)
    {
        try{
            $conexion= parent::conectar();
            $sql="DELETE FROM PRODUCTOS WHERE CODPRO='$code'";
            $sent=$conexion->exec($sql);
            if($sent)
            {
                return true;
            }
        } catch (PDOException $ex)
        {
            echo "Error-> ".$ex->getMessage();
        }
        return FALSE;
    }
}
