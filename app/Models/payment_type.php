<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key'
    ];

    protected $table = 'payment_type';

    public $timestamps = false;
}
