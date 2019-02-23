<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wallet;
use App\Ewallet;
use App\Notifications\InvoicePaid;
use App\User;
use Auth;

class WalletController extends Controller
{
    public function index() {
        $data = Ewallet::all();
        $user = Auth::user();
        return view('home', ['data' => $data, 'user' => $user]);
    }

    public function add() {
        $wallet = Ewallet::first()->delete();
        return $wallet;
    }

    public function notify()
    {
    $user = User::first()->notify(new InvoicePaid);
    $data = wallet::all();
    return view('welcome', ['data' => $data]);
    }
}
