<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TransporteInterprovincial\Destino\Application\CreateUseCase;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class CreateController
{
    private $repository;

    public function __construct(EloquentDestinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): void
    {
        $_nombre = $request->input('nombre');
        $_precioBase = $request->input('precioBase');
        $_idCliente = $request->input('idCliente');
        $_idEstado = $request->input('idEstado');
        $_idUsuario = Auth::user()->getId();

        $createUseCase = new CreateUseCase($this->repository);
        $createUseCase->__invoke(
            $_nombre,
            $_precioBase,
            $_idCliente,
            $_idEstado,
            $_idUsuario
        );
    }
}
