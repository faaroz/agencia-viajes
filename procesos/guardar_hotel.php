<?php

require_once "../conexion.php";


/* ==========================================
   VALIDAR ENVÍO DEL FORMULARIO
========================================== */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $ubicacion = trim($_POST["ubicacion"]);
    $habitaciones = intval($_POST["habitaciones"]);
    $tarifa = floatval($_POST["tarifa"]);


    /* ==========================
       VALIDACIÓN EN PHP
    ========================== */
    if (
        empty($nombre) ||
        empty($ubicacion) ||
        $habitaciones <= 0 ||
        $tarifa <= 0
    ) {

        die("
        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Error registro hotel</title>
            <link rel='stylesheet' href='../css/styles.css'>
        </head>

        <body>

        <header>
            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>
        </header>

        <main>

        <fieldset>

            <h2>Error al registrar hotel</h2>

            <p>Todos los datos del hotel son obligatorios.</p>

            <a href='../index.php'>
                <button>Volver al inicio</button>
            </a>

        </fieldset>

        </main>

        </body>
        </html>
        ");

    }

    /* ==========================
       INSERTAR EN MYSQL
    ========================== */
    $sql = "INSERT INTO hotel
            (nombre, ubicacion, habitaciones_disponibles, tarifa_noche)
            VALUES
            (?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssid",
        $nombre,
        $ubicacion,
        $habitaciones,
        $tarifa
    );

    if ($stmt->execute()) {

        echo "

        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Hotel registrado</title>
            <link rel='stylesheet' href='../css/styles.css'>
        </head>

        <body>

        <header>
            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>
        </header>

        <main>

        <fieldset>

            <h2>Hotel registrado correctamente.</h2>

            <hr>

            <h3>Listado de hoteles registrados</h3>

        ";

        /* ==========================
           CONSULTA SIMPLE
        ========================== */

        $consulta = "SELECT * FROM hotel ORDER BY id_hotel";

        $resultado = $conn->query($consulta);

        if ($resultado->num_rows > 0) {

            echo "

            <table>

            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Habitaciones disponibles</th>
                <th>Tarifa por noche</th>
            </tr>

            ";

            while ($fila = $resultado->fetch_assoc()) {

                echo "

                <tr>
                    <td>".$fila["id_hotel"]."</td>
                    <td>".$fila["nombre"]."</td>
                    <td>".$fila["ubicacion"]."</td>
                    <td>".$fila["habitaciones_disponibles"]."</td>
                    <td>$".number_format($fila["tarifa_noche"], 0, ",", ".")."</td>
                </tr>

                ";

            }

            echo "</table>";

        } else {

            echo "
            <p>No existen hoteles registrados.</p>
            ";

        }

        echo "

        <br>

        <a href='../index.php'>
            <button>Volver al inicio</button>
        </a>

        </fieldset>

        </main>

        </body>

        </html>

        ";


    } else {


        echo "

        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Error</title>
            <link rel='stylesheet' href='../css/styles.css'>
        </head>

        <body>

        <header>
            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>
        </header>

        <main>

        <fieldset>

            <h2>Error al registrar el hotel.</h2>

            <a href='../index.php'>
                <button>Volver al inicio</button>
            </a>

        </fieldset>

        </main>

        </body>

        </html>

        ";

    }

    $stmt->close();

}

$conn->close();

?>