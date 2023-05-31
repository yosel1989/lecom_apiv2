<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $table = "sys_modules";

    protected $fillable = [
        'id',
        'name',
        'short_name',
    ];
}
