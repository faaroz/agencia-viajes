<?php
require_once "conexion.php";

// Obtener clientes registrados
$clientes = $conn->query(
    "SELECT id_cliente, nombre FROM cliente"
);

// Obtener vuelos registrados
$vuelos = $conn->query(
    "SELECT id_vuelo, origen, destino, fecha FROM vuelo"
);

// Obtener hoteles registrados
$hoteles = $conn->query(
    "SELECT id_hotel, nombre, ubicacion FROM hotel"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agencia de Viajes</title>

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/validaciones.js"></script>

</head>

<body>

    <header>
        <h1>Agencia de Viajes</h1>
        <p>
            Gestión de Servicios Turísticos
        </p>
    </header>

    <main>

        <!-- ==========================
            REGISTRO VUELOS
        =========================== -->

        <fieldset>

            <legend>Registrar vuelo</legend>

            <form action="procesos/guardar_vuelo.php"
                method="post"
                onsubmit="return validarVuelo();">

                <div class="campo">

                    <label>Origen</label>

                    <input type="text" name="origen" id="origen">

                </div>

                <div class="campo">

                    <label>Destino</label>

                    <input type="text" name="destino" id="destino">

                </div>

                <div class="campo">

                    <label>Fecha</label>

                    <input type="date" name="fecha" id="fecha">

                </div>

                <div class="campo">

                    <label>Plazas disponibles</label>

                    <input type="number" name="plazas" id="plazas" min="1">

                </div>

                <div class="campo">

                    <label>Precio</label>

                    <input type="number" name="precio" id="precio" min="0" step="1000">

                </div>

                <button type="submit">
                    Registrar vuelo
                </button>

            </form>

        </fieldset>

        <!-- ==========================
            REGISTRO HOTELES
        =========================== -->

        <fieldset>

            <legend>Registrar hotel</legend>

            <form action="procesos/guardar_hotel.php" method="post" onsubmit="return validarHotel();">

                <div class="campo">

                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombreHotel">

                </div>

                <div class="campo">

                    <label>Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion">

                </div>

                <div class="campo">

                    <label>Habitaciones disponibles</label>
                    <input type="number" name="habitaciones" id="habitaciones" min="1">

                </div>

                <div class="campo">

                    <label>Tarifa por noche</label>
                    <input type="number" name="tarifa" id="tarifa" min="0" step="1000">

                </div>

                <button type="submit">
                    Registrar hotel
                </button>

            </form>

        </fieldset>

        <!-- ==========================
            REGISTRO CLIENTES
        =========================== -->

        <fieldset>

            <legend>Registrar cliente</legend>

            <form action="procesos/guardar_cliente.php" method="post" onsubmit="return validarCliente();">

                <div class="campo">

                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombreCliente">

                </div>

                <div class="campo">

                    <label>Correo</label>
                    <input type="email" name="correo" id="correo">

                </div>

                <div class="campo">

                    <label>Teléfono</label>
                    <input type="text" name="telefono" id="telefono">

                </div>

                <button type="submit">
                    Registrar cliente
                </button>

            </form>

        </fieldset>

        <!-- ==========================
            REGISTRO RESERVAS
        =========================== -->

        <fieldset>

            <legend>Registrar reserva</legend>

            <form action="procesos/guardar_reserva.php" method="post" onsubmit="return validarReserva();">

                <div class="campo">

                    <label>Cliente</label>

                    <select name="id_cliente" id="id_cliente">

                        <option value="">
                            Seleccione un cliente
                        </option>

                        <?php while ($cliente = $clientes->fetch_assoc()) { ?>

                            <option value="<?= $cliente["id_cliente"] ?>">

                                <?= $cliente["nombre"] ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="campo">

                    <label for="cantidad_personas">

                        Cantidad de personas

                    </label>

                    <input
                        type="number"
                        name="cantidad_personas"
                        id="cantidad_personas"
                        min="1"
                        value="1">

                </div>

                <div class="campo">

                    <label>Fecha de reserva</label>
                    <input type="date" name="fecha_reserva" id="fecha_reserva" value="<?= date('Y-m-d') ?>">

                </div>

                <div class="campo">

                    <label>Vuelo</label>

                    <select name="id_vuelo" id="id_vuelo">

                        <option value="">
                            Seleccione un vuelo
                        </option>

                        <?php while ($vuelo = $vuelos->fetch_assoc()) { ?>

                            <option value="<?= $vuelo["id_vuelo"] ?>">

                                <?= $vuelo["origen"] ?>

                                →

                                <?= $vuelo["destino"] ?>

                                |

                                <?= $vuelo["fecha"] ?>


                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="campo">

                    <label>Hotel</label>

                    <select name="id_hotel" id="id_hotel">

                        <option value="">
                            Seleccione un hotel
                        </option>

                        <?php while ($hotel = $hoteles->fetch_assoc()) { ?>

                            <option value="<?= $hotel["id_hotel"] ?>">


                                <?= $hotel["nombre"] ?>

                                -

                                <?= $hotel["ubicacion"] ?>


                            </option>


                        <?php } ?>

                    </select>

                </div>

                <button type="submit">

                    Registrar reserva

                </button>

            </form>

        </fieldset>

        <!-- ==========================
            CONSULTA AVANZADA
        =========================== -->

        <fieldset>

            <legend>Consulta avanzada</legend>

            <p>
                Mostrar los hoteles que poseen más de dos reservas registradas.
            </p>

            <form action="procesos/consulta_avanzada.php" method="post">

                <button type="submit">

                    Ejecutar consulta

                </button>

            </form>

        </fieldset>

        <!-- ==========================
            CONSULTAS SIMPLES
        =========================== -->

        <fieldset>

            <legend>Consultas simples</legend>

            <p>
                Visualizar la información almacenada en las tablas de la base de datos.
            </p>

            <form action="procesos/consultas_simples.php" method="get" class="botones-consulta">

                <button type="submit" name="tabla" value="cliente">

                    Consultar clientes

                </button>

                <button type="submit" name="tabla" value="vuelo">

                    Consultar vuelos

                </button>

                <button type="submit" name="tabla" value="hotel">

                    Consultar hoteles

                </button>

                <button type="submit" name="tabla" value="reserva">

                    Consultar reservas

                </button>

            </form>

        </fieldset>

    </main>

</body>

</html>