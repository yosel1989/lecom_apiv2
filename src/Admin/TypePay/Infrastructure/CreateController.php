<?php


namespace Src\Admin\TypePay\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\TypePay\Application\CreateUseCase;
use Src\Admin\TypePay\Domain\TypePay;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class CreateController
{
    private $repository;

    public function __construct(EloquentTypePayRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?TypePay
    {
        $id = Uuid::uuid4();
        $g_name = $request->input('name');
        $g_description = $request->input('description');
        $g_currency = $request->input('currency');
        $g_amount = $request->input('amount');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke( $id, $g_name, $g_description, $g_currency, $g_amount );
    }
}
