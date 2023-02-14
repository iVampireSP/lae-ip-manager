<?php

namespace App\Models;

class Host extends \ivampiresp\Cocoa\Models\Host
{

    public function ip() {
        return $this->hasMany(Ip::class);
    }
}
