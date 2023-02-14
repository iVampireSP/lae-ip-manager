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
        'module_host_id',
        'host_id'
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

    // host
    public function host(): BelongsTo
    {
        return $this->belongsTo(Host::class);
    }
}
