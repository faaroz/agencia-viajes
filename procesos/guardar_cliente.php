<?php

require_once "../conexion.php";


/* ==========================================
   VALIDAR ENVÍO DEL FORMULARIO
========================================== */

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $telefono = trim($_POST["telefono"]);

    /* ==========================
       VALIDACIÓN EN PHP
    ========================== */
    if (
        empty($nombre) ||
        empty($correo) ||
        empty($telefono)
    ) {

        die("

        <!DOCTYPE html>
        <html lang='es'>

        <head>

            <meta charset='UTF-8'>
            <title>Error registro cliente</title>
            <link rel='stylesheet' href='../css/styles.css'>

        </head>

        <body>

        <header>

            <h1>Agencia de Viajes</h1>
            <p>Gestión de Servicios Turísticos</p>

        </header>

        <main>

        <fieldset>

            <h2>Error al registrar cliente</h2>

            <p>
                Todos los datos del cliente son obligatorios.
            </p>

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
    $sql = "INSERT INTO cliente
            (nombre, correo, telefono)
            VALUES
            (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sss",
        $nombre,
        $correo,
        $telefono
    );

    if ($stmt->execute()) {

        echo "

        <!DOCTYPE html>
        <html lang='es'>

        <head>
            <meta charset='UTF-8'>
            <title>Cliente registrado</title>
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
                Cliente registrado correctamente.
            </h2>

            <hr>

            <h3>
                Listado de clientes registrados
            </h3>

        ";

        /* ==========================
           CONSULTA SIMPLE
        ========================== */
        $consulta = "SELECT * FROM cliente ORDER BY id_cliente";

        $resultado = $conn->query($consulta);

        if ($resultado->num_rows > 0) {

            echo "

            <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
            </tr>

            ";

            while ($fila = $resultado->fetch_assoc()) {

                echo "

                <tr>
                    <td>" . $fila["id_cliente"] . "</td>
                    <td>" . $fila["nombre"] . "</td>
                    <td>" . $fila["correo"] . "</td>
                    <td>" . $fila["telefono"] . "</td>
                </tr>

                ";
            }

            echo "</table>";
        } else {

            echo "

            <p>
                No existen clientes registrados.
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
                Error al registrar el cliente.
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