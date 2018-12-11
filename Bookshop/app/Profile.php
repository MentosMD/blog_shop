<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'firstname', 'lastname', 'age', 'user_id'
    ];
    public $timestamps = false;
    protected $table = "user_profile";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'user_id', 'user_id');
    }
}
