<?php

declare(strict_types=1);

namespace Src\Administracion\PersonalCategoria\Domain;

use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

final class PersonalCategoria
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
     * @var Id
     */
    private $id;
    /**
     * @var Text
     */
    private $nombre;
    /**
     * @var float|int|Numeric|string
     */
    private $codigo;
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
     * PersonalCategoria constructor.
     * @param Id $id
     * @param Text $nombre
     * @param Numeric $codigo
     * @param Numeric $idEstado
     * @param Id $idUsuarioRegistro
     * @param Id $idCliente
     * @param DateTimeFormat $fechaRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Numeric $codigo,
        Numeric $idEstado,
        Id $idUsuarioRegistro,
        DateTimeFormat $fechaRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
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
     * @return float|int|string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param float|int|string $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
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


}
