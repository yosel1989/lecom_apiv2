<?php


namespace Src\Admin\TypeInvoicing\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\TypeInvoicing\Application\CreateUseCase;
use Src\Admin\TypeInvoicing\Domain\TypeInvoicing;
use Src\Admin\TypeInvoicing\Infrastructure\Repositories\EloquentTypeInvoicingRepository;

final class CreateController
{
    private $repository;

    public function __construct(EloquentTypeInvoicingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?TypeInvoicing
    {
        $id = Uuid::uuid4();
        $g_name = $request->input('name');
        $g_mounths = $request->input('months');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke( $id, $g_name, $g_mounths );
    }
}
