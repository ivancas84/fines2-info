<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/path/to/config.php"); //desarrollo

define("PATH_HTTP_SITE" , "http://" . $_SERVER["SERVER_NAME"] . "/path/to/system"); //desarrollo

define("PATH_ROOT_SITE" ,  $_SERVER["DOCUMENT_ROOT"] . "/path/to/system"); //desarrollo


//definición de rutas de inclusión
set_include_path(get_include_path()
  . PATH_SEPARATOR . PATH_ROOT_SITE
);

session_start();
