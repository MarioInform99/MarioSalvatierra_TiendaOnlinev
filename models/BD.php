<?php

abstract class BD{
    
    const  user='root';
    const clave='';
    const server='localhost';
    const database='tienda_dwes20';


    protected function conectar()
    {
        try {
            $connection=new PDO("mysql:host=".self::server.";dbname=".self::database.";charset=utf8", self::user, self::clave);
            return $connection;
        } catch (Exception $ex) {
            echo 'Error en ejecucion:'.$ex->getMessage();
        }        
    }
    
}
