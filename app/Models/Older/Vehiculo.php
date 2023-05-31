<?php

namespace App\Models\Older;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{

    //protected $keyType = 'string';
    //public $incrementing = false;

    use SoftDeletesBoolean;

    const DELETED = 'vehiculo';

    public $timestamps = false;
    protected $table = "ert";

    protected $connection = 'mysql2';
    protected $primaryKey = 'vehiculo_id';
    /**
     * @var string[]
     */
    protected $fillable = [
        'vehiculo_id',
        'categoria_id',
        'parent_id',
        'cliente_id',
        'conductor_id',
        'flota_id',
        'clase_id',
        'marca_id',
        'modelo_id',
        'admin_id',
        'tanque_id',
        'vehiculo_desc1',
        'vehiculo_desc2',
        'marcador_nombre',
        'marcador_label',
        'vehiculo_unidad',
        'vehiculo_serie',
        'vehiculo_sim',
        'vehiculo_nombre',
        'vehiculo_descripcion',
        'vehiculo_marca',
        'vehiculo_modelo',
        'vehiculo_placa',
        'vehiculo_tarjpro',
        'vehiculo_color',
        'vehiculo_anio',
        'vehiculo_chasis',
        'vehiculo_conductor_nombre',
        'vehiculo_conductor_telefono',
        'vehiculo_conductor_brevete',
        'vehiculo_fecha',
        'vehiculo_ufecha',
        'vehiculo_imagen',
        'vehiculo_velmax',
        'vehiculo_odometro',
        'sutran_envio',
        'vehiculo_estado',
        'vehiculo_borrar',
        'padron',
        'ejes',
        'puertas',
        'n_motor',
        'cilindros',
        'serie_motor',
        'ruedas',
        'n_sticker',
        'n_asientos',
        'pasajeros',
        'peso_seco',
        'peso_bruto',
        'longitud',
        'altura',
        'ancho',
        'carga_util',
        'propietario_cod',
        'propietario_nombresap',
        'propietario_direcciono',
        'propietario_telefono',
        'propietario_fecinsc',
        'odometro_ini',
        'combustible_tipo',
        'unidad_medida',
        'rendimiento',
        'costo',
        'notas',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

}
