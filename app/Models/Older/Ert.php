<?php

namespace App\Models\Older;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Ert extends Model
{

    //protected $keyType = 'string';
    //public $incrementing = false;

    use SoftDeletesBoolean;

    const DELETED = 'ert_borrar';

    public $timestamps = false;
    protected $table = "ert";

    protected $connection = 'mysql2';
    protected $primaryKey = 'ert_id';
    /**
     * @var string[]
     */
    protected $fillable = [
        'ert_id',
        'egps_id',
        'categoria_id',
        'ert_rastreo',
        'ert_rastreo_nombre',
        'vehiculo_id',
        'personal_id',
        'activo_id',
        'paquete_id',
        'ert_descripcion',
        'ert_serie',
        'ert_codigo',
        'ert_modelo',
        'ert_imei',
        'ert_operador',
        'ert_sim',
        'ert_sim_imei',
        'ert_periodo',
        'ert_plan',
        'ert_sutran',
        'ert_osinerg',
        'ert_wisetrack',
        'ert_wisetrack_emp',
        'ert_uprocesar',
        'ert_uodometro',
        'ert_ralenti',
        'ert_parada',
        'ert_gralenti',
        'ert_gparada',
        'ert_imagen',
        'ert_ufecha',
        'ert_uid',
        'ert_estado',
        'ert_incidencia',
        'ert_feccreacion',
        'ert_borrar',
        'ert_uhorometro',
        'ert_utmp',
        'perifoneo_active'
    ];

}
