<?php

namespace App\Models\V2;

use App\Enums\EnumEstadoBoleto;
use App\Enums\EnumTipoMoneda;
use App\Enums\EnumTipoPago;
use App\Enums\IdAnulado;
use App\Enums\IdEliminado;
use App\Enums\IdEnBlanco;
use App\Enums\IdEstado;
use App\Enums\IdPorPagar;
use App\Enums\IdTipoBoleto;
use App\Enums\IdTipoComprobante;
use App\Enums\IdTipoDocumento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BoletoInterprovincial extends Model
{
//    use UUID;
//    use TableNameDynamic;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "boleto_interprovincial_base";
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
        'idCliente',
        'idSede',
        'idCaja',
        'idTipoDocumento',
        'numeroDocumento',
        'nombres',
        'apellidos',
        'menorEdad',

        'idVehiculo',
        'idAsiento',
        'fechaPartida',
        'horaPartida',
        'idRuta',
        'idParadero',
        'precio',
        'idTipoMoneda',
        'idFormaPago',
        'obsequio',


        'idPos',
        'codigo',
//        'serie',
//        'numero',
        'latitud',
        'longitud',


        'fechaEmision',
        'idEstado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico',


        'idTipoBoleto',
        'porPagar',
        'idTipoComprobante'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'idTipoComprobante' => IdTipoComprobante::class,
        'idTipoDocumento' => IdTipoDocumento::class,
        'idTipoMoneda' => EnumTipoMoneda::class,
        'idFormaPago' => EnumTipoPago::class,
        'idEstado' => EnumEstadoBoleto::class,
//        'idEliminado' => IdEliminado::class,
        'precio' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'fechaPartida' => 'string',
        'horaPartida' => 'string',
        'fechaEmision' => 'string',
//        'numeroComprobante' => 'integer',
        'fechaRegistro' => 'string',
        'fechaModifico' => 'string',
        'total' => 'integer',
//        'anulado' => IdAnulado::class,
//        'enBlanco' => IdEnBlanco::class,
        'porPagar' => 'boolean',
        'idTipoBoleto' => IdTipoBoleto::class,

        'menorEdad' => 'boolean',

    ];


    public function setDynamicTableName($tableName)
    {
        $this->dynamicTableName = $tableName;
        $this->table = $tableName;
        parent::setTable($tableName);
        self::setTable($tableName);
    }

    public function getTable()
    {
        if ($this->dynamicTableName) {
            return $this->dynamicTableName;
        }

        return parent::getTable();
    }




    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);

        $model->setTable($this->getTable());

        return $model;
    }






    public function usuarioRegistro(): HasOne{
        $this->dynamicTableName = $this->getTable();
        $this->table = $this->getTable();
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->setTable('boleto_interprovincial_' . $this->getTable())->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

    public function vehiculo(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Vehiculo','id','idVehiculo');
    }

    public function paradero(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Paradero','id','idParadero');
    }

    public function ruta(): HasOne{
        $this->dynamicTableName = 'boleto_interprovincial_' . $this->getTable();
        $this->table = 'boleto_interprovincial_' . $this->getTable();
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->setTable('boleto_interprovincial_' . $this->getTable())->hasOne('App\Models\V2\Ruta','id','idRuta');
    }

    public function caja(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Caja','id','idCaja');
    }

    public function pos(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Pos','id','idPos');
    }

    public function sede(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\Sede','id','idSede');
    }

    public function tipoDocumento(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\TipoDocumento','id','idTipoDocumento');
    }

    public function tipoMoneda(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\TipoMoneda','id','idTipoMoneda');
    }

    public function tipoComprobante(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\TipoComprobante','id','idTipoComprobante');
    }

    public function tipoDocumentoEntidad(): HasOne{
        parent::setTable('boleto_interprovincial_' . $this->getTable());
        return $this->hasOne('App\Models\V2\TipoDocumento','id','idTipoDocumentoEntidad');
    }

}
