<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class b4 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'coefficient'
    ];

    protected $table = 'b4';

    public $timestamps = false;
}
