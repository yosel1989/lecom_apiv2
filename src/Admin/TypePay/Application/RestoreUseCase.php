<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Application;

use Src\Admin\TypePay\Domain\Contracts\TypePayRepositoryContract;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayId;

final class RestoreUseCase
{
    /**
     * @var TypePayRepositoryContract
     */
    private $repository;

    public function __construct(TypePayRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new TypePayId($value);
                $this->repository->restore($g_id);
            }

        }else{

            $g_id = new TypePayId($id);
            $this->repository->restore($g_id);

        }

    }
}
