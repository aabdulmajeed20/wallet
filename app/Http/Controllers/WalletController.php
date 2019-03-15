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

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $data = Ewallet::all();
        $user = Auth::user();
        return view('home', ['data' => $data, 'user' => $user]);
    }

}
