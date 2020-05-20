<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    public function prefectures(): HasMany
    {
      return $this->hasMany('App\Prefecture');
    }
}
