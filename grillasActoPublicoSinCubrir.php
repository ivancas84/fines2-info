<?php

require_once("./config.php");
require_once("class/model/Dba.php");
require_once("config/valuesClasses.php");


$dba = new Dba();
$sqlo = new CursoSqlo();
$sql = $sqlo->actoPublicoSinCubrir($fecha);

$db = Dba::dbInstance();
try {
  $result = $db->query($sql);
  $rows_ = $db->fetchAll($result);
  $rows = EntitySql::getInstanceString("curso")->jsonAll($rows_);
} finally {
  Dba::dbClose();
}

$title = "Grillas Acto Público";

require_once("html/grillasActoPublico_.html");
