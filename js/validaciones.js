/* ==========================================
   VALIDACIÓN FORMULARIO DE VUELOS
========================================== */

function validarVuelo() {

    const origen = document.getElementById("origen").value.trim();
    const destino = document.getElementById("destino").value.trim();
    const fecha = document.getElementById("fecha").value;
    const plazas = document.getElementById("plazas").value;
    const precio = document.getElementById("precio").value;

    if (
        origen === "" ||
        destino === "" ||
        fecha === "" ||
        plazas === "" ||
        precio === ""
    ) {

        alert("Debe completar todos los datos del vuelo.");
        return false;

    }

    if (Number(plazas) <= 0) {

        alert("Las plazas disponibles deben ser mayores que cero.");
        return false;

    }

    if (Number(precio) <= 0) {

        alert("El precio debe ser mayor que cero.");
        return false;

    }

    return true;

}


/* ==========================================
   VALIDACIÓN FORMULARIO DE HOTELES
========================================== */

function validarHotel() {

    const nombre = document.getElementById("nombreHotel").value.trim();
    const ubicacion = document.getElementById("ubicacion").value.trim();
    const habitaciones = document.getElementById("habitaciones").value;
    const tarifa = document.getElementById("tarifa").value;

    if (
        nombre === "" ||
        ubicacion === "" ||
        habitaciones === "" ||
        tarifa === ""
    ) {

        alert("Debe completar todos los datos del hotel.");
        return false;

    }

    if (Number(habitaciones) <= 0) {

        alert("Las habitaciones disponibles deben ser mayores que cero.");
        return false;

    }

    if (Number(tarifa) <= 0) {

        alert("La tarifa debe ser mayor que cero.");
        return false;

    }

    return true;

}


/* ==========================================
   VALIDACIÓN FORMULARIO DE RESERVAS
========================================== */

function validarReserva() {

    const cliente = document.getElementById("id_cliente").value;
    const cantidadPersonas = document.getElementById("cantidad_personas").value;
    const fecha = document.getElementById("fecha_reserva").value;
    const vuelo = document.getElementById("id_vuelo").value;
    const hotel = document.getElementById("id_hotel").value;

    if (
        cliente === "" ||
        cantidadPersonas === "" ||
        fecha === "" ||
        vuelo === "" ||
        hotel === ""
    ) {

        alert("Debe completar todos los datos de la reserva.");
        return false;

    }

    if (Number(cantidadPersonas) <= 0) {

        alert("La cantidad de personas debe ser mayor que cero.");
        return false;

    }

    return true;

}