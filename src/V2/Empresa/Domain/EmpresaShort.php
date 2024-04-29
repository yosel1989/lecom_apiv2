<?php
declare(strict_types=1);

namespace Src\V2\Empresa\Domain;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;

final class EmpresaShort
{
    private Id $id;
    private Text $nombre;
    private Text $ruc;
    private ValueBoolean $predeterminado;

    /**
     * @param Id $id
     * @param Text $nombre
     * @param Text $ruc
     * @param ValueBoolean $predeterminado
     */
    public function __construct(
        Id $id,
        Text $nombre,
        Text $ruc,
        ValueBoolean $predeterminado
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ruc = $ruc;
        $this->predeterminado = $predeterminado;
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
     * @return Text
     */
    public function getRuc(): Text
    {
        return $this->ruc;
    }

    /**
     * @param Text $ruc
     */
    public function setRuc(Text $ruc): void
    {
        $this->ruc = $ruc;
    }

    /**
     * @return ValueBoolean
     */
    public function getPredeterminado(): ValueBoolean
    {
        return $this->predeterminado;
    }

    /**
     * @param ValueBoolean $predeterminado
     */
    public function setPredeterminado(ValueBoolean $predeterminado): void
    {
        $this->predeterminado = $predeterminado;
    }

}
