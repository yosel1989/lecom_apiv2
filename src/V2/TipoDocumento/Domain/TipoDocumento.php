<?php
declare(strict_types=1);

namespace Src\V2\TipoDocumento\Domain;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class TipoDocumento
{
    private NumericInteger $id;
    private Text $nombre;
    private NumericInteger $numeroDigitos;
    private Text $nombreCorto;
    private NumericInteger $aplFactura;
    private NumericInteger $aplBoleta;
    private NumericInteger $aplPasajero;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param Text $nombreCorto
     * @param NumericInteger $numeroDigitos
     * @param NumericInteger $aplFactura
     * @param NumericInteger $aplBoleta
     * @param NumericInteger $aplPasajero
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        Text $nombreCorto,
        NumericInteger $numeroDigitos,
        NumericInteger $aplFactura,
        NumericInteger $aplBoleta,
        NumericInteger $aplPasajero,
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->numeroDigitos = $numeroDigitos;
        $this->nombreCorto = $nombreCorto;
        $this->aplFactura = $aplFactura;
        $this->aplBoleta = $aplBoleta;
        $this->aplPasajero = $aplPasajero;
    }

    /**
     * @return NumericInteger
     */
    public function getId(): NumericInteger
    {
        return $this->id;
    }

    /**
     * @param NumericInteger $id
     */
    public function setId(NumericInteger $id): void
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
     * @return NumericInteger
     */
    public function getNumeroDigitos(): NumericInteger
    {
        return $this->numeroDigitos;
    }

    /**
     * @param NumericInteger $numeroDigitos
     */
    public function setNumeroDigitos(NumericInteger $numeroDigitos): void
    {
        $this->numeroDigitos = $numeroDigitos;
    }

    /**
     * @return Text
     */
    public function getNombreCorto(): Text
    {
        return $this->nombreCorto;
    }

    /**
     * @param Text $nombreCorto
     */
    public function setNombreCorto(Text $nombreCorto): void
    {
        $this->nombreCorto = $nombreCorto;
    }

    /**
     * @return NumericInteger
     */
    public function getAplFactura(): NumericInteger
    {
        return $this->aplFactura;
    }

    /**
     * @param NumericInteger $aplFactura
     */
    public function setAplFactura(NumericInteger $aplFactura): void
    {
        $this->aplFactura = $aplFactura;
    }

    /**
     * @return NumericInteger
     */
    public function getAplBoleta(): NumericInteger
    {
        return $this->aplBoleta;
    }

    /**
     * @param NumericInteger $aplBoleta
     */
    public function setAplBoleta(NumericInteger $aplBoleta): void
    {
        $this->aplBoleta = $aplBoleta;
    }

    /**
     * @return NumericInteger
     */
    public function getAplPasajero(): NumericInteger
    {
        return $this->aplPasajero;
    }

    /**
     * @param NumericInteger $aplPasajero
     */
    public function setAplPasajero(NumericInteger $aplPasajero): void
    {
        $this->aplPasajero = $aplPasajero;
    }

}
