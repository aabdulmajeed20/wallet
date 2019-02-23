
<!-- transactionindex.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Receiver Name</th>
        <th>purpose</th>
        <th>amount</th>
        <th>Date</th>

      </tr>
    </thead>
    <tbody>
      
      @foreach($transactions as $transaction)
      <tr>
        <td>{{$transaction->ewallet()->first()->user()->first()->name}}</td>
        <td>{{$transaction->purpose}}</td>
        <td>{{$transaction->amount}}</td>
        <td>{{$transaction->created_at}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>