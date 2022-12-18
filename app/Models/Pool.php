<?php

namespace App\Models;

use PhpIP\IPBlock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pool extends Model
{
    use HasFactory;

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
    ];


    protected $casts = [
        'nameservers' => 'array',
        'price' => 'decimal:2',
    ];

    public function parent()
    {
        return $this->belongsTo(Pool::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Pool::class, 'parent_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function ips()
    {
        return $this->hasMany(Ip::class);
    }

    public function max() {
        $block = IPBlock::create($this->pool);
        return $block->getNbAddresses();
    }
}
