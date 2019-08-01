<?php
include_once("../datos/AnsTek_libs/integracion.inc.php");
if ($_REQUEST['error'] == 2){
	Session::logout("../../index.php");
}elseif ($_REQUEST['error'] == 1) {
	Session::logout("../../index.php");
}else {
	Session::logout("../../index.php");
}





 ?>
