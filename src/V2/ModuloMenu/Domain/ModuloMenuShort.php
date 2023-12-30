<?php
declare(strict_types=1);

namespace Src\V2\ModuloMenu\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;

final class ModuloMenuShort
{
    private NumericInteger $id;
    private Text $nombre;
    private Text $icono;
    private NumericInteger $idEstado;
    private NumericInteger $idEliminado;




    private bool $activado;
    private Text $link;

    /**
     * @param NumericInteger $id
     * @param Text $nombre
     * @param Text $link
     * @param Text $icono
     * @param NumericInteger $idEstado
     * @param NumericInteger $idEliminado
     */
    public function __construct(
        NumericInteger $id,
        Text $nombre,
        Text $link,
        Text $icono,
        NumericInteger $idEstado,
        NumericInteger $idEliminado
    )
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->icono = $icono;
        $this->idEstado = $idEstado;
        $this->idEliminado = $idEliminado;
        $this->link = $link;
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
     * @return bool
     */
    public function isActivado(): bool
    {
        return $this->activado;
    }

    /**
     * @param bool $activado
     */
    public function setActivado(bool $activado): void
    {
        $this->activado = $activado;
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




    public function getModules(): array{
        return array([
            'id' => 1,
            'nombre' => 'Adminitración',
            'icon' => asset('assets/img/icons/modulo-administracion.png'),
            'link' => 'administracion'
        ],[
            'id' => 2,
            'nombre' => 'Boletaje Interprovincial',
            'icon' => asset('assets/img/icons/modulo-boletaje-interprovincial.png'),
            'link' => 'boletaje-interprovincial'
        ],[
            'id' => 3,
            'nombre' => 'Contabilidad',
            'icon' => asset('assets/img/icons/modulo-facturacion-electronica.png'),
            'link' => 'contabilidad'
        ]);
    }
}
