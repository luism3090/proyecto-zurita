<?php

	include 'conexion.php';
	require_once 'recursos.php';

	date_default_timezone_set("Mexico/General");

	$variable = $_REQUEST["variable"];
        
        

	if($variable == "crearFormulario")  // Luis 4
	{
            $idObra = $_REQUEST["idObra"];
        
        

		
		try
		{
                    $peticion = $mysqli->query("SELECT * FROM obras WHERE id_obra = $idObra");
                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }
                    $registros =  $peticion->num_rows;
                    if($registros>0)
                    {
                        if($row = $peticion->fetch_array(MYSQLI_BOTH))
                        {
                            $fechaInicio = $row["fec_inicio"];
                            $fechaFin = $row["fec_fin"];
                            $titulo = $row["nombre_obra"];
                        }
                    }   
                }
                catch(exception $e) 
                {

                    echo "Error: ".$e->getMessage()." ";
                }
                
		$html = "<div id='headerSeguimiento'>".
				"<p>Seguimiento de la obra: $titulo</p>".
	    		"<p>Fecha de inicio: $fechaInicio</p>".
	    		"<p>Fecha de fin: $fechaFin</p>".
	    		"</div>";
		$datetime1 = date_create($fechaInicio);
		$datetime2 = date_create($fechaFin);
		$diferencia = date_diff($datetime1, $datetime2);
		$diferencia = $diferencia->format('%m');
		
		$fecha = date($fechaInicio);
		for($x=0;$x<$diferencia;$x++)
		{
			$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'Y-m' , $nuevafecha );
			$fecha = $nuevafecha;

			$parte = explode("-", $nuevafecha);
			$anio = $parte[0];
			$mes = $parte[1];
                        
                        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
			$mes = $meses[$mes-1];
                        
                        $anio_mes = $mes." ".$anio;
                        
                        
                 try
               {
                
                $peticion = $mysqli->query("SELECT * FROM rel_seguimiento_obra WHERE id_obra = $idObra and mes_anio='$anio_mes'" );
                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }
                    $registros =  $peticion->num_rows;
                    
                    if($registros>0)
                   {
                          if($row = $peticion->fetch_array(MYSQLI_BOTH))
                           {
                                  $id = $row["id_seguimiento_obra"];
                                  $id_obra = $row["id_obra"];
                                  $mes_anio = $row["mes_anio"];
                                  $foto = $row["foto"];
                                    
                                  $descripcion = $row["descripcion"];
                                  $costo = $row["costo"];
                                  
                                  

                             
                              $html .="<div id='contenedorSeguimiento_$x' class='contenedorSeguimiento'>".
                                              "<p class='mes-anio_$x'>$mes $anio</p>".
                                              "<p><img src='files/".$foto."' width='400px' height='200px' class='imagen_$x' /> </p>".
                                              "<p><label for='imagenSeguimiento_$x'>Cambiar la imagen:</label><input type='file' id='imagenSeguimiento_$x' class='imagenSeguimiento' /></p>".
                                              "<p class='mensage_".$x."'></p>".
                                              "<p><label for='descripcionSeguimiento_$x'>Descripción:</label><textarea id='descripcionSeguimiento_$x' class='descripcionSeguimiento' maxlength='245'>".$descripcion."</textarea> </p>".
                                              "<p><label for='costoSeguimiento_$x'>Costo:</label><input type='text' id='costoSeguimiento_$x' class='costoSeguimiento' value='".$costo."' maxlength='20'/></p>".
                                              "<td><button class='btn btnSeguimientoCancelar' style='margin-right:1em;'>Cancelar</button></td>".
                          "<td><button class='btn btn-primary btnSeguimientoAceptar' data-id_obra='$id_obra' id='btnSeguimientoAceptar_$x' data-id-seguimiento='$id'>Aceptar</button></td>".   // Luis 4
                                              "</div>";

                              
                          }
                    }
                    else
                    {
                        
			$html .="<div id='contenedorSeguimiento_$x' class='contenedorSeguimiento'>".
					"<p class='mes-anio_$x'>$mes $anio</p>".
					"<p><label for='imagenSeguimiento_$x'>Selecciona una imagen:</label><input type='file' id='imagenSeguimiento_$x' class='imagenSeguimiento'/></p>".
                                        "<p class='mensage_".$x."'></p>".
					"<p><label for='descripcionSeguimiento_$x'>Descripción:</label><textarea id='descripcionSeguimiento_$x' class='descripcionSeguimiento' maxlength='245'></textarea> </p>".
					"<p><label for='costoSeguimiento_$x'>Costo:</label><input type='text' id='costoSeguimiento_$x' class='costoSeguimiento' maxlength='20'/></p>".
					"<td><button class='btn btnSeguimientoCancelar' style='margin-right:1em;'>Cancelar</button></td>".
                    "<td><button class='btn btn-primary btnSeguimientoAceptar' data-id_obra='$idObra' id='btnSeguimientoAceptar_$x' data-id-seguimiento='-1'>Aceptar</button></td>".   // Luis 4
					"</div>";
                        
                        
                    }
               }
                 catch(exception $e) 
                {

                    echo "Error: ".$e->getMessage()." ";
                }
                    
                
                
                
