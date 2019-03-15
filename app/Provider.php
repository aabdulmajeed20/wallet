<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'provider';

    protected $fillable = [
        'name', 'picture',
    ];

    public function bid()
    {
        return $this->belongsToMany('App\Bid');
    }
}
