<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Infrastructure\Repositories;

use App\Models\TransporteInterprovincial\Destino as EloquentModel;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\Core\Domain\ValueObjects\Id;
use Src\TransporteInterprovincial\Destino\Domain\SmallDestino;

final class EloquentDestinoRepository implements DestinoRepositoryContract
{
    /**
     * @var EloquentModel
     */
    private EloquentModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new EloquentModel;
    }

    public function create(
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idCliente,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModel->create([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'idCliente' => $idCliente->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value(),
        ]);
    }

    public function update(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idCliente,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModel->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'idCliente' => $idCliente->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioModifico->value(),
        ]);

    }

    public function find( Id $idDestino ): ?Destino
    {
        $item = $this->eloquentModel->findOrFail($idDestino->value());

        $ODestino = new Destino(
            new Id($item->id,false,'El formato del id no es valido'),
            new Text($item->nombre,false,250, 'El nombre del destino excede los 250 caracteres'),
            new NumericFloat($item->precioBase),
            new Id($item->idCliente,false,'El formato del id del cliente no es valido'),
            new NumericInteger($item->idEliminado->value),
            new NumericInteger($item->idEstado->value),
            new Id($item->idUsuarioRegistro,false,'El formato del id del usuario que registro no es valido'),
            new DateTimeFormat($item->fechaRegistro,false,'El formato de la fecha de registro no es valido'),
            new Id($item->idUsuarioModifico,false,'El formato del id del usuario que modifico no es valido'),
            new DateTimeFormat($item->fechaModifico,false,'El formato de la fecha de modifico no es valido')
        );

        return $ODestino;
    }

    public function collectionByClient(Id $idCliente): array
    {
        $Destinos = $this->eloquentModel->where('idCliente', $idCliente->value());

        $arrDestinos = array();

        foreach ( $Destinos as $item ){
            $ODestino = new Destino(
                new Id($item->id,false,'El formato del id no es valido'),
                new Text($item->nombre,false,250, 'El nombre del destino excede los 250 caracteres'),
                new NumericFloat($item->precioBase),
                new Id($item->idCliente,false,'El formato del id del cliente no es valido'),
                new NumericInteger($item->idEliminado->value),
                new NumericInteger($item->idEstado->value),
                new Id($item->idUsuarioRegistro,false,'El formato del id del usuario que registro no es valido'),
                new DateTimeFormat($item->fechaRegistro,false,'El formato de la fecha de registro no es valido'),
                new Id($item->idUsuarioModifico,false,'El formato del id del usuario que modifico no es valido'),
                new DateTimeFormat($item->fechaModifico,false,'El formato de la fecha de modifico no es valido')
            );

            $arrDestinos[] = $ODestino;
        }

        return $arrDestinos;
    }

    public function collectionActivedByClient(Id $idCliente): array
    {
        $Destinos = $this->eloquentModel->where('idCliente',$idCliente->value())->where('idEstado',1)->get();

        $arrDestinos = array();

        foreach ( $Destinos as $item ){
            $ODestino = new Destino(
                new Id($item->id,false,'El formato del id no es valido'),
                new Text($item->nombre,false,250, 'El nombre del destino excede los 250 caracteres'),
                new NumericFloat($item->precioBase),
                new Id($item->idCliente,false,'El formato del id del cliente no es valido'),
                new NumericInteger($item->idEliminado->value),
                new NumericInteger($item->idEstado->value),
                new Id($item->idUsuarioRegistro,false,'El formato del id del usuario que registro no es valido'),
                new DateTimeFormat($item->fechaRegistro,false,'El formato de la fecha de registro no es valido'),
                new Id($item->idUsuarioModifico,false,'El formato del id del usuario que modifico no es valido'),
                new DateTimeFormat($item->fechaModifico,false,'El formato de la fecha de modifico no es valido')
            );

            $arrDestinos[] = $ODestino;
        }

        return $arrDestinos;
    }

    public function listByClient(Id $idCliente): array
    {
        $Destinos = $this->eloquentModel->where('idCliente',$idCliente->value())->where('idEstado',1)->get();

        $arrDestinos = array();

        foreach ( $Destinos as $item ){
            $ODestino = new SmallDestino(
                new Id($item->id,false,'El formato del id no es valido'),
                new Text($item->nombre,false,250, 'El nombre del destino excede los 250 caracteres'),
                new NumericFloat($item->precioBase),
                new NumericInteger($item->idEstado->value)
            );

            $arrDestinos[] = $ODestino;
        }

        return $arrDestinos;
    }

}
