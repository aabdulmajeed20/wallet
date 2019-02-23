@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><h3>Balance</h3></div>
                            <div class="card-body">
                                <h2>{{$user->ewallet()->first()->balance}}</h2>
                            </div>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row extend-row">
                                <a href="{{route('transfer')}}" class="btn btn-success full-button"><h3>Make Transfer</h3></a>
                            </div>
                            <div class="row extend-row">
                                <a href="{{route('history')}}" class="btn btn-primary full-button"><h3>Show History</h3></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
