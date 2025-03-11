<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'payment_type_id'
    ];

    protected $table = 'service_type';

    public $timestamps = false;
}
