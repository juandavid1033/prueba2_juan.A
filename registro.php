<?php

if (isset($_POST["registrar"])) {
    
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $id_tip_doc = $_POST['id_tip_doc'];
    $id_comida = $_POST['id_comida'];

    $fecha_ing = date("Y-m-d");

    
    require_once("conexion/conexion.php");
    $db = new Database();
    $conectar = $db->conectar();

    
    $consulta = $conectar->prepare("SELECT * FROM usuario WHERE documento = ?");
    $consulta->execute([$documento]);
    $usuario_existente = $consulta->fetch();

    if ($usuario_existente) {
        
        echo '<script>alert("El documento ya está registrado.");</script>';
    } else {
        
        
        $insertar = $conectar->prepare("INSERT INTO usuario (documento, nombre, correo, telefono, fecha_ing, id_tip_doc, id_comida) VALUES (?, ?, ?, ?, ?, ?,  ?)");
        $insertar->execute([$documento, $nombre, $correo, $telefono, $fecha_ing, $id_tip_doc,  $id_comida]);
        echo '<script>alert("Usuario registrado exitosamente.");</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PARQUE DE DIVERSIONES </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <!-- =======================================================
    Theme Name: EstateAgency
    Theme URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>
    <div style="margin-top: 200px;">
        <div class="container mt-5">
            <h2>Formulario de Usuario</h2>
            <form method="POST" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="documento">Documento:</label>
                    <input type="number" maxlength="11" class="form-control" id="documento" name="documento" required>
                    <small class="text-danger" id="documentoError"></small>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <small class="text-danger" id="nombreError"></small>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                    <small class="text-danger" id="correoError"></small>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" maxlength="10" id="telefono" name="telefono" required>
                    <small class="number-danger" id="telefonoError"></small>
                </div>

                <div class="form-group">
                    <label for="id_tip_doc">Tipo de Documento:</label>
                    <select class="form-control" id="id_tip_doc" name="id_tip_doc">
                        <option value="1">TI</option>
                        <option value="2"> CC</option>
                        
                    </select>
                </div>

                </div>

                <div class="form-group">
                    <label for="id_comida">Comida:</label>
                    <select class="form-control" id="id_comida" name="id_comida">
                      
                        <option value="1">crispetas</option>
                        <option value="2">perro caliente</option>
                        <option value="2">hamburguesa</option>
                        <option value="2">gaseosa</option>
                        <option value="2">agua</option>
                        <option value="2">manzana acaramelizada</option>
                        
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
            </form>
        </div>
        <script>
            function validarFormulario() {
                var documento = document.getElementById("documento").value;
                var nombre = document.getElementById("nombre").value;
                var correo = document.getElementById("correo").value;
                var telefono = document.getElementById("telefono").value;

                var documentoError = document.getElementById("documentoError");
                var nombreError = document.getElementById("nombreError");
                var correoError = document.getElementById("correoError");
                var telefonoError = document.getElementById("telefonoError");

                var documentoPattern = /^[0-9]{10,11}$/;
                var nombrePattern = /^[A-Za-z\s]+$/;
                var telefonoPattern = /^[0-9]{10}$/;

                if (!documentoPattern.test(documento)) {
                    documentoError.textContent = "El documento debe contener entre 10 y 11 números.";
                    return false;
                } else {
                    documentoError.textContent = "";
                }

                if (!nombrePattern.test(nombre)) {
                    nombreError.textContent = "El nombre solo debe contener letras y espacios.";
                    return false;
                } else {
                    nombreError.textContent = "";
                }

                if (!telefonoPattern.test(telefono)) {
                    telefonoError.textContent = "El teléfono debe contener solo y exactamente 10 números.";
                    return false;
                } else {
                    telefonoError.textContent = "";
                }

                // Validación de correo electrónico utilizando el atributo "required" de HTML5
                if (correo === "") {
                    correoError.textContent = "Por favor, introduce tu correo electrónico.";
                    return false;
                } else {
                    correoError.textContent = "";
                }

                // Validación de correo electrónico utilizando expresión regular
                var correoPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!correoPattern.test(correo)) {
                    correoError.textContent = "Por favor, introduce una dirección de correo electrónico válida.";
                    return false;
                } else {
                    correoError.textContent = "";
                }

                return true;
            }
        </script>

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        <div id="preloader"></div>

        <!-- JavaScript Libraries -->
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/jquery/jquery-migrate.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/scrollreveal/scrollreveal.min.js"></script>
        <!-- Contact Form JavaScript File -->
        <script src="contactform/contactform.js"></script>

        <!-- Template Main Javascript File -->
        <script src="js/main.js"></script>

</body>

</html>
