<?php

namespace App\Http\Resources\V2\BoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class BoletoInterprovincialReporteTotalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Map Domain User model values
        return [
            'idVehiculo'            => $this->getIdVehiculo()->value(),
            'placa'       => $this->getPlaca()->value(),
            'total'       => $this->getTotal()->value(),
            'totalBoletos'       => $this->getTotalBoletos()->value(),
        ];

    }
}
