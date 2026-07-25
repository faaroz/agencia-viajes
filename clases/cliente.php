<?php

class Cliente
{
    public $idCliente;
    public $nombre;
    public $correo;
    public $telefono;

    // Constructor
    public function __construct(
        $idCliente,
        $nombre,
        $correo,
        $telefono
    ) {

        $this->idCliente = $idCliente;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;

    }

    // Mostrar información del cliente
    public function mostrarInformacion()
    {

        return "

        <div class='result-card'>

            <h3>{$this->nombre}</h3>

            <p><strong>ID:</strong> {$this->idCliente}</p>

            <p><strong>Correo:</strong> {$this->correo}</p>

            <p><strong>Teléfono:</strong> {$this->telefono}</p>

        </div>

        ";

    }

}

?>