<?php


namespace Src\Older\Ert\Infraestructure\Repositories;


use App\Models\Older\Ert as EloquentErtModel;
use Src\Older\Ert\Domain\Contracts\ErtRepositoryContract;
use Src\Older\Ert\Domain\Ert;
use Src\Older\Ert\Domain\ValueObjects\ErtId;
use Src\Older\Ert\Domain\ValueObjects\ErtImei;
use Src\Older\Ert\Domain\ValueObjects\ErtVehiculoId;

final class EloquentErtRepository implements ErtRepositoryContract
{
    /**
     * @var EloquentErtModel
     */
    private $eloquentClientModel;

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentErtModel;
    }

    public function findByImei( ErtImei $imei ): ?Ert
    {
        $Ert = $this->eloquentClientModel->where('ert_imei',$imei->value())->firstOrFail();

        return new Ert(
            new ErtId($Ert->ert_id),
            new ErtImei($Ert->ert_imei),
            new ErtVehiculoId($Ert->vehiculo_id)
        );
    }

}
