<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public $incrementing = true;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User');
    }

    public function messages(): HasMany
    {
        return $this->hasMany('App\Message');
    }
}
