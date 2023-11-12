<?php

if ($xhr) {
    require_once "../../config/connection.php";
    require_once "../../controller/mainController.php";
} else {
    require_once "./config/connection.php";
    require_once "./controller/mainController.php";
}

/**
 * Clase controlador para la gestion general del sistema
 */
class gestionController extends mainController
{
    public function ListarProductos()
    {
        $conexion = new Connection();
        $conexion = $conexion->connect();

        $sql = "CALL ListarProductos()";
        $statement = $conexion->prepare($sql);
        $statement->execute();
        $datos = $statement->fetchAll(PDO::FETCH_ASSOC);
        $mData = array();

        $contador = 1;
        foreach ($datos as $row) {
            // $estadoproduc = mainModel::stockProducto($row['stock']);
            $directorio = mainModel::imagenProducto($row['imagen']);
            $data = [
                "contador" => $contador,
                "idproducto" => $row['idproducto'],
                "producto" => $row['producto'],
                "precio" => $row['precio'],
                "descripcion" => $row['descripcion'],
                "stock" => $row['stock'],
                "categoria" => $row['categoria'],
                "color" => $row['color'],
                "imagen" => '<img class="image-table-product" src="' . $directorio . '">',
                "editar" => '<button class="mostrar-producto" data-bs-toggle="modal" data-bs-target="#productoupdate" data-bs-id="' . $row['idproducto'] . '">
                                <img src="' . SERVERURL . 'view/img/svg/eyes.svg">
                            </button>'
                // "estado" => $estadoproduc
            ];
            $mData[] = $data;
            $contador++;
        }

        $data = json_encode($mData, JSON_UNESCAPED_UNICODE);

        return $data;
    }

    public function DatosCategoria($nombrecategoria)
    {
        $conexion = new Connection();
        $conexion = $conexion->connect();

        $sql = "CALL DatosCategoria('$nombrecategoria', 0, 99)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $mData = array();

        $contador = 1;
        $grupo = array(); // Nuevo array para agrupar productos

        foreach ($datos as $row) {
            $directorio = mainModel::imagenProducto($row['imagen']);
            $data = [
                "contador" => $contador,
                "idproducto" => $row['idproducto'],
                "producto" => $row['producto'],
                "precio" => $row['precio'],
                "descripcion" => $row['descripcion'],
                "stock" => $row['stock'],
                "categoria" => $row['categoria'],
                "color" => $row['color'],
                "imagen" => $directorio
            ];

            $grupo[] = $data;

            // Cuando el contador alcanza 3, añade el grupo al mData y reinicia el grupo
            if ($contador === 3) {
                $mData[] = $grupo;
                $contador = 0;
                $grupo = array();
            }

            $contador++;
        }

        // Si queda algún producto en el último grupo, agrégalo
        if (!empty($grupo)) {
            $mData[] = $grupo;
        }

        $data = json_encode($mData, JSON_UNESCAPED_UNICODE);

        return $data;
    }

    public function ProductoById($idproducto)
    {

        $conexion = new Connection();
        $conexion = $conexion->connect();

        $sql = "CALL ProductoById($idproducto)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $mData = array();

        $contador = 1;
        foreach ($datos as $row) {
            // $estadoproduc = mainModel::stockProducto($row['stock']);
            $directorio = mainModel::imagenProducto($row['imagen']);
            $data = [
                "contador" => $contador,
                "idproducto" => $row['idproducto'],
                "producto" => $row['producto'],
                "precio" => $row['precio'],
                "descripcion" => $row['descripcion'],
                "stock" => $row['stock'],
                "categoria" => $row['categoria'],
                "color" => $row['color'],
                "imagen" => '<img class="image-table-product" src="' . $directorio . '">'
                // "editar" => '<button class="mostrar-producto" data-bs-toggle="modal" data-bs-target="#productoupdate" data-bs-id="' . $row['idproducto'] . '">
                //                 <img src="' . SERVERURL . 'view/img/svg/eyes.svg">
                //             </button>'
                // "estado" => $estadoproduc
            ];
            $mData[] = $data;
            $contador++;
        }

        $data = json_encode($mData, JSON_UNESCAPED_UNICODE);

        return $data;

        return $consulta;
    }

    public function ListarCategorias()
    {
        $conexion = new Connection();
        $conexion = $conexion->connect();

        $sql = "CALL ListarCategorias()";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $mData = array();

        foreach ($datos as $row) {
            $data = [
                "idcategoria" => $row['idcategoria'],
                "categoria" => $row['categoria']
            ];
            $mData[] = $data;
        }

        $data = json_encode($mData, JSON_UNESCAPED_UNICODE);

        return $data;
    }
}
