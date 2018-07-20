<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    namespace app\clases;
    require_once 'clases/coneccion.php';
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;
    use  app\clases\coneccion;
	$obj_coneccion = new coneccion(); //

/**
 * Description of cuotas
 *
 * @author soporte
 */

if(isset($_POST['nombre']) && isset($_POST['clave'])){
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $clave = $_POST["clave"];
    $obj_usuario = new usuario();
    $obj_usuario->nombre= $nombre;
    $obj_usuario->clave= $clave;
    $obj_usuario->tipo_usu= "Administrador";
    $obj_usuario->guardar_usuario($obj_usuario);
}

if($_POST['valorBusqueda']){
    var_dump("holaaaaaaaaaaaaa");
    $nombre = $_POST["valorBusqueda"];
    $obj_usuario = new usuario();
    $obj_usuario->Buscar_usuario($nombre);
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
		//print_r($usuario->nombre);
		$con = mysqli_connect('localhost', 'root', 'slam2016', 'corgran') or die('Error al intentar conectarse a la base de datos.');
                //$con = $obj_coneccion->conectar();
                mysqli_query($con, 'SET NAMES "utf8"');
		$consulta = "INSERT INTO usuarios (nombre, tipo_usu, clave) VALUES ('$usuario->nombre','$usuario->tipo_usu', '$usuario->clave')";
		if(mysqli_query($con, $consulta)){
		   echo 'Registro insertado correctamente.';
                //   $result = $conn->lastInsertRowID();
		}else{
		   echo 'Error: ' . mysqli_error($con);
		}
		mysqli_close($con);
                //return $result;
			
        // Create connection
        //$conn = $obj_coneccion->conectar();
        
       // $sql = 
        //print_r($sql);
       // if ($conn->query($sql) === TRUE) {
       //     $result = $conn->lastInsertRowID();
       // } else {
       /*     $result = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
        return $result;
*/
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
	$password = "slam2016";
	$dbname = "corgran";

		// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
	if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
	} 
        $sql = "SELECT id_usuario,nombre,clave,tipo_usu FROM `usuarios` where WHERE nombre like '%$nombre%' ";
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
        $_SESSION['Buscar'] =TRUE;
        $conn->close();
        return $resultado; 
        
    }
    
    
    public static function lista_usuarios()
    {
        
		$servername = "localhost";
		$username = "root";
		$password = "slam2016";
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
        $_SESSION['Buscar']=FALSE;
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
{
        
		$servername = "localhost";
		$username = "root";
		$password = "slam2016";
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
        $conn->close();
        return $resultado;   
    }
{
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update usuario set tipo_usu='$obj_usu->id_usuario',nombre='$obj_usu->nombre',clave='$obj_usu->clave' where id_usuario ='$obj_usu->id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
        
    }
{
            $lista_usuario =  $this->$lista_usu();  
    }
{        
        $persona1 = new usuario(1,'mariano', '38', 'Administrador');
        $persona2 = new usuario(2,'juan', '5', 'M', 'Administrador');
        $persona3 = new usuario(3,'ivan', '15', 'M', 'Administrador');
        $persona4 = new usuario(4,'valeria', '37', 'F', 'Administrador');
        $persona5 = new usuario(5,'berenice', '18', 'F', 'Administrador');
        return [
            $persona1, $persona2, $persona3, $persona4, $persona5
        ];
    }
