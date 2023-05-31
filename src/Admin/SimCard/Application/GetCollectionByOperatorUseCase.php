<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Application;

use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\SimCard\Domain\Contracts\SimCardRepositoryContract;

final class GetCollectionByOperatorUseCase
{
    /**
     * @var SimCardRepositoryContract
     */
    private $repository;

    public function __construct(SimCardRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idOperator  ): array
    {
        $operator = new OperatorPhoneId($idOperator);
        return $this->repository->collectionByOperator( $operator );
    }
}
