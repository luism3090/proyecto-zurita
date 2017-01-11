<?php
	
	include 'conexion.php';
	require_once 'recursos.php';


	if($_REQUEST["option"] == 1)
	{
	    try
	    {
                $unidad_medida = $_REQUEST["unidad_medida"];
	        $peticion = $mysqli->query("INSERT INTO unidades_medida(descripcion) VALUES('$unidad_medida')");
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
	else if($_REQUEST["option"] == 2)
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
					$html .= "<tr>
								<td>".$row['id_unidad']."</td>".
								"<td>".$row['descripcion']."</td>".
								"<td>".
									"<a href='#' class='btn modificar-unidad_medida' id='modificar-unidad_medida_".$row["id_unidad"]."' >".
										"<i class='icon-pencil'></i></a>".
									 "<a href='#'  class='btn eliminar-unidad_medida' id='eliminar-unidad_medida_".$row["id_unidad"]."' >".
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
	else if($_REQUEST["option"] == 3)
	{
		try
		{
		    $peticion = $mysqli->query("SELECT * FROM unidades_medida WHERE id_unidad =".$_REQUEST['id_unidad']);
		    if(!$peticion)
		    {
		        throw new Exception($mysqli->error);
		    }
		    $registros = $peticion->num_rows;
		    if($registros>0)
			{
				while($row = $peticion->fetch_array(MYSQLI_BOTH))
				{	
					echo $row["descripcion"];
				}
			}
		}  
		catch(exception $e) 
		{
		   
		    echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
		}	
	}
	else if($_REQUEST["option"] == 4)
	{
		try
		{
		    $peticion = $mysqli->query("DELETE FROM unidades_medida WHERE id_unidad =".$_REQUEST['id_unidad']);
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
	else if($_REQUEST["option"] == 5)
	{
		try
		{
		    $peticion = $mysqli->query("UPDATE unidades_medida SET descripcion = '".$_REQUEST['nombre']."' WHERE id_unidad =".$_REQUEST['id_unidad']);
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
