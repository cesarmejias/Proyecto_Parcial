<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function category()

    {

        return $this->belongsTo(Category::class);

    }



    public function getCategoryNameAttribute()

    {

        return $this->category ? $this->category->name : null;

    }



    public function getUserNameAttribute()

    {

        return $this->user ? $this->user->name : null;

    }

}
