<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id','category_id','amount', 'state'
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


    public function scopeState($query, $state)

    {
        if($state)

        return $query->where('state', 'LIKE', "%$state%");

    }

    public function scopeCategory($query, $category)

    {
        if($category)

        return $query->where('category_id', 'LIKE', "%$category%");

    }

    public function scopeDate($query, $date)

    {
        if($date)

        return $query->where('created_at', 'LIKE', "%$date%");

    }


}
