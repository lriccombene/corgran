<?php

    namespace app\clases;
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;

//$obj_coneccion = new coneccion(); //



class datos_personales{
    public $id_datos_personales;
    public $apellido; //directoria o ruta de archivo
    public $nombre; 
    public $dni;
    public $cuit_cuil;
    public $fec_nac;
    public $id_usuario;
    public $mp;
    

    public function __construct($id_datos_personales, $apellido, $nombre,$dni,$cuit_cuil,$fec_nac,$id_usuario,$mp) {
            $this->id_datos_personales=$id_datos_personales;
            $this->apellido=$apellido;
            $this->nombre=$nombre;
            $this->dni=$dni;
            $this->cuit_cuil=$cuit_cuil;
            $this->fec_nac=$fec_nac;
            $this->id_usuario=$id_usuario;
            $this->mp=$mp;
            
    } 
    
    public function guardar_datos_personales($obj_dts_perso){
		/*echo "estamos en datos personales".$obj_dts_perso->apellido.', '.$obj_dts_perso->nombre.','.$obj_dts_perso->dni.',
		        '.$obj_dts_perso->cuit_cuil.','.$obj_dts_perso->fec_nac.','.$obj_dts_perso->mp."----".$obj_dts_perso->id_usuario;*/
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
	   
		$sql= "SELECT * FROM `datos_personales` WHERE id_usuario=$obj_dts_perso->id_usuario";
		$result = $conn->query($sql);


		if ($result->num_rows > 0) {
		            $sql = "Update datos_personales set apellido=$obj_dts_perso->apellido, nombre=$obj_dts_perso->nombre,
                dni=$obj_dts_perso->dni,cuit_cuil=$obj_dts_perso->cuit_cuil,fec_nac='$obj_dts_perso->fec_nac',
                mp=$obj_dts_perso->mp where id_usuario =$obj_dts_perso->id_usuario";
		} else {
					
		        $sql ="INSERT INTO `datos_personales`( `apellido`, `nombre`, `dni`, `cuit_cuil`, `fec_nac`, `id_usuario`, `mp`) 
		        VALUES ($obj_dts_perso->apellido,$obj_dts_perso->nombre,$obj_dts_perso->dni,$obj_dts_perso->cuit_cuil,
		        '$obj_dts_perso->fec_nac',$obj_dts_perso->id_usuario,$obj_dts_perso->mp)"; 
				echo $sql ;		
		}
		if ($conn->query($sql) === TRUE) {
			            $result = "OK";

	   } else {
	            echo "Error: " . $sql . "<br>" . $conn->error;
	   }
	   $conn->close();

    

    }
  /*  
    public function borrar_datos_personales($id_usuario){
        
         // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Delete from datos_personales where id_usuario ="$id_usuario;
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $conn->close();
    }     
    
    public function buscar_datos_personales($id_usuario):
    {
        $conn = $obj_coneccion->conectar();
        $sql= "select id_datos_personales, id_usuario, apellido, nombre,dni,cuit_cuil,fec_nac from datos_personales where id_usario="$id_usuario;
        $resultado = mysqli_query($conn,$sql);
        
        while ($fila = mysql_fetch_assoc($resultado)) {
            
            $obj_colegiado=new datos_personales($fila["id_datos_personales"],$fila["id_usuario"],$fila["apellido"],$fila["nombre"],
                                                $fila["dni"],$fila["cuit_cuit"],$fila["fec_nac"]);
            
        }
        return $obj_colegiado;    
    }
    
    public function actualizar_datos_personales($obj_dts_perso)
    {
        // Create connection
        $conn = $obj_coneccion->conectar();
        
        $sql = "Update datos_personales set apellido='$obj_dts_perso->apellido', nombre='$obj_dts_perso->nombre',
                dni='$obj_dts_perso->dni',cuit_cuit='$obj_dts_perso->cuit_cuit',fec_nac='$obj_dts_perso->fec_nac'                  
                where id_usuario ="$id_usuario;
        
        mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $conn->close();
    }
    */
}
?>
