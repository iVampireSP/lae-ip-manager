<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Host extends \ivampiresp\Cocoa\Models\Host
{

    public function ip(): HasOne
    {
        return $this->hasOne(Ip::class);
    }
}
