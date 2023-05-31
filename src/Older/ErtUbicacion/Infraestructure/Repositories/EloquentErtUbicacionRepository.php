<?php


namespace Src\Older\ErtUbicacion\Infraestructure\Repositories;


use App\Models\Older\ErtUbicacion as EloquentErtUbicacionModel;
use Illuminate\Support\Facades\DB;
use Src\Older\Ert\Domain\ValueObjects\ErtId;
use Src\Older\ErtUbicacion\Domain\Contracts\ErtUbicacionRepositoryContract;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slatitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Slongitud;
use Src\Older\SutranUbicaciones\Domain\ValueObjects\Svelocidad;
use Src\Utility\UDateTime;

final class EloquentErtUbicacionRepository implements ErtUbicacionRepositoryContract
{
    /**
     * @var EloquentErtUbicacionModel
     */
    private $eloquentErtUbicacionModel;

    public function __construct()
    {
        $this->eloquentErtUbicacionModel = new EloquentErtUbicacionModel;
    }

    public function register(
        ErtId $ertId,
        UDateTime $fecha,
        Slatitud $latitud,
        Slongitud $longitud,
        Svelocidad $velocidad
    ): void
    {
        $date = new \DateTime($fecha->value());
        $this->eloquentErtUbicacionModel->create([
            'dev_id' => 0,
            'sutran' => 0,
            'vehiculo_id' => $ertId->value(),
            'gsm_tms' => $date->getTimestamp(),
            'gsm_csq' => 0,
            'gsm_mcc' => 0,
            'gsm_mnc' => 0,
            'gsm_lac' => 0,
            'gsm_cid' => 0,
            'gps_fix' => 0,
            'gps_tms' => $date->getTimestamp(),
            'gps_sat' => 0,
            'coordenadas' => $latitud->value() . "," . $longitud->value(),
            'trama_valida' => 1,
            'ignition' => 0,
            'idestado' => 5,
            'fecha' => $date->getTimestamp(),
            'event_code' => 0,
            'event_fecha' => 0,
            'velocidad' => $velocidad->value(),
            'distancia' => 0,
            'rumbo' => 0,
            'odometro' => 0,
            'horometro' => 0,
            'numero_satelites' => 0,
            'senal_gsm' => 0,
            'altitud' => 0,
            'nivel_bateria_carro' => 0,
            'analogico1' => null,
            'analogico2' => null,
            'auxiliar_dato' => 0,
            'auxiliar_tipo' => 0,
            'demora' => 0,
            'ur_fecha' => 0,
            'ur_odometro' => 0,
            'eps_tms' => 0,
            'din' => 0,
            'dout' => 0,
            'gps_eps' => 0,
            'gps_battery' => 0,
            'gps_csq' => 0,
            'ralenti_tms' => 0,
            'alm1' => 0,
            'alm2' => 0,
            'alm3' => 0,
            'alm4' => 0,
            'nivel_bateria_gps' => null,
            'cod_servicio' => null,
            'cod_conductor' => null
        ]);
    }

    public function registerUbication(
        ErtId $ertId,
        UDateTime $fecha,
        Slatitud $latitud,
        Slongitud $longitud,
        Svelocidad $velocidad
    ): void
    {
        $date = new \DateTime($fecha->value());
        DB::table('ubicacion_' . $date->format('m') . '_' . $date->format('y'))->insert([
            'vehiculo_id' => $ertId->value(),
            'coordenadas' => $latitud->value() . "," . $longitud->value(),
            'coordenadas2' => '',
            'trama_valida' => 1,
            'event_code' => 0,
            'idestado' => 6,
            'fecha' => $date->getTimestamp(),
            'velocidad' => $velocidad->value(),
            'distancia' => 0,
            'rumbo' => 0,
            'odometro' => 0,
            'horometro' => 0,
            'horometro_e' => 0,
            'horometro_r' => 0,
            'horometro_t' => 0,
            'numero_satelites' => 0,
            'senal_gsm' => 0,
            'altitud' => 0,
            'nivel_bateria_carro' => 0,
            'eps' => 0,
            'battery' => 0,
            'csq' => 0,
            'din' => 0,
            'dout' => 0,
            'analogico1' => 0,
            'analogico2' => 0,
            'auxiliar_dato' => 0,
            'auxiliar_tipo' => 0,
            'demora ' => 0,
            'nivel_bateria_gps' => 0
        ]);
    }

}
