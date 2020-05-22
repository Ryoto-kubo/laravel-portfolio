<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Post extends Model
{
    protected $fillable = [
        'title',
        'team_name',
        'image',
        'activity_place',
        'activity_time',
        'description',
        'prefecture_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Comment');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo('App\Prefecture');
    }
}
