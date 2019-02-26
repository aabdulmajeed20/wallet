<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Ewallet;
use Auth;

class TransactionController extends Controller
{
    //

    public function create()
    {
        return view('transaction');
    }

    public function store(Request $request)
    {
        $transaction = new Transaction();
        $transaction->receiver_iban = $request->get('receiver_name');
        $transaction->purpose = $request->get('purpose'); 
        $transaction->sender_iban = Auth::user()->ewallet()->first()->iban;
        $transaction->amount = $request->get('amount');


        $receiver_wallet = Ewallet::where('iban', $transaction->receiver_iban)->get()->first();
        $sender_wallet = Ewallet::where('iban', $transaction->sender_iban)->get()->first();
        $receiver_wallet->balance += floatval($transaction->amount);
        $sender_wallet->balance -= floatval($transaction->amount);

        $transaction = $receiver_wallet->transaction()->save($transaction);
        $receiver_wallet->save();
        $sender_wallet->save();
        return redirect('transaction')->with('success', 'transaction has been successfully added');
    }

    //PostController.php

    public function index()
    {

        $wallet = Ewallet::where('user_id', Auth::user()->id)->get();
        $transactions = Transaction::where('sender_iban', $wallet->first()->iban)->orWhere('receiver_iban', $wallet->first()->iban)->get();
        return view('transactionindex', ['transactions' => $transactions, 'wallet' => $wallet]);
    }

    public function invoice()
    {
        return view('invoice');
    }

}
