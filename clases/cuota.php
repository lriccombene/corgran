<?php
    namespace app\clases;
    require_once 'clases/coneccion.php';
    use \mysqli;
    use \mysqli_query;
    use \mysqli_error;
    use \mysql_fetch_assoc;
    use  app\clases\coneccion;
 	 $obj_coneccion = new coneccion; //


if(isset($_GET['pagar_cta_cole'])){
	
	$obj_cuota= new cuota;
	$obj_cuota->fec_pago= $_GET[''];
	$obj_cuota->monto = $_GET[''];
	$obj_cuota->estado = $_GET['DDLEstado'];
	$obj_cuota->interes = $_GET[''];
	$obj_cuota->pago_adelantado = $_GET[''];
	$obj_cuota->nro_cta = $_GET[''];
	$obj_cuota->fecha_cta = $_GET['txtFecCta'];	
	$obj_cuota->tipo_cuota = $_GET['DDLTipo_cta'];	
	$obj_cuota->idusuario=9;

}




class cuota {
    public $id_cuota;
    public $idusuario;
    public $fec_pago; //directoria o ruta de archivo
    public $monto ;
    public $estado;
    public $interes;
    public $pago_adelantado;
    public $nro_cta;
    public $fecha_cta;
    public $tipo_cta;
    
    public function __construct($id_cuota,$idusuario,$fec_pago,$monto,$estado,$interes,$pago_adelantado,$nro_cta,$fecha_cta,$tipo_cta) {
            $this->id_cuota=$id_cuota;
            $this->idusuario=$idcolegiados;
            $this->fec_pago=$fec_pago;
            $this->monto=$monto;
            $this->estado=$estado;
            $this->interes=$interes;
            $this->pago_adelantado= $pago_adelantado;
            $this->nro_cta=$nro_cta;
            $this->fecha_cta=$fecha_cta;
            $this->tipo_cuota=$tipo_cta;
                } 
        
    public static function listaCta($obj_cta)
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

            $sql = "SELECT `id_cuota`,`idusuario`,`fec_pago`,`tipo_cuota`,`monto`,`estado`,"
                    . "`interes`,`pago_adelantado`,`nro_cta`,`fecha_cta`,`tipo_cta` FROM cuotas where idusuario =".$obj_cta->idusuario ;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $cuota = new cuota($row["id_cuota"],$row["idusuario"],
			                               $row["fec_pago"],$row["tipo_cuota"],$row["monto"],$row["estado"],
			                               $row["interes"],$row["pago_adelantado"],$row["nro_cta"],$row["fecha_cta"],$row["tipo_cuota"]);
                $resultado[] = $cuota;                    
                }
                return $resultado;
            } else {
                echo "0 results";
            }
            $conn->close();
        }
			
		public function guardar_cuota($obj_cta){
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
			$sql1= "SELECT max(nro_cta) as maxCta FROM `cuota` WHERE id_usuario=$$obj_cta->idusuario";
			$result = $conn->query($sql1);

			$resultado="";
			$nro_max_cta=0;
			//echo $result->num_rows;
			if ($result->num_rows > 0) {
 				 while($row = $result->fetch_assoc()) {
					//var_dump($row);	                
					$nro_max_cta = $row["maxCta"];
				
		        }
			} 
			$nro_cta_nueva= $nro_max_cta +1;
			$sql2 = "INSERT INTO cuota (`idusuario`,`fec_pago`,`tipo_cuota`,`monto`,`estado`,
                                     `interes`,`pago_adelantado`,`nro_cta`,`fecha_cta`) 
                  VALUES (idusuario =$obj_cta->idusuario , fec_pago=$obj_cta->fec_pago, tipo_cuota=$obj_cta->tipo_cuota,
                  		  monto=$obj_cta->monto,estado=$obj_cta->estado, interes=0,pago_adelantado=$obj_cta->pago_adelantado,
                  		  nro_cta=$nro_cta_nueva, fecha_cta=$obj_cta->fecha_cta)";
                  		  
			if ($conn->query($sql2) === TRUE) {
				            $result = "OK";
			   } else {
		            $echo "Error: " . $sql . "<br>" . $conn->error;
		   }
		   $conn->close();
		   echo "grabado ok cuota";
				
		}        
        
        
                     
}
?><?php
    namespace app\clases;
    require_once 'clases/coneccion.php';
    use \mysqli;
    use \mysqli_query;
    use \mysqli_error;
    use \mysql_fetch_assoc;
    use  app\clases\coneccion;
 	 $obj_coneccion = new coneccion; //


if(isset($_GET['pagar_cta_cole'])){
	
	$obj_cuota= new cuota;
	$obj_cuota->fec_pago= $_GET[''];
	$obj_cuota->monto = $_GET[''];
	$obj_cuota->estado = $_GET['DDLEstado'];
	$obj_cuota->interes = $_GET[''];
	$obj_cuota->pago_adelantado = $_GET[''];
	$obj_cuota->nro_cta = $_GET[''];
	$obj_cuota->fecha_cta = $_GET['txtFecCta'];	
	$obj_cuota->tipo_cuota = $_GET['DDLTipo_cta'];	
	$obj_cuota->idusuario=9;

}




class cuota {
    public $id_cuota;
    public $idusuario;
    public $fec_pago; //directoria o ruta de archivo
    public $monto ;
    public $estado;
    public $interes;
    public $pago_adelantado;
    public $nro_cta;
    public $fecha_cta;
    public $tipo_cta;
    
    public function __construct($id_cuota,$idusuario,$fec_pago,$monto,$estado,$interes,$pago_adelantado,$nro_cta,$fecha_cta,$tipo_cta) {
            $this->id_cuota=$id_cuota;
            $this->idusuario=$idcolegiados;
            $this->fec_pago=$fec_pago;
            $this->monto=$monto;
            $this->estado=$estado;
            $this->interes=$interes;
            $this->pago_adelantado= $pago_adelantado;
            $this->nro_cta=$nro_cta;
            $this->fecha_cta=$fecha_cta;
            $this->tipo_cuota=$tipo_cta;
                } 
        
    public static function listaCta($obj_cta)
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

            $sql = "SELECT `id_cuota`,`idusuario`,`fec_pago`,`tipo_cuota`,`monto`,`estado`,"
                    . "`interes`,`pago_adelantado`,`nro_cta`,`fecha_cta`,`tipo_cta` FROM cuotas where idusuario =".$obj_cta->idusuario ;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $cuota = new cuota($row["id_cuota"],$row["idusuario"],
			                               $row["fec_pago"],$row["tipo_cuota"],$row["monto"],$row["estado"],
			                               $row["interes"],$row["pago_adelantado"],$row["nro_cta"],$row["fecha_cta"],$row["tipo_cuota"]);
                $resultado[] = $cuota;                    
                }
                return $resultado;
            } else {
                echo "0 results";
            }
            $conn->close();
        }
			
		public function guardar_cuota($obj_cta){
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
			$sql1= "SELECT max(nro_cta) as maxCta FROM `cuota` WHERE id_usuario=$$obj_cta->idusuario";
			$result = $conn->query($sql1);

			$resultado="";
			$nro_max_cta=0;
			//echo $result->num_rows;
			if ($result->num_rows > 0) {
 				 while($row = $result->fetch_assoc()) {
					//var_dump($row);	                
					$nro_max_cta = $row["maxCta"];
				
		        }
			} 
			$nro_cta_nueva= $nro_max_cta +1;
			$sql2 = "INSERT INTO cuota (`idusuario`,`fec_pago`,`tipo_cuota`,`monto`,`estado`,
                                     `interes`,`pago_adelantado`,`nro_cta`,`fecha_cta`) 
                  VALUES (idusuario =$obj_cta->idusuario , fec_pago=$obj_cta->fec_pago, tipo_cuota=$obj_cta->tipo_cuota,
                  		  monto=$obj_cta->monto,estado=$obj_cta->estado, interes=0,pago_adelantado=$obj_cta->pago_adelantado,
                  		  nro_cta=$nro_cta_nueva, fecha_cta=$obj_cta->fecha_cta)";
                  		  
			if ($conn->query($sql2) === TRUE) {
				            $result = "OK";
			   } else {
		            $echo "Error: " . $sql . "<br>" . $conn->error;
		   }
		   $conn->close();
		   echo "grabado ok cuota";
				
		}        
        
        
                     
}
?><?php
    namespace app\clases;
    require_once 'clases/coneccion.php';
    use \mysqli;
    use \mysqli_query;
    use \mysqli_error;
    use \mysql_fetch_assoc;
    use  app\clases\coneccion;
 	 $obj_coneccion = new coneccion; //


if(isset($_GET['pagar_cta_cole'])){
	
	$obj_cuota= new cuota;
	$obj_cuota->fec_pago= $_GET[''];
	$obj_cuota->monto = $_GET[''];
	$obj_cuota->estado = $_GET['DDLEstado'];
	$obj_cuota->interes = $_GET[''];
	$obj_cuota->pago_adelantado = $_GET[''];
	$obj_cuota->nro_cta = $_GET[''];
	$obj_cuota->fecha_cta = $_GET['txtFecCta'];	
	$obj_cuota->tipo_cuota = $_GET['DDLTipo_cta'];	
	$obj_cuota->idusuario=9;

}




class cuota {
    public $id_cuota;
    public $idusuario;
    public $fec_pago; //directoria o ruta de archivo
    public $monto ;
    public $estado;
    public $interes;
    public $pago_adelantado;
    public $nro_cta;
    public $fecha_cta;
    public $tipo_cta;
    
    public function __construct($id_cuota,$idusuario,$fec_pago,$monto,$estado,$interes,$pago_adelantado,$nro_cta,$fecha_cta,$tipo_cta) {
            $this->id_cuota=$id_cuota;
            $this->idusuario=$idcolegiados;
            $this->fec_pago=$fec_pago;
            $this->monto=$monto;
            $this->estado=$estado;
            $this->interes=$interes;
            $this->pago_adelantado= $pago_adelantado;
            $this->nro_cta=$nro_cta;
            $this->fecha_cta=$fecha_cta;
            $this->tipo_cuota=$tipo_cta;
                } 
        
    public static function listaCta($obj_cta)
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

            $sql = "SELECT `id_cuota`,`idusuario`,`fec_pago`,`tipo_cuota`,`monto`,`estado`,"
                    . "`interes`,`pago_adelantado`,`nro_cta`,`fecha_cta`,`tipo_cta` FROM cuotas where idusuario =".$obj_cta->idusuario ;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $cuota = new cuota($row["id_cuota"],$row["idusuario"],
			                               $row["fec_pago"],$row["tipo_cuota"],$row["monto"],$row["estado"],
			                               $row["interes"],$row["pago_adelantado"],$row["nro_cta"],$row["fecha_cta"],$row["tipo_cuota"]);
                $resultado[] = $cuota;                    
                }
                return $resultado;
            } else {
                echo "0 results";
            }
            $conn->close();
        }
			
		public function guardar_cuota($obj_cta){
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
			$sql1= "SELECT max(nro_cta) as maxCta FROM `cuota` WHERE id_usuario=$$obj_cta->idusuario";
			$result = $conn->query($sql1);

			$resultado="";
			$nro_max_cta=0;
			//echo $result->num_rows;
			if ($result->num_rows > 0) {
 				 while($row = $result->fetch_assoc()) {
					//var_dump($row);	                
					$nro_max_cta = $row["maxCta"];
				
		        }
			} 
			$nro_cta_nueva= $nro_max_cta +1;
			$sql2 = "INSERT INTO cuota (`idusuario`,`fec_pago`,`tipo_cuota`,`monto`,`estado`,
                                     `interes`,`pago_adelantado`,`nro_cta`,`fecha_cta`) 
                  VALUES (idusuario =$obj_cta->idusuario , fec_pago=$obj_cta->fec_pago, tipo_cuota=$obj_cta->tipo_cuota,
                  		  monto=$obj_cta->monto,estado=$obj_cta->estado, interes=0,pago_adelantado=$obj_cta->pago_adelantado,
                  		  nro_cta=$nro_cta_nueva, fecha_cta=$obj_cta->fecha_cta)";
                  		  
			if ($conn->query($sql2) === TRUE) {
				            $result = "OK";
			   } else {
		            $echo "Error: " . $sql . "<br>" . $conn->error;
		   }
		   $conn->close();
		   echo "grabado ok cuota";
				
		}        
        
        
                     
}
?>
