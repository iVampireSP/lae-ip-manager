<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ip extends Model
{

    protected $table = 'ips';

    protected $fillable = [
        'ip',
        'pool_id',
        'mac',
        'hostname',
        'description',
        'position',
        'blocked',
        'netmask',
        'cidr',
        'module_id',
        'host_id'
    ];

    protected $with = [
        'pool'
    ];

    public function pool(): BelongsTo
    {
        return $this->belongsTo(Pool::class);
    }

    // ipv6
    public function getIpV6Attribute($value): ?string
    {
        return $value ? gmp_strval($value, 16) : null;
    }

    // where unused and not blocked
    public function scopeAvailable($query)
    {
        return $query->where('blocked', false)->where('host_id', null);
    }
}
