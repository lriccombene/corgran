<?php
    namespace app\clases;
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;

class matriculacion {
    public $id_matriculacion;
    public $id_usuario; //directoria o ruta de archivo
    public $nro_resolucion;
    public $fec_resolucion;
    public $resolucion_baja;
    public $fec_resolucion_baja;
    public $fec_matricula;
    public $venc_matricula;
    

    public function __construct($id_matriculacion, $id_usuario,$nro_resolucion,$fec_resolucion
                                ,$resolucion_baja,$fec_resolucion_baja,$fec_matricula,$venc_matricula) 
    {
            $this->id_matriculacion=$id_matriculacion;
            $this->id_usuario=$id_usuario;
            $this->nro_resolucion=$nro_resolucion;
            $this->fec_resolucion=$fec_resolucion;
            $this->resolucion_baja=$resolucion_baja;
            $this->fec_resolucion_baja=$fec_resolucion_baja;
            $this->fec_matricula=$fec_matricula;
            $this->venc_matricula=$venc_matricula;

    } 
    
    public function guardar_matriculacion($obj_matri){
    	
    
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
		$sql= "SELECT * FROM `matriculacion` WHERE id_usuario=$obj_matri->id_usuario";
		$result = $conn->query($sql);
		$resultado="";

		if ($result->num_rows > 0) {
		echo "hay para actulizar matriculacion ".$result->num_rows ."----------------------------";

         
		    $sql = "Update matriculacion set   nro_resolucion =$obj_matri->nro_resolucion ,
										            	fec_resolucion ='$obj_matri->fec_resolucion',
											            resolucion_baja =$obj_matri->resolucion_baja ,
									                  fec_matricula ='$obj_matri->fec_matricula',
									                  venc_matricula ='$obj_matri->venc_matricula',
									                  fec_resolucion_baja ='$obj_matri->fec_resolucion_baja'
						WHERE id_usuario=$obj_matri->id_usuario";
         echo $sql;
		} else {
		       $sql = "INSERT INTO matriculacion (id_usuario,nro_resolucion,fec_resolucion_baja,fec_resolucion,resolucion_baja,fec_matricula,venc_matricula)
                		VALUES ($obj_matri->id_usuario,$obj_matri->nro_resolucion,'$obj_matri->fec_resolucion_baja',
	                         '$obj_matri->fec_resolucion',$obj_matri->resolucion_baja,
	                         '$obj_matri->fec_matricula','$obj_matri->venc_matricula')";
		}
		if ($conn->query($sql) === TRUE) {
			            $result = "OK";


	   } else {
	            echo "Error: " . $sql . "<br>" . $conn->error;
	   }
	   $conn->close();
	   echo "grabado ok matriculado";

    }
    
    public function borrar_matriculacion($id_matriculacion){
        
         // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Delete from matriculacion where id_matriculacion ='$id_matriculacion'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
    }
     
    
    public function buscar_matriculacion($id_usuario)
    {
        
        $conn = $obj_coneccion->conectar();

        $sql= "select id_matriculacion,id_usuario, mp, nro_resolucion, fec_resolucion,resolucion_baja,fec_matricula,venc_matricula
               from matriculacion  where id_usuario ='$id_usuario'";
        $resultado = mysqli_query($conn,$sql);
        $result=[];
        while ($fila = mysql_fetch_assoc($resultado)) {
            
            $obj_link_interes=new link_interes($fila["id_matriculacion"],$fila["id_usuario"],$fila["mp"],$fila["nro_resolucion"],
                                                $fila["fec_resolucion"],$fila["resolucion_baja"],$fila["fec_matricula"],
                                                $fila["venc_matricula"]);
            $result[]=$obj_link_interes;
        }
        return $result;    
    }
    
    public function actualizar_matriculacion($obj_matri)
    {
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update matriculacion set id_usuario='$obj_matri->id_usuario', mp='$obj_matri->mp',
                nro_resolucion ='$obj_matri->nro_resolucion',fec_resolucion ='$obj_matri->fec_resolucion',resolucion_baja ='$obj_matri->resolucion_baja'
                fec_matricula ='$obj_matri->fec_matricula',venc_matricula ='$obj_matri->venc_matricula' 
                where id_matriculacion ='$obj_matri->id_matriculacion'";
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
    }

    
}
?>
