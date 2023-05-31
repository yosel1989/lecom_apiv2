<?php


namespace Src\VehicleTicketing\Report\Infraestructure\Repositories;

use DB;
use Src\ModelBase\Domain\ValueObjects\DateFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\Report\Domain\RankingTicketByFleet;
use Src\VehicleTicketing\Report\Domain\TicketsByVehicleRangeHour;
use Src\VehicleTicketing\Report\Domain\TotalAverageByFleetByHourRangeDate;
use Src\VehicleTicketing\Report\Domain\TotalAverageByFleetHour;
use Src\VehicleTicketing\Report\Domain\TotalByClientByDate;
use Src\VehicleTicketing\Report\Domain\TotalByDayByClient;
use Src\VehicleTicketing\Report\Domain\TotalByFleetRangeDate;
use Src\VehicleTicketing\Report\Domain\TotalByVehicle;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;
use Src\VehicleTicketing\Report\Domain\TotalByVehicleByTurn;
use Src\VehicleTicketing\Report\Domain\TotalByVehicleDates;
use Src\VehicleTicketing\Report\Domain\TotalByVehicleHour;

final class EloquentTicketReportRepository implements TicketReportRepositoryContract
{

    public function __construct()
    {

    }


    public function totalByVehicleByTurn(Id $idVehicle, DateTimeFormat $date): array
    {
        $_f = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorVehiculoPorVuelta('" . $idVehicle->value() . "', '" . $_f->format('Y-m-d') . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByVehicleByTurn(
                new Numeric((int)$item->Vuelta,false),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByVehicle(DateTimeFormat $start, DateTimeFormat $end, Id $idVehicle, Id $idUser): array
    {
        $_s = new \DateTime($start->value());
        $_e = new \DateTime($end->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorVehiculo('" . $idVehicle->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByVehicle(
                new Id($item->IdVehiculo,false,'El id del vehiculo no tiene el formato valido'),
                new Text($item->Padron,false, 10 ,'El padrón debe tener máximo 10 digitos'),
                new Text($item->Placa,false, 10 ,'La placa debe tener máximo 10 digitos'),
                new Text($item->Propietario,false, 200 ,'El nombre del propietario debe tener máximo 200 digitos'),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((int)$item->Dias,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalTopByFleet(DateTimeFormat $start, DateTimeFormat $end, Id $idClient, Id $idUser): array
    {
        $_s = new \DateTime($start->value());
        $_e = new \DateTime($end->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionTopPorFlota('" . $idClient->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByVehicle(
                new Id($item->IdVehiculo,false,'El id del vehiculo no tiene el formato valido'),
                new Text($item->Padron,false, 10 ,'El padrón debe tener máximo 10 digitos'),
                new Text($item->Placa,false, 10 ,'La placa debe tener máximo 10 digitos'),
                new Text($item->Propietario,false, 200 ,'El nombre del propietario debe tener máximo 200 digitos'),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((int)$item->Dias,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function rankingTicketTopByFleet(DateTimeFormat $start, DateTimeFormat $end, Id $idClient, Id $idUser): array
    {
        $_s = new \DateTime($start->value());
        $_e = new \DateTime($end->value());

        $collection = [];

        $query = "call Boletaje_RanckingPorTipoBoleto('" . $idClient->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new RankingTicketByFleet(
                new Numeric((float)$item->Precio,false),
                new Numeric((float)$item->RecaudoTotal,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByClientByDate(DateTimeFormat $date, Id $idClient, Id $idUser): array
    {
        $_s = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorDiaPorCliente('" . $idClient->value() . "', '" . $_s->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByClientByDate(
                new Id($item->IdVehiculo,false,'El id del vehiculo no tiene el formato valido'),
                new Text($item->Padron,false, 10 ,'El padrón debe tener máximo 10 digitos'),
                new Text($item->Placa,false, 10 ,'La placa debe tener máximo 10 digitos'),
                new Text($item->Propietario,false, 200 ,'El nombre del propietario debe tener máximo 200 digitos'),
                new Numeric((int)$item->NumeroVueltas,false),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function topTotalByClientByDate( DateTimeFormat $date, Id $IdClient, int $hourStart, int $hourEnd, Id $idUser): array
    {
        $_s = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionTopPorDiaPorCliente('" . $IdClient->value() . "', '" . $_s->format('Y-m-d') . "',".$hourStart.",".$hourEnd.", '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByClientByDate(
                new Id($item->IdVehiculo,false,'El id del vehiculo no tiene el formato valido'),
                new Text($item->Padron,false, 10 ,'El padrón debe tener máximo 10 digitos'),
                new Text($item->Placa,false, 10 ,'La placa debe tener máximo 10 digitos'),
                new Text($item->Propietario,false, 200 ,'El nombre del propietario debe tener máximo 200 digitos'),
                new Numeric((int)$item->NumeroVueltas,false),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByVehicleDates(DateTimeFormat $start, DateTimeFormat $end, Id $idVehicle): array
    {
        $_s = new \DateTime($start->value());
        $_e = new \DateTime($end->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorVehiculoFechas('" . $idVehicle->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByVehicleDates(
                new Id($item->IdVehiculo,false,'El id del vehiculo no tiene el formato valido'),
                new DateFormat($item->Fecha . ' 00:00:00',false, 'La fecha no tiene el formato correcto'),
                new Numeric((int)$item->NumeroVuelta,false),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByRangeDayByClient(DateTimeFormat $start, DateTimeFormat $end, Id $idClient, Id $idUser): array
    {
        $_s = new \DateTime($start->value());
        $_e = new \DateTime($end->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionTotalPorDia('" . $idClient->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByDayByClient(
                new DateTimeFormat($item->Fecha . ' 00:00:00',false, 'La fecha no tiene el formato correcto'),
                new Numeric((int)$item->NumeroBuses,false),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByVehicleHour(DateTimeFormat $date, Id $idVehicle): array
    {
        $_d = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorVehiculoFechaHora('" . $idVehicle->value() . "', '" . $_d->format('Y-m-d') . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByVehicleHour(
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->Monto,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByFleetRangeDate(Id $idClient, DateTimeFormat $start, DateTimeFormat $end, Id $idUser): array
    {
        $_s = new \DateTime($start->value());
        $_e = new \DateTime($end->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorFlotaRangoFecha('" . $idClient->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByFleetRangeDate(
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->Monto,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalByClientHour(DateTimeFormat $date, Id $idClient, Id $idUser): array
    {
        $_d = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionTotalFechaHora('" . $idClient->value() . "', '" . $_d->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalByVehicleHour(
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->Monto,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }


    public function totalAverageByClientHourUseByRange(Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $idUser): array
    {
        $_start = new \DateTime($dateStart->value());
        $_end = new \DateTime($dateEnd->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPromedioTotalFlotaFechaHora('" . $idClient->value() . "', '" . $_start->format('Y-m-d') . "', '" . $_end->format('Y-m-d') . "', '" . $idUser->value() . "')";
        $data = DB::select($query);

//        dd($data);

        foreach ( $data as $item ){

            $model = new TotalAverageByFleetByHourRangeDate(
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Text($item->Hora ,false, 10,'El formato de hora excede los 10 digitos'),
                new Numeric((float)$item->Monto,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalAverageTopByClientHourUseByRange(Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Numeric $hourStart, Numeric $hourEnd, Id $idUser): array
    {
        $_start = new \DateTime($dateStart->value());
        $_end = new \DateTime($dateEnd->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPromedioTopTotalFlotaFechaHora('" . $idClient->value() . "', '" . $_start->format('Y-m-d') . "', '" . $_end->format('Y-m-d') . "',".$hourStart->value().",".$hourEnd->value().", '" . $idUser->value() . "')";
        $data = DB::select($query);

        //        dd($data);

        foreach ( $data as $item ){

            $model = new TotalByClientByDate(
                new Id($item->IdVehiculo,false,'El id del vehiculo no tiene el formato valido'),
                new Text($item->Padron,false, 10 ,'El padrón debe tener máximo 10 digitos'),
                new Text($item->Placa,false, 10 ,'La placa debe tener máximo 10 digitos'),
                new Text($item->Propietario,false, 200 ,'El nombre del propietario debe tener máximo 200 digitos'),
                new Numeric((int)$item->NumeroVueltas,false),
                new Numeric((int)$item->NumeroBoletos,false),
                new Numeric((float)$item->MontoTotal,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function totalAverageByFleetHour(DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $idClient): array
    {
        $_s = new \DateTime($dateStart->value());
        $_e = new \DateTime($dateEnd->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionTotalPromedioFechaHora('" . $idClient->value() . "', '" . $_s->format('Y-m-d') . "', '" . $_e->format('Y-m-d') . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TotalAverageByFleetHour(
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->Monto,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function ticketsByVehicleRange(Id $idVehicle, DateTimeFormat $date, int $hourStart,  int $hourEnd): array
    {
        $_d = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorVehiculoRangoHoras('" . $idVehicle->value() . "', '" . $_d->format('Y-m-d') . "', ".$hourStart.",".$hourEnd.")";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TicketsByVehicleRangeHour(
                new Id($item->Id,false,'El id del ticket no tiene el formato valido'),
                new Numeric((int)$item->NumeroBoleto,false),
                new Numeric((int)$item->NumeroVuelta,false),
                new Numeric((float)$item->Latitud,false),
                new Numeric((float)$item->Longitud,false),
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function ticketsByClientVehicleRangeHour(Id $idClient, DateTimeFormat $date, int $hourStart,  int $hourEnd, Id $idUser): array
    {
        $_d = new \DateTime($date->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorClienteRangoHoras('" . $idClient->value() . "', '" . $_d->format('Y-m-d') . "', ".$hourStart.",".$hourEnd.", '" . $idUser->value() . "')";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TicketsByVehicleRangeHour(
                new Id($item->Id,false,'El id del ticket no tiene el formato valido'),
                new Numeric((int)$item->NumeroBoleto,false),
                new Numeric((int)$item->NumeroVuelta,false),
                new Numeric((float)$item->Latitud,false),
                new Numeric((float)$item->Longitud,false),
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

    public function ticketsByClientFleetVehicleRangeHour(Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, int $hourStart,  int $hourEnd): array
    {
        $_dS = new \DateTime($dateStart->value());
        $_dE = new \DateTime($dateEnd->value());

        $collection = [];

        $query = "call Boletaje_RecaudacionPorClientePorFlotaRangoHoras('" . $idClient->value() . "', '" . $_dS->format('Y-m-d') . "', '" . $_dE->format('Y-m-d') . "', ".$hourStart.",".$hourEnd.")";
        $data = DB::select($query);

        foreach ( $data as $item ){

            $model = new TicketsByVehicleRangeHour(
                new Id($item->Id,false,'El id del ticket no tiene el formato valido'),
                new Numeric((int)$item->NumeroBoleto,false),
                new Numeric((int)$item->NumeroVuelta,false),
                new Numeric((float)$item->Latitud,false),
                new Numeric((float)$item->Longitud,false),
                new DateTimeFormat($item->Fecha ,false, 'La fecha no tiene el formato correcto'),
                new Numeric((float)$item->TotalRecaudo,false)
            );

            $collection[] = $model;

            //}
        }

        return $collection;

    }

}
