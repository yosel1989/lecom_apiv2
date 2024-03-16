<?php

namespace Sunat\Models;

use InvalidArgumentException;
use Sunat\Enums\TipoDocumento;
use Sunat\Enums\TipoMoneda;
use Sunat\Enums\TipoOperacion;

class Documento
{
    private string $serie;
    private int $numero;
    private string $fecha_emision;
    private string $hora_emision;
    private string $fecha_vencimiento;
    private TipoDocumento $tipo_comprobante;
    private TipoMoneda $tipo_moneda;
    private TipoOperacion $tipo_transaccion;
    private int $numero_items;
    private string $tipo_pago;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getSerie(): string
    {
        return $this->serie;
    }

    /**
     * @param string $serie
     */
    public function setSerie(string $serie): void
    {
        $this->serie = $serie;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getFechaEmision(): string
    {
        return $this->fecha_emision;
    }

    /**
     * @param string $fecha_emision
     */
    public function setFechaEmision(string $fecha_emision): void
    {
        $datetime = strtotime($fecha_emision);
        if (!$datetime) {
            throw new InvalidArgumentException('La fecha de vencimiento no tiene el formato correcto YYYY-MM-DD');
        }
        $this->fecha_emision = $fecha_emision;
    }

    /**
     * @return string
     */
    public function getHoraEmision(): string
    {
        return $this->hora_emision;
    }

    /**
     * @param string $hora_emision
     */
    public function setHoraEmision(string $hora_emision): void
    {
        $now = new \DateTime('now');

        $format = 'Y-m-d H:i:s';
        $d = \DateTime::createFromFormat($format, $now->format('Y-m-d ').$hora_emision);
        $result = $d && $d->format($format) == $now->format('Y-m-d ').$hora_emision;
        if( !$result ){
            throw new InvalidArgumentException('La hora de emisión no tiene el formato correcto HH:MM:SS');
        }

        $this->hora_emision = $hora_emision;
    }

    /**
     * @return string
     */
    public function getFechaVencimiento(): string
    {
        return $this->fecha_vencimiento;
    }

    /**
     * @param string $fecha_vencimiento
     */
    public function setFechaVencimiento(string $fecha_vencimiento): void
    {
        $datetime = strtotime($fecha_vencimiento);
        if (!$datetime) {
            throw new InvalidArgumentException('La fecha de vencimiento no tiene el formato correcto YYYY-MM-DD');
        }

        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    /**
     * @return TipoDocumento
     */
    public function getTipoComprobante(): TipoDocumento
    {
        return $this->tipo_comprobante;
    }

    /**
     * @param TipoDocumento $tipo_comprobante
     */
    public function setTipoComprobante(TipoDocumento $tipo_comprobante): void
    {
        $this->tipo_comprobante = $tipo_comprobante;
    }

    /**
     * @return TipoMoneda
     */
    public function getTipoMoneda(): TipoMoneda
    {
        return $this->tipo_moneda;
    }

    /**
     * @param TipoMoneda $tipo_moneda
     */
    public function setTipoMoneda(TipoMoneda $tipo_moneda): void
    {
        $this->tipo_moneda = $tipo_moneda;
    }

    /**
     * @return TipoOperacion
     */
    public function getTipoTransaccion(): TipoOperacion
    {
        return $this->tipo_transaccion;
    }

    /**
     * @param TipoOperacion $tipo_transaccion
     */
    public function setTipoTransaccion(TipoOperacion $tipo_transaccion): void
    {
        $this->tipo_transaccion = $tipo_transaccion;
    }

    /**
     * @return int
     */
    public function getNumeroItems(): int
    {
        return $this->numero_items;
    }

    /**
     * @param int $numero_items
     */
    public function setNumeroItems(int $numero_items): void
    {
        $this->numero_items = $numero_items;
    }

    /**
     * @return string
     */
    public function getTipoPago(): string
    {
        return $this->tipo_pago;
    }

    /**
     * @param string $tipo_pago
     */
    public function setTipoPago(string $tipo_pago): void
    {
        $this->tipo_pago = $tipo_pago;
    }


}
