<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_type_id',
        'coefficient'
    ];

    protected $table = 'user_group';

    public $timestamps = false;
}
