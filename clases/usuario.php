<?php


    namespace app\clases;
    //require_once 'clases/coneccion.php';
    use mysqli;
    use mysqli_query;
    use mysqli_error;
    use mysql_fetch_assoc;
    use  app\clases\coneccion;
	//$obj_coneccion = new coneccion(); //

if(isset($_POST['actualizarUsuBoton'])){
	 //var_dump($_POST['contra');
	 $nombre = $_POST["nombre"];
    $clave = $_POST["contra"];
    $id_usuario= $_POST["id_usu"];
    $obj_usuario = new usuario();
    $obj_usuario->nombre= $nombre;
    $obj_usuario->clave= $clave;
    $obj_usuario->tipo_usu= "Administrador";
    $obj_usuario->id_usu= $id_usuario;
    
    $obj_usuario->actualizar_usuario($obj_usuario);
}

//pasadatos para guardar usuario
if(isset($_POST['nombre']) && isset($_POST['contra'])){
	if($_POST['nombre']) {
    $nombre = $_POST["nombre"];
    $clave = $_POST["contra"];

    $obj_usuario = new usuario();
    $obj_usuario->nombre= $nombre;
    $obj_usuario->clave= $clave;
    $obj_usuario->tipo_usu= "Administrador";
    
    $obj_usuario->guardar_usuario($obj_usuario);
 }
}

//busca con fiultro usuario
if(isset($_POST['busqueda'])){
    session_start();
	$_SESSION['Buscar'] =TRUE;
    $nombre = $_POST["busqueda"];
	$_SESSION['nombre'] =$nombre;
    $obj_usuario = new usuario();
    $obj_usuario->Buscar_usuario($_POST["busqueda"]);
}

//elimina usuario
if(isset($_POST['valorCaja1'])) {
 	//session_start();
	//$_SESSION['valorCaja1']=$_POST['valorCaja1'];
	
	$id_usuario=$_POST['valorCaja1'];
	
	$obj_usuario = new usuario();
    $obj_usuario->borrar_usuario($id_usuario);


}

//busca usuario por id  para acutalizar
if(isset($_POST['actualizarUsu'])) {
 	//session_start();
	//$_SESSION['valorCaja1']=$_POST['valorCaja1'];
	
	 $id_usuario=$_POST['actualizarUsu'];
	
	 $obj_usuario = new usuario();
    $obj_usuario->Buscar_usuario_por_id($id_usuario);


}

        
class usuario {
    public $id_usuario; //directoria o ruta de archivo
    public $tipo_usu;
    public $nombre;
    public $clave;
   


    public function __construct($id_usuario,$tipo_usu,$nombre,$clave) {
            $this->id_usuario=$id_usuario;
            $this->tipo_usu=$tipo_usu;
            $this->nombre=$nombre;
            $this->clave=$clave;
            
    } 
        
    public function guardar_usuario($usuario){
	
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
			header('Location: ../index.php');

    }
    
    public function borrar_usuario($id_usuario){

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
        
        $sql = "Delete from `usuarios` where id_usuario =".$id_usuario;        

		if ($conn->query($sql) === TRUE) {
    		echo "El registro se elimino correctamente";
		} else {
    		echo "Error deleting record: " . $conn->error;
		}

		$conn->close();
		header('Location: ../index.php');

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
    
    public function Buscar_usuario_por_id($id_usuario){
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
			$parte1= "SELECT id_usuario,nombre,clave,tipo_usu FROM `usuarios` WHERE id_usuario=";
			
		    $sql = $parte1. $id_usuario;
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
				echo json_encode($resultado);
      	
    
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
    	//echo "El registro se actualizo correctamente";
      
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
        
        $sql ="Update usuarios set nombre='$obj_usu->nombre',clave='$obj_usu->clave', tipo_usu='$obj_usu->tipo_usu' where id_usuario ='8'";        

		if ($conn->query($sql) === TRUE) {
    		echo "El registro se actualizo correctamente";
		} else {
    		echo "Error deleting record: " . $conn->error;
		}

		$conn->close();   
		header('Location: ../index.php');     
    }
    
    
    public static function paginado_usuario(){
    
  //primero obtenemos el parametro que nos dice en que pagina estamos
		    $page = 1; //inicializamos la variable $page a 1 por default
		    if(array_key_exists('pg', $_GET)){
		        $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
		    }
		    //ahora que tenemos en que pagina estamos obtengamos los resultados:
		    // a) el numero de registros en la tabla
		    $mysqli = new mysqli("localhost","root","slam2018","corgran");
		    if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}


		    $conteo_query =  $mysqli->query("SELECT COUNT(*) as conteo FROM usuarios");
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
		    $segmento = $mysqli->query("SELECT *  FROM usuarios LIMIT ".(($page-1)*10).", 10 ");
          $resultado=[];
		    //ya tenemos el segmento, ahora le damos output.
		    if($segmento){
			  // echo '<table>';
			    while($obj2 = $segmento->fetch_object())
			    {
			    	$obj_usu = new usuario($obj2->id_usuario,$obj2->tipo_usu,$obj2->nombre,$obj2->clave);
                $resultado[]=$obj_usu;
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
    

}



?>

