<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreStatus extends Model
{
    use HasFactory;

    public $table = 'store_status';
    public $primaryKey = 'id_store_status';

    public $attributes = [
        'store_status',
        'message'
    ];

    public $timestamps = false;
}
