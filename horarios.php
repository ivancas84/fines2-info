<?php

require_once("./config.php");
require_once("class/model/Data.php");
//require_once("class/model/Values.php");


$dba = new Data();
$fecha = (isset($_GET["fecha"])) ? $_GET["fecha"] : "2018-02-01";
$horarios = $dba->horarios($_GET["id"]);


//variables del html
$title = "Horarios";
$content = "horarios.html";
$numero_comision = $horarios[0]["numero_division"] .  "/" . $horarios[0]["anio"] . $horarios[0]["semestre"];
$sede = $horarios[0]["numero_sede"] . " " . $horarios[0]["nombre"];
$domicilio = $horarios[0]["calle"] . " N° " . $horarios[0]["numero_domicilio"] . " entre " . $horarios[0]["entre"] . " " . $horarios[0]["barrio"] . " " . $horarios[0]["localidad"];
$orientacion = $horarios[0]["orientacion"];
//$coordinador = $values->nombrePersona($horarios[0], "coordinador");

(!empty($horarios[0]["coordinador_sobrenombre"])) ? $horarios[0]["coordinador_sobrenombre"] : $horarios[0]["coordinador_nombres"];

require_once("html/index.html");
