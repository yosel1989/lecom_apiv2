<?php


namespace Src\Admin\Client\Application;


use Src\Admin\Client\Domain\Contracts\ClientRepositoryContract;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientAddress;
use Src\Admin\Client\Domain\ValueObjects\ClientBussinessName;
use Src\Admin\Client\Domain\ValueObjects\ClientDni;
use Src\Admin\Client\Domain\ValueObjects\ClientEmail;
use Src\Admin\Client\Domain\ValueObjects\ClientFirstName;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Client\Domain\ValueObjects\ClientIdParent;
use Src\Admin\Client\Domain\ValueObjects\ClientLastName;
use Src\Admin\Client\Domain\ValueObjects\ClientPhone;
use Src\Admin\Client\Domain\ValueObjects\ClientRuc;
use Src\Admin\Client\Domain\ValueObjects\ClientType;

final class CreateClientUseCase
{

    /**
     * @var ClientRepositoryContract
     */
    private $repository;

    public function __construct( ClientRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $bussinessName,
        string $firstName,
        string $lastName,
        string $ruc,
        string $dni,
        string $email,
        string $address,
        string $phone,
        int $type,
        ?string $idParent
    ): ?Client
    {
        $Cid                = new ClientId($id);
        $CbussinessName     = new ClientBussinessName($bussinessName);
        $CfirstName     = new ClientFirstName($firstName);
        $ClastName     = new ClientLastName($lastName);
        $Cruc     = new ClientRuc($ruc);
        $Cdni     = new ClientDni($dni);
        $Cemail     = new ClientEmail($email);
        $Caddress     = new ClientAddress($address);
        $Cphone     = new ClientPhone($phone);
        $Ctype     = new ClientType($type);
        $CidParent    = new ClientIdParent($idParent);

        return $this->repository->create(
            $Cid,
            $CbussinessName,
            $CfirstName,
            $ClastName,
            $Cruc,
            $Cdni,
            $Cemail,
            $Caddress,
            $Cphone,
            $Ctype,
            $CidParent
        );

    }
}
