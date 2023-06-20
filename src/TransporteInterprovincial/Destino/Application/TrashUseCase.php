<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Application;

use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\Core\Domain\ValueObjects\Id;

final class TrashUseCase
{
    /**
     * @var DestinoRepositoryContract
     */
    private $repository;

    public function __construct(DestinoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new Id($value);
                $this->repository->trash($g_id);
            }

        }else{

            $g_id = new Id($id);
            $this->repository->trash($g_id);

        }

    }
}
