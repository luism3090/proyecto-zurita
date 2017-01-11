<?php

include("conexion.php");
require('fpdf/fpdf.php');


$id_obra = $_REQUEST["id_obra"];

$fecha_inicio ="";
$fecha_fin ="";


    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    
   //$pdf->SetTextColor(25,50,90);
            
    $pdf->Cell(187,17,utf8_decode("SAVCO: Sistema de control de obras"),1);
    
     $pdf->Ln();
      $pdf->Ln();
      
       try
            {
$peticion = $mysqli->query("select nombre_obra as nombre, obr.descripcion as descripcion,obr.estado as estado,obr.municipio as municipio ,obr.ciudad,tbr.descripcion as tipo_obra, rec.descripcion as regimen, fec_inicio, fec_fin, nombre as nombre_cliente,ape_paterno,ape_materno,cli.estado as estadoc,cli.municipio as municipioc,cli.colonia as coloniac,cli.calle,cli.numero,cli.telefono,cli.rfc from obras obr join tipo_obra tbr on (obr.id_tipo_obra=tbr.id_tipo_obra) join regimen_contratacion rec on (obr.id_regimen=rec.id_regimen) join clientes cli on (obr.id_cliente=cli.id_cliente) where obr.id_obra = $id_obra "); 
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
                
                
                $registros =  $peticion->num_rows;
                
                if($registros>0)
                {
                    $suma = 0;
                  
                    
    
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
                        $pdf->SetFont('Arial','B',13);
                        $pdf->MultiCell(188, 13, utf8_decode("Obra: ".$row['nombre'].""), 'RLT');
                        $pdf->SetFont('Arial', 'B', 10);

//                        $pdf->Cell(54, 15, utf8_decode("Descripcion:"), 1);
                        $pdf->SetFont('Arial', 'B', 10);
                        //$pdf->Cell(134, 15, utf8_decode($row['descripcion']), 1);
                        // $pdf->Ln();
                        $pdf->MultiCell(188,13,utf8_decode("Descripción:".$row['descripcion']),1);
                         
                         $pdf->SetFont('Arial', 'B', 10);
                        $pdf->Cell(54, 10, utf8_decode("Tipo de obra:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['tipo_obra']), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Regimen de contratación:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['regimen']), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Estado:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['estado']), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Municipio:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['municipio']), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Ciudad:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['ciudad']), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Fecha de inicio:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['fec_inicio']), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Fecha Fin:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row['fec_fin']), 1);
                        $pdf->Ln();
                        
                        $fecha_inicio=$row['fec_inicio'];
                        $fecha_fin=$row['fec_fin'];
                        

                         // datos de cliente 

                        $pdf->Ln();
                        $pdf->Ln();

                        $pdf->SetFont('Arial', 'B', 13);
                        $pdf->MultiCell(188, 7, utf8_decode("Cliente: ".$row["nombre_cliente"]." ".$row["ape_paterno"]." ".$row["ape_materno"].""), 'RLT');
                        $pdf->SetFont('Arial', 'B', 10);

                        $pdf->Cell(54, 10, utf8_decode("Estado:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["estadoc"]), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Municipio:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["municipioc"]), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Colonia:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["coloniac"]), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Calle:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["calle"]), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("Número:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["numero"]), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("teléfono:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["telefono"]), 1);
                        $pdf->Ln();

                        $pdf->Cell(54, 10, utf8_decode("RFC:"), 1);
                        $pdf->Cell(134, 10, utf8_decode($row["rfc"]), 1);
                           
                    }
                                        
                }   
                
            }
            catch(exception $e) 
            {
                echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
            }

  
            
             try
            {
                $peticion = $mysqli->query("select * from rel_seguimiento_obra where id_obra = $id_obra ");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
                
               
                $registros =  $peticion->num_rows;
               
                if($registros>0)
                {
                     for($x=0 ;$x<15;$x++)
                     {
                        $pdf->Ln();
                     }
                         
                    $suma = 0;
                    
             
                     $posicion= 50;
                    
                     
                     
                     $contador = 0;
                     
                    while($row = $peticion->fetch_array(MYSQLI_BOTH))
                    {
                        // seguimiento de la obra
                       
                        $imagen=$row["foto"];
                        
                        
                       
                        if($imagen!="")
                        {
                            if($contador%2==0)
                            {
                                $pdf->SetFont('Arial', 'B', 14);
                                $pdf->Ln();
                                $pdf->Ln();

                                $pdf->Cell(187, 7, utf8_decode("Seguimiento  de obra"), 1);


                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Ln();
                                $pdf->Ln();
                                $pdf->Cell(187, 7, utf8_decode("          Fecha de inicio: $fecha_inicio                                             Fecha Fin: $fecha_fin    "), 1);
                                $pdf->Ln();   
                                $pdf->SetFont('Arial', 'B', 15);
                                $pdf->Ln();
                                
                                $pdf->SetFont('Arial', 'B', 15);

                                $pdf->MultiCell(187,8,utf8_decode($row["mes_anio"]),1,'C');
                                $pdf->MultiCell(187, 70,$pdf->Image('files/'.$row["foto"],28,$posicion,150,60), 1);
                                $pdf->SetFont('Arial', 'B', 8);

                                $pdf->MultiCell(187,8,utf8_decode("Descrición:  ".$row["descripcion"]),1);
                                $pdf->MultiCell(187,8,utf8_decode("Costo:       $".$row["costo"]),1);
                                
                                $posicion= $posicion+120;
                            }
                       
                            else
                            {
                             
                                
                                
                               $pdf->SetFont('Arial', 'B', 15);

                                $pdf->MultiCell(187,8,utf8_decode($row["mes_anio"]),1,'C');
                                $pdf->MultiCell(187, 70,$pdf->Image('files/'.$row["foto"],28,$posicion,150,60), 1);
                                $pdf->SetFont('Arial', 'B', 8);

                                $pdf->MultiCell(187,8,utf8_decode("Descrición:  ".$row["descripcion"]),1);
                                $pdf->MultiCell(187,8,utf8_decode("Costo:       $".$row["costo"]),1);
                                
                                
                                $posicion= $posicion-120;
                                
                            }
                            
                            if($registros-1==$contador)
                            {
                                 
                                $pdf->Ln();
                                $pdf->Ln();
                            }
                            else
                            {
                                $pdf->Ln();
                                $pdf->Ln();
                                $pdf->Ln();
                            }
                            //$posicion= $posicion+20;
                            
                            
                        }
                        else
                        {
                             
                        }
//                        $pdf->Cell(30, 20, utf8_decode("$".$row["costo"]), 1);
//                         $pdf->Ln();

                        $suma = $suma+$row["costo"];
                        
                        $contador++;
                        
                    }
                    $pdf->SetFont('Arial', 'B', 14);
              
                      
                       //$this->SetFillColor(25,50,200);
    

                      
                    $pdf->Cell(187,7,utf8_decode("Costo Total: $".$suma),1);
                       
                    
                }   
                
            }
            catch(exception $e) 
            {
                echo "@%@Ocurrió un error en la base de datos. @%@ ".$e->getMessage()." ";
            }

    
    


    
    
    
    
    
$pdf->Output();
