<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Ewallet extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'ewallet';

    protected $fillable = [
        'iban', 'balance',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
