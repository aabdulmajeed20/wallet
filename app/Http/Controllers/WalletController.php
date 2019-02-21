<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wallet;

class WalletController extends Controller
{
    public function index() {
        $data = wallet::all();
        return view('welcome', ['data' => $data]);
    }

    public function add() {
        $wallet = new wallet();
        $wallet->name = "Hello";
        $wallet->save();
    }
}