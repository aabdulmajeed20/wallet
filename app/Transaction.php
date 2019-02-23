<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Transaction extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'transaction';
    
    protected $fillable = [
        'receiver_iban', 'purpose', 'amount', 'created_at'
    ];

    public function ewallet()
    {
        return $this->belongsTo('App\Ewallet');
    }
}
