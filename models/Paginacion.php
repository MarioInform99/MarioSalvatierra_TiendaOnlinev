<?php

/**
 * Description of Paginacion
 *
 * @author Mario
 */
include_once './models/BD.php';
class Paginacion extends BD{
    public $table;
    
    public function __construct($tabla) {
        $this->table=$tabla;
    }
            
    public function getTotalElementos($filasPaginaporPagina,$codCat) {
        $conn = parent::conectar();
        try {
            $sql ="SELECT * FROM ".$this->table." WHERE CODCAT='".$codCat."';";
            $resul = $conn->query($sql);
            $numRegistros = $resul->rowCount();
        } catch (PDOException $ex) {
            die("Error" . $ex->getMessage());
        }
        $totalPaginas = intval($numRegistros / $filasPaginaporPagina);
        if ($numRegistros % $filasPaginaporPagina)
            $totalPaginas++;
        return $totalPaginas;
    }

    public function getBloqueReservas($registroInicio, $filasPagina,$codCat) {
        $conn = parent::conectar();
        try {
                    $sql="SELECT * FROM $this->table WHERE CODCAT='$codCat'"
                           . " limit " . ($registroInicio - 1) * $filasPagina. "," . $filasPagina . ";";
                
               $result = $conn->query($sql);
            if($result){
                
                return $result->fetchAll();
            } else {
                echo "Mal";
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
        }
    }

    public  function dibujarBloquePaginacionReservas($nPagina, $totalPaginas) {
        echo "<nav><ul class='pagination'>";
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($nPagina == $i) {
                echo "<li class='page-item active'><a class='page-link' href='#' onclick='paginacionAjax($i)'>" . $i . "</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='#' onclick='paginacionAjax($i)'>" . $i . "</a></li>";
            }
        }
        echo "</ul></nav>";
    }
}

