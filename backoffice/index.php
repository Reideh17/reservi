<?php
require_once "controllers/plantilla.controller.php";
require_once "controllers/general.controlador.php";

require_once "controllers/user.controller.php";
require_once "models/user.model.php";

require_once "controllers/reserva.controller.php";
//require_once "models/reserva.model.php";

//require_once "controllers/academia.controller.php";
//require_once "models/academia.model.php";

//require_once "controllers/multinivel.controlador.php";
//require_once "models/multinivel.modelo.php";

// https://github.com/PHPMailer/PHPMailer
require_once "../vendor/autoload.php";

$plantilla = new ControllerPlantilla();
$plantilla -> ctrPlantilla();