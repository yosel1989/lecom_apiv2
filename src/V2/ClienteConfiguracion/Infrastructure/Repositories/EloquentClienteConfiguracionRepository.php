<?php

declare(strict_types=1);

namespace Src\V2\ClienteConfiguracion\Infrastructure\Repositories;

use App\Enums\EnumParametroConfiguracion;
use App\Models\V2\ClienteConfiguracion as EloquentModelClienteConfiguracion;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ClienteConfiguracion\Domain\ClienteConfiguracion;
use Src\V2\ClienteConfiguracion\Domain\Contracts\ClienteConfiguracionRepositoryContract;

final class EloquentClienteConfiguracionRepository implements ClienteConfiguracionRepositoryContract
{
    private EloquentModelClienteConfiguracion $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelClienteConfiguracion = new EloquentModelClienteConfiguracion;
    }




    public function find(
        Id $idCliente
    ): ClienteConfiguracion
    {
        $ruc = $this->eloquentModelClienteConfiguracion
            ->where('id_cliente', $idCliente->value())
            ->where('id_parametro_configuracion', EnumParametroConfiguracion::Empresa_Ruc);

        $razonSocial = $this->eloquentModelClienteConfiguracion
            ->where('id_cliente', $idCliente->value())
            ->where('id_parametro_configuracion', EnumParametroConfiguracion::Empresa_RazonSocial);

        $direccionFiscal = $this->eloquentModelClienteConfiguracion
            ->where('id_cliente', $idCliente->value())
            ->where('id_parametro_configuracion', EnumParametroConfiguracion::Empresa_DireccionFiscal);

        $OModel = new ClienteConfiguracion(
            new Text( $ruc->count() > 0 ? $ruc->first()->valor : null ,true,-1, ''),
            new Text( $direccionFiscal->count() > 0 ? $direccionFiscal->first()->valor : null ,true,-1, ''),
            new Text( $razonSocial->count() > 0 ? $razonSocial->first()->valor : null ,true,-1, ''),
        );

        return $OModel;
    }

}
