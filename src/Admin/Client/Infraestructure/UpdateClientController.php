<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\UpdateClientUseCase;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class UpdateClientController
{

    /**
     * @var EloquentClientRepository
     */
    private $repository;


    public function __construct( EloquentClientRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): ?Client
    {

        $Cid = $request->id;
        $CbussinessName = $request->input('businessName');
        $CfirstName = $request->input('firstname');
        $ClastName = $request->input('lastname');
        $Cruc = $request->input('ruc');
        $Cdni = $request->input('dni');
        $Cemail = $request->input('email');
        $Caddress = $request->input('address');
        $Cphone = $request->input('phone');
        $Ctype = $request->input('type');
        $CidParent = $request->input('idParent');

        $updateClientUseCase = new UpdateClientUseCase( $this->repository );
        return $updateClientUseCase->__invoke(
            $Cid,
            $CbussinessName,
            $CfirstName,
            $ClastName,
            $Cruc,
            $Cdni,
            $Cemail,
            $Caddress,
            $Cphone,
            $Ctype
        );

    }
}
