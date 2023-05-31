<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class GpsModel extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "gps_models";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'number_input',
        'number_output',
        'deleted'
    ];

    protected $casts = [
        'deleted'      => 'integer',
        'number_input' => 'integer',
        'number_output'=> 'integer'
    ];
}
