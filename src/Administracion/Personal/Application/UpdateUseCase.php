<?php

namespace Src\Administracion\Personal\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Personal\Domain\Contracts\PersonalRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var PersonalRepositoryContract
     */
    private $repository;

    public function __construct( PersonalRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        string $apellido,
        string $documentoIdentidad,
        ?string $fechaNacimiento,
        string $idCategoriaPersonal,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $id = new Id($id,false,'El id del Personal no tiene el formato valido');
        $name = new Text($nombre,false, 100 ,'El nombre tiene mas de 100 caracteres');
        $lastname = new Text($apellido,false, 100 ,'El apellido tiene mas de 100 caracteres');
        $personalDocument = new Text($documentoIdentidad,false, 20 ,'El documento de identidad tiene mas de 20 caracteres');
        $birthDay = new DateOnlyFormat($fechaNacimiento,true, 10 ,'La fecha de cumpleaños tiene el formato incorrecto');
        $idPersonalCategory = new Id($idCategoriaPersonal,false,'El id de la categoria del Personal no tiene el formato valido');
        $idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato valido');

        $idStatus = new Numeric($idEstado,false);
        $idUserRegistered = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');

        $this->repository->update(
            $id,
            $name,
            $lastname,
            $personalDocument,
            $birthDay,
            $idPersonalCategory,
            $idCliente,
            $idStatus,
            $idUserRegistered
        );

    }
}
