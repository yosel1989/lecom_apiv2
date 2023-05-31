<?php


namespace Src\TransportePersonal\Paradero\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Paradero\Application\GetListByClientUseCase;
use Src\TransportePersonal\Paradero\Infraestructure\Repositories\EloquentParaderoRepository;

final class GetListByClientController
{

    /**
     * @var EloquentParaderoRepository
     */
    private $repository;

    public function __construct( EloquentParaderoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $useCase = new GetListByClientUseCase( $this->repository );
        return $useCase->__invoke($Id);
    }
}
