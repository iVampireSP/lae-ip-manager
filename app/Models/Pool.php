<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    protected $fillable = [
        'pool',
        'mask',
        'type',
        'gateway',
        'nameservers',
        'description',
        'parent_id',
        'price',
    ];


    protected $casts = [
        'nameservers' => 'array',
        'price' => 'decimal:2',
    ];
}
