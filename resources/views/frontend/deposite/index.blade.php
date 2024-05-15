@extends('frontend.layouts.app')
@section('content')
    <div class="container">
      

        <div class="row justify-content-center">
            <h3>All your transactions are here</h3>
            <h1>CURRENT BALANCE : {{$current_balance??0}} </h1>
            <div class="text-end">
                <a class="btn btn-danger" href="{{ route('dashboard') }}">Go back</a>
            </div>

            <hr class="text-warning">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Transaction type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Fee</th>
                        <th scope="col">Time</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>
                                @if($item->transaction_type == 0)
                                 <p class="text-warning"> Deposit</p>  
                                @elseif($item->transaction_type == 1)
                                 <p class="text-danger"> Withdrawal</p>  
                                @endif
                            </td>
                            
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->fee }}</td>
                            <td>{{ $item->created_at }}</td>
                         
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
