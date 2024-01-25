<?php

namespace App\Http\Resources\V2\BoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class BolInterReporteTotalVehiculoFechaRangoResource extends JsonResource
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
            'fecha'            => $this->getFecha()->value(),
            'total'       => $this->getTotal()->value(),
        ];

    }
}
