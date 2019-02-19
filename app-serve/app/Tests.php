<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'history_id', 'questions', 'second_question',
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
        'questions_obj',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getQuestionsObjAttribute()
    {
        return json_decode($this->questions);
    }

    public function points(){
        return $this->hasMany(Point::class);
    }

}
