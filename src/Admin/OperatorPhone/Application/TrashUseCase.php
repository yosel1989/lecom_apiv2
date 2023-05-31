<?php

declare(strict_types=1);

namespace Src\Admin\OperatorPhone\Application;

use Src\Admin\OperatorPhone\Domain\Contracts\OperatorPhoneRepositoryContract;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;

final class TrashUseCase
{
    /**
     * @var OperatorPhoneRepositoryContract
     */
    private $repository;

    public function __construct(OperatorPhoneRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {
        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $o_id = new OperatorPhoneId($value);
                $this->repository->trash($o_id);
            }

        }else{

            $o_id = new OperatorPhoneId($id);
            $this->repository->trash($o_id);

        }

    }
}
