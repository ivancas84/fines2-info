<?php
require_once("../config/config.php");
require_once("class/model/Data.php");
require_once("class/model/Values.php");

function get_data($d){
    return [
        "sede" => new SedeValues($d["comision_"]["division_"]["sede_"]),
        "domicilio" => new DomicilioValues($d["comision_"]["division_"]["sede_"]["domicilio_"]),
        "asignatura" => new AsignaturaValues($d["carga_horaria_"]["asignatura_"]),
        "carga_horaria" => new CargaHorariaValues($d["carga_horaria_"]),
        "curso" => new CursoValues($d),
        "comision" => new ComisionValues($d["comision_"]),
        "division" => new DivisionValues($d["comision_"]["division_"]),
    ];
}

$fechaAnio = (!empty($_GET["fecha_anio"])) ? $_GET["fecha_anio"] : 2019;
$fechaSemestre = (!empty($_GET["fecha_semestre"])) ? $_GET["fecha_semestre"] : 1;
$filtros = [
    ["com_fecha_anio", "=", $fechaAnio],
    ["com_fecha_semestre", "=", $fechaSemestre],
    ["toma_activa","=",false],
    ["com_dvi__clasificacion_nombre","=","Fines"],
    ["com_publicar","=",true],
    //["horario","=",true]
];

$render = new Render();
$render->setCondition($filtros);
$render->setOrder(["ch_asi_nombre" => "ASC", "com_dvi_sed_numero" => "ASC", "com_tramo" => "ASC" ]);

$cursos = Dba::all("curso", $render);
require_once("grillaSad/template.html");


