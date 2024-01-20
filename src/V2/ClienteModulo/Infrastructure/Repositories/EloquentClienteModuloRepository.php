<?php

declare(strict_types=1);

namespace Src\V2\ClienteModulo\Infrastructure\Repositories;

use App\Models\V2\ClienteModulo as EloquentModelClienteModulo;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ClienteModulo\Domain\Contracts\ClienteModuloRepositoryContract;

final class EloquentClienteModuloRepository implements ClienteModuloRepositoryContract
{
    private EloquentModelClienteModulo $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelClienteModulo;
    }

    public function assign(
        Id $idCliente,
        array $modulos,
        Id $idUsuario
    ): void
    {
        if($this->eloquent->where('id_cliente', $idCliente->value())->count() > 0){
            $this->eloquent->where('id_cliente', $idCliente->value())->update([
                'modulos' => $modulos,
                'id_usu_registro' => $idUsuario->value()
            ]);
        }else{
            $this->eloquent->create([
               'id_cliente' => $idCliente->value(),
               'modulos' => $modulos,
               'id_usu_registro' => $idUsuario->value()
            ]);
        }



    }



}
