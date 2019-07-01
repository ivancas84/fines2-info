<?php

require_once("./config.php");
require_once("class/model/Data.php");
require_once("class/model/Render.php");
require_once("config/valuesClasses.php");

$orden = (isset($_GET["orden"]) && ($_GET["orden"] == "tramo")) ? "tramo" : "sede";

$comisiones = Data::comisionesPublicadas($fecha, $orden);

$title = "Comisiones";
$content = "comisiones.html";

require_once("html/indexMenu.html");
