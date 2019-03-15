<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'bid';

    protected $fillable = [
        'amount', 'status', 'provider_id',
    ];

    public function provider()
    {
        return $this->belongsToMany('App\Provider');
    }
}
