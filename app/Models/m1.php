<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'coefficient',
        'service_type_id'
    ];

    protected $table = 'm1';

    public $timestamps = false;
}
