
<!-- transactionindex.blade.php -->
@extends('layouts.app')
@section('content')
    
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif

     <ul id="mytabs" class="nav nav-tabs">
        <li><a href="#received" data-toggle="tab">Received</a></li>
        <li><a href="#sent" data-toggle="tab">Sent</a></li>
     </ul>

     <div class="tab-content" id="tabs">

       <div class="tap-pane" id="received">  
    <table class="table table-striped">
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
      @if($transaction->receiver_iban == $wallet->first()->iban)
      <tr>
        <td>{{$transaction->ewallet()->first()->user()->first()->name}}</td>
        <td>{{$transaction->sender_iban}}</td>
        <td>{{$transaction->purpose}}</td>
        <td>{{$transaction->amount}}</td>
        <td>{{$transaction->created_at}}</td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>

<div class="tap-pane" id="sent">  
    <table class="table table-striped">
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
      @if($transaction->sender_iban == $wallet->first()->iban)
      <tr>
        <td>{{$transaction->ewallet()->first()->user()->first()->name}}</td>
        <td>{{$transaction->sender_iban}}</td>
        <td>{{$transaction->purpose}}</td>
        <td>{{$transaction->amount}}</td>
        <td>{{$transaction->created_at}}</td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>
</div>
{{$testHash}}
  </div>
  <script>
      $('#mytabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
      })
  </script>
  @endsection



