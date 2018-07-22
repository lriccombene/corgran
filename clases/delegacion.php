<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    namespace app\clases;
    require_once 'clases/coneccion.php';
    use \mysqli;
    use \mysqli_query;
    use \mysqli_error;
    use \mysql_fetch_assoc;
    use  app\clases\coneccion;
	$obj_coneccion = new coneccion; //
/**
 * Description of cuotas
 *
 * @author soporte
 */
class delegacion {
    public $id_delegacion;
    public $delegacion;
    public $localidad; //directoria o ruta de archivo
    public $mes ;
    public $anio;
    public $id_usuario;
    
    public function __construct($id_delegacion,$delegacion,$localidad,$mes,$anio,$id_usuario) {
            $this->id_delegacion=$id_delegacion;
            $this->delegacion=$delegacion;
            $this->localidad=$localidad;
            $this->mes=$mes;
            $this->anio=$anio;
            $this->id_usuario=$id_usuario;
    } 
    
    public function guardar_delegacion($obj_delegacion){
		echo("holaaa estoy en guardar");
	
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
		//----busca si existe para saber que query ejecutar insert o update 
		$sql= "SELECT * FROM `delegacion` WHERE id_usuario='$obj_delegacion->id_usuario'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		        // output data of each row
			$sql = "Update `delegacion` set delegacion='$obj_delegacion->delegacion',localidad='$obj_delegacion->localidad', mes='$obj_delegacion->mes',
                anio='$obj_delegacion->anio' where id_usuario ='$obj_delegacion->id_usuario'";
		}else {
        $sql = "INSERT INTO `delegacion` (delegacion,localidad, mes, anio,id_usuario)
        			VALUES ('$obj_delegacion->delegacion','$obj_delegacion->localidad','$obj_delegacion->mes', 
        			'$obj_delegacion->anio','$obj_delegacion->id_usuario')";
        
		}
		
      if ($conn->query($sql) === TRUE) {
            $result = "OK";
      } else {
            $result = "Error: " . $sql . "<br>" . $conn->error;
      }
        $conn->close();
		echo "llegue al final";        
       
        
        
        
        
        

    }
    public function borrar_delegacion($id_usuario){
        
         // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Delete from delegacion where id_usuario ='$id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();

    }
    
    public function buscar_delegacion($id_usuario)
    {
        
        $conn = $obj_coneccion->conectar();

        $sql= "select id_delegacion, localidad, mes, anio,id_usuario
               from delegacion  where id_usuario ='$id_usuario'";
        $resultado = mysqli_query($conn,$sql);
        $result=[];
        while ($fila = mysql_fetch_assoc($resultado)) {
            
            $obj_delegacion=new delegacion($fila["id_delegacion"],$fila["delegacion"],$fila["localidad"],$fila["mes"],
                                          $fila["anio"],$fila["id_usuario"]);
            $result[]=$obj_delegacion;
        }
        return $result;    
    }   
    
    public function actualizar_delegacion($obj_delegacion)
    {
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update delegacion set delegacion='$obj_delegacion->delegacion',localidad='$obj_delegacion->localidad', mes='$obj_delegacion->mes',
                anio='$obj_delegacion->anio' where id_usuario ='$obj_delegacion->id_usuario'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();

    }

    
}
