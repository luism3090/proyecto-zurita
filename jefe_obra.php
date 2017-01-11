<?php
include 'conexion.php';
require_once 'recursos.php';

$variable = $_REQUEST["variable"];
    
   

    if($variable == "InsertarJefes")
    {
         $titulo = $_POST["titulo"];
        $nombre = $_POST["nombre"];
        $paterno = $_POST["paterno"];
        $materno = $_POST["materno"];

        $estado = $_POST["estado"];
        $municipio = $_POST["municipio"];
        $colonia = $_POST["colonia"];
        $calle = $_POST["calle"];
        $telefono = $_POST["telefono"];
    
    
         try
	    {
             
	        $peticion = $mysqli->query("INSERT INTO encargado_obra VALUES(null,'$titulo','$nombre','$paterno','$materno','$estado','$municipio','$colonia','$calle','$telefono')");
	        if(!$peticion)
	        {
	            throw new Exception($mysqli->error);
	        }            
	        echo "Registro insertado correctamente.";
	    }  
	    catch(exception $e) 
	    {
	       
	        echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
	    }
            
    }
    

 if($variable=='cargarJefes')
{
    $salida="";
            try
            {
                $peticion = $mysqli->query("select * from encargado_obra");
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
                                    "<td>".$row["id_jefe_obra"]."</td>".
                                    "<td>".$row["titulo"]."</td>".
                                    "<td>".$row["nombre"]."</td>".
                                    "<td>".$row["ape_paterno"]."</td>".
                                    "<td>".$row["ape_materno"]."</td>".
                                    "<td><button class='btn-primary btnDomicilioJefe'  id='btnDomicilioJefe_".$row["id_jefe_obra"]."' >Detalles</button></td>".
                                    "<td><button class='btn-primary'  id='btnDomicilioJefe' >Detalles</button></td>".
                                    "<td><a href='#' class='btn modificar-jefe' id='modificar-jefe_".$row["id_jefe_obra"]."' ><i class='icon-pencil'></i></a> <a href='#'  class='btn eliminar-jefe' id='eliminar-jefe_".$row["id_jefe_obra"]."' ><i class='icon-cross'></i></a></td>".
                                    
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
               
                echo "error";
            }
            
            
            
}

if($variable=='cargarDomicilio')
{
    $salida="";
    $jefe="";
    	
    $id_jefe = $_POST["id"];
    
            try
            {
                $peticion = $mysqli->query("select * from encargado_obra where id_jefe_obra = ".$id_jefe." ");
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
                        
                        $jefe = $row["nombre"]." ".$row["ape_paterno"]." ".$row["ape_materno"];
                                
			$salida =  "<tr>".
                                    "<td>".$row["estado"]."</td>".
                                    "<td>".$row["municipio"]."</td>".
                                    "<td>".$row["colonia"]."</td>".
                                    "<td>".$row["calle"]."</td>".
                                    "<td>".$row["telefono"]."</td>".
                                "</tr>";
                    }
                    
                    echo $salida.";@".$jefe;
                    
                }
                else
                    {
                        $valida = "Sin datos";
                    }
               
            }
            catch(exception $e) 
            {
               
                echo $e->getMessage();
            }
            
            
            
}


if($variable=='cargarDatosJefeObra')
{
    $salida="";
    	
    $id_jefe = $_POST["id_jefe"];
    
    
    
            try
            {
                $peticion = $mysqli->query("select * from encargado_obra where id_jefe_obra =".$id_jefe." ");
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
                        
                        $salida =  $row["titulo"]."@;".$row["nombre"]."@;".$row["ape_paterno"]."@;".$row["ape_materno"]."@;".
                                   $row["estado"]."@;".$row["municipio"]."@;".
                                    $row["colonia"]."@;".$row["calle"]."@;".$row["telefono"];
                                    
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
               
                echo "error";
            }
            
                   
}


if($variable=='ModificarJefe')
{
    $salida="";
    
    $titulo = $_POST["titulo"];
    $nombre = $_POST["nombre"];
    $paterno = $_POST["paterno"];
    $materno = $_POST["materno"];

    $estado = $_POST["estado"];
    $municipio = $_POST["municipio"];
    $colonia= $_POST["colonia"];
    $calle = $_POST["calle"];
    $telefono = $_POST["telefono"];
    
    
    $id = $_POST["id"];
    
    
    
    
            try
	    {
                
	        $peticion = $mysqli->query("update encargado_obra set titulo = '$titulo', nombre= '$nombre', ape_paterno= '$paterno', ape_materno='$materno', estado= '$estado', municipio= '$municipio', colonia = '$colonia', calle='$calle',telefono= '$telefono' where id_jefe_obra= '$id' ");
                
	        if(!$peticion)
	        {
	            throw new Exception($mysqli->error);
	        }            
	        echo "Registro modificado correctamente.";
	    }  
	    catch(exception $e) 
	    {
	       
	        echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
	    }
            
            
            
}



