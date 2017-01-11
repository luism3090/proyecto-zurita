<?php

include 'conexion.php';
require_once 'recursos.php';

date_default_timezone_set("Mexico/General");

$variable = $_REQUEST["variable"];

if($variable == "mostrarTiposObras")
{
    $salida="";
	try
            {
                $peticion = $mysqli->query("select o.id_obra, nombre_obra, t.descripcion, fec_inicio, fec_fin
											from obras as o
											inner join tipo_obra as t
											on o.id_tipo_obra = t.id_tipo_obra order by o.id_obra");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
            
	            $registros =  $peticion->num_rows;
	            
                if($registros>0)
                {
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {             
						$salida = $salida . "<tr>".
                                    "<td>".$row["id_obra"]."</td>".
                                    "<td>".$row["nombre_obra"]."</td>".
                                    "<td>".$row["descripcion"]."</td>".
                                    "<td>".$row["fec_inicio"]."</td>".
                                    "<td>".$row["fec_fin"]."</td>".
                                    "<td><button class='btn btn-primary btnDetallesObra'  id='btnDetallesObra_".$row["id_obra"]."' >Detalles</button></td>".
                                    "<td><button class='btn btn-primary btnSeguimientoObra'  id='btnSeguimientoObra_".$row["id_obra"]."' >Seguimiento</button></td>".
                                    "<td><button class='btn btn-primary btnReporteObra' id='btnReporteObra_".$row["id_obra"]."'>Reporte</button></td>".
                                    "<td><a href='#' class='btn modificar-obra' id='modificar-obra_".$row["id_obra"]."' ><i class='icon-pencil'></i></a> <a href='#'  class='btn eliminar-obra' id='eliminarObra_".$row["id_obra"]."' ><i class='icon-cross'></i></a></td>".
                                "</tr>";
                    }
                    
                    echo $salida;
                    
                }
            }
            catch(exception $e) 
            {
               
                echo "error";
            }
}
if($variable=='cargarClientesSeleccionObra')  // Luis 3
{
    $salida="";
            try
            {
                $peticion = $mysqli->query("select * from clientes");
                
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
               
                $registros =  $peticion->num_rows;
                
                if($registros>0)
                {
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
                        
                                
            $salida = $salida . "<tr>".
                                    "<td>".$row["titulo"]."</td>".
                                    "<td>".$row["nombre"]."</td>".
                                    "<td>".$row["ape_paterno"]."</td>".
                                    "<td>".$row["ape_materno"]."</td>".
                                    "<td>".$row["razon_social"]."</td>".
                                    "<td>".$row["rfc"]."</td>".
                                    "<td><input type='radio' data-id-cliente='".$row["id_cliente"]."' data-nombre='".$row["nombre"]." ".$row["ape_paterno"]." ".$row["ape_materno"]."' class='rd-id-cliente' name='radio-cliente'></td>".
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
if($variable == "cargarRegimenContratacionObras") // Luis 3
{
    
    
    $salida="";
            try
            {
                $peticion = $mysqli->query("select * from regimen_contratacion");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
                
            
                $registros =  $peticion->num_rows;
                
                if($registros>0)
                {
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
                        
                                
            $salida = $salida . "<tr>".
                                    "<td>".$row["id_regimen"]."</td>".
                                    "<td>".$row["descripcion"]."</td>".
                                   "<td><input type='radio' data-id-seguimiento-obra='".$row["id_regimen"]."' data-nombre-seguimiento='".$row["descripcion"]."' class='rd-seguimiento-obra' name='radio-seguimiento-obra'></td>".
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

 if($variable=="validaDistanciaMinimaUnMes") // Luis 3
 {
    $fecha_inicio= $_REQUEST["fecha_inicio"];
    $fecha_fin= $_REQUEST["fecha_fin"];
    
    $datetime1 = date_create($fecha_inicio);
    $datetime2 = date_create($fecha_fin);
    $diferencia = date_diff($datetime1, $datetime2);
    $diferencia = $diferencia->format('%m');
    
    echo $diferencia;
    
 }
 
 if($variable=="InsertarObras") 
 {
   $cadena= $_REQUEST["cadena"];
   
   $vector = explode("§@",$cadena);
   
    try
        {
             
            $peticion = $mysqli->query("INSERT INTO obras VALUES(null,'$vector[0]','$vector[1]','$vector[2]','$vector[3]','$vector[4]','$vector[5]','$vector[6]','$vector[7]','$vector[8]','$vector[9]')");
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
                                   "<td><input type='radio' data-id-tipo-obra='".$row["id_tipo_obra"]."' data-nombre-obra='".$row["descripcion"]."' class='rd-id-tipo-obra' name='radio-id-tipo-obra'></td>".
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

if($variable=='cargarObrasUpdate')
      {
          $id_obra=$_REQUEST['id_obra'];
          
          
          try
            {
                $peticion = $mysqli->query("select nombre_obra as nombre, obr.descripcion as descripcion,obr.estado as estado,obr.municipio as municipio ,ciudad,tbr.descripcion as tipo_obra, rec.descripcion as regimen, fec_inicio, fec_fin, nombre as nombre_cliente,ape_paterno,ape_materno, obr.id_tipo_obra, obr.id_regimen, obr.id_cliente from obras obr join tipo_obra tbr on (obr.id_tipo_obra=tbr.id_tipo_obra) join regimen_contratacion rec on (obr.id_regimen=rec.id_regimen) join clientes cli on (obr.id_cliente=cli.id_cliente) where obr.id_obra = $id_obra "); 
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
                        
                                
                      $salida = $row["nombre"]."§@".$row["estado"]."§@".$row["municipio"]."§@".$row["ciudad"]."§@".$row["fec_inicio"]."§@".$row["fec_fin"]."§@".$row["tipo_obra"]."§@".$row["nombre_cliente"]." ".$row["ape_paterno"]." ".$row["ape_materno"]."§@".$row["regimen"]."§@".$row["descripcion"]."§@".$row["id_tipo_obra"]."§@".$row["id_regimen"]."§@".$row["id_cliente"];
                                    
                                    
                    }
                    
                    echo $salida;
                    
                }
                
               
            }
            catch(exception $e) 
            {
               
                echo " error§@ ".$e->getMessage()." ";
            }
            
          
          
          
          
          
          
          
          
      }
      
      
      
      
  
      
      if($variable=='cargarDetallesObra')
      {
          $id_obra=$_REQUEST['id_obra'];
          
          $salida ="";
          
          try
            {
                $peticion = $mysqli->query("select nombre_obra as nombre, obr.descripcion as descripcion,obr.estado as estado,obr.municipio as municipio ,ciudad,tbr.descripcion as tipo_obra, rec.descripcion as regimen, fec_inicio, fec_fin, nombre as nombre_cliente,ape_paterno,ape_materno from obras obr join tipo_obra tbr on (obr.id_tipo_obra=tbr.id_tipo_obra) join regimen_contratacion rec on (obr.id_regimen=rec.id_regimen) join clientes cli on (obr.id_cliente=cli.id_cliente) where obr.id_obra = $id_obra "); 
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
                        
                                
                      $salida = "<tr>".
                                    "<td>".$row["nombre"]."</td>".
                                    "<td>".$row["descripcion"]."</td>".
                                    "<td>".$row["estado"]."</td>".
                                    "<td>".$row["municipio"]."</td>".
                                    "<td>".$row["ciudad"]."</td>".
                                    "<td>".$row["tipo_obra"]."</td>".
                                    "<td>".$row["regimen"]."</td>".
                                    "<td>".$row["fec_inicio"]."</td>".
                                    "<td>".$row["fec_fin"]."</td>".
                                    "<td>".$row["nombre_cliente"]." ".$row["ape_paterno"]." ".$row["ape_materno"]."</td>".
                                    
                                    
                               "</tr>";
                              
                              //$row["nombre"]."§@".$row["estado"]."§@".$row["municipio"]."§@".$row["ciudad"]."§@".$row["fec_inicio"]."§@".$row["fec_fin"]."§@".$row["tipo_obra"]."§@".$row["nombre_cliente"]." ".$row["ape_paterno"]." ".$row["ape_materno"]."§@".$row["regimen"]."§@".$row["descripcion"];
                                    
                                    
                    }
                    
                    echo $salida;
                    
                }
                
               
            }
            catch(exception $e) 
            {
               
                echo " error§@ ".$e->getMessage()." ";
            }
              
      }
      
      

if($variable=='modificarObra')
      {
          $id_obra=$_REQUEST['id_obra'];
          $cadena=$_REQUEST['cadena'];
          
          $vector = explode("§@",$cadena);
          
          // vector[6]  id_tipo_obra
          // vector[7]  id_cliente
          // vector[8]  id_regimen
          
          try
            {
                $peticion = $mysqli->query("update obras set nombre_obra = '$vector[0]' , estado = '$vector[1]', municipio = '$vector[2]', ciudad = '$vector[3]', fec_inicio= '$vector[4]' ,  fec_fin = '$vector[5]', id_tipo_obra = $vector[6] , id_cliente = $vector[7], id_regimen = $vector[8] , descripcion = '$vector[9]'  where id_obra = ".$id_obra." "); 
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
                
                echo "Registro modificado correctamente";
                
               
            }
            catch(exception $e) 
            {
               
                
                echo $e->getMessage();
            }
            
          
          
         //  echo "Registro modificado correctamente";
          
          
          
          
          
      }
      
      
 
      if($variable=='eliminarLaObra')
      {
          $id_obra=$_REQUEST['id_obra'];
          
        
          try
            {
                $peticion = $mysqli->query("delete from obras where id_obra = ".$id_obra." "); 
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
                
                echo "Registro Eliminado correctamente";
                
               
            }
            catch(exception $e) 
            {
               
                
                echo $e->getMessage();
            }
            
          
          
         //  echo "Registro modificado correctamente";
          
          
          
          
          
      }

      
      
      
      
  