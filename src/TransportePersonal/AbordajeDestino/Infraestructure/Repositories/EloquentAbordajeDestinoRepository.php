<?php


namespace Src\TransportePersonal\AbordajeDestino\Infraestructure\Repositories;


use App\Models\TransportePersonal\AbordajeDestino as EloquentAbordajeDestinoModel;
use InvalidArgumentException;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\AbordajeDestino\Domain\Contracts\AbordajeDestinoRepositoryContract;

final class EloquentAbordajeDestinoRepository implements AbordajeDestinoRepositoryContract
{
    /**
     * @var EloquentAbordajeDestinoModel
     */
    private $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentAbordajeDestinoModel;
    }

    public function create(
        Id $id,
        Id $idVehiculo,
        Text $matricula,
        Id $idRuta,
        Id $idTipoRuta,
        Id $idParaderoAbordaje,
        Id $idParaderoDestino,
        Id $idCliente,
        Text $hora
    ): void
    {
        $today = new \DateTime('now');

        $search = $this->eloquent->whereDate('created_at',$today->format('Y-m-d'))->where('matricula',$matricula->value())->where('id_tipo_ruta', $idTipoRuta->value())->get();

        if(!$search->isEmpty()){
            throw new InvalidArgumentException("Ya tiene registrado una salida con el mismo tipo de ruta");
        }

        $this->eloquent->create([
            'id' => $id->value(),
            'id_vehicle' => $idVehiculo->value(),
            'matricula' => $matricula->value(),
            'id_client' => $idCliente->value(),
            'id_ruta' => $idRuta->value(),
            'id_tipo_ruta' => $idTipoRuta->value(),
            'id_paradero_abordaje' => $idParaderoAbordaje->value(),
            'id_paradero_destino' => $idParaderoDestino->value(),
            'hora' => $hora->value()
        ]);
    }


}
