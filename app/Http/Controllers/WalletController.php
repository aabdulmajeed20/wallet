<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\wallet;
use App\Ewallet;
use App\Notifications\InvoicePaid;
use App\User;
use Auth;
use Validator;

class WalletController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
        $data = Ewallet::all();
        $user = Auth::user();
        return view('home', ['data' => $data, 'user' => $user]);
    }

    // add the cbx to the user's wallet
    /** 
        * @return \Illuminate\Http\Response 
        */ 
    public function plusWallet(Request $request)
    {    
        $validator = Validator::make($request->all(), [ 
            'user_id' => 'required', 
            'cbx' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        
        $wallet = Ewallet::where('user_id', $input['user_id'])->first();
        $wallet->balance += $input['cbx'];
        $wallet->save();
        return response()->json("success", 200);
    }
}
