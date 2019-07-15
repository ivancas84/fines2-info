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
$filtros = [
    ["com_fecha_anio", "=", $fechaAnio],
    ["com_fecha_semestre", "=", $fechaSemestre],
    ["com_dvi__clasificacion_nombre","=","Fines"],
    ["com_publicar","=",true],
    //["horario","=",true]
];

if($dependencia) array_push($filtros, ["com_dvi_sed_dependencia", "=", id_dependencia_numero($dependencia)]);


$render = new Render();
$render->setCondition($filtros);
$render->setOrder(["ch_asi_nombre" => "ASC", "com_dvi_sed_numero" => "ASC", "com_tramo" => "ASC" ]);

$cursos = Dba::fetchAll(CursoSqlo::getInstance()->all($render));
$asignaturas_cursos = array_group_value($cursos, "ch_asignatura");


require_once("grillaSadCompleta/template.html");
