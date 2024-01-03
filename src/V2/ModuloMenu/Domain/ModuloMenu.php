<?php
declare(strict_types=1);

namespace Src\V2\ModuloMenu\Domain;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class ModuloMenu
{
    private NumericInteger $id;
    private Text $texto;
    private Text $icono;
    private NumericInteger $idTipoMenu;
    private NumericInteger $padre;
    private Text $link;
    private NumericInteger $idModulo;
    private NumericInteger $idEstado;
    private Id $idUsuarioRegistro;
    private Id $idUsuarioModifico;
    private DateTimeFormat $fechaRegistro;
    private DateTimeFormat $fechaModifico;


    // Secondary
    private Text $tipoMenu;
    private Text $modulo;
    private Text $usuarioRegistro;
    private Text $usuarioModifico;
    private array $hijos = [];

    private ValueBoolean $activado;

    /**
     * @param Id $id
     * @param Text $texto
     * @param Text $icono
     * @param NumericInteger $idTipoMenu
     * @param NumericInteger $padre
     * @param Text $link
     * @param NumericInteger $idModulo
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     * @param Id $idUsuarioModifico
     * @param DateTimeFormat $fechaRegistro
     * @param DateTimeFormat $fechaModifico
     */
    public function __construct(
        NumericInteger $id,
        Text $texto,
        Text $icono,
        NumericInteger $idTipoMenu,
        NumericInteger $padre,
        Text $link,
        NumericInteger $idModulo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro,
        Id $idUsuarioModifico,
        DateTimeFormat $fechaRegistro,
        DateTimeFormat $fechaModifico
    )
    {
        $this->id = $id;
        $this->texto = $texto;
        $this->icono = $icono;
        $this->idTipoMenu = $idTipoMenu;
        $this->padre = $padre;
        $this->link = $link;
        $this->idModulo = $idModulo;
        $this->idEstado = $idEstado;
        $this->idUsuarioRegistro = $idUsuarioRegistro;
        $this->idUsuarioModifico = $idUsuarioModifico;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaModifico = $fechaModifico;


        $this->activado = new ValueBoolean(false);
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
    public function getTexto(): Text
    {
        return $this->texto;
    }

    /**
     * @param Text $texto
     */
    public function setTexto(Text $texto): void
    {
        $this->texto = $texto;
    }

    /**
     * @return Text
     */
    public function getIcono(): Text
    {
        return $this->icono;
    }

    /**
     * @param Text $icono
     */
    public function setIcono(Text $icono): void
    {
        $this->icono = $icono;
    }

    /**
     * @return NumericInteger
     */
    public function getIdTipoMenu(): NumericInteger
    {
        return $this->idTipoMenu;
    }

    /**
     * @param NumericInteger $idTipoMenu
     */
    public function setIdTipoMenu(NumericInteger $idTipoMenu): void
    {
        $this->idTipoMenu = $idTipoMenu;
    }

    /**
     * @return NumericInteger
     */
    public function getPadre(): NumericInteger
    {
        return $this->padre;
    }

    /**
     * @param NumericInteger $padre
     */
    public function setPadre(NumericInteger $padre): void
    {
        $this->padre = $padre;
    }

    /**
     * @return Text
     */
    public function getLink(): Text
    {
        return $this->link;
    }

    /**
     * @param Text $link
     */
    public function setLink(Text $link): void
    {
        $this->link = $link;
    }

    /**
     * @return NumericInteger
     */
    public function getIdModulo(): NumericInteger
    {
        return $this->idModulo;
    }

    /**
     * @param NumericInteger $idModulo
     */
    public function setIdModulo(NumericInteger $idModulo): void
    {
        $this->idModulo = $idModulo;
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
    public function getTipoMenu(): Text
    {
        return $this->tipoMenu;
    }

    /**
     * @param Text $tipoMenu
     */
    public function setTipoMenu(Text $tipoMenu): void
    {
        $this->tipoMenu = $tipoMenu;
    }

    /**
     * @return Text
     */
    public function getModulo(): Text
    {
        return $this->modulo;
    }

    /**
     * @param Text $modulo
     */
    public function setModulo(Text $modulo): void
    {
        $this->modulo = $modulo;
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
     * @return array
     */
    public function getHijos(): array
    {
        return $this->hijos;
    }

    /**
     * @param array $hijos
     */
    public function setHijos(array $hijos): void
    {
        $this->hijos = $hijos;
    }

    /**
     * @return ValueBoolean
     */
    public function getActivado(): ValueBoolean
    {
        return $this->activado;
    }

    /**
     * @param ValueBoolean $activado
     */
    public function setActivado(ValueBoolean $activado): void
    {
        $this->activado = $activado;
    }

}
