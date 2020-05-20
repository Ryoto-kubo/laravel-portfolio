<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prefecture extends Model
{
    public function users(): HasMany
    {
      return $this->hasMany('App\User');
    }

    public function region(): BelongsTo
    {
      return $this->belongsTo('App\Region');
    }
}
