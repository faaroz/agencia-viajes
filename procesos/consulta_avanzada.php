<?php

require_once "../conexion.php";

/* ==========================================
   CONSULTA AVANZADA
========================================== */

$sql = "

SELECT

    h.nombre,
    h.ubicacion,
    COUNT(r.id_reserva) AS total_reservas

FROM hotel h

INNER JOIN reserva r

ON h.id_hotel = r.id_hotel

GROUP BY

    h.id_hotel,
    h.nombre,
    h.ubicacion

HAVING COUNT(r.id_reserva) > 2

ORDER BY total_reservas DESC

";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Consulta Avanzada</title>

<link rel="stylesheet" href="../css/styles.css">

</head>

<body>

<header>

<h1>Consulta Avanzada</h1>

<p>Hoteles con más de dos reservas</p>

</header>

<main>

<?php

if ($resultado->num_rows > 0) {

    echo "<table>";

    echo "<tr>";

    echo "<th>Hotel</th>";
    echo "<th>Ubicación</th>";
    echo "<th>Total reservas</th>";

    echo "</tr>";

    while ($fila = $resultado->fetch_assoc()) {

        echo "<tr>";

        echo "<td>{$fila['nombre']}</td>";

        echo "<td>{$fila['ubicacion']}</td>";

        echo "<td>{$fila['total_reservas']}</td>";

        echo "</tr>";

    }

    echo "</table>";

} else {

    echo "<p>No existen hoteles con más de dos reservas.</p>";

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