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
        $receiver_wallet = Ewallet::where('iban', $request->get('receiver_iban'))->get()->first();
        // Check if the wallet exist
        if($receiver_wallet !== null)
        {
            if($request->get('amount') <= 0)
            {
                return redirect('createTransfer')->with('failed', 'The amount should be greater than 0!');
            }

            // Check if the user try to transfer to himself
            if($request->get('receiver_iban') === Auth::user()->ewallet()->first()->iban)
            {
                return redirect('createTransfer')->with('failed', "You can't transfer to yourself");
            }

            // Create the transaction
            $transaction = new Transaction();
            $transaction->receiver_iban = $request->get('receiver_iban');
            $transaction->purpose = $request->get('purpose'); 
            $transaction->sender_iban = Auth::user()->ewallet()->first()->iban;
            $transaction->sender_name = Auth::user()->name;
            $transaction->amount = $request->get('amount');
        }
        else
        {
            return redirect('createTransfer')->with('failed', 'The IBAN you entered is not found!');
        }        

        $sender_wallet = Ewallet::where('iban', $transaction->sender_iban)->get()->first();

        // Check if the user has the amount of transaction
        if($sender_wallet->balance < $transaction->amount + 0.01) 
        {
            return redirect('createTransfer')->with('failed', 'Your Balance is less than the amount!');           
        }
        $receiver_wallet->balance += floatval($transaction->amount);
        $sender_wallet->balance -= floatval($transaction->amount) + 0.01;

        // Data will be related with the messages
        $data = ['receiver_wallet' => $receiver_wallet, 'sender_wallet' => $sender_wallet, 'transaction' => $transaction];

        // Send notifications to the sender and receiver
        // $transaction->notify($data);

        $transaction = $receiver_wallet->transaction()->save($transaction);
        $receiver_wallet->save();
        $sender_wallet->save();
        return redirect('transaction')->with('success', 'transaction has been successfully added');
    }

    // Show the transactions history related to the user
    public function index()
    {
        $wallet = Ewallet::where('user_id', Auth::user()->id)->get();
        $transactions = Transaction::where('sender_iban', $wallet->first()->iban)->orWhere('receiver_iban', $wallet->first()->iban)->get();
        return view('history', ['transactions' => $transactions, 'wallet' => $wallet]);
    }

    public function details($transaction_id)
    {
        $transaction = Transaction::where('id', $transaction_id)->first();
        return view('invoice', ['$transaction' => $transaction]);
    }

}
