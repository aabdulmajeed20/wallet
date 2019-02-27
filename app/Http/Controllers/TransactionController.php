<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Ewallet;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;


class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('transaction');
    }

    public function store(Request $request)
    {
        // Create the transaction
        $transaction = new Transaction();
        $transaction->receiver_iban = $request->get('receiver_name');
        $transaction->purpose = $request->get('purpose'); 
        $transaction->sender_iban = Auth::user()->ewallet()->first()->iban;
        $transaction->amount = $request->get('amount');

        // Get sender and receiver wallets data
        $receiver_wallet = Ewallet::where('iban', $transaction->receiver_iban)->get()->first();
        $sender_wallet = Ewallet::where('iban', $transaction->sender_iban)->get()->first();

        if($sender_wallet->balance < $transaction->amount + 0.01) {
        return redirect('createTransfer')->with('failed', 'Your Balance is less than the amount!');            
        }
        $receiver_wallet->balance += floatval($transaction->amount);
        $sender_wallet->balance -= floatval($transaction->amount) + 0.01;

        // Data will be related with the messages
        $data = ['receiver_wallet' => $receiver_wallet, 'sender_wallet' => $sender_wallet, 'transaction' => $transaction];

        $transaction->notify($data);

        $transaction = $receiver_wallet->transaction()->save($transaction);
        $receiver_wallet->save();
        $sender_wallet->save();
        return redirect('transaction')->with('success', 'transaction has been successfully added');
    }

    public function index()
    {
        $wallet = Ewallet::where('user_id', Auth::user()->id)->get();
        $transactions = Transaction::where('sender_iban', $wallet->first()->iban)->orWhere('receiver_iban', $wallet->first()->iban)->get();
        return view('history', ['transactions' => $transactions, 'wallet' => $wallet]);
    }

    public function invoice()
    {
        return view('invoice');
    }

}
