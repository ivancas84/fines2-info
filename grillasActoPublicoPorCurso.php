<?php

require_once("./config.php");
require_once("class/model/Dba.php");
require_once("config/valuesClasses.php");
require_once("class/Filter.php");

$id = Filter::requestRequired("id");

$row = Dba::get("curso", $id);
$rows = [$row];


$title = "Grillas Acto Público";

require_once("html/grillasActoPublico_.html");
