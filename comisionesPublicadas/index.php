<?php
require_once("../config/config.php");
require_once("class/model/Data.php");
require_once("class/model/Render.php");

require_once("class/model/Values.php");
require_once("function/array_combine_key.php");
require_once("function/dependencias.php");
require_once("function/id_dependencia_numero.php");
require_once("function/ordenamientos.php");




$title = "Comisiones";
$fechaAnio = (!empty($_GET["fecha_anio"])) ? $_GET["fecha_anio"] : 2019;
$fechaSemestre = (!empty($_GET["fecha_semestre"])) ? $_GET["fecha_semestre"] : 1;
$dependencia = (!empty($_GET["dependencia"])) ? $_GET["dependencia"] : "456";
$orden =  (!empty($_GET["orden"])) ? $_GET["orden"] : "sede";

$render = new Render();
$render->setCondition(filtros($fechaAnio, $fechaSemestre, $dependencia));
$render->setOrder(orden($orden));

$sql = EntitySqlo::getInstanceRequire("comision")->all($render);
$comisiones = Dba::fetchAll($sql);

$content = "comisionesPublicadas/template.html";
require_once("index/menu.html");


function orden($orden){
    switch(strtolower($orden)){
        case "sede": return ["dvi_sed_numero" => "ASC", "tramo" => "ASC" ]; break;
        case "tramo": return ["tramo" => "ASC", "dvi_sed_numero" => "ASC"]; break;
        case "apertura": return ["apertura" => "DESC", "tramo" => "ASC", "dvi_sed_numero" => "ASC"]; break;
        case "dependencia": return ["dvi_sed_dependencia" => "ASC", "dvi_sed_numero" => "ASC", "tramo" => "ASC",]; break;
        case "coordinador": return ["dvi_sed_coordinador" => "ASC", "dvi_sed_numero" => "ASC", "tramo" => "ASC",]; break;
    }
}

function filtros($fechaAnio, $fechaSemestre, $dependencia){
    return [
        ["fecha_anio", "=", $fechaAnio],
        ["fecha_semestre", "=", $fechaSemestre],    
        ["dvi__clasificacion_nombre","=","Fines"],
        ["dvi_sed_dependencia","=",id_dependencia_numero($dependencia)],
        ["publicar","=",true],
    ];
}
