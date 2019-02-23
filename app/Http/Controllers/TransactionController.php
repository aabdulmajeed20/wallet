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
        $wallet = Ewallet::where('iban', $transaction->receiver_iban)->get()->first();
        $transaction = $wallet->transaction()->save($transaction);
        return redirect('transaction')->with('success', 'transaction has been successfully added');
    }

    //PostController.php

    public function index()
    {

        $wallet = Ewallet::where('user_id', Auth::user()->id)->get();
        $transactions = Transaction::where('sender_iban', $wallet->first()->iban)->get();
        return view('transactionindex', ['transactions' => $transactions, 'wallet' => $wallet]);
    }

    public function invoice()
    {
        return view('invoice');
    }

}
