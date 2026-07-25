<?php

class Vuelo
{
    public $idVuelo;
    public $origen;
    public $destino;
    public $fecha;
    public $plazasDisponibles;
    public $precio;

    // Constructor
    public function __construct(
        $idVuelo,
        $origen,
        $destino,
        $fecha,
        $plazasDisponibles,
        $precio
    ) {

        $this->idVuelo = $idVuelo;
        $this->origen = $origen;
        $this->destino = $destino;
        $this->fecha = $fecha;
        $this->plazasDisponibles = $plazasDisponibles;
        $this->precio = $precio;

    }

    // Mostrar información del vuelo
    public function mostrarInformacion()
    {

        return "

        <div class='result-card'>

            <h3>Vuelo {$this->idVuelo}</h3>

            <p><strong>Origen:</strong> {$this->origen}</p>

            <p><strong>Destino:</strong> {$this->destino}</p>

            <p><strong>Fecha:</strong> {$this->fecha}</p>

            <p><strong>Plazas disponibles:</strong> {$this->plazasDisponibles}</p>

            <p><strong>Precio:</strong> $ {$this->precio}</p>

        </div>

        ";

    }

}

?>