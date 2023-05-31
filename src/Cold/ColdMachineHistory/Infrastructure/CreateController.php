<?php


namespace Src\Cold\ColdMachineHistory\Infrastructure;


use App\Events\AlertColdMachineHistoryEvent;
use App\Events\ColdMachineHistoryEvent;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Cold\ColdMachine\Application\FindByImeiUseCase;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;
use Src\Cold\ColdMachineAlert\Application\FindByCodeUseCase;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;
use Src\Cold\ColdMachineAlertHistory\Infrastructure\Repositories\EloquentColdMachineAlertHistoryRepository;
use Src\Cold\ColdMachineHistory\Application\CreateUseCase;
use Src\Cold\ColdMachineAlertHistory\Application\CreateUseCase as CreateAlertHistoryUseCase;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistory;
use Src\Cold\ColdMachineHistory\Infrastructure\Repositories\EloquentColdMachineHistoryRepository;
use Src\Cold\ColdMachineRealTime\Infrastructure\Repositories\EloquentColdMachineRealTimeRepository;


final class CreateController
{
    private $repository;
    private $machineRepository;
    private $alertHistoryRepository;
    private $alertRepository;
    /**
     * @var EloquentColdMachineRealTimeRepository
     */
    private $coldMachineRealTimeRepository;

    /**
     * @param EloquentColdMachineHistoryRepository $repository
     * @param EloquentColdMachineRepository $machineRepository
     * @param EloquentColdMachineAlertHistoryRepository $alertHistoryRepository
     * @param EloquentColdMachineAlertRepository $alertRepository
     * @param EloquentColdMachineRealTimeRepository $coldMachineRealTimeRepository
     */
    public function __construct(
        EloquentColdMachineHistoryRepository $repository,
        EloquentColdMachineRepository $machineRepository,
        EloquentColdMachineAlertHistoryRepository $alertHistoryRepository,
        EloquentColdMachineAlertRepository $alertRepository,
        EloquentColdMachineRealTimeRepository $coldMachineRealTimeRepository
    )
    {
        $this->repository = $repository;
        $this->machineRepository = $machineRepository;
        $this->alertHistoryRepository = $alertHistoryRepository;
        $this->alertRepository = $alertRepository;
        $this->coldMachineRealTimeRepository = $coldMachineRealTimeRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?ColdMachineHistory
    {
        $date = new \DateTime();
        $date->setTimestamp((int)$request->input('dt'));
        $id = Uuid::uuid4();
        $type = (int)$request->input('type');
        $imei = $request->input('i');
        $alertCode = $request->has('cod') ? (int)$request->input('cod') : 0 ;
        $status = null;
        $levelFuel = null;
        $levelBattery = null;
        $levelOutput = null;
        $frequencyOutput = null;
        $temperatureMotor = null;
        $hourmeter = null;
        $temperatureSupply = null;
        $temperatureReturn = null;
        $humidity = null;
        $co2 = null;
        $spTemperature = null;
        $spCo2 = null;
        $latitude = (float)$request->input('lat');
        $longitude = (float)$request->input('lng');
        $spHumidity = null;
        $createdAt = $date->format('Y-m-d H:i:s');

        if($type === 0){
            $status = $request->has('st') ? (int)$request->input('st') : null;
            $levelFuel = $request->has('lvlF') ? (float)$request->input('lvlF') : null;
            $levelBattery = $request->has('lvlB') ? (float)$request->input('lvlB') : null;
            $levelOutput = $request->has('lvlO') ? (float)$request->input('lvlO') : null;
            $frequencyOutput = $request->has('frO') ? (float)$request->input('frO') : null;
            $temperatureMotor = $request->has('tmpM') ? (float)$request->input('tmpM') : null;
            $hourmeter = $request->has('hr') ? (int)$request->input('hr') : null;
        }else{
            $temperatureSupply = $request->has('tmpS') ? (float)$request->input('tmpS') : null;
            $temperatureReturn = $request->has('tmpR') ? (float)$request->input('tmpR') : null;
            $humidity = $request->has('hm') ? (float)$request->input('hm') : null;
            $co2 = $request->has('co2') ? (int)$request->input('co2') : null;
            $spTemperature = $request->has('spTmp') ? (float)$request->input('spTmp') : null;
            $spCo2 = $request->has('spCo2') ? (float)$request->input('spCo2') : null;
            $spHumidity = $request->has('spHm') ? (float)$request->input('spHm') : null;
        }

        $finMachineByImei = new FindByImeiUseCase($this->machineRepository);
        $machine = $finMachineByImei->__invoke($imei);

        $clientId = $machine->getIdClient()->value();

        $createUseCase = new CreateUseCase($this->repository);
        $history = $createUseCase->__invoke(
            $id,
            $type,
            $imei,
            $machine->getId()->value(),
            $status,
            $levelFuel,
            $levelBattery,
            $levelOutput,
            $frequencyOutput,
            $temperatureMotor,
            $hourmeter,
            $temperatureSupply,
            $temperatureReturn,
            $humidity,
            $co2,
            $spTemperature,
            $spCo2,
            $spHumidity,
            $clientId,
            $latitude,
            $longitude,
            $createdAt
        );

        $createRealTimeUseCase = new \Src\Cold\ColdMachineRealTime\Application\CreateUseCase($this->coldMachineRealTimeRepository);
        $createRealTimeUseCase->__invoke(
            $id,
            $type,
            $imei,
            $machine->getId()->value(),
            $status,
            $levelFuel,
            $levelBattery,
            $levelOutput,
            $frequencyOutput,
            $temperatureMotor,
            $hourmeter,
            $temperatureSupply,
            $temperatureReturn,
            $humidity,
            $co2,
            $spTemperature,
            $spCo2,
            $spHumidity,
            $clientId,
            $latitude,
            $longitude,
            $createdAt
        );

        // Registrar alerta si existe
        if($alertCode !== 0 ){

            $findByCodeUseCase = new FindByCodeUseCase($this->alertRepository);
            $alert = $findByCodeUseCase->__invoke(
              $alertCode
            );

            if($alert){
                $idAlertHistory = Uuid::uuid4();
                $createAlertHistoryUseCase = new CreateAlertHistoryUseCase($this->alertHistoryRepository);
                $machineAlert = $createAlertHistoryUseCase->__invoke(
                    $idAlertHistory,
                    $alert->getId()->value(),
                    $machine->getId()->value(),
                    $clientId,
                    $latitude,
                    $longitude,
                    $createdAt
                );
                broadcast(new AlertColdMachineHistoryEvent($machineAlert))->toOthers();
            }

        }

        broadcast(new ColdMachineHistoryEvent($history))->toOthers();

        return $history;
    }
}
