<?php


namespace Src\Older\SutranUbicaciones\Infraestructure\Repositories;


use App\Models\Older\SutranUbicaciones as EloquentSutranUbicacionesModel;
use Src\Older\SutranUbicaciones\Domain\Contracts\SutranUbicacionesRepositoryContract;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Sevento;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Splaca;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Srumbo;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;


final class EloquentSutranUbicacionesRepository implements SutranUbicacionesRepositoryContract
{
    /**
     * @var EloquentSutranUbicacionesModel
     */
    private $eloquentSutranUbicacionModel;

    public function __construct()
    {
        $this->eloquentSutranUbicacionModel = new EloquentSutranUbicacionesModel;
    }

    public function register(
        Splaca $placa,
        Slatitud $latitud,
        Slongitud $longitud,
        Srumbo $rumbo,
        Svelocidad $velocidad,
        Sevento $evento,
        UDateTime $fechaemv,
        UDateTime $fecha,
        UDateTime $tms
    ): void
    {
        $Dtms = new \DateTime($tms->value());
        $this->eloquentSutranUbicacionModel->create([
            'placa' => $placa->value(),
            'latitud' => $latitud->value(),
            'longitud' => $longitud->value(),
            'rumbo' => $rumbo->value(),
            'velocidad' => $velocidad->value(),
            'evento' => $evento->value(),
            'fechaemv' => $fechaemv->value(),
            'fecha' => $fecha->value(),
            'tms' => $Dtms->getTimestamp()
        ]);
    }

}
