<?php

    namespace app\clases;
    //require_once 'clases/coneccion.php';
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;
    use  app\clases\coneccion;
	//$obj_coneccion = new coneccion(); //
	

if(isset($_GET['btnAceptar'])){
	 //var_dump($_GET['DDLRol');
	// print_r("holaaaa");

	 	 $obj_colegiado= new colegiado();
		 $obj_colegiado->nro_colegiado =$_GET['txtColegiado'];
	    $obj_colegiado->rol =$_GET['DDLRol'];
	    $obj_colegiado->id_usuario =9;
	 	 $obj_colegiado->guardar_colegiado($obj_colegiado);
	 	 
	 
}

	//esto hay que modificarlo lo dejo en 9 para continuar pero tiene que llegar en la URL
	//$id_usuario=$_GET['id_usuario']	
/*	$id_usuario=9;
	$obj_colegiado= new colegiado();
	$obj_colegiado->nro_colegiado =$_POST['txtColegiado'];
	$obj_colegiado->rol =$_POST['DDLRol'];
	$obj_colegiado->id_usuario =9;
	$obj_colegiado->guardar_colegiado($obj_colegiado);
	*/
	/*$obj_delegacion = new delegacion();
	$obj_delegacion-> = $_GET[''];
		$obj_delegacion-> = $_GET[''];
			$obj_delegacion-> = $_GET[''];
				$obj_delegacion-> = $_GET[''];
					$obj_delegacion-> = $_GET[''];*/
//}

class colegiado{
    public $id_colegiado;
    public $id_usuario; //directoria o ruta de archivo
    public $nro_colegiado;
    public $rol;
    

    public function __construct($id_usuario,$id_colegiado,$nro_colegiado,$rol) {
            $this->id_usuario=$id_usuario;
            $this->id_colegiado=$id_colegiado;
            $this->nro_colegiado=$nro_colegiado;
            $this->rol=$rol;
            
            
    } 
        
    public function guardar_colegiado($colegiado){

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
		$sql= "SELECT * FROM `colegiado` WHERE id_usuario=$colegiado->id_usuario";
		$result = $conn->query($sql);
		$resultado="";
		//echo $result->num_rows;
		if ($result->num_rows > 0) {
		    $sql = "Update `colegiado` set nro_colegiado= $colegiado->nro_colegiado , rol=$colegiado->rol where id_usuario =$colegiado->id_usuario";
				
		} else {
		       $sql = "INSERT INTO colegiado (id_usuario, nro_colegiado, rol) VALUES ($colegiado->id_usuario,$colegiado->nro_colegiado,$colegiado->rol)";
		}
		if ($conn->query($sql) === TRUE) {
			            $result = "OK";

	   } else {
	            $result = "Error: " . $sql . "<br>" . $conn->error;
	   }
	   $conn->close();
	   echo "grabado ok";
    
    }

    public function borrar_colegiado($id_usuario){
        
         // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Delete from colegiado where id_usuario ='$id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
    }
    
   
    
    public function actualizar_colegiado($id_usuario, $nro_colegiado)
    {
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update colegiado set nro_colegiado='$nro_colegiado' where id_usuario ='$id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
        
    }
    
    
    
    
       
}
