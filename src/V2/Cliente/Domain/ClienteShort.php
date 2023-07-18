<?php

declare(strict_types=1);

namespace Src\V2\Cliente\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ClienteShort
{
    private Id $id;
    private NumericInteger $codigo;
    private NumericInteger $idTipoDocumento;
    private Text $numeroDocumento;
    private Text $nombre;
    private NumericInteger $idTipo;
    private Id $idCliente;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;

    /**
     * @param Id $id
     * @param NumericInteger $codigo
     * @param NumericInteger $idTipoDocumento
     * @param Text $numeroDocumento
     * @param Text $nombre
     * @param NumericInteger $idTipo
     * @param Id $idCliente
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        Id             $id,
        NumericInteger $codigo,
        NumericInteger $idTipoDocumento,
        Text           $numeroDocumento,
        Text           $nombre,
        NumericInteger $idTipo,
        Id             $idCliente,
        NumericInteger $idEstado,
        NumericInteger $idEliminado,
    )
    {

        $this->id = $id;
        $this->codigo = $codigo;
        $this->idTipoDocumento = $idTipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->nombre = $nombre;
        $this->idTipo = $idTipo;
        $this->idCliente = $idCliente;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
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
     * @return NumericInteger
     */
    public function getCodigo(): NumericInteger
    {
        return $this->codigo;
    }

    /**
     * @param NumericInteger $codigo
     */
    public function setCodigo(NumericInteger $codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoDocumento(): NumericInteger
    {
        return $this->idTipoDocumento;
    }

    /**
     * @param NumericInteger $idTipoDocumento
     */
    public function setIdTipoDocumento(NumericInteger $idTipoDocumento): void
    {
        $this->idTipoDocumento = $idTipoDocumento;
    }

    /**
     * @return Text
     */
    public function getNumeroDocumento(): Text
    {
        return $this->numeroDocumento;
    }

    /**
     * @param Text $numeroDocumento
     */
    public function setNumeroDocumento(Text $numeroDocumento): void
    {
        $this->numeroDocumento = $numeroDocumento;
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
     * @return NumericInteger
     */
    public function getIdTipo(): NumericInteger
    {
        return $this->idTipo;
    }

    /**
     * @param NumericInteger $idTipo
     */
    public function setIdTipo(NumericInteger $idTipo): void
    {
        $this->idTipo = $idTipo;
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

}
