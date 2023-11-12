<?php
    $xhr = true;
    session_start();

    require_once "../../controller/gestionController.php";
    $opciones = new gestionController();

    if ($_POST['action'] == 'ProductoById') {
        echo $opciones->ProductoById($_POST['idproducto']);
    }

    if ($_POST['action'] == 'DatosCategoria') {
        echo $opciones->DatosCategoria($_POST['nombrecategoria']);
    }