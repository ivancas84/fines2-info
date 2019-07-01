<?php
require_once("./config.php");
require_once("class/model/Dba.php");


$dba = new Dba();
$sql = EntitySqlo::getInstanceFromString("asignatura")->cantidadesCursosPublicados($fecha);
$rows = Dba::fetchAll($sql);


$i = 0;
$tomas_aprobadas = 0;
$tomas_error = 0;
$faltan = 0;
$cursos_ = 0;
$aprobadas_ = 0;
$errores_ = 0;
$renuncias_ = 0;
$faltan_ = 0;


$content = "porcentajeAsignacion.html";
$title = "Porcentaje Asignación";
require_once("html/index.html");
