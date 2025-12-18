<?php
include_once "Usuario.php";
include_once "Dinosaurio.php";

//Constantes para la conexion
define("SERVER_DB", "localhost");
define("DATABASE", "reino_prehistorico");
define("DB_USER", "root");
define("DB_PASSWD", "");

//Acceso a los datos
class AccesoDatos {
    private static $modelo = null;
    private $dbh = null;
    private $stmt_dinosaurios = null;
    private $stmt_creauser = null;
    private $stmt_usuario  = null;
    private $stmt_añadirvoto  = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
     
   //Constructor privado
    private function __construct(){  
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

        //Creacion y preparacion de las consultas
        $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        try {
            //FALTA-----
        $this->stmt_dinosaurios  = $this->dbh->prepare("select * from Usuarios");
        $this->stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        $this->stmt_usuario   = $this->dbh->prepare("select * from Usuarios where id=:id");
        $this->stmt_añadirvoto   = $this->dbh->prepare("update Usuarios set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        } catch ( PDOException $e){
            echo " Error al crear la sentencias ".$e->getMessage();
            exit();
        }
    }

    //Cierre de la conexión
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->stmt_dinosaurios = null;
            $obj->stmt_creauser = null;
            $obj->stmt_usuario  = null;
            $obj->stmt_añadirvoto  = null;
            $obj->dbh = null;
            self::$modelo = null; 
        }
    }

    //Devuelvo la lista de Dinosaurios
    public function getDinosaurios ():array {
        $tdinosaurio = [];
        $this->stmt_dinosaurios->setFetchMode(PDO::FETCH_CLASS, 'Dinosaurio');
        
        if ( $this->stmt_dinosaurios->execute() ){
            while ( $dinosaurio = $this->stmt_dinosaurios->fetch()){
               $tdinosaurio[]= $dinosaurio;
            }
        }
        return $tdinosaurio;
    }
    
    //Dar de alta a un usuario
    public function addUsuario($user):bool{
        
        $this->stmt_creauser->execute( [$user->login, $user->nombre, $user->password, $user->comentario]);
        $resu = ($this->stmt_creauser->rowCount () == 1);
        return $resu;
    }

    //Devuelvo un usuario o false
    public function getUsuario (String $login) {
        $user = false;
        
        $this->stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $this->stmt_usuario->bindParam(':id', $login);
        if ( $this->stmt_usuario->execute() ){
             if ( $obj = $this->stmt_usuario->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }
    
    /*Votar por dinosaurio
    public function votarDinosaurio($usuario,$dinosaurio):bool{
      
        $this->stmt_moduser->bindValue(':login',$user->login);
        $this->stmt_moduser->bindValue(':nombre',$user->nombre);
        $this->stmt_moduser->bindValue(':password',$user->password);
        $this->stmt_moduser->bindValue(':comentario',$user->comentario);
        $this->stmt_moduser->execute();
        $resu = ($this->stmt_moduser->rowCount () == 1);
        return $resu;
    }
*/
     // Evito que se pueda clonar el objeto
    public function __clone(){ 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
?>