<?php
include 'conexion.php';
require_once 'recursos.php';

	$variable = $_POST["variable"];
        
        
        
         


if($variable=='cargarClientes')
{
    $salida="";
            try
            {
                $peticion = $mysqli->query("select * from clientes");
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
                                    "<td>".$row["id_cliente"]."</td>".
                                    "<td>".$row["titulo"]."</td>".
                                    "<td>".$row["nombre"]."</td>".
                                    "<td>".$row["ape_paterno"]."</td>".
                                    "<td>".$row["ape_materno"]."</td>".
                                    "<td>".$row["razon_social"]."</td>".
                                    "<td>".$row["rfc"]."</td>".
                                    "<td><button class='btn btn-primary btnDomicilioCliente'  id='btnDomicilioCliente_".$row["id_cliente"]."' >Detalles</button></td>".
                                    "<td><button class='btn btn-primary btnObraCliente' id='btnObraCliente_".$row["id_cliente"]."'>Obra</button></td>".
                                    "<td><a href='#' class='btn modificar-cliente' id='modificar-cliente_".$row["id_cliente"]."' ><i class='icon-pencil'></i></a> <a href='#'  class='btn eliminar-cliente' id='eliminar-cliente_".$row["id_cliente"]."' ><i class='icon-cross'></i></a></td>".
                                    
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
    $cliente="";
    	
    $id_cliente = $_POST["id_cliente"];
    
            try
            {
                $peticion = $mysqli->query("select * from clientes where id_cliente =".$id_cliente." ");
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
                        
                        $cliente = $row["nombre"]." ".$row["ape_paterno"]." ".$row["ape_materno"];
                                
			$salida =  "<tr>".
                                    "<td>".$row["estado"]."</td>".
                                    "<td>".$row["municipio"]."</td>".
                                    "<td>".$row["colonia"]."</td>".
                                    "<td>".$row["calle"]."</td>".
                                    "<td>".$row["numero"]."</td>".
                                    "<td>".$row["telefono"]."</td>".
                                "</tr>";
                    }
                    
                    echo $salida.";@".$cliente;
                    
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


if($variable=='cargarDomicilioModificar')
{
    $salida="";
    	
    $id_cliente = $_POST["id_cliente"];
    
    
    
            try
            {
                $peticion = $mysqli->query("select * from clientes where id_cliente =".$id_cliente." ");
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
                                   $row["razon_social"]."@;".$row["rfc"]."@;".$row["estado"]."@;".$row["municipio"]."@;".
                                    $row["colonia"]."@;".$row["calle"]."@;".$row["numero"]."@;".$row["telefono"];
                                    
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


if($variable=='insertarClientes')
{
    $salida="";
    
    	
    $titulo_cliente = $_POST["titulo_cliente"];
    $nombre_cliente = $_POST["nombre_cliente"];
    $paterno_cliente = $_POST["paterno_cliente"];
    $materno_cliente = $_POST["materno_cliente"];
    $razon_cliente = $_POST["razon_cliente"];
    $rfc_cliente = $_POST["rfc_cliente"];
    $estado_cliente = $_POST["estado_cliente"];
    $municipio_cliente = $_POST["municipio_cliente"];
    $colonia_cliente = $_POST["colonia_cliente"];
    $calle_cliente = $_POST["calle_cliente"];
    $numero_cliente = $_POST["numero_cliente"];
    $telefono_cliente = $_POST["telefono_cliente"];
    
    /*
    echo $titulo_cliente.";";
    echo $nombre_cliente.";";
    echo $paterno_cliente.";";
    echo $materno_cliente.";";
    echo $razon_cliente.";";
    echo $rfc_cliente.";";
    echo $estado_cliente.";";
    echo $municipio_cliente.";";
     echo $colonia_cliente.";";
    echo $calle_cliente.";";
    echo $numero_cliente.";";
    echo $telefono_cliente.";";
            
    */
            try
	    {
                
	        $peticion = $mysqli->query("INSERT INTO clientes VALUES(null,'$titulo_cliente','$nombre_cliente','$paterno_cliente','$materno_cliente','$razon_cliente','$rfc_cliente','$estado_cliente','$municipio_cliente','$colonia_cliente','$calle_cliente','$numero_cliente','$telefono_cliente')");
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


if($variable=='ModificarClientes')
{
    $salida="";
    
    $titulo_cliente = $_POST["titulo_cliente"];
    $nombre_cliente = $_POST["nombre_cliente"];
    $paterno_cliente = $_POST["paterno_cliente"];
    $materno_cliente = $_POST["materno_cliente"];
    $razon_cliente = $_POST["razon_cliente"];
    $rfc_cliente = $_POST["rfc_cliente"];
    $estado_cliente = $_POST["estado_cliente"];
    $municipio_cliente = $_POST["municipio_cliente"];
    $colonia_cliente = $_POST["colonia_cliente"];
    $calle_cliente = $_POST["calle_cliente"];
    $numero_cliente = $_POST["numero_cliente"];
    $telefono_cliente = $_POST["telefono_cliente"];
    
    
    $id_cliente = $_POST["id_cliente"];
    
    
    
    
            try
	    {
                
	        $peticion = $mysqli->query("update clientes set titulo = '$titulo_cliente', nombre= '$nombre_cliente', ape_paterno= '$paterno_cliente', ape_materno='$materno_cliente', razon_social='$razon_cliente', rfc= '$rfc_cliente', estado= '$estado_cliente', municipio= '$municipio_cliente', colonia = '$colonia_cliente', calle='$calle_cliente', numero= '$numero_cliente', telefono= '$telefono_cliente' where id_cliente= '$id_cliente' ");
                
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


if($variable=='eliminarClientes')
{
    
    $valida = 0;
            
   $id_cliente = $_POST["id_cliente"];
    
          try
	    {
                
	        $peticion = $mysqli->query("select * from obras where id_cliente = $id_cliente ");
                
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
	       
	        echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
	    }
            
    
            if($valida==0)
            {

                    try
                    {

                        $peticion = $mysqli->query("delete from clientes where id_cliente = '$id_cliente' ");

                        if(!$peticion)
                        {
                            throw new Exception($mysqli->error);
                        }            
                        echo "Registro eliminado correctamente.";
                    }  
                    catch(exception $e) 
                    {

                        echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
                    }
            
            }
            else
            {
                echo "El cliente no se puede eliminar debido a que esta relacionado con una obra";
            }
            
            
}
if($variable=='modalObraCliente')
{
    
    $salida = "";
   $id_cliente = $_POST["id_cliente"];
    
    
    
    
            try
        {
                
            $peticion = $mysqli->query("SELECT o.nombre_obra, o.descripcion as descripcion_obra, o.estado, o.municipio, o.ciudad, t.descripcion as tipo_obra, r.descripcion as regimen, o.fec_inicio, o.fec_fin 
                                        FROM clientes AS c
                                        INNER JOIN obras as o
                                        ON c.id_cliente = o.id_cliente
                                        INNER JOIN tipo_obra as t
                                        ON t.id_tipo_obra = o.id_tipo_obra
                                        INNER JOIN regimen_contratacion as r
                                        ON r.id_regimen = o.id_regimen
                                        WHERE c.id_cliente = '$_POST[id_cliente]'; ");
                
            if(!$peticion)
            {
                throw new Exception($mysqli->error);
            }            
            $registros =  $peticion->num_rows;
                if($registros>0)
                {
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
                        $salida = $salida.  "<tr><td>".$row['nombre_obra']."</td>".
                                    "<td>".$row['descripcion_obra']."</td>".
                                    "<td>".$row['estado']."</td>".
                                    "<td>".$row['municipio']."</td>".
                                    "<td>".$row['ciudad']."</td>".
                                    "<td>".$row['tipo_obra']."</td>".
                                    "<td>".$row['regimen']."</td>".
                                    "<td>".$row['fec_inicio']."</td>".
                                    "<td>".$row['fec_fin']."</td></tr>";
                    }
                    
                    echo $salida;
                    
                }
                else
                {
                    echo "no";
                }
        }  
        catch(exception $e) 
        {
           
            echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
        }
            
            
            
}

			



?>
