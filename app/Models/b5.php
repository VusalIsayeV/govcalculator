<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class b5 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'coefficient',
        'service_type_id'
    ];

    protected $table = 'b5';

    public $timestamps = false;
}
