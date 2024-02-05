<?php
declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Domain;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class BoletoInterprovincialLiquidacionVehiculoFecha
{

    private Id $idRuta;
    private Text $ruta;
    private Id $idVehiculo;
    private NumericInteger $cantidad;
    private NumericFloat $precio;
    private NumericFloat $total;
    private DateFormat $fecha;

    /**
     * @param Id $idRuta
     * @param Text $ruta
     * @param Id $idVehiculo
     * @param NumericInteger $cantidad
     * @param NumericFloat $precio
     * @param NumericFloat $total
     * @param DateFormat $fecha
     */
    public function __construct(
        Id $idRuta,
        Text $ruta,
        Id $idVehiculo,
        NumericInteger $cantidad,
        NumericFloat $precio,
        NumericFloat $total,
        DateFormat $fecha
    )
    {

        $this->idRuta = $idRuta;
        $this->ruta = $ruta;
        $this->idVehiculo = $idVehiculo;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->total = $total;
        $this->fecha = $fecha;
    }

    /**
     * @return Id
     */
    public function getIdRuta(): Id
    {
        return $this->idRuta;
    }

    /**
     * @param Id $idRuta
     */
    public function setIdRuta(Id $idRuta): void
    {
        $this->idRuta = $idRuta;
    }

    /**
     * @return Text
     */
    public function getRuta(): Text
    {
        return $this->ruta;
    }

    /**
     * @param Text $ruta
     */
    public function setRuta(Text $ruta): void
    {
        $this->ruta = $ruta;
    }

    /**
     * @return Id
     */
    public function getIdVehiculo(): Id
    {
        return $this->idVehiculo;
    }

    /**
     * @param Id $idVehiculo
     */
    public function setIdVehiculo(Id $idVehiculo): void
    {
        $this->idVehiculo = $idVehiculo;
    }

    /**
     * @return NumericInteger
     */
    public function getCantidad(): NumericInteger
    {
        return $this->cantidad;
    }

    /**
     * @param NumericInteger $cantidad
     */
    public function setCantidad(NumericInteger $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return NumericFloat
     */
    public function getPrecio(): NumericFloat
    {
        return $this->precio;
    }

    /**
     * @param NumericFloat $precio
     */
    public function setPrecio(NumericFloat $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return NumericFloat
     */
    public function getTotal(): NumericFloat
    {
        return $this->total;
    }

    /**
     * @param NumericFloat $total
     */
    public function setTotal(NumericFloat $total): void
    {
        $this->total = $total;
    }

    /**
     * @return DateFormat
     */
    public function getFecha(): DateFormat
    {
        return $this->fecha;
    }

    /**
     * @param DateFormat $fecha
     */
    public function setFecha(DateFormat $fecha): void
    {
        $this->fecha = $fecha;
    }



}
