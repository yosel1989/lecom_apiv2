<?php


namespace Src\Administracion\Ruta\Application;


use Src\Administracion\Ruta\Domain\RutaShort;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\Administracion\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Text;

final class FindByClientByCodeUseCase
{
    private $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idCliente, string $codigoRuta ): ?RutaShort
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $code = new Text($codigoRuta,false,15, 'El código de ruta excede los 15 caracteres');
        return $this->repository->findByClientByCode($id, $code);
    }

}
