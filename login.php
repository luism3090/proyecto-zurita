<?php
include 'conexion.php';
require_once 'recursos.php';


		$usuario = $_POST["usuario"];
                $contra = $_POST["contra"];
		
		//echo $contra." ".$usuario;
		
		$valida="";

            try
            {
                $peticion = $mysqli->query("select * from administrador");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
                
                //$peticion = $mysqli->query("CALL show_productos(0)");
            
	            $registros =  $peticion->num_rows;
	            
                if($registros>0)
                {
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
                        
			if($usuario == $row["usuario"] && $contra == $row["password"])
                        {
			   $valida = "correcto";
			}
			else
                        {
                            $valida = "error";
                        }
							
                            
                        
                    }
                    
                    echo $valida;
                    
                }
               
            }
            catch(exception $e) 
            {
               
                echo "error§@ ".$e->getMessage()." ";
            }
            



			



?>
