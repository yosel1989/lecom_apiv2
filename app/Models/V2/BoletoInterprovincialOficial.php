<?php

namespace App\Models\V2;

use App\Enums\EnumEstadoBoletoInterprovincial;
use App\Enums\EnumTipoMoneda;
use App\Enums\EnumTipoPago;
use App\Enums\IdTipoBoleto;
use App\Enums\IdTipoComprobante;
use App\Enums\IdTipoDocumento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BoletoInterprovincialOficial extends Model
{
//    use UUID;
//    use TableNameDynamic;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "boleto_interprovincial";
    public $timestamps = true;
    protected $dynamicTableName;

    const CREATED_AT = 'f_registro';
    const UPDATED_AT = 'f_modifico';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_cliente',
        'id_sede',
        'id_caja',
        'id_caja_diario',
        'id_tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'menor_edad',


        'id_vehiculo',
        'id_asiento',
        'f_partida',
        'h_partida',
        'id_ruta',
        'id_paradero_origen',
        'id_paradero_destino',
        'precio',
        'id_tipo_moneda',
        'id_forma_pago',
        'id_medio_pago',
        'obsequio',


        'id_pos',
        'codigo',

        'latitud',
        'longitud',


        'f_emision',
        'id_estado',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico',


        'id_tipo_comprobante',
        'id_tipo_boleto',
        'por_pagar',
        'id_origen',
        'id_liquidacion',
        'id_empresa',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id_tipo_comprobante' => IdTipoComprobante::class,
        'id_tipo_documento' => IdTipoDocumento::class,
        'id_tipo_moneda' => EnumTipoMoneda::class,
        'id_forma_pago' => EnumTipoPago::class,
        'id_estado' => EnumEstadoBoletoInterprovincial::class,
//        'idEliminado' => IdEliminado::class,
        'precio' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'f_partida' => 'string',
        'h_partida' => 'string',
        'f_emision' => 'string',
//        'numeroComprobante' => 'integer',
        'fecha' => 'string',
        'f_registro' => 'string',
        'f_modifico' => 'string',
        'total' => 'integer',
        'total_boletos' => 'integer',
        'id_origen' => 'integer',
        'id_vehiculo' => 'string',
//        'anulado' => IdAnulado::class,
//        'enBlanco' => IdEnBlanco::class,
        'por_pagar' => 'boolean',
        'id_tipo_boleto' => IdTipoBoleto::class,

        'menor_edad' => 'boolean',

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
        parent::setTable($this->getTable());
        return $this->setTable('boleto_interprovincial_' . $this->getTable())->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(): HasOne{
        $this->dynamicTableName = $this->getTable();
        $this->table = $this->getTable();
        parent::setTable($this->getTable());
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function vehiculo(): HasOne{
        parent::setTable($this->getTable());
        return $this->hasOne('App\Models\V2\Vehiculo','id','id_vehiculo');
    }

    public function paraderoOrigen(): HasOne{
        parent::setTable($this->getTable());
        return $this->hasOne('App\Models\V2\Paradero','id','id_paradero_origen');
    }

    public function paraderoDestino(): HasOne{
        parent::setTable($this->getTable());
        return $this->hasOne('App\Models\V2\Paradero','id','id_paradero_destino');
    }

    public function ruta(): HasOne{
        $this->dynamicTableName = 'boleto_interprovincial_' . $this->getTable();
        $this->table = $this->getTable();
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
