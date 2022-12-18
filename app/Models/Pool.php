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
}
