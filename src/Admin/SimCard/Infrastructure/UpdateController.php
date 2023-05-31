<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\UpdateUseCase;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class UpdateController
{
    private $repository;

    public function __construct(EloquentSimCardRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?SimCard
    {
        $id = $request->id;
        $s_number = $request->input('number');
        $s_imei = $request->input('imei');
        $s_detail = $request->input('detail');
        $o_id = $request->input('operator');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke( $id, $s_number, $s_imei, $s_detail, $o_id );
    }
}
