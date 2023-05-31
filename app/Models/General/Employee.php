<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;


/**
 * @mixin Model
 */
class Employee extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "employees";

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'address',
        'dni',
        'phone',
        'code',
        'photo',
        'deleted',
        'id_client',
        'id_category',
        'id_license',
        'id_seg_vial',
        'id_gtu',
        'id_psicology_exam'
    ];

    protected $hidden = [];

    protected $guarded = [];
}
