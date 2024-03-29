<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/necesidades.class.php");
    /** Instancia la clase experiencia*/
    $datos = new necesidad($db);
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
          $data = array("Necesidad1"=>$_REQUEST['txtN1'], "Calificacion1"=>$_REQUEST['txtC1'], "Necesidad2"=>$_REQUEST['txtN2'], "Calificacion2"=>$_REQUEST['txtC2'],
                  "Necesidad3"=>$_REQUEST['txtN3'], "Calificacion3"=>$_REQUEST['txtC3'],
                  "Pnecesidad1"=>$_REQUEST['txtNn1'], "Pcalificacion1"=>$_REQUEST['txtCc1'], "Pnecesidad2"=>$_REQUEST['txtNn2'], "Pcalificacion2"=>$_REQUEST['txtCc2'],
                  "Pnecesidad3"=>$_REQUEST['txtNn3'], "Pcalificacion3"=>$_REQUEST['txtCc3'],
                  "Status"=>1, "Created_by"=>$user, "Created_ad"=>date("Y-m-d H:i:s"), "Usuario_Id"=>$_REQUEST['Userdoc']
            );
            if($datos->insertData($data)){
                /* Tomamos el Id del ultimo registro
                $vId = $db->lastInsert();*/
                $jsondata['success'] = true;
                $jsondata['message'] = "Registrado";
                // header('Location: ../expectativas.php');
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
