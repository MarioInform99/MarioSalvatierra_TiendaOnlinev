<?php
/*su primer método definido ha de ser público y estático y llamarse
getCategorias. Devolverá la información de las categorías que necesites en los
siguientes apartados.*/
include_once './models/BD.php';
class Categoria extends BD{
 
    private $codcat;
    private $nomcat;
    function getCodcat() {
        return $this->codcat;
    }

    function getNomcat() {
        return $this->nomcat;
    }

    function setCodcat($codcat) {
        $this->codcat = $codcat;
    }

    function setNomcat($nomcat) {
        $this->nomcat = $nomcat;
    }    
    public  static function getCategorias()
    {
        $sql="SELECT CODCAT,NOMCAT FROM CATEGORIAS";
        $con=parent::conectar();
        $sent= $con->query($sql, PDO::FETCH_ASSOC);
        if($sent)
        {
            return $sent->fetchAll();
        }
    }
   
}
