<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Host extends \ivampiresp\Cocoa\Models\Host
{

    public function ip(): HasMany
    {
        return $this->hasMany(Ip::class);
    }
}
