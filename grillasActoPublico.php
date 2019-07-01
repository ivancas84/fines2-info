<?php

require_once("./config.php");
require_once("class/model/Data.php");

$data = new Data();
$rows = $data->actoPublico($fecha);

$title = "Grillas Acto Público";
require_once("html/grillasActoPublico.html");
