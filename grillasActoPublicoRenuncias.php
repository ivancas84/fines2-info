<?php

require_once("./config.php");
require_once("class/model/Dba.php");

$dba = new Dba();
$sqlo = new CursoSqlo();
$sql = $sqlo->actoPublicoRenuncias($fecha);

echo "<pre>";
echo $sql;
$db = Dba::dbInstance();
try {
  $result = $db->query($sql);
  $rows = $db->fetchAll($result);
} finally {
  Dba::dbClose();
}

$title = "Grillas Acto Público Renuncias";

require_once("html/grillasActoPublicoSinCubrir.html");
