<?php

class Reserva
{

    public $idReserva;
    public $idCliente;
    public $cantidadPersonas;
    public $fechaReserva;
    public $idVuelo;
    public $idHotel;


    // Constructor
    public function __construct(
        $idReserva,
        $idCliente,
        $cantidadPersonas,
        $fechaReserva,
        $idVuelo,
        $idHotel
    ) {

        $this->idReserva = $idReserva;
        $this->idCliente = $idCliente;
        $this->cantidadPersonas = $cantidadPersonas;
        $this->fechaReserva = $fechaReserva;
        $this->idVuelo = $idVuelo;
        $this->idHotel = $idHotel;

    }


    // Mostrar información de la reserva
    public function mostrarInformacion()
    {

        return "

        <div class='result-card'>

            <h3>Reserva Nº {$this->idReserva}</h3>

            <p><strong>Cliente:</strong> {$this->idCliente}</p>

            <p><strong>Cantidad de personas:</strong> {$this->cantidadPersonas}</p>

            <p><strong>Fecha de reserva:</strong> {$this->fechaReserva}</p>

            <p><strong>Vuelo:</strong> {$this->idVuelo}</p>

            <p><strong>Hotel:</strong> {$this->idHotel}</p>

        </div>

        ";

    }

}

?>