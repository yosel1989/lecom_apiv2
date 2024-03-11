<?php

namespace Sunat\Models;

use Sunat\Enums\CodigoPais;
use Sunat\Enums\TipoDocumentoEntidad;

class Emisor
{
    private TipoDocumentoEntidad $tipo_documento;
    private string $numero;
    private string $razon_social;
    private ?string $nombre_comercial;
    private string $ubigeo;
    private string $departamento;
    private string $provincia;
    private string $distrito;
    private string $direccion;
    private string $anexo;
    private CodigoPais $pais;

    public function __construct()
    {
    }

    /**
     * @return TipoDocumentoEntidad
     */
    public function getTipoDocumento(): TipoDocumentoEntidad
    {
        return $this->tipo_documento;
    }

    /**
     * @param TipoDocumentoEntidad $tipo_documento
     */
    public function setTipoDocumento(TipoDocumentoEntidad $tipo_documento): void
    {
        $this->tipo_documento = $tipo_documento;
    }

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getRazonSocial(): string
    {
        return $this->razon_social;
    }

    /**
     * @param string $razon_social
     */
    public function setRazonSocial(string $razon_social): void
    {
        $this->razon_social = $razon_social;
    }

    /**
     * @return string|null
     */
    public function getNombreComercial(): ?string
    {
        return $this->nombre_comercial;
    }

    /**
     * @param string|null $nombre_comercial
     */
    public function setNombreComercial(?string $nombre_comercial): void
    {
        $this->nombre_comercial = $nombre_comercial;
    }

    /**
     * @return string
     */
    public function getUbigeo(): string
    {
        return $this->ubigeo;
    }

    /**
     * @param string $ubigeo
     */
    public function setUbigeo(string $ubigeo): void
    {
        if(strlen($ubigeo) !== 6){
            throw new \InvalidArgumentException("El ubigeo no tiene el formato correcto");
        }
        $this->ubigeo = $ubigeo;
    }

    /**
     * @return string
     */
    public function getDepartamento(): string
    {
        return $this->departamento;
    }

    /**
     * @param string $departamento
     */
    public function setDepartamento(string $departamento): void
    {
        $this->departamento = $departamento;
    }

    /**
     * @return string
     */
    public function getProvincia(): string
    {
        return $this->provincia;
    }

    /**
     * @param string $provincia
     */
    public function setProvincia(string $provincia): void
    {
        $this->provincia = $provincia;
    }

    /**
     * @return string
     */
    public function getDistrito(): string
    {
        return $this->distrito;
    }

    /**
     * @param string $distrito
     */
    public function setDistrito(string $distrito): void
    {
        $this->distrito = $distrito;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getAnexo(): string
    {
        return $this->anexo;
    }

    /**
     * @param string $anexo
     */
    public function setAnexo(string $anexo): void
    {
        $this->anexo = $anexo;
    }

    /**
     * @return CodigoPais
     */
    public function getPais(): CodigoPais
    {
        return $this->pais;
    }

    /**
     * @param CodigoPais $pais
     */
    public function setPais(CodigoPais $pais): void
    {
        $this->pais = $pais;
    }


}
