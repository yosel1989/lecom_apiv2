<?php

declare(strict_types=1);

namespace Src\Administracion\Personal\Domain;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class Personal
{

    /**
     * @var Text
     */
    private $usuarioRegistro;
    /**
     * @var Text
     */
    private $usuarioModifico;
    /**
     * @var Text
     */
    private $categoria;
    /**
     * @var Id
     */
    private $id;
    /**
     * @var Text
     */
    private $nombre;
    /**
     * @var Text
     */
    private $apellido;
    /**
     * @var Text
     */
    private $documentoIdentidad;
    /**
     * @var DateOnlyFormat
     */
    private $fechaNacimiento;
    /**
     * @var Id
     */
    private $idCategoriaPersonal;
    /**
     * @var Id
     */
    private $idCliente;
    /**
     * @var float|int|Numeric|string
     */
    private $idEstado;
    /**
     * @var Id
     */
    private $idUsuarioRegistro;
    /**
     * @var DateTimeFormat
     */
    private $fechaRegistro;
    /**
     * @var Id
     */
    private $idUsuarioModifico;
    /**
     * @var DateTimeFormat
     */
    private $fechaModifico;

    /**
     * Personal constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Text $apellido
     * @param Text $documentoIdentidad
     * @param DateOnlyFormat $fechaNacimiento
     * @param Id $idCategoriaPersonal
     * @param Id $idCliente
     * @param Numeric $idEstado
     * @param Id $idUsuarioRegistro
     * @param DateTimeFormat $fechaRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $apellido,
        Text $documentoIdentidad,
        DateOnlyFormat $fechaNacimiento,
        Id $idCategoriaPersonal,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        DateTimeFormat $fechaRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->documentoIdentidad = $documentoIdentidad;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idCategoriaPersonal = $idCategoriaPersonal;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->fechaRegistro = $fechaRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaModifico = $fechaModifico;
    }

    /**
     * @return Text
     */
    public function getUsuarioRegistro(): Text
    {
        return $this->usuarioRegistro;
    }

    /**
     * @param Text $usuarioRegistro
     */
    public function setUsuarioRegistro(Text $usuarioRegistro): void
    {
        $this->usuarioRegistro = $usuarioRegistro;
    }

    /**
     * @return Text
     */
    public function getUsuarioModifico(): Text
    {
        return $this->usuarioModifico;
    }

    /**
     * @param Text $usuarioModifico
     */
    public function setUsuarioModifico(Text $usuarioModifico): void
    {
        $this->usuarioModifico = $usuarioModifico;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param Id $id
     */
    public function setId(Id $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Text
     */
    public function getNombre(): Text
    {
        return $this->nombre;
    }

    /**
     * @param Text $nombre
     */
    public function setNombre(Text $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Text
     */
    public function getApellido(): Text
    {
        return $this->apellido;
    }

    /**
     * @param Text $apellido
     */
    public function setApellido(Text $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return Text
     */
    public function getDocumentoIdentidad(): Text
    {
        return $this->documentoIdentidad;
    }

    /**
     * @param Text $documentoIdentidad
     */
    public function setDocumentoIdentidad(Text $documentoIdentidad): void
    {
        $this->documentoIdentidad = $documentoIdentidad;
    }

    /**
     * @return DateOnlyFormat
     */
    public function getFechaNacimiento(): DateOnlyFormat
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param DateOnlyFormat $fechaNacimiento
     */
    public function setFechaNacimiento(DateOnlyFormat $fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return Id
     */
    public function getIdCategoriaPersonal(): Id
    {
        return $this->idCategoriaPersonal;
    }

    /**
     * @param Id $idCategoriaPersonal
     */
    public function setIdCategoriaPersonal(Id $idCategoriaPersonal): void
    {
        $this->idCategoriaPersonal = $idCategoriaPersonal;
    }

    /**
     * @return Id
     */
    public function getIdCliente(): Id
    {
        return $this->idCliente;
    }

    /**
     * @param Id $idCliente
     */
    public function setIdCliente(Id $idCliente): void
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return float|int|string
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param float|int|string $idEstado
     */
    public function setIdEstado($idEstado): void
    {
        $this->idEstado = $idEstado;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioRegistro(): Id
    {
        return $this->idUsuarioRegistro;
    }

    /**
     * @param Id $idUsuarioRegistro
     */
    public function setIdUsuarioRegistro(Id $idUsuarioRegistro): void
    {
        $this->idUsuarioRegistro = $idUsuarioRegistro;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaRegistro(): DateTimeFormat
    {
        return $this->fechaRegistro;
    }

    /**
     * @param DateTimeFormat $fechaRegistro
     */
    public function setFechaRegistro(DateTimeFormat $fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * @return Id
     */
    public function getIdUsuarioModifico(): Id
    {
        return $this->idUsuarioModifico;
    }

    /**
     * @param Id $idUsuarioModifico
     */
    public function setIdUsuarioModifico(Id $idUsuarioModifico): void
    {
        $this->idUsuarioModifico = $idUsuarioModifico;
    }

    /**
     * @return DateTimeFormat
     */
    public function getFechaModifico(): DateTimeFormat
    {
        return $this->fechaModifico;
    }

    /**
     * @param DateTimeFormat $fechaModifico
     */
    public function setFechaModifico(DateTimeFormat $fechaModifico): void
    {
        $this->fechaModifico = $fechaModifico;
    }

    /**
     * @return Text
     */
    public function getCategoria(): Text
    {
        return $this->categoria;
    }

    /**
     * @param Text $categoria
     */
    public function setCategoria(Text $categoria): void
    {
        $this->categoria = $categoria;
    }



}
