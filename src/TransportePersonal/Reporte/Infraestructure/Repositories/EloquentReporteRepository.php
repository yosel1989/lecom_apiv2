<?php


namespace Src\TransportePersonal\Reporte\Infraestructure\Repositories;


use App\Models\TransportePersonal\AbordajeDestino as EloquentReporteModel;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\TransportePersonal\Reporte\Domain\Contracts\ReporteRepositoryContract;
use Src\TransportePersonal\Reporte\Domain\ListReporte;
use Src\TransportePersonal\Reporte\Domain\Reporte;

final class EloquentReporteRepository implements ReporteRepositoryContract
{
    /**
     * @var EloquentReporteModel
     */
    private $eloquentReporteModel;

    public function __construct()
    {
        $this->eloquentReporteModel = new EloquentReporteModel;
    }


    public function reportByClient(
        Id $idCliente,
        DateOnlyFormat $fechaDesde,
        DateOnlyFormat $fechaHasta
    ): array
    {
        $collection = [];

        $response = $this->eloquentReporteModel
            ->with('paraderoAbordaje:id,name','paraderoDestino:id,name','tipoRuta:id,name')
            ->where('id_client', $idCliente->value())
            ->whereDate('created_at','>=', $fechaDesde->value())
            ->whereDate('created_at','<=', $fechaHasta->value())
            ->get();

        foreach( $response as $item) {
            $model = new Reporte(
                new Id($item->id,false,'El id del Reporte no tiene el formato valido'),
                new Text($item->matricula,false, 100 ,'El nombre de la matricula tiene mas de 100 caracteres'),
                new Id($item->id_tipo_ruta,false,'El id del tipo de ruta no tiene el formato valido'),
                new Text($item->tipoRuta->name,false, 100 ,'El nombre del tipo de ruta tiene mas de 100 caracteres'),
                new Id($item->id_paradero_abordaje,false,'El id del paradero de abordaje no tiene el formato valido'),
                new Text($item->paraderoAbordaje->name,false, 100 ,'El nombre del paradero de abordaje tiene mas de 100 caracteres'),
                new Id($item->id_paradero_destino,false,'El id del paradero de destino no tiene el formato valido'),
                new Text($item->paraderoDestino->name,false, 100 ,'El nombre del paradero de destino tiene mas de 100 caracteres'),
                new DateTimeFormat($item->updated_at ,true, 'La fecha de creación no tiene el formato correcto'),
            );
            $collection[] = $model;
        }

        return $collection;
    }


}
