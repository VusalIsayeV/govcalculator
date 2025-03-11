<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'coefficient',
        'service_type_id'
    ];

    protected $table = 'm3';

    public $timestamps = false;
}
