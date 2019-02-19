<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'config'
    ];

    public function histories(){
        return $this->hasMany(History::class);
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
