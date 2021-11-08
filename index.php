<?php

require_once "controllers/plantilla.controller.php";
require_once "controllers/route.controller.php";

require_once "backoffice/controllers/user.controller.php";
require_once "backoffice/models/user.model.php";

require_once "vendor/autoload.php";


$plantilla = new ControllerPlantilla();
$plantilla -> ctrPlantilla();

