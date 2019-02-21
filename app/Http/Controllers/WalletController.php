<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wallet;
use App\Ewallet;
use App\Notifications\InvoicePaid;
use App\User;

class WalletController extends Controller
{
    public function index() {
        $data = Ewallet::all();
        return view('home', ['data' => $data]);
    }

    public function add() {
        $wallet = Ewallet::first()->delete();
        return $wallet;
    }
}
