<?php

require_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $origen = trim($_POST["origen"]);
    $destino = trim($_POST["destino"]);
    $fecha = $_POST["fecha"];
    $plazas = intval($_POST["plazas"]);
    $precio = floatval($_POST["precio"]);

    if (
        empty($origen) ||
        empty($destino) ||
        empty($fecha) ||
        $plazas <= 0 ||
        $precio <= 0
    ) {

        die("
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Error registro vuelo</title>
            <link rel='stylesheet' href='../css/styles.css'>
        </head>

        <body>

        <header>
            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>
        </header>

        <main>

        <fieldset>

            <h2>Error al registrar vuelo</h2>

            <p>
                Todos los datos del vuelo son obligatorios.
            </p>

            <a href='../index.php'>
                <button>
                    Volver al inicio
                </button>
            </a>

        </fieldset>

        </main>

        </body>
        </html>
        ");

    }


    $sql = "INSERT INTO vuelo
            (origen, destino, fecha, plazas_disponibles, precio)
            VALUES
            (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssid",
        $origen,
        $destino,
        $fecha,
        $plazas,
        $precio
    );


    if ($stmt->execute()) {

        echo "
        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Vuelo registrado</title>
            <link rel='stylesheet' href='../css/styles.css'>
        </head>

        <body>

        <header>
            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>
        </header>

        <main>

        <fieldset>

            <h2>
                Vuelo registrado correctamente.
            </h2>

            <hr>

            <h3>
                Listado de vuelos registrados
            </h3>
        ";


        $consulta = "SELECT * FROM vuelo ORDER BY id_vuelo";

        $resultado = $conn->query($consulta);


        if ($resultado->num_rows > 0) {

            echo "
            <table>

            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Plazas disponibles</th>
                <th>Precio</th>
            </tr>
            ";


            while ($fila = $resultado->fetch_assoc()) {

                echo "
                <tr>
                    <td>{$fila["id_vuelo"]}</td>
                    <td>{$fila["origen"]}</td>
                    <td>{$fila["destino"]}</td>
                    <td>{$fila["fecha"]}</td>
                    <td>{$fila["plazas_disponibles"]}</td>
                    <td>$" . number_format($fila["precio"], 0, ",", ".") . "</td>
                </tr>
                ";

            }

            echo "</table>";

        } else {

            echo "
            <p>
                No existen vuelos registrados.
            </p>
            ";

        }


        echo "

        <br>

        <a href='../index.php'>
            <button>
                Volver al inicio
            </button>
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

            <h2>
                Error al registrar el vuelo.
            </h2>

            <a href='../index.php'>
                <button>
                    Volver al inicio
                </button>
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