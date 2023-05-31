<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\ValueObjects\UserActived;
use Src\Admin\User\Domain\ValueObjects\UserEmail;
use Src\Admin\User\Domain\ValueObjects\UserFirstName;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Admin\User\Domain\ValueObjects\UserIdRole;
use Src\Admin\User\Domain\ValueObjects\UserLastName;
use Src\Admin\User\Domain\ValueObjects\UserPhone;

final class UpdateUserUseCase
{
    /**
     * @var UserRepositoryContract
     */
    private $repository;

    public function __construct( UserRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone,
        int $actived,
        ?string $idRole
    ): ?User
    {
        $Uid = new UserId($id);
        $UfirstName = new UserFirstName($firstName);
        $UlastName = new UserLastName($lastName);
        $Uemail = new UserEmail($email);
        $Uphone = new UserPhone($phone);
        $Uactived = new UserActived($actived);
        $UidRole = new UserIdRole($idRole);

        return $this->repository->update(
            $Uid,
            $UfirstName,
            $UlastName,
            $Uemail,
            $Uphone,
            $Uactived,
            $UidRole
        );

    }
}
