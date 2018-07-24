<?php


    namespace app\clases;
    //require_once 'clases/coneccion.php';
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;
    use  app\clases\coneccion;
	//$obj_coneccion = new coneccion(); //

//$obj_coneccion = new coneccion(); //

if (isset($_GET['buscar_colegiado'])){
	session_start();
	$_SESSION['Buscar'] =TRUE;
	/*$obj_dts_perso= new datos_personales();
	$obj_dts_perso->apellido=$_GET['apellido'];
	$obj_dts_perso->buscar_dts_perso_ape($obj_dts_perso);
	*/
}


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
    
    public function buscar_dts_perso_ape($obj_dts_perso)
    {
		//echo "holaaaaaaaaaa buscando";
	     $servername = "localhost";
			$username = "root";
			$password = "slam2016";
			$dbname = "corgran";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
		/*	if ($conn->connect_error) {
				echo("Connection failed: " . $conn->connect_error);
      
        $sql= "select id_datos_personales, id_usuario, apellido, nombre,dni,cuit_cuil,fec_nac from datos_personales where apellido=$obj_dts_perso";
        $resultado = mysqli_query($conn,$sql);
        $resul=[];
        
        while ($fila = mysql_fetch_assoc($resultado)) {
            
            $obj_perso=new datos_personales($fila["id_datos_personales"],$fila["id_usuario"],$fila["apellido"],$fila["nombre"],
                                                $fila["dni"],$fila["cuit_cuit"],$fila["fec_nac"]);
            $resul[]=$obj_perso;
        }
			$_SESSION['resultado']=$resul[];
			*/header('Location: ../index.php');
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
			//echo "------------MP:". $obj_dts_perso->mp."-----------------------------";
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
   public static function lista_dts_perso()
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
        $sql = "SELECT * FROM `datos_personales`";
        $result = $conn->query($sql);
        $resultado=[];
        if ($result->num_rows > 0) {
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
				//var_dump($row);	                
				$obj_dts_perso = new datos_personales($row["id_datos_personales"],$row["apellido"], $row["nombre"],$row["dni"],$row["cuit_cuil"]
														 ,$row["fec_nac"],$row["id_usuario"],$row["mp"]);
                $resultado[]=$obj_dts_perso;
            }

        } else {
            echo "0 results";
        }
        //$_SESSION['Buscar']=FALSE;
        $conn->close();
        return $resultado;   
    }
    
     public static function paginado_dts_perso(){
    
  //primero obtenemos el parametro que nos dice en que pagina estamos
		    $page = 1; //inicializamos la variable $page a 1 por default
		    if(array_key_exists('pg', $_GET)){
		        $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
		    }
		    //ahora que tenemos en que pagina estamos obtengamos los resultados:
		    // a) el numero de registros en la tabla
		    $mysqli = new mysqli("localhost","root","slam2016","corgran");
		    if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}


		    $conteo_query =  $mysqli->query("SELECT COUNT(*) as conteo FROM datos_personales");
		    $conteo = "";
		    if($conteo_query){
		    	while($obj = $conteo_query->fetch_object()){ 
		    	 	$conteo =$obj->conteo; 
		    	}
		    }
		    $conteo_query->close(); 
		    unset($obj); 
    		
		    //ahora dividimos el conteo por el numero de registros que queremos por pagina.
		    $max_num_paginas = intval($conteo/10); //en esto caso 10
			
		    // ahora obtenemos el segmento paginado que corresponde a esta pagina
		    $segmento = $mysqli->query("SELECT *  FROM datos_personales LIMIT ".(($page-1)*10).", 10 ");
          $resultado=[];
		    //ya tenemos el segmento, ahora le damos output.
		    if($segmento){
			  // echo '<table>';
			    while($obj2 = $segmento->fetch_object())
			    {
			    	$obj_dts_perso = new usuario($obj2->id_usuario,$obj2->tipo_usu,$obj2->nombre,$obj2->clave);
                $resultado[]=$obj_dts_perso;
			     /* echo '<tr>
			                   <td>'.$obj2->id_usuario.'</td>
			                   <td>'.$obj2->tipo_usu.'</td>
			                   <td>'.$obj2->nombre.'</td>
			             </tr>'; 
			   */ }
			   // echo '</table><br/><br/>';
			}
	
		    //ahora viene la parte importante, que es el paginado
		    //recordemos que $max_num_paginas fue previamente calculado.
		    for($i=0; $i<$max_num_paginas;$i++){

		       echo '<a href="index.php?pg='.($i+1).'">'.($i+1).'</a> | ';
		       
		    }  
		    echo '<div>-------------------------- PAginacion------------------------------------------------</div>';    
            return $resultado;  
    
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
