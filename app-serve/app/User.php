<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Category;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'rol', 'status', 'avatar', 'birthdate', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'photo_url',
        'age',
        'total_point',
        'my_category'
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return asset(Storage::url('images/avatars/' . $this->avatar));
    }

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getAgeAttribute()
    {
        $birthdate = new Carbon($this->birthdate);
        return $birthdate->age;
    }

    public function getMyCategoryAttribute()
    {
        $age = $this->age;
        $categories = Category::Where("config", "LIKE", "%$age%")->get();

        foreach ($categories as $key => $category) {

            $porciones = explode(",", $categories[0]->config);

            foreach ($porciones as $key => $porcion) {
                if ($porcion == $age) {
                    return $category->name;
                }
            }

        }

        //explode("," $categories[0]->config);

        return 'Libre';
    }

    public function getTotalPointAttribute()
    {

        $p = 0;

        foreach ($this->points as $key => $point) {
            $p += $point->point;
        }

        return $p;
    }

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    public function isUser()
    {
        return $this->rol === 'user';
    }

    public function histories(){
        return $this->hasMany(History::class);
    }

    public function points(){
        return $this->hasMany(Point::class);
    }
}
