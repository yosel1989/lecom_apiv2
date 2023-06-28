<?php
declare(strict_types=1);

namespace Src\V2\Vehiculo\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class Vehiculo
{
    private Id $id;
    private Text $placa;
    private Text $unidad;
    private Id $idCliente;
    private Id $idMarca;
    private Id $idModelo;
    private Id $idClase;
    private Id $idFlota;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;
    private Id $idUsurioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;
    private Text $usuarioModifico;
    private Text $usuarioRegistro;
    private Id $idCategoria;

    /**
     * @param Id $id
     * @param Text $placa
     * @param Text $unidad
     * @param Id $idCliente
     * @param Id $idMarca
     * @param Id $idModelo
     * @param Id $idClase
     * @param Id $idFlota
     * @param Id $idCategoria
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     * @param Id $idUsurioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        Id $id,
        Text $placa,
        Text $unidad,
        Id $idCliente,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota,
        Id $idCategoria,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
        Id $idUsurioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {

        $this->id = $id;
        $this->placa = $placa;
        $this->unidad = $unidad;
        $this->idCliente = $idCliente;
        $this->idMarca = $idMarca;
        $this->idModelo = $idModelo;
        $this->idClase = $idClase;
        $this->idFlota = $idFlota;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->idUsurioRegistro = $idUsurioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;
        $this->idCategoria = $idCategoria;
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
    public function getPlaca(): Text
    {
        return $this->placa;
    }

    /**
     * @param Text $placa
     */
    public function setPlaca(Text $placa): void
    {
        $this->placa = $placa;
    }

    /**
     * @return Text
     */
    public function getUnidad(): Text
    {
        return $this->unidad;
    }

    /**
     * @param Text $unidad
     */
    public function setUnidad(Text $unidad): void
    {
        $this->unidad = $unidad;
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
     * @return Id
     */
    public function getIdMarca(): Id
    {
        return $this->idMarca;
    }

    /**
     * @param Id $idMarca
     */
    public function setIdMarca(Id $idMarca): void
    {
        $this->idMarca = $idMarca;
    }

    /**
     * @return Id
     */
    public function getIdModelo(): Id
    {
        return $this->idModelo;
    }

    /**
     * @param Id $idModelo
     */
    public function setIdModelo(Id $idModelo): void
    {
        $this->idModelo = $idModelo;
    }

    /**
     * @return Id
     */
    public function getIdClase(): Id
    {
        return $this->idClase;
    }

    /**
     * @param Id $idClase
     */
    public function setIdClase(Id $idClase): void
    {
        $this->idClase = $idClase;
    }

    /**
     * @return Id
     */
    public function getIdFlota(): Id
    {
        return $this->idFlota;
    }

    /**
     * @param Id $idFlota
     */
    public function setIdFlota(Id $idFlota): void
    {
        $this->idFlota = $idFlota;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEstado(): NumericInteger
    {
        return $this->idEstado;
    }

    /**
     * @param NumericInteger $idEstado
     */
    public function setIdEstado(NumericInteger $idEstado): void
    {
        $this->idEstado = $idEstado;
    }

    /**
     * @return NumericInteger
     */
    public function getIdEliminado(): NumericInteger
    {
        return $this->idEliminado;
    }

    /**
     * @param NumericInteger $idEliminado
     */
    public function setIdEliminado(NumericInteger $idEliminado): void
    {
        $this->idEliminado = $idEliminado;
    }

    /**
     * @return Id
     */
    public function getIdUsurioRegistro(): Id
    {
        return $this->idUsurioRegistro;
    }

    /**
     * @param Id $idUsurioRegistro
     */
    public function setIdUsurioRegistro(Id $idUsurioRegistro): void
    {
        $this->idUsurioRegistro = $idUsurioRegistro;
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
     * @return Id
     */
    public function getIdCategoria(): Id
    {
        return $this->idCategoria;
    }

    /**
     * @param Id $idCategoria
     */
    public function setIdCategoria(Id $idCategoria): void
    {
        $this->idCategoria = $idCategoria;
    }



}
