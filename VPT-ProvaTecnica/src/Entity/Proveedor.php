<?php
// src/Entity/Proveedor.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProveedorRepository")
 */
class Proveedor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id; // Identificador del proveedor

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre; // Nombre del proveedor

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correoElectronico; // Correo electrónico del proveedor

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telefono; // Teléfono del proveedor

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tipo; // Tipo de proveedor
 
    /**
     * @ORM\Column(type="boolean")
     */
    private $activo; // Indica si el proveedor está activo o no

    /**
     * @ORM\Column(type="datetime")
     */
    private $creadoEn; // Fecha de creación del proveedor

    /**
     * @ORM\Column(type="datetime")
     */
    private $actualizadoEn; // Fecha de la última actualización del proveedor

    // Getters y setters
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->correoElectronico;
    }

    public function setCorreoElectronico(string $correoElectronico): self
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getCreadoEn(): ?\DateTimeInterface
    {
        return $this->creadoEn;
    }

    public function setCreadoEn(\DateTimeInterface $creadoEn): self
    {
        $this->creadoEn = $creadoEn;

        return $this;
    }

    public function getActualizadoEn(): ?\DateTimeInterface
    {
        return $this->actualizadoEn;
    }

    public function setActualizadoEn(\DateTimeInterface $actualizadoEn): self
    {
        $this->actualizadoEn = $actualizadoEn;

        return $this;
    }
}


?>