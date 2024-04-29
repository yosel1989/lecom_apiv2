<?php
declare(strict_types=1);

namespace Src\V2\ComprobanteSerie\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ComprobanteSerieShort
{
    private Id $id;
    private NumericInteger $idTipoComprobante;
    private Text $nombre;
    private Id $idSede;
    private NumericInteger $idEstado;
    private Id $idEmpresa;

    /**
     * @param Id $id
     * @param NumericInteger $idTipoComprobante
     * @param Text $nombre
     * @param Id $idEmpresa
     * @param Id $idSede
     * @param NumericInteger $idEstado
     */
    public function __construct(
        Id             $id,
        NumericInteger $idTipoComprobante,
        Text $nombre,
        Id             $idEmpresa,
        Id             $idSede,
        NumericInteger $idEstado
    )
    {
        $this->id = $id;
        $this->idTipoComprobante = $idTipoComprobante;
        $this->nombre = $nombre;
        $this->idSede = $idSede;
        $this->idEstado = $idEstado;
        $this->idEmpresa = $idEmpresa;
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
    public function getIdTipoComprobante(): NumericInteger
    {
        return $this->idTipoComprobante;
    }

    /**
     * @param NumericInteger $idTipoComprobante
     */
    public function setIdTipoComprobante(NumericInteger $idTipoComprobante): void
    {
        $this->idTipoComprobante = $idTipoComprobante;
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
     * @return Id
     */
    public function getIdSede(): Id
    {
        return $this->idSede;
    }

    /**
     * @param Id $idSede
     */
    public function setIdSede(Id $idSede): void
    {
        $this->idSede = $idSede;
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
     * @return Id
     */
    public function getIdEmpresa(): Id
    {
        return $this->idEmpresa;
    }

    /**
     * @param Id $idEmpresa
     */
    public function setIdEmpresa(Id $idEmpresa): void
    {
        $this->idEmpresa = $idEmpresa;
    }


}
