<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    namespace app\clases;
    //require_once 'clases/coneccion.php';
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;
    use  app\clases\coneccion;
	//$obj_coneccion = new coneccion(); //

/**
 * Description of cuotas
 *
 * @author soporte
 */

if(isset($_GET['nombre']) && isset($_GET['clave'])){
    $nombre = $_GET["nombre"];
    $clave = $_GET["clave"];

    $obj_usuario = new usuario();
    $obj_usuario->nombre= $nombre;
    $obj_usuario->clave= $clave;
    $obj_usuario->tipo_usu= "Administrador";
    $obj_usuario->guardar_usuario($obj_usuario);
}

if(isset($_POST['busqueda'])){
    session_start();
	$_SESSION['Buscar'] =TRUE;
    $nombre = $_POST["busqueda"];
	$_SESSION['nombre'] =$nombre;
    $obj_usuario = new usuario();
    $obj_usuario->Buscar_usuario($_POST["busqueda"]);
}
        
        
class usuario {
    public $id_usuario; //directoria o ruta de archivo
    public $tipo_usu;
    public $nombre;
    public $clave;
    public static $lista_usu =[
            [
                id_usuario =>1,
                tipo_usu => "Administrador",
                nombre => "Informatica",
                clave => "Telesur"
            ],
            [
                 id_usuario =>1,
                tipo_usu => "Administrador",
                nombre => "Informatica",
                clave => "Telesur"
            ],
            [
                id_usuario =>1,
                tipo_usu => "Administrador",
                nombre => "Informatica",
                clave => "Telesur"
            ]
        ];


    public function __construct($id_usuario,$tipo_usu,$nombre,$clave) {
            $this->id_usuario=$id_usuario;
            $this->tipo_usu=$tipo_usu;
            $this->nombre=$nombre;
            $this->clave=$clave;
            
    } 
        
    public function guardar_usuario($usuario){
		
                //return $result;
			
        // Create connection
        //$conn = $obj_coneccion->conectar();
        $servername = "localhost";
		$username = "root";
		$password = "slam2018";
		$dbname = "corgran";

			// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
		if ($conn->connect_error) {
		        die("Connection failed: " . $conn->connect_error);
		} 
        $sql = "INSERT INTO usuarios (nombre, tipo_usu, clave) VALUES ('$usuario->nombre','$usuario->tipo_usu', '$usuario->clave')";
        //print_r($sql);
        if ($conn->query($sql) === TRUE) {
            $result = $conn->lastInsertRowID();
        } else {
            $result = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
        return $result;

    }
    
    public function borrar_usuario($id_usuario){
        
         // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Delete from usuario where id_usuario ='$id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();


    }
    
    public static function Buscar_usuario($nombre) {


        $servername = "localhost";
		$username = "root";
		$password = "slam2018";
		$dbname = "corgran";

			// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
		if ($conn->connect_error) {
		        die("Connection failed: " . $conn->connect_error);
		} 
			$parte1= "SELECT id_usuario,nombre,clave,tipo_usu FROM `usuarios` WHERE nombre like '%";
			
		    $sql = $parte1. $_SESSION['nombre'] . "%'";
		    $result = $conn->query($sql);
		    $resultado=[];
		    if ($result->num_rows > 0) {
		        // output data of each row
		        while($row = $result->fetch_assoc()) {
					//var_dump($row);	                
					$obj_usu = new usuario($row["id_usuario"],$row["tipo_usu"],$row["nombre"],$row["clave"]);
		            $resultado[]=$obj_usu;
		        }

		    } else {
		        echo "0 results";
		    }

		    $conn->close();
			$_SESSION['resultado']=$resultado;
      		//return ==$resultado;

			header('Location: ../index.php');

    }
  
    
    public static function lista_usuarios()
    {
        
		$servername = "localhost";
		$username = "root";
		$password = "slam2018";
		$dbname = "corgran";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
        $sql = "SELECT id_usuario,nombre,clave,tipo_usu FROM `usuarios`";
        $result = $conn->query($sql);
        $resultado=[];
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
				//var_dump($row);	                
				$obj_usu = new usuario($row["id_usuario"],$row["tipo_usu"],$row["nombre"],$row["clave"]);
                $resultado[]=$obj_usu;
            }

        } else {
            echo "0 results";
        }
        //$_SESSION['Buscar']=FALSE;
        $conn->close();
        return $resultado;   
    }
    
    public function actualizar_usuario($obj_usu)
    {
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update usuario set tipo_usu='$obj_usu->id_usuario',nombre='$obj_usu->nombre',clave='$obj_usu->clave' where id_usuario ='$obj_usu->id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
        
    }
    

}