//               
                

			
		

		
	}
        
        echo $html;
        
        //echo"SELECT * FROM rel_seguimiento_obra WHERE id_obra = $idObra and mes_anio='$anio_mes'" ;
        
 }
        
    
        
 if($variable=="insertSeguimientoObra") // Luis 4
 {
     $id_obra = $_REQUEST["id_obra"];
     $descripcion = $_REQUEST["descripcion"];
     $costo = $_REQUEST["costo"];
     $foto = $_REQUEST["imagen"];
     
     $mes_anio = $_REQUEST["mes_anio"];
     $id_seguimiento = $_REQUEST["id_seguimiento"];
     
     $date = date("y-m-d");
     
     //$valida = validar($id_seguimiento);
     
     $valida=0;
     
     try    // verifico que si ya existe una imagen en el registro 
            {
                $peticion = $mysqli->query("select *  from rel_seguimiento_obra where id_seguimiento_obra= $id_seguimiento");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
               
	            $registros =  $peticion->num_rows;
	            
                if($registros>0)
                {
                    $valida=1;
                }
                
               
            }
            catch(exception $e) 
            {
               
                echo "Error: ".$e->getMessage()." ";
            }
     
     
        if($valida == 0)  // si es un insert 
        {
            
            
            
      try
            {
                $peticion = $mysqli->query("select max(id_seguimiento_obra) as id from rel_seguimiento_obra");
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
                            $identificador = $row["id"]+1;
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
               
                echo "Error: ".$e->getMessage()." ";
            }
            
            
            $foto = $identificador."_".$foto;
       
            
            
                try
                   {
                    $peticion = $mysqli->query("INSERT INTO rel_seguimiento_obra values (null,$id_obra,'$descripcion',$costo,'$date','$foto','$mes_anio')");
                           if(!$peticion)
                           {
                               throw new Exception($mysqli->error);
                           }
                          echo "Registro insertado correctamente" ;
                   }
                   catch(exception $e) 
                   {

                       echo "Error: ".$e->getMessage()." ";
                      // echo "INSERT INTO rel_seguimiento_obra (null,$id_obra,'$descripcion',$costo,'$date','$foto')";
                   }
        }
        else // si es una actualizacion
        {
            
            $identificador= $id_seguimiento;
            
      try        // eliminar el archivo anterior
            {
                $peticion = $mysqli->query("select foto from rel_seguimiento_obra where id_seguimiento_obra= '$id_seguimiento'");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
               
	            $registros =  $peticion->num_rows;
	            
                if($registros>0)
                {
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
//                        if($row["id"]=="")
//                        {
//                            $identificador= "1";
//                        }
//                        else
//                        {
//                            $identificador = $row["id"];
//                        }
                        
                        if($foto!="")
                        {
                        $fotillo= $row["foto"];
                        
                        unlink('files/'.$fotillo);
                        }
                    }
                }
//                else
//                {
//                    $identificador="1";
//                }
               
            }
            catch(exception $e) 
            {
               
                echo "Error: ".$e->getMessage()." ";
            }
            
            
                if($foto!="")
                {        
                    $foto = $identificador."_".$foto;


                    try
                           {
                            $peticion = $mysqli->query("UPDATE rel_seguimiento_obra set descripcion= '$descripcion', costo= $costo, fecha_registro= '$date', foto='$foto' where id_seguimiento_obra=$id_seguimiento");
                                   if(!$peticion)
                                   {
                                       throw new Exception($mysqli->error);
                                   }
                                 echo "Registro modificado correctamente" ;
                           }
                           catch(exception $e) 
                           {

                               //echo "Error: ".$e->getMessage()." ";
                               //echo "UPDATE rel_seguimiento_obra set descripcion= '$descripcion', costo= $costo, fecha_registro= '$date', foto='$foto' where id_seguimiento_obra=$id_seguimiento )";
                           }
                   
                }
                else
                {
                    try
                           {
                            $peticion = $mysqli->query("UPDATE rel_seguimiento_obra set descripcion= '$descripcion', costo= $costo, fecha_registro= '$date' where id_seguimiento_obra=$id_seguimiento");
                                   if(!$peticion)
                                   {
                                       throw new Exception($mysqli->error);
                                   }
                                 echo "Registro modificado correctamente" ;
                           }
                           catch(exception $e) 
                           {

                               echo "Error: ".$e->getMessage()." ";
                               //echo "UPDATE rel_seguimiento_obra set descripcion= '$descripcion', costo= $costo, fecha_registro= '$date', foto='$foto' where id_seguimiento_obra=$id_seguimiento )";
                           }
                    
                    
                    
                }
                   
                   
        }
     
 }
 
