<?php

require_once("./config.php");
require_once("class/db/My.php");


$db = new DbSqlMy(DATA_HOST, DATA_USER, DATA_PASS, DATA_DBNAME, DATA_SCHEMA);
try {
  $sql = "
SET lc_time_names = 'es_AR';
";
  $result = $db->query($sql);

  $sql = "
SELECT anio, semestre, COUNT(*) AS cantidad
FROM comision
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN plan ON ( division.plan = plan.id )
WHERE fecha = '{$fecha}'
AND comision.publicar
AND plan.id != 3
GROUP BY anio, semestre;
";

  $result = $db->query($sql);
  $comisiones = $db->fetchAll($result);


    $sql = "
SELECT COUNT(DISTINCT sede.id) AS cantidad
FROM sede
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
INNER JOIN plan ON ( division.plan = plan.id )
WHERE fecha = '{$fecha}'
AND comision.publicar
AND plan.id != 3;
";

  $result = $db->query($sql);
  $cantidad_sedes = $db->fetchRow($result, 1);

} finally {
  $db->close();
}

$title = "Comisiones";
$content = "cantidadComisiones.html";
$total = 0;
$sedes = $cantidad_sedes[0];

require_once("html/index.html");
