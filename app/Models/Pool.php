<?php

namespace App\Models;

use PhpIP\IPBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed|string $pool
 */
class Pool extends Model
{

    protected $fillable = [
        'pool',
        'netmask',
        'cidr',
        'type',
        'gateway',
        'nameservers',
        'description',
        'parent_id',
        'price',
        'region_id'
    ];


    protected $casts = [
        'nameservers' => 'array',
        'price' => 'decimal:2',
    ];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pool::class, 'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pool::class, 'parent_id');
    }

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function ips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ip::class);
    }

    public function max() {
        $block = IPBlock::create($this->pool);
        return $block->getNbAddresses();
    }
}
