<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\SimCard\Application\CreateUseCase;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class CreateController
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
        $id = Uuid::uuid4();
        $s_number = $request->input('number');
        $s_imei = $request->input('imei');
        $s_status = $request->input('status');
        $s_detail = $request->input('detail');
        $o_id = $request->input('operator');
        $s_client = $request->input('client');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke( $id, $s_number, $s_imei, $s_detail, $s_status,$o_id,$s_client);
    }
}
