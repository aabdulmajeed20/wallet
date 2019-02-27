<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Mail;

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

    public function notify($data)
    {
        $receiver = $data['receiver_wallet']->user()->first()->email;
        $sender = $data['sender_wallet']->user()->first()->email;
        Mail::send('receiver_mail', $data, function($message) use($receiver) {
            $message->to($receiver)->subject('You have received a new transaction');
        });
        Mail::send('sender_mail', $data, function($message) use($sender) {
            $message->to($sender)->subject('Transaction details');
        });
    }
}
