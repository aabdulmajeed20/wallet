@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Make your Transfer</h1> --}}

        {{Form::open(['route' => 'makeTransfer'])}}
            <div class="col-md-8">
                <div class="panel" style="background-color: white; padding: 30px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Enter Receiver Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="receiver_iban" placeholder="Enter Receiver IBAN">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="amount" placeholder="Enter the amount you will transfer">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="receiver_iban" placeholder="Enter The purpose of the transfer">
                        </div>
                    </div>
                </div>
                
            </div>
        {{Form::close()}}

    </div>
    
@endsection
