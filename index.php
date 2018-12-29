<?php



# =====================================
# =           CONTROLADORES           =
# =====================================
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/actividades.controlador.php";
require_once "controladores/subactividades.controlador.php";
require_once "controladores/alumnos.controlador.php";


# ===============================
# =           MODELOS           =
# ===============================
require_once "modelos/rutas.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/actividades.modelo.php";
require_once "modelos/subactividades.modelo.php";
require_once "modelos/alumnos.modelo.php";


# =================================
# =           PLANTILLA           =
# =================================
$plantilla = new ControladorPlantilla();

$plantilla -> ctrPlantilla();
