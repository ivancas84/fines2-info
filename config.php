<?php

require_once("../programacion/src/config/config.php");
require_once("function/settypebool.php");

$page = (!empty($_GET["page"])) ? $_GET["page"] : 1;
$coordinadores = (!empty($_GET["coordinadores"])) ? settypebool($_GET["coordinadores"]) : false;
$optCoord = $coordinadores ? "=" : "<>";
$fecha = (!empty($_GET["fecha"])) ? $_GET["fecha"] : '2018-02-01';



?>
