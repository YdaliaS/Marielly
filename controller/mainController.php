<?php
if ($xhr) {
    require_once "../../config/connection.php";
    require_once "../../model/mainModel.php";
} else {
    require_once "./config/connection.php";
    require_once "./model/mainModel.php";
}
/**
 * Clase controlador global del sistema
 */
class mainController extends mainModel
{

}