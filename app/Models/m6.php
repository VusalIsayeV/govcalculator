<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m6 extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type_id',
        'radio_tezlik_zolagi_id',
    ];

    protected $table = 'm6';

    public $timestamps = false;
}
