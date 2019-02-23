<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

<<<<<<< HEAD

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
=======
class Transaction extends Eloquent
{
    public function user() {
        return $this->belongsTo('App\User');
>>>>>>> e2eb6ad81ee4111d4f650aa0250a87061299721d
    }
}
