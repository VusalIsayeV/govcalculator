<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class b3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_type_id',
        'coefficient'
    ];

    protected $table = 'b3';

    public $timestamps = false;
}
