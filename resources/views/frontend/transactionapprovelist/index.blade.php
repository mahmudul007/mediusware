@extends('frontend.layouts.app')
@section('content')
    <div class="container">
      

        <div class="row justify-content-center">
            <h3>All your aprrove list  are here</h3>
           
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
                        <th scope="col">Action</th> 
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
                            
                            @if ($item->status!='approved')<td>
                                <!-- Button to trigger the modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approveModal{{$item->id}}">
                                    Approve/Decline
                                </button>
                            
                                <!-- Modal -->
                               
                                <div class="modal fade" id="approveModal{{$item->id}}" tabindex="-1" aria-labelledby="approveModalLabel{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel{{$item->id}}">Approve or Decline Submission</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex">
                                              
                                                <form action="{{ route('updateTransactionStatus', ['transactionId' => $item->id, 'status' => 'approve']) }}" method="post">
                                                    @csrf
                                                    
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                                
                                              
                                                <form action="{{ route('updateTransactionStatus', ['transactionId' => $item->id, 'status' => 'decline']) }}" method="post">
                                                    @csrf
                                                  
                                                    <button type="submit" class="btn btn-danger">Decline</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                              
                               
                                
                            </td>
                            @else
                            <td>
                                <p>Deposit approved</p>
                            </td>
                            @endif
                         
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
