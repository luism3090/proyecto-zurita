<?php

include 'conexion.php';
require_once 'recursos.php';

$variable = $_POST["variable"];



if($variable == "cargarTipoObras")
{
    
    
    $salida="";
            try
            {
                $peticion = $mysqli->query("select * from tipo_obra");
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
                        
                                
			$salida = $salida . "<tr>".
                                    "<td>".$row["id_tipo_obra"]."</td>".
                                    "<td>".$row["descripcion"]."</td>".
                                    "<td><a href='#' class='btn modificar-tipo-obra' id='modificar-tipo-obra_".$row["id_tipo_obra"]."' ><i class='icon-pencil'></i></a> <a href='#'  class='btn eliminar-tipo-obra' id='eliminar-tipo-obra_".$row["id_tipo_obra"]."' ><i class='icon-cross'></i></a></td>".
                                    
                                "</tr>";
                    }
                    
                    echo $salida;
                    
                }
                else
                    {
                        $valida = "Sin datos";
                    }
               
            }
            catch(exception $e) 
            {
               
                echo " error§@ ".$e->getMessage()." ";
            }
            
            
            
}


if($variable == "insertarTipoObra")
{
    $nombre = $_POST["nombre"];
    
    try
	    {
             
	        $peticion = $mysqli->query("INSERT INTO tipo_obra VALUES(null,'$nombre')");
	        if(!$peticion)
	        {
	            throw new Exception($mysqli->error);
	        }            
	        echo "Registro insertado correctamente.";
	    }  
	    catch(exception $e) 
	    {
	       
	        echo " error§@ ".$e->getMessage()." ";
	    }
    
    
}


if($variable == "modificarTipoObra")
{
    $nombre = $_POST["nombre"];
    $id = $_POST["id"];
    
    try
	    {
             
	        $peticion = $mysqli->query("UPDATE tipo_obra SET descripcion = '$nombre' where id_tipo_obra= '$id' ");
	        if(!$peticion)
	        {
	            throw new Exception($mysqli->error);
	        }            
	        echo "Registro modificado correctamente.";
	    }  
	    catch(exception $e) 
	    {
	       
	        echo " error§@ ".$e->getMessage()." ";
	    }
    
    
}
if($variable == "eliminarTipoObra")
{
    $id = $_POST["id_unidad"];
   $valida =0; 
    
     try
        {
             
            $peticion = $mysqli->query("select * FROM obras WHERE id_tipo_obra = $id");
            if(!$peticion)
            {
                throw new Exception($mysqli->error);
            }            
             
            $registros =  $peticion->num_rows;
	            
                if($registros>0)
                {
                   
                    $valida = 1;
                    
                }
        }  
        catch(exception $e) 
        {
           
            echo " error§@ ".$e->getMessage()." ";
        }
        
        if($valida==0)
        {
        
            try
                {

                    $peticion = $mysqli->query("DELETE FROM tipo_obra WHERE id_tipo_obra = $id");
                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }            
                    echo "Registro eliminado correctamente.";
                }  
                catch(exception $e) 
                {

                    echo " error§@ ".$e->getMessage()." ";
                }
        }
        else
        {
            echo "Este registro no se puede eliminar debido a que esta relacionado con una obra";
        }
}

