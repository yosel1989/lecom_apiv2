<?php


namespace Src\Administracion\MotivoAnulacion\Infraestructure;


use Illuminate\Http\Request;
//use Src\Administracion\MotivoAnulacion\Application\GetCollectionUseCase;
use Src\Administracion\MotivoAnulacion\Application\GetListUseCase;
use Src\Administracion\MotivoAnulacion\Infraestructure\Repositories\EloquentMotivoAnulacionRepository;

final class GetListController
{

    /**
     * @var EloquentMotivoAnulacionRepository
     */
    private $repository;

    public function __construct( EloquentMotivoAnulacionRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
//        $Id       = $request->id;

        $createParaderoCase = new GetListUseCase( $this->repository );
        return $createParaderoCase->__invoke();
    }
}
