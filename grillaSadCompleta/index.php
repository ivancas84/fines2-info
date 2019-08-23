<?php
require_once("../config/config.php");
require_once("class/model/Data.php");
require_once("class/model/Values.php");
require_once("function/array_group_value.php");
require_once("function/id_dependencia_numero.php");
require_once("function/numero_dependencia_abr_id.php");

$fechaAnio = (!empty($_GET["fecha_anio"])) ? $_GET["fecha_anio"] : 2019;
$fechaSemestre = (!empty($_GET["fecha_semestre"])) ? $_GET["fecha_semestre"] : 1;
$dependencia = (!empty($_GET["dependencia"])) ? $_GET["dependencia"] : null;
$comision = (!empty($_GET["comision"])) ? $_GET["comision"] : null;
$pendiente = (!empty($_GET["pendiente"])) ? true : false;
$curso = (!empty($_GET["curso"])) ? $_GET["curso"] : false;

$filtros = [];
if($curso){
    array_push($filtros, ["id", "=", $curso]);
} else {
    array_push($filtros, ["com_fecha_anio", "=", $fechaAnio]);
    array_push($filtros, ["com_fecha_semestre", "=", $fechaSemestre]);
    array_push($filtros, ["com_dvi__clasificacion_nombre","=","Fines"]);
    array_push($filtros, ["com_publicar","=",true]);
    if($pendiente) array_push($filtros, ["toma_activa", "=", false]);
    if($dependencia) array_push($filtros, ["com_dvi_sed_dependencia", "=", id_dependencia_numero($dependencia)]);
    if($comision) array_push($filtros, ["com_id", "=", $comision]);
}

$render = new Render();
$render->setCondition($filtros);
$render->setOrder(["ch_asi_nombre" => "ASC", "com_dvi_sed_numero" => "ASC", "com_tramo" => "ASC" ]);

$cursos = Dba::fetchAll(EntitySqlo::getInstanceRequire("curso")->all($render));
$asignaturas_cursos = array_group_value($cursos, "ch_asignatura");


require_once("grillaSadCompleta/template.html");
