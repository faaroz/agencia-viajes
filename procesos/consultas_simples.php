<?php

require_once "../conexion.php";

/* ==========================================
   TABLAS PERMITIDAS
========================================== */

$tablasPermitidas = [
    "cliente",
    "vuelo",
    "hotel",
    "reserva"
];

/* ==========================================
   VALIDAR TABLA SOLICITADA
========================================== */

$tabla = $_GET["tabla"] ?? "";

if (!in_array($tabla, $tablasPermitidas)) {

    die("Tabla no válida.");

}

/* ==========================================
   CONSULTA SIMPLE
========================================== */

$sql = "SELECT * FROM $tabla";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Consulta simple</title>

<link rel="stylesheet" href="../css/styles.css">

</head>

<body>

<header>

<h1>Agencia de Viajes</h1>

<p>Consulta simple de la tabla <?= ucfirst($tabla) ?></p>

</header>

<main>

<h2>Contenido de la tabla <?= strtoupper($tabla) ?></h2>

<?php

if ($resultado->num_rows > 0) {

    echo "<table>";

    echo "<tr>";

    while ($campo = $resultado->fetch_field()) {

        echo "<th>{$campo->name}</th>";

    }

    echo "</tr>";

    while ($fila = $resultado->fetch_assoc()) {

        echo "<tr>";

        foreach ($fila as $valor) {

            echo "<td>$valor</td>";

        }

        echo "</tr>";

    }

    echo "</table>";

} else {

    echo "<p>No existen registros.</p>";

}

?>

<br>

<a href="../index.php">

<button>Volver al inicio</button>

</a>

</main>

</body>

</html>

<?php

$conn->close();

?>