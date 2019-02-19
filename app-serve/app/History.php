<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'sub_title', 'description', 'content', 'image', 'video', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function letter_soup()
    {
        return $this->hasOne(LetterSoup::class);
    }

    public function memores()
    {
        return $this->hasMany(Memory::class);
    }

    public function test()
    {
        return $this->hasOne(Tests::class);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'image_url',
        'video_url',
        'created',
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

    public function getCreatedAttribute()
    {
        return Carbon::now()->diffForHumans($this->created_at, false);
    }

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getVideoUrlAttribute()
    {
        return ($this->video)? asset(Storage::url($this->video)): '';
    }

    public function scopeSearch($query, $search)
    {

        $var = $query->orWhere("title", "LIKE", "%$search%")
                    ->orWhere("sub_title", "LIKE", "%$search%")
                    ->orWhere("description", "LIKE", "%$search%");

        return $var;
    }

}
