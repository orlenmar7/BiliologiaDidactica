<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LetterSoup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'history_id', 'words',
    ];

    public function history()
    {
        return $this->belongsTo(History::class);
    }
}
