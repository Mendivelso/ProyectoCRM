<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/demograficos.class.php");
    /** Instancia la clase experiencia*/
    $datos = new demograficos($db);
    $user = 1;
    /** captura el tipo de accion a realizar*/
    $accion = $_REQUEST['accion'];
    /** conmutador que determina las acciones a realizar para
     * este modulo
     */
    switch($accion){
    /* Obtiene un solo registro de Experiencias */
      case "single":
      $jsondata = array();
      $where = " Where Id = " . $_REQUEST['pId'];
      $result = $ser->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Titulo'] = $r["Titulo"];
        $jsondata['Imagen_principal'] = $r["Imagen_principal"];
        $jsondata['Descripcion'] = $r["Descripcion"];
        $jsondata['Status'] = $r["Status"];
        $jsondata['Url'] = $r["Url"];
        $jsondata['success'] = true;
        $jsondata['message'] = "recuperado correctamente";
      }
     else
      {
          $jsondata['success'] = false;
          $jsondata['message'] = "Fallo al obtener el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;
    /* insert  de Servicios */
    case "ins":


      $jsondata = array();
      		// Realiza Insert
		    $data = array("Pais"=>$_REQUEST['optPais'].$_REQUEST['paises'],  "Nucleo_familiar"=>$_REQUEST['opt21']. $_REQUEST['opt22'].$_REQUEST['opt23'].$_REQUEST['opt24'].$_REQUEST['opt25'].$_REQUEST['opt26'],
		    		"Hogar"=>$_REQUEST['opt31'].$_REQUEST['opt32'].$_REQUEST['opt33'].$_REQUEST['opt34'].$_REQUEST['txt3o'],
		    		"Pregrado1"=>$_REQUEST['pre1'], "Inst1"=>$_REQUEST['InsE1'], "Ano1"=>$_REQUEST['txtA1'], "Pais1"=>$_REQUEST['txtP1'],
		    		"Pregrado2"=>$_REQUEST['pre2'], "Inst2"=>$_REQUEST['InsE2'], "Ano2"=>$_REQUEST['txtA2'], "Pais2"=>$_REQUEST['txtP2'],
		    		"Especializacion1"=>$_REQUEST['esp1'], "Inst3"=>$_REQUEST['InsE3'], "Ano3"=>$_REQUEST['txtA3'], "Pais3"=>$_REQUEST['txtP3'],
		    		"Especializacion2"=>$_REQUEST['esp2'], "Inst4"=>$_REQUEST['InsE4'], "Ano4"=>$_REQUEST['txtA4'], "Pais4"=>$_REQUEST['txtP4'],
		    		"Maestria1"=>$_REQUEST['mta1'], "Inst5"=>$_REQUEST['InsE5'], "Ano5"=>$_REQUEST['txtA5'], "Pais5"=>$_REQUEST['txtP5'],
		    		"Maestria2"=>$_REQUEST['mta2'], "Inst6"=>$_REQUEST['InsE6'], "Ano6"=>$_REQUEST['txtA6'], "Pais6"=>$_REQUEST['txtP6'],
		    		"Doctorado1"=>$_REQUEST['doct'], "Inst7"=>$_REQUEST['InsE7'], "Ano7"=>$_REQUEST['txtA7'], "Pais7"=>$_REQUEST['txtP7'],
		    		"Postdoctorado1"=>$_REQUEST['post'], "Inst8"=>$_REQUEST['InsE8'], "Ano8"=>$_REQUEST['txtA8'], "Pais8"=>$_REQUEST['txtP8'],
					"Ingresos_anuales"=>$_REQUEST['opt51'].$_REQUEST['opt52'].$_REQUEST['opt53'].$_REQUEST['opt54'],
		    	"Status"=>1, "Created_by"=>$user, "Created_ad"=>date("Y-m-d H:i:s"), "Usuario_Id"=>$_REQUEST['Userdoc']
		    );
		  	if($datos->insertData($data)){
			  	/* Tomamos el Id del ultimo registro
			  	$vId = $db->lastInsert();*/
			  	$jsondata['success'] = true;
			  	$jsondata['message'] = "Registrado";

		  	}
		  	else
		  	{
		  	  $jsondata['success'] = false;
		  	  $jsondata['message'] = "Falla al realizar el registro";
		  	}

      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
   break;






    /*crea update de Expereincias */

    case "upd":
      $jsondata = array();
      $vimg = $_FILES['txtImg']['name'];
      if ($vimg != "") {
        // si file viene lleno
		$data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
		);
        $where = "Id = " . $_REQUEST['txtId'];
        $ser->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          $carpeta = "../public/servicios/".$_REQUEST['txtId'];
          $destino2 = "../public/servicios/".$_REQUEST['txtId']."/".$vimg;
          $dest = "public/servicios/".$_REQUEST['txtId']."/".$vimg."'-";
          $ruta2 = $_FILES['txtImg']['tmp_name'];
          if(copy($ruta2,$destino2)){
            $data = array("Imagen_principal"=>$dest);
            $where = " Id = " . $_REQUEST['txtId'];
            if($ser->updateData($data, $where)){
              $jsondata['success'] = true;
              $jsondata['message'] = "Modificado Correctamente";
            }else {
              $jsondata['success'] = false;
              $jsondata['message'] = "No fue posible Actualizar sus Datos";
            }

          }else{
            $jsondata['success'] = false;
            $jsondata['message'] = "No Fue posible subir su Imagen";
          }

        }else{
          $jsondata['success'] = false;
          $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
        }

      }else{
        /*si tipo file esta vacio*/
        $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
        );
        $where = "Id = " . $_REQUEST['txtId'];
        if($ser->updateData($data, $where))
         {
           $jsondata['success'] = true;
           $jsondata['message'] = "Actualizado correctamente";
         }else {
          $jsondata['success'] = false;
          $jsondata['message'] = "No fue posible Actualizar sus Datos";
        }
      }

      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
   break;

   // cambia estado

   case "status":
      $jsondata = array();
      // Realiza Insert
        $data = array("Status"=>$_REQUEST['pStatus'], "Descripcion"=>$_REQUEST['txtDes'], "Updated_by"=>$user, "Updated_at"=>date("Y-m-d H:i:s")
                  );
      $where = "Id = " . $_REQUEST['pId'];
     if($servicio->updateData($data, $where))
     {
       $jsondata['success'] = true;
       $jsondata['message'] = "Modificado correctamente";
      }
      else
      {
        $jsondata['success'] = false;
        $jsondata['message'] = "Falla al modificar el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
   break;
   /* Crea delete de usuarios */
   case "del":
     $Id =  $_REQUEST['pId'];
     $jsondata = array();
     if($ser->delData($Id))
     {
       $jsondata['success'] = true;
       $jsondata['message'] = "Eliminado correctamente";
     }
     else
     {
      $jsondata['success'] = false;
      $jsondata['message'] = "Falla al Desactivar el registro";
     }
     header('Content-type: application/json; charset=utf-8');
     echo json_encode($jsondata);
   break;


    }
?>
