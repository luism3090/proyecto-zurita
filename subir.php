<?php
include("conexion.php");

$id_seguimiento=$_REQUEST["id"];

$ruta = 'files/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
$identificador="";
$identificador2="";

$valida=0;
            
         if($id_seguimiento>0){  // Si se modifica
             
             $identificador = $id_seguimiento;
    
    
         }
         else // si se inserta se debe traer el ultimo id
         {
               try
                    {
                       $peticion = $mysqli->query("select max(id_seguimiento_obra) as id from rel_seguimiento_obra");
                       //$peticion = $mysqli->query("select id_seguimiento_obra rel_seguimiento_obra where id_seguimiento_obra = ");
                  
                        if(!$peticion)
                        {
                            throw new Exception($mysqli->error);
                        }

                            $registros =  $peticion->num_rows;

                        if($registros>0)
                        {
                            while($row = $peticion->fetch_array(MYSQLI_BOTH))
                            {
                                if($row["id"]=="")
                                {
                                    $identificador= "1";
                                }
                                else
                                {
                                    //$identificador2=$row["id"];
                                    $identificador = $row["id"];
                                }

                            }
                        }
                        else
                        {
                            $identificador="1";
                        }

                    }
                    catch(exception $e) 
                    {

                        echo "error";
                    }
                        
//                    if($id_seguimiento==-1)
//                    {
//                        $identificador=$identificador2;
//                    }
             
              
        }  
            
            
            
            
            
foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
		{
            
			$NombreOriginal = $identificador."_".$key['name'];//Obtenemos el nombre original del archivo
			$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino = $ruta.$NombreOriginal;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada		
		}
 
	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
			$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
		}
	if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
		{
			$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: \n'.$key['error']; 
		}
	
}
echo $mensage;//$mensage.$identificador;// Regresamos los mensajes generados al cliente
?>

