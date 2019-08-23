<?php

require_once("../config/config.php");
require_once("class/model/Data.php");
require_once("class/model/Values.php");
require_once("function/array_combine_key.php");
require_once("function/array_combine_keys.php");

require_once("function/array_unique_key.php");

require_once("function/array_group_value.php");

$plan_distribuciones = plan_distribuciones();
$plan_tramo_distribuciones = plan_tramo_distribuciones($plan_distribuciones);


$content = "distribucionHoraria/template.html";
require_once("index/menu.html");


function plan_distribuciones(){
  $render = new Render();
  $render->setOrder(["ch_pla_resolucion" => "DESC", "ch_pla_orientacion" => "ASC", "ch_tramo" => "ASC", "dia"=>"ASC"]);
  $sql = EntitySqlo::getInstanceRequire("distribucion_horaria")->all($render);

  return array_group_value(Dba::fetchAll($sql), "ch_plan");
}

function plan_tramo_distribuciones($plan_distribuciones){
  $plan_tramo_distribuciones = [];
  foreach($plan_distribuciones as $id_plan => $distribuciones){
    if(!key_exists($id_plan, $plan_tramo_distribuciones)) $plan_tramo_distribuciones[$id_plan] = [];
    $plan_tramo_distribuciones[$id_plan] = array_group_value($distribuciones, "ch_tramo");
  }
  return $plan_tramo_distribuciones;
}