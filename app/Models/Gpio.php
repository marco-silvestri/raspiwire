<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpio extends Model
{
    use HasFactory;

    protected $fillable = [
        'gpio_number',
        'state',
        'category',
        'name'
    ];
}
