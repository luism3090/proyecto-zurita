<?php

	include 'conexion.php';
	require_once 'recursos.php';

	if($_REQUEST["option"] == 1)
	{
		try
		{
		    $peticion = $mysqli->query("SELECT * FROM unidades_medida");
		    if(!$peticion)
		    {
		        throw new Exception($mysqli->error);
		    }
		    $html = "";
		    $registros = $peticion->num_rows;
		    if($registros>0)
			{
				while($row = $peticion->fetch_array(MYSQLI_BOTH))
				{
					$html .= "<option values='".$row['id_unidad']."'>".$row['descripcion']."</option>";
				}
			}
			echo $html;
		}  
		catch(exception $e) 
		{
		   
		    echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
		}	
	}
	else if($_REQUEST["option"] == 2)
	{
		try
		{
		    $peticion = $mysqli->query("INSERT INTO materiales VALUES (null, '".$_REQUEST["nombre"]."')");
		    if(!$peticion)
		    {
		        throw new Exception($mysqli->error);
		    }
		    try
		    {
		        $peticion2 = $mysqli->query("SELECT MAX(id_material) as id_material FROM materiales");
		        if(!$peticion2)
		        {
		            throw new Exception($mysqli->error);
		        }
		        $registros = $peticion2->num_rows;
		        if($registros>0)
		    	{
		    		if($row = $peticion2->fetch_array(MYSQLI_BOTH))
		    		{
		    			$idMaterialNuevo = $row["id_material"];		
		    		}
		    	}
		    	try
		    	{
		    	    $peticion3 = $mysqli->query("INSERT INTO rel_precio_material_unidad VALUES (null,$idMaterialNuevo,".$_REQUEST['id_unidad'].",".$_REQUEST['precio'].")");
		    	    if(!$peticion3)
		    	    {
		    	        throw new Exception($mysqli->error);
		    	    }
		    	    echo "Registro ingresado correctamente.";
		    	}  
		    	catch(exception $e) 
		    	{
		    	   
		    	    echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
		    	}	
		    }  
		    catch(exception $e) 
		    {
		       
		        echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
		    }	

		}  
		catch(exception $e) 
		{
		   
		    echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
		}	
	}
	else if($_REQUEST["option"] == 3)
	{
		try
		{
		    $peticion = $mysqli->query("select id_precio_material_unidad, (select descricpion from materiales as m where m.id_material = r.id_material) as nombre, (select descripcion from unidades_medida as u where u.id_unidad = r.id_unidad) as unidad_medida, precio from rel_precio_material_unidad as r");
		    if(!$peticion)
		    {
		        throw new Exception($mysqli->error);
		    }
		    $html = "";
		    $registros = $peticion->num_rows;
		    if($registros>0)
			{
				while($row = $peticion->fetch_array(MYSQLI_BOTH))
				{
					$html .= "<tr>
								<td>".$row['id_precio_material_unidad']."</td>".
								"<td>".$row['unidad_medida']."</td>".
								"<td>".$row['nombre']."</td>".
								"<td>".$row['precio']."</td>".
								"<td>".
									"<a href='#' class='btn modificar-material' id='modificar-material_".$row["id_precio_material_unidad"]."' >".
										"<i class='icon-pencil'></i></a>".
									 "<a href='#'  class='btn eliminar-material' id='eliminar-material_".$row["id_precio_material_unidad"]."' >".
									 	"<i class='icon-cross'></i></a>".
								"</td>".
							"</tr>";
				}
			}
			echo $html;
		}  
		catch(exception $e) 
		{
		   
		    echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
		}	
	}