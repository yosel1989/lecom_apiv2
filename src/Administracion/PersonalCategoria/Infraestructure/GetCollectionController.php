<?php


namespace Src\Administracion\PersonalCategoria\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\PersonalCategoria\Application\GetCollectionUseCase;
use Src\Administracion\PersonalCategoria\Infraestructure\Repositories\EloquentPersonalCategoriaRepository;

final class GetCollectionController
{

    /**
     * @var EloquentPersonalCategoriaRepository
     */
    private $repository;

    public function __construct( EloquentPersonalCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {

        $createPersonalCategoriaCase = new GetCollectionUseCase( $this->repository );
        return $createPersonalCategoriaCase->__invoke();
    }
}
