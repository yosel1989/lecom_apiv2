<?php

namespace App\Models\Older;

use Illuminate\Database\Eloquent\Model;

class ErtUbicacion extends Model
{

    //protected $keyType = 'string';
    //public $incrementing = false;

    public $timestamps = false;
    protected $table = "ert_ubicacion";

    protected $connection = 'mysql2';
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'dev_id',
        'sutran',
        'vehiculo_id',
        'gsm_tms',
        'gsm_csq',
        'gsm_mcc',
        'gsm_mnc',
        'gsm_lac',
        'gsm_cid',
        'gps_fix',
        'gps_tms',
        'gps_sat',
        'coordenadas',
        'trama_valida',
        'ignition',
        'idestado',
        'fecha',
        'event_code',
        'event_fecha',
        'velocidad',
        'distancia',
        'rumbo',
        'odometro',
        'horometro',
        'numero_satelites',
        'senal_gsm',
        'altitud',
        'nivel_bateria_carro',
        'analogico1',
        'analogico2',
        'auxiliar_dato',
        'auxiliar_tipo',
        'demora',
        'ur_fecha',
        'ur_odometro',
        'eps_tms',
        'din',
        'dout',
        'gps_eps',
        'gps_battery',
        'gps_csq',
        'ralenti_tms',
        'alm1',
        'alm2',
        'alm3',
        'alm4',
        'nivel_bateria_gps',
        'cod_servicio',
        'cod_conductor'
    ];

}
