<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/habitos.class.php");
    /** Instancia la clase experiencia*/
    $datos = new habito($db);
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
          $data = array("Pregunta_1"=>$_REQUEST['optr1'], "Pregunta_2"=>$_REQUEST['optr2'], "Pregunta_3"=>$_REQUEST['optr3'], "Pregunta_4"=>$_REQUEST['optr4'],
                "Pregunta_5"=>$_REQUEST['optr5'], "Pregunta_6"=>$_REQUEST['optr6'], "Pregunta_7"=>$_REQUEST['optr7'], "Pregunta_8"=>$_REQUEST['optr8'], "Pregunta_9"=>$_REQUEST['optr9'],
                "Pregunta_10"=>$_REQUEST['optr10'], "Pregunta_11"=>$_REQUEST['optr11'], "Pregunta_12"=>$_REQUEST['optr12'], "Pregunta_13"=>$_REQUEST['optr13'], "Pregunta_14"=>$_REQUEST['optr14'],
                "Pregunta_15"=>$_REQUEST['optr15'], "Pregunta_16"=>$_REQUEST['optr16'], "Pregunta_17"=>$_REQUEST['optr17'], "Pregunta_18"=>$_REQUEST['optr18'], "Pregunta_19"=>$_REQUEST['optr19'], "Pregunta_20"=>$_REQUEST['optr20'],
                "Pregunta_17"=>$_REQUEST['optr17'], "Pregunta_18"=>$_REQUEST['optr18'], "Pregunta_19"=>$_REQUEST['optr19'], "Pregunta_20"=>$_REQUEST['optr20'], "Pregunta_21"=>$_REQUEST['optr21'],
                "Pregunta_22"=>$_REQUEST['optr22'], "Pregunta_23"=>$_REQUEST['optr23'], "Pregunta_24"=>$_REQUEST['optr24'], "Pregunta_25"=>$_REQUEST['optr25'], "Pregunta_26"=>$_REQUEST['optr26'],
                "Status"=>1, "Created_by"=>$user, "Created_ad"=>date("Y-m-d H:i:s"), "Usuario_Id"=>$_REQUEST['txtUser']
            );
            if($datos->insertData($data)){
                /* Tomamos el Id del ultimo registro
                $vId = $db->lastInsert();*/
                $jsondata['success'] = true;
                $jsondata['message'] = "Registrado";
                header('Location: ../necesidades.php?P='.base64_encode($_REQUEST['txtUser']));
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
