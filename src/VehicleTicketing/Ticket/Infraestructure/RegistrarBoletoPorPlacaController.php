<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\Ticket\Application\RegistrarBoletoPorPlacaUseCase;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class RegistrarBoletoPorPlacaController
{

    /**
     * @var EloquentTicketRepository
     */
    private $repository;

    public function __construct( EloquentTicketRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {

        $idBoleto         = Uuid::uuid4();
        $idVehiculo    = $request->input('idVehiculo');
        $idRuta    = $request->input('idRuta');
        $latitud          = $request->input('latitud');
        $longitud          = $request->input('longitud');
        //$fecha          = new \DateTime( $request->input('fecha') );
        $fecha          = new \DateTime();
        $monto          = $request->input('monto');
        $numeroBoleto          = $request->input('numeroBoleto');
        $dni          = $request->input('documentoIdentidad');
        $fechaReserva          = $request->input('fechaReserva');

        $createTicketCase = new RegistrarBoletoPorPlacaUseCase( $this->repository );
        $createTicketCase->__invoke(
            new Id($idBoleto,false,'El id del boleto no tiene el formato adecuado'),
            new Id($idVehiculo,false,'El id del vehiculo no tiene el formato adecuado'),
            new Id($idRuta,false,'El id de la ruta no tiene el formato adecuado'),
            new Numeric((float)$latitud ),
            new Numeric((float)$longitud ),
            new DateTimeFormat($fecha->format('Y-m-d H:i:s')),
            new Numeric((float)$monto ),
            new Text($numeroBoleto ,false, 50,'El formato del numero boleto excede los 50 digitos'),
            new Text($dni ,false, 25,'El formato del dni boleto excede los 25 digitos'),
            new DateOnlyFormat($fechaReserva, true,'La fecha de reserva no tiene el formato adecuado')
        );

    }
}
