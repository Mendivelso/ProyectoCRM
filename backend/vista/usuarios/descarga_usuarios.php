<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Bogota');
$jsondata = array();
if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel*/
require_once '../../datos/Classes/PHPExcel.php';
include_once("../../../backend/datos/AnsTek_libs/integracion.inc.php");
include_once("../../datos/model/usuarios.class.php");



    $accion = $_REQUEST['accion'];

    switch($accion){

        case "desc":


            $dateC = $_REQUEST['Date1'];
             $date1 = substr($dateC, 0, 10);
             $date2 = substr($dateC, 13);


            if ($date1 != "" AND $date2 == "") {
                $where  = " Where Created_at  LIKE  " . "'%".  $date1 . "%'";
            }elseif ($date1 == ""  and $date2 == "") {
                $where  = " Where Id > 0";
            }else{
                // $where = " Where  Created_date >= ". " '" . $date1. " 00:00:00'". "  and  Created_date <= ". " '" . $date2. " 23:59:00'";
                $where = " Where  Created_at BETWEEN "."'" . $date1. " 00:00:00'". " and  "."'" . $date2. " 23:59:00'";
            }


                $user = new usuario($db);
                $result = $user->selectAll($where);
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                        // Set document properties
                        $objPHPExcel->getProperties()->setCreator("Conjunto Digital")
                                                     ->setLastModifiedBy("Developer")
                                                     ->setTitle("Office 2007 XLSX Test Document")
                                                     ->setSubject("Office 2007 XLSX Test Document")
                                                     ->setDescription("Reporte registros campaña admisiones uan.")
                                                     ->setKeywords("office 2007 openxml php")
                                                     ->setCategory("Test result file");
                        // Add some data
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('A1', 'Nombres')
                                    ->setCellValue('B1', 'Cedula')
                                    ->setCellValue('C1', 'Telefono')
                                    ->setCellValue('D1', 'Direccion')
                                    ->setCellValue('E1', 'Email')
                                    ->setCellValue('F1', 'Perfil')
                                    ->setCellValue('G1', 'Usuario')
                                    ->setCellValue('H1', 'Created_at')
                                    ->setCellValue('I1', 'Status');





                        if($db->numRows($result) > 0){
                            $i=2;
                          while ($r = $db->datos($result)) {
                            $date = $r['Created_at'];
                            $nuevafecha = strtotime ( '-5 hour' , strtotime ($date));
                            $nuevafecha = date( 'Y-m-d H:i:s' , $nuevafecha );

                            $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("A$i", $r['Nombre'])
                                        ->setCellValue("B$i", $r['Cedula'])
                                        ->setCellValue("C$i", $r['Telefono'])
                                        ->setCellValue("D$i", $r['Direccion'])
                                        ->setCellValue("E$i", $r['Email'])
                                        ->setCellValue("F$i", $r['Perfil'])
                                        ->setCellValue("G$i", $r['Usuario'])
                                        ->setCellValue("H$i", $r['Created_at'])
                                        ->setCellValue("I$i", $r['Status']);
                                        $i++;


                            //$r['Id']
                          }




                        }
                        else{

                        }

                    // Rename worksheet
                    $objPHPExcel->getActiveSheet()->setTitle('Registros_Incap_Cali');
                    $objPHPExcel->setActiveSheetIndex(0);

                    // Redirect output to a client’s web browser (Excel5)
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="contactos_incap_cali.xls"');
                    header('Cache-Control: max-age=0');
                    // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');

                    // If you're serving to IE over SSL, then the following may be needed
                    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header ('Pragma: public'); // HTTP/1.0

                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                    $objWriter->save('php://output');




        break;
        exit;




    }




?>