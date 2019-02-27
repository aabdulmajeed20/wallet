
<!-- history.blade.php -->
@extends('layouts.app')
@section('content')
  <div class="container">
    <h2> History</h2>
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br/>
     @endif
      <ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">Home</a>
          </li>
          <li><a href="#receiver" data-toggle="tab">Received</a>
          </li>
          <li><a href="#sender" data-toggle="tab">Sent</a>
          </li>
      </ul>
      
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Receiver Name</th>
                  <th>Sender IBAN</th>
                  <th>purpose</th>
                  <th>amount</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($transactions as $transaction)
                
                <tr>
                  <td>{{$transaction->ewallet()->first()->user()->first()->name}}</td>
                  <td>{{$transaction->sender_iban}}</td>
                  <td>{{$transaction->purpose}}</td>
                  <td>{{$transaction->amount}}</td>
                  <td>{{$transaction->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="receiver">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Sender Name</th>
                    <th>amount</th>
                    <th>Date</th>
                    <th>Details</th>
                  </tr>
                </thead>
                    <tbody>
                      @foreach($transactions as $transaction)
                      @if($transaction->receiver_iban == $wallet->first()->iban)
                      <tr>
                        <td>{{$transaction->sender_name}}</td>
                        <td>{{$transaction->amount}}</td>
                        <td>{{$transaction->created_at}}</td>
                        <td> <button><a href=" {{route('details', ['transaction_id' => $transaction->id])}} ">Details</a></button> </td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
              </table>
        </div>

        <div class="tab-pane fade" id="sender">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                            <th>Receiver Name</th>
                            <th>amount</th>
                            <th>Date</th>
                            <th>Details</th>
                      </tr>
                    </thead>
                        <tbody>
                          @foreach($transactions as $transaction)
                          @if($transaction->sender_iban == $wallet->first()->iban)
                          <tr>
                                <td>{{$transaction->ewallet()->first()->user()->first()->name}}</td>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$transaction->created_at}}</td>
                                <td> <button><a href=" {{route('details', ['transaction_id' => $transaction->id])}} ">Details</a></button></td>
                          </tr>
                          @endif
                          @endforeach
                        </tbody>
                  </table>
            </div>
      </div>
  </div>
  
  @endsection



