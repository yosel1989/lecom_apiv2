<?php


namespace Src\Admin\User\Application;


use Src\Admin\User\Domain\Contracts\UserRepositoryContract;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Domain\ValueObjects\UserActived;
use Src\Admin\User\Domain\ValueObjects\UserEmail;
use Src\Admin\User\Domain\ValueObjects\UserFirstName;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Admin\User\Domain\ValueObjects\UserIdClient;
use Src\Admin\User\Domain\ValueObjects\UserIdRole;
use Src\Admin\User\Domain\ValueObjects\UserLastName;
use Src\Admin\User\Domain\ValueObjects\UserLevel;
use Src\Admin\User\Domain\ValueObjects\UserPassword;
use Src\Admin\User\Domain\ValueObjects\UserPhone;
use Src\Admin\User\Domain\ValueObjects\UserUserName;

final class CreateUserUseCase
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
        string $username,
        string $password,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone,
        int $level,
        int $actived,
        ?string $idClient,
        ?string $idRole
    ): ?User
    {
        $Uid = new UserId($id);
        $Uusername = new UserUserName($username);
        $Upassword = new UserPassword($password);
        $UfirstName = new UserFirstName($firstName);
        $UlastName = new UserLastName($lastName);
        $Uemail = new UserEmail($email);
        $Uphone = new UserPhone($phone);
        $Ulevel = new UserLevel($level);
        $Uactived = new UserActived($actived);
        $UidClient = new UserIdClient($idClient);
        $UidRole = new UserIdRole($idRole);

        return $this->repository->create(
            $Uid,
            $Uusername,
            $UfirstName,
            $UlastName,
            $Upassword,
            $Uemail,
            $Uphone,
            $Ulevel,
            $Uactived,
            $UidClient,
            $UidRole
        );

    }
}
