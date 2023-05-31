<?php


namespace Src\Admin\TypeInvoicing\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypeInvoicing\Application\UpdateUseCase;
use Src\Admin\TypeInvoicing\Domain\TypeInvoicing;
use Src\Admin\TypeInvoicing\Infrastructure\Repositories\EloquentTypeInvoicingRepository;

final class UpdateController
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
        $id = $request->id;
        $g_name = $request->input('name');
        $g_mounths = $request->input('months');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke( $id, $g_name, $g_mounths );
    }
}
