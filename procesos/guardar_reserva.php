<?php

require_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idCliente = intval($_POST["id_cliente"]);
    $cantidadPersonas = intval($_POST["cantidad_personas"]);
    $idVuelo = intval($_POST["id_vuelo"]);
    $idHotel = intval($_POST["id_hotel"]);

    $fechaReserva = date("Y-m-d");


    if (
        $idCliente <= 0 ||
        $cantidadPersonas <= 0||
        $idVuelo <= 0 ||
        $idHotel <= 0
    ) {

        die("
        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Error registro reserva</title>
            <link rel='stylesheet' href='../css/styles.css'>
        </head>

        <body>

        <header>
            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>
        </header>

        <main>

        <fieldset>

            <h2>Error al registrar reserva</h2>

            <p>
                Debe seleccionar un cliente, indicar la cantidad de personas, un vuelo y un hotel.
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


    $sql = "INSERT INTO reserva
            (id_cliente, cantidad_personas, fecha_reserva, id_vuelo, id_hotel)
            VALUES
            (?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "iisii",
        $idCliente,
        $cantidadPersonas,
        $fechaReserva,
        $idVuelo,
        $idHotel
    );


    if ($stmt->execute()) {

        echo "
        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Reserva registrada</title>
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
                Reserva registrada correctamente.
            </h2>

            <hr>

            <h3>
                Listado de reservas registradas
            </h3>
        ";


        $consulta = "SELECT * FROM reserva ORDER BY id_reserva";

        $resultado = $conn->query($consulta);


        if ($resultado->num_rows > 0) {

            echo "
            <table>

            <tr>
                <th>ID Reserva</th>
                <th>ID Cliente</th>
                <th>Personas</th>
                <th>Fecha</th>
                <th>ID Vuelo</th>
                <th>ID Hotel</th>
            </tr>
            ";


            while ($fila = $resultado->fetch_assoc()) {

                echo "
                <tr>
                    <td>{$fila["id_reserva"]}</td>
                    <td>{$fila["id_cliente"]}</td>
                    <td>{$fila["cantidad_personas"]}</td>
                    <td>{$fila["fecha_reserva"]}</td>
                    <td>{$fila["id_vuelo"]}</td>
                    <td>{$fila["id_hotel"]}</td>
                </tr>
                ";

            }


            echo "</table>";


        } else {

            echo "
            <p>
                No existen reservas registradas.
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
                Error al registrar la reserva.
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