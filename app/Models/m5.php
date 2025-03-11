<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m5 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'coefficient',
        'service_type_id',
        'm5_min',
        'm5_max'
    ];

    protected $table = 'm5';

    public $timestamps = false;
}
