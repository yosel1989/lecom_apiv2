<?php


namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ComprobanteSerie\Application\FindByEmpresaTipoComprobanteSedeUseCase;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerieShort;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class FindByEmpresaTipoComprobanteSedeController
{
    private EloquentComprobanteSerieRepository $repository;

    public function __construct(EloquentComprobanteSerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): ComprobanteSerieShort
    {
        $idEmpresa = $request->idEmpresa;
        $idSede = $request->idSede;
        $idTipoComprobante = $request->idTipoComprobante;
        $useCase = new FindByEmpresaTipoComprobanteSedeUseCase($this->repository);
        return $useCase->__invoke(
            $idEmpresa,
            $idSede,
            $idTipoComprobante
        );
    }

}
