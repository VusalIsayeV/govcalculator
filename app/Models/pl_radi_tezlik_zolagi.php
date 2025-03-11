<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pl_radi_tezlik_zolagi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'coefficient'
    ];

    protected $table = 'pl_radi_tezlik_zolagi';

    public $timestamps = false;
}
