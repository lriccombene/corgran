<?php

    namespace app\clases;

    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;
    use  app\clases\coneccion;
	//$obj_coneccion = new coneccion(); //
	set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__ . '/..'),
    get_include_path()
	)));
	
	require_once 'clases/delegacion.php';	
	require_once 'clases/datos_personales.php';
	require_once 'clases/matriculacion.php';
	require_once 'clases/titulo.php';



if(isset($_GET['btnAceptar'])){
	 //var_dump($_GET['DDLRol');
	// print_r("holaaaa");

	 	 $obj_colegiado= new colegiado();
		 $obj_colegiado->nro_colegiado =$_GET['txtColegiado'];
	    $obj_colegiado->rol =$_GET['DDLRol'];
	    $obj_colegiado->id_usuario =9;
	 	 $obj_colegiado->guardar_colegiado($obj_colegiado);
	 	 
	 	 $obj_delegacion = new delegacion();
	    $obj_delegacion->delegacion = $_GET['DDLDelegacion'];
		 $obj_delegacion->localidad = $_GET['DDLLocalidad'];
		 $obj_delegacion->mes = $_GET['DDLMes'];
		 $obj_delegacion->anio = $_GET['DDLAnio'];
		 $obj_delegacion->id_usuario = 9;
		 $obj_delegacion->guardar_delegacion($obj_delegacion);
		 
		 //-------DATOS PERSONALES------------
		 $obj_dto_person= new datos_personales();
		 $obj_dto_person->apellido =$_GET['txtApellido'];
	    $obj_dto_person->nombre =$_GET['txtNombre'];
	    $obj_dto_person->dni =$_GET['txtDNI'];
	    $obj_dto_person->cuit_cuil =$_GET['txtCUIT'];
	    $obj_dto_person->fec_nac =$_GET['txtFecNac'];
	    $obj_dto_person->mp =$_GET['txtMP'];
	    $obj_dto_person->id_usuario =9;
	 	 $obj_dto_person->guardar_datos_personales( $obj_dto_person);

		 $obj_matriculacion = new matriculacion();
		 $obj_matriculacion->nro_resolucion =$_GET['txtNroResolucion'];
	    $obj_matriculacion->fec_resolucion=$_GET['txtFechaResolucion'];
	    $obj_matriculacion->resolucion_baja =$_GET['txtResolucionBaja'];
	    $obj_matriculacion->fec_resolucion_baja=$_GET['txtFechaResolucionBaja'];
	    $obj_matriculacion->fec_matricula =$_GET['txtFechaMP'];
		 $obj_matriculacion->venc_matricula =$_GET[txtVencMP];
	    $obj_matriculacion->id_usuario =9;
		//	echo $obj_matriculacion->nro_resolucion ."--". $obj_matriculacion->fec_resolucion ."--". $obj_matriculacion->resolucion_baja 
		//	."--".$obj_matriculacion->fec_resolucion_baja ."--".$obj_matriculacion->fec_matricula."--".$obj_matriculacion->id_usuario;	 	 
	 	 $obj_matriculacion->guardar_matriculacion( $obj_matriculacion);
	 	 
		 $obj_matriculacion = new titulo();
		 $obj_matriculacion->nro_resolucion =$_GET['txtTitulo'];
	    $obj_matriculacion->fec_resolucion=$_GET['txtFechaResolucion'];
	    $obj_matriculacion->resolucion_baja =$_GET['txtResolucionBaja'];
	    $obj_matriculacion->id_usuario =9;
		//	echo $obj_matriculacion->nro_resolucion ."--". $obj_matriculacion->fec_resolucion ."--". $obj_matriculacion->resolucion_baja 
		//	."--".$obj_matriculacion->fec_resolucion_baja ."--".$obj_matriculacion->fec_matricula."--".$obj_matriculacion->id_usuario;	 	 
	 	 $obj_matriculacion->guardar_matriculacion( $obj_matriculacion);
	 	 
	 	 
	 	 
	 	 
	 
}

	//esto hay que modificarlo lo dejo en 9 para continuar pero tiene que llegar en la URL
	//$id_usuario=$_GET['id_usuario']	
/*	$id_usuario=9;
*/

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
	   echo "grabado ok colegiado";
    
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
