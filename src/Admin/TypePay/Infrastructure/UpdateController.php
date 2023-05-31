<?php


namespace Src\Admin\TypePay\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypePay\Application\UpdateUseCase;
use Src\Admin\TypePay\Domain\TypePay;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class UpdateController
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
        $id = $request->id;
        $g_name = $request->input('name');
        $g_description = $request->input('description');
        $g_currency = $request->input('currency');
        $g_amount = $request->input('amount');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke( $id, $g_name, $g_description, $g_currency, $g_amount );
    }
}
