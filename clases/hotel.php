<?php

class Hotel
{
    public $idHotel;
    public $nombre;
    public $ubicacion;
    public $habitacionesDisponibles;
    public $tarifaNoche;

    // Constructor
    public function __construct(
        $idHotel,
        $nombre,
        $ubicacion,
        $habitacionesDisponibles,
        $tarifaNoche
    ) {

        $this->idHotel = $idHotel;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->habitacionesDisponibles = $habitacionesDisponibles;
        $this->tarifaNoche = $tarifaNoche;

    }

    // Mostrar información del hotel
    public function mostrarInformacion()
    {

        return "

        <div class='result-card'>

            <h3>{$this->nombre}</h3>

            <p><strong>ID:</strong> {$this->idHotel}</p>

            <p><strong>Ubicación:</strong> {$this->ubicacion}</p>

            <p><strong>Habitaciones disponibles:</strong> {$this->habitacionesDisponibles}</p>

            <p><strong>Tarifa por noche:</strong> $ {$this->tarifaNoche}</p>

        </div>

        ";

    }

}

?>