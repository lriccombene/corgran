<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   namespace app\clases;
   use mysqli;
   use mysqli_query;
   use mysqli_error;
   use mysql_fetch_assoc;
/**/
    class Coneccion {
                 
        public $servername = "localhost"; //directoria o ruta de archivo
        public $username= "root";
        public $password= "slam2016";
        public $dbname= "corgran";
        
        public function conectar()
        {                    
            $con = mysqli_connect('localhost', 'root', 'slam2016', 'corgran') or die('Error al intentar conectarse a la base de datos.');
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            return $conn;
        }
    }
?>

