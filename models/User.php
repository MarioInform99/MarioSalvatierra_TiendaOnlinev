<?php


/**
 * Description of User
 *
 * @author Mario
 */
include_once './models/BD.php';
class User extends BD{
    public  $user;
    public $password;
    
    public function __construct($user,$passwd) {
        $this->user=$user;
        $this->password=$passwd;
    }
            
    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    public  function login()
    {
        $found=FALSE;
        try{
            $conexion= parent::conectar();
            $sql="SELECT USUARIO, PASSWORD FROM USUARIOS WHERE USUARIO='$this->user';";
            $sent= $conexion->query($sql, PDO::FETCH_OBJ);
            if($sent && $sent->rowCount()==1)
            {
                $user=$sent->fetchObject(); 
                if(password_verify($this->password, $user->PASSWORD))
                {
                    $found=TRUE;
                }
            }
            return $found;
            
        } catch (PDOException $ex)
        {
            echo "Error".$ex->getMessage();
        }
    }
}
