<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\TableNameDynamic;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class BoletoInterprovincial extends Model
{
    use UUID;
//    use TableNameDynamic;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
    protected $dynamicTableName;

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'idDestino',
        'idVehiculo',
        'idCliente',
        'numeroDocumento',
        'codigoBoleto',
        'latitud',
        'longitud',
        'precio',
        'fecha',
        'idEstado',
        'idEliminado',
        'fechaRegistro',
        'fechaModifico',
        'idUsuarioRegistro',
        'idUsuarioModifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
        'precio' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'fecha' => 'string',
        'fechaRegistro' => 'string',
        'fechaModifico' => 'string'
    ];


    public function setDynamicTableName($tableName)
    {
        $this->dynamicTableName = $tableName;
    }

    public function getTable()
    {
        if ($this->dynamicTableName) {
            return $this->dynamicTableName;
        }

        return parent::getTable();
    }











    public function usuarioRegistro(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

    public function vehiculo(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Vehiculo','id','idVehiculo');
    }

    public function destino(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Destino','id','idDestino');
    }

}
