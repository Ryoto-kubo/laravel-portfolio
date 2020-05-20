<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User');
    }
}
