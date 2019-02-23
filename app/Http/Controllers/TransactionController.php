<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Ewallet;

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
        // $transaction->sender_name = $request->get('sender_name');
        $transaction->purpose = $request->get('purpose');   
        $transaction->amount = $request->get('amount');    
        $wallet = Ewallet::where('iban', $transaction->receiver_iban)->get()->first();
        $transaction = $wallet->transaction()->save($transaction);
        $transaction->save();
        return redirect('transaction')->with('success', 'transaction has been successfully added');
    }

    //PostController.php

    public function index()
    {
        $transactions = Transaction::all();
        $wallet = Ewallet::where('iban', '6')->get();
        return view('transactionindex', ['transactions' => $transactions, 'wallet' => $wallet]);
    }

    public function invoice()
    {
        return view('invoice');
    }

}
