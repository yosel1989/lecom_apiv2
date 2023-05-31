<?php


namespace Src\Older\Ert\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;
use Src\Older\Ert\Application\GetErtByImeiUseCase;
use Src\Older\Ert\Infraestructure\Repositories\EloquentErtRepository;
use Src\Older\ErtUbicacion\Application\RegisterErtUbicacionUseCase;
use Src\Older\ErtUbicacion\Application\RegisterUbicacionUseCase;
use Src\Older\ErtUbicacion\Infraestructure\Repositories\EloquentErtUbicacionRepository;
use Src\Older\SutranUbicaciones\Application\RegisterSutranUseCase;
use Src\Older\SutranUbicaciones\Infraestructure\Repositories\EloquentSutranUbicacionesRepository;
use Src\Older\Vehiculo\Application\GetVehiculoByIdUseCase;
use Src\Older\Vehiculo\Infraestructure\Repositories\EloquentVehiculoRepository;

final class RegisterStateController
{

    /**
     * @var EloquentUserRepository
     */
    private $repository;
    /**
     * @var EloquentVehiculoRepository
     */
    private $vrepository;
    /**
     * @var EloquentSutranUbicacionesRepository
     */
    private $srepository;
    /**
     * @var EloquentErtUbicacionRepository
     */
    private $eurepository;


    /**
     * RegisterStateController constructor.
     * @param EloquentErtRepository $repository
     * @param EloquentVehiculoRepository $vrepository
     * @param EloquentSutranUbicacionesRepository $srepository
     * @param EloquentErtUbicacionRepository $eurepository
     */
    public function __construct(
        EloquentErtRepository $repository,
        EloquentVehiculoRepository $vrepository,
        EloquentSutranUbicacionesRepository $srepository,
        EloquentErtUbicacionRepository $eurepository
    )
    {
        $this->repository = $repository;
        $this->vrepository = $vrepository;
        $this->srepository = $srepository;
        $this->eurepository = $eurepository;
    }

    public function __invoke( Request $request ): void
    {

        $imei = $request->input('imei');
        $datetime = $request->input('datetime');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $velocity = $request->input('velocity');
        $stateOff = $request->input('state_off');
        $stateBlock = $request->input('state_block');


        $getErtByImeiUseCase = new GetErtByImeiUseCase($this->repository);
        $Ert = $getErtByImeiUseCase->__invoke($imei);

        $getVehiculoByidUseCase = new GetVehiculoByIdUseCase($this->vrepository);
        $Vehiculo = $getVehiculoByidUseCase->__invoke($Ert->getVehiculoId()->value());

        $registerSutranUseCase = new RegisterSutranUseCase($this->srepository);
        $registerSutranUseCase->__invoke(
            $Vehiculo->getPlaca()->value(),
            $latitude,
            $longitude,
            0,
            $velocity,
            'ER',
            $datetime,
            $datetime,
            $datetime
        );

        $registerErtUbicacionUseCase = new RegisterErtUbicacionUseCase($this->eurepository);
        $registerErtUbicacionUseCase->__invoke(
            $Ert->getId()->value(),
            $datetime,
            $latitude,
            $longitude,
            $velocity
        );

        $registerUbicacionUseCase = new RegisterUbicacionUseCase($this->eurepository);
        $registerUbicacionUseCase->__invoke(
            $Ert->getId()->value(),
            $datetime,
            $latitude,
            $longitude,
            $velocity
        );
    }
}
