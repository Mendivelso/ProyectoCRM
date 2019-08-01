<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/laborales.class.php");
    /** Instancia la clase experiencia*/
    $datos = new laboral($db);
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
            $data = array("Labora"=>$_REQUEST['opt11'].$_REQUEST['opt12'].$_REQUEST['opt13'].$_REQUEST['opt14'].$_REQUEST['opt15'].$_REQUEST['opt16'].$_REQUEST['opt1O'],
              "Trabaja"=>$_REQUEST['opt21'].$_REQUEST['opt22'].$_REQUEST['opt23'].$_REQUEST['opt2O'], "Anos_graduado"=>$_REQUEST['Gra'], "Anos_ejercicio"=>$_REQUEST['Ejer'],
              "Actualmente_usted"=>$_REQUEST['opt41'].$_REQUEST['opt42'].$_REQUEST['opt43'], "Exterior"=>$_REQUEST['opt51'].$_REQUEST['opt52'].$_REQUEST['exterior'],
              "Areas_Experiencia"=>$_REQUEST['opt61'].$_REQUEST['opt62'].$_REQUEST['opt63'].$_REQUEST['opt64'].$_REQUEST['opt65'].$_REQUEST['opt66'].$_REQUEST['opt67'].$_REQUEST['opt68'].$_REQUEST['opt69'].$_REQUEST['opt610'].$_REQUEST['opt611'].$_REQUEST['opt612'].$_REQUEST['opt613'].$_REQUEST['opt614'].
              $_REQUEST['opt615'].$_REQUEST['opt616'].$_REQUEST['opt617'].$_REQUEST['opt618'].$_REQUEST['opt619'].$_REQUEST['opt620'].$_REQUEST['opt621'].$_REQUEST['opt622'].$_REQUEST['opt23'].$_REQUEST['opt624'].$_REQUEST['opt625'].$_REQUEST['opt626'].$_REQUEST['opt627'].$_REQUEST['opt628'].$_REQUEST['opt629'].$_REQUEST['opt630'].$_REQUEST['optO'],
				"Status"=>1, "Created_by"=>$user, "Created_ad"=>date("Y-m-d H:i:s"), "Usuario_Id"=>$_REQUEST['Userdoc']
            );
            if($datos->insertData($data)){
                /* Tomamos el Id del ultimo registrod
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
