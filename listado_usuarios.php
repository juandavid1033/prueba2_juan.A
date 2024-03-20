<?php
require_once("conexion/conexion.php");

// Conectar a la base de datos
$db = new Database();
$conectar = $db->conectar();

// Procesar el formulario de creación de usuarios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $id_comida = $_POST['id_comida']; // Nuevo campo id_comida
    
    // Definir la fecha actual
    $fecha_ing = date("Y-m-d");
    
    // Definir un valor para id_tip_doc, ajusta según sea necesario
    $id_tip_doc = 1;

    // Insertar el nuevo usuario en la base de datos
    $insertar = $conectar->prepare("INSERT INTO usuario (documento, nombre, correo, telefono, fecha_ing, id_tip_doc, id_comida) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertar->execute([$documento, $nombre, $correo, $telefono, $fecha_ing, $id_tip_doc, $id_comida]);

    // Recargar la página para mostrar la lista actualizada
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Obtener la lista de usuarios registrados ordenados por fecha de ingreso
$lista_usuarios = $conectar->prepare("SELECT * FROM usuario ORDER BY fecha_ing ASC");
$lista_usuarios->execute();
$listas_usuarios = $lista_usuarios->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Creación de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        form {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Lista de Usuarios Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Fecha de Ingreso</th>
                <th>ID de Tipo de Documento</th>
                <th>ID de Comida</th> <!-- Nueva columna -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listas_usuarios as $usuario) { ?>
                <tr>
                    <td><?= $usuario["documento"] ?></td>
                    <td><?= $usuario["nombre"] ?></td>
                    <td><?= $usuario["correo"] ?></td>
                    <td><?= $usuario["telefono"] ?></td>
                    <td><?= $usuario["fecha_ing"] ?></td>
                    <td><?= $usuario["id_tip_doc"] ?></td>
                    <td><?= $usuario["id_comida"] ?></td> <!-- Nueva columna -->
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <a href="registro.php">Volver</a>
</body>
</html>
