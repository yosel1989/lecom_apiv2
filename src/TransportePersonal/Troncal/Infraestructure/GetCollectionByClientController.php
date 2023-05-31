<?php


namespace Src\TransportePersonal\Troncal\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Troncal\Application\GetCollectionByClientUseCase;
use Src\TransportePersonal\Troncal\Infraestructure\Repositories\EloquentTroncalRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentTroncalRepository
     */
    private $repository;

    public function __construct( EloquentTroncalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $createTroncalCase = new GetCollectionByClientUseCase( $this->repository );
        return $createTroncalCase->__invoke(
            $Id,
        );
    }
}
