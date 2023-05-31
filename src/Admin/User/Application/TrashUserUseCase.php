<?php


namespace Src\Admin\User\Application;

use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\ValueObjects\UserId;

final class TrashUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): void
    {

        if( strpos($id, ',') ){

            $ids = explode(',', $id);
            foreach ( $ids as $value) {
                $g_id = new UserId($value);
                $this->repository->trash($g_id);
            }

        }else{

            $g_id = new UserId($id);
            $this->repository->trash($g_id);

        }
    }

}
