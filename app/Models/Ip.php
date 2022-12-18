<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpIP\IP as PhpIPIP;

class Ip extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'pool_id',
        'mac',
        'hostname',
        'description',
        'price',
        'position',
        'blocked',
        'netmask',
        'cidr'
    ];

    // casts of price
    protected $casts = [
        'price' => 'decimal:2',

    ];


    public function pool()
    {
        return $this->belongsTo(Pool::class);
    }

    // ipv6
    public function getIpV6Attribute($value)
    {
        return $value ? gmp_strval($value, 16) : null;
    }
}
