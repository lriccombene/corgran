<?php

    namespace app\clases;
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;

//$obj_coneccion = new coneccion(); //


class titulo {
    public $id_titulo;
    public $id_usuario; 
    public $expedido_por;
    public $fec_egreso;
    public $descripcion;
    

    public function __construct($id_usuario,$id_titulo,$expedido_por,$fec_egreso,$descripcion) {
            $this->id_usuario=$id_usuario;
            $this->id_titulo=$id_titulo;
            $this->expedido_por=$expedido_por;
            $this->fec_egreso=$fec_egreso;
            $this->descripcion=$descripcion;
            
    } 
    public function guardar_titulo($obj_titulo){


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
	   
		$sql= "SELECT * FROM `titulo` WHERE id_usuario=$obj_titulo->id_usuario";
		$result = $conn->query($sql);

		echo "NRO de ROWESSSS:".$result->num_rows;
		if ($result->num_rows > 0) {
			
		 //echo "titulo".$obj_titulo->expedido_por ."--". $obj_titulo->fec_egreso ."--". $obj_titulo->descripcion;
		 
		            $sql = "Update titulo set expedido_por = $obj_titulo->expedido_por, fec_egreso='$obj_titulo->fec_egreso',
                descripcion = $obj_titulo->descripcion WHERE id_usuario=$obj_titulo->id_usuario";
		} else {
					
		        $sql ="INSERT INTO titulo (id_usuario, expedido_por, fec_egreso,descripcion)
                VALUES ($obj_titulo->id_usuario,$obj_titulo->expedido_por, 
                        '$obj_titulo->fec_egreso',$obj_titulo->descripcion)";		
		}
		if ($conn->query($sql) === TRUE) {
			            $result = "OK";

	   } else {
	            echo "Error: " . $sql . "<br>" . $conn->error;
	   }
	   $conn->close();

    }  
    public function borrar_titulo($id_titulo){
        
         // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Delete from titulo where id_titulo ='$id_titulo'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
    }
    
    public function buscar_titulo($id_titulo)
    {
        
        $conn = $obj_coneccion->conectar();

        $sql= "select id_titulo,id_usuario, expedido_por, fec_egreso,descripcion
               from titulo where='$id_titulo'";
        $resultado = mysqli_query($conn,$sql);
        $result=[];
        while ($fila = mysql_fetch_assoc($resultado)) {
            
            $obj_titulo=new titulo($fila["id_titulo"],$fila["id_usuario"],$fila["expedido_por"],$fila["fec_egreso"],$fila["descripcion"]);
            $result[]=$obj_titulo;
        }
        return $result;    
    }

    public function actualizar_titulo($obj_titulo)
    {
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update titulo set expedido_por='$obj_titulo->expedido_por', fec_egreso='$obj_titulo->fec_egreso',
                descripcion ='$obj_titulo->descripcion' where id_titulo ='$obj_titulo->id_titulo'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
    } 
    
}
