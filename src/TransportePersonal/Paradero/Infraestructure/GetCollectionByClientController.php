<?php


namespace Src\TransportePersonal\Paradero\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Paradero\Application\GetCollectionByClientUseCase;
use Src\TransportePersonal\Paradero\Infraestructure\Repositories\EloquentParaderoRepository;

final class GetCollectionByClientController
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

        $createParaderoCase = new GetCollectionByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id,
        );
    }
}
