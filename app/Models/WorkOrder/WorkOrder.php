<?php

namespace App\Models\WorkOrder;

use App\Models\Host;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'work_orders';
    protected $fillable = [
        'id',
        'title',
        'content',
        'host_id',
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];

    // 取消自动管理 timestamp
    // public $timestamps = false;


    // replies

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // if id exists
            if ($model->where('id', $model->id)->exists()) {
                return false;
            }
        });
    }

    // host

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    // on createing

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
