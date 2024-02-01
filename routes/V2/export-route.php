<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\Export')->group( function (){
    Route::get('export', 'ExportController');
});
