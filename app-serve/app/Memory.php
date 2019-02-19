<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Memory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'history_id', 'image',
    ];

    public function history()
    {
        return $this->belongsTo(History::class);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'image_url',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return asset(Storage::url($this->image));
    }
}
