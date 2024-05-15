@extends('frontend.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                       
                        <a href="{{route('create.deposite')}}">
                            <button type="button" class="btn btn-primary"> Deposite money </button>
                        </a>
                        <a href="{{route('withdraw.create')}}">
                            <button type="button" class="btn btn-primary"> Withdrwal request of money </button>
                        </a>

                       
                        <a href="{{route('all.transaction')}}">
                            <button type="button" class="btn btn-primary"> All of My transactions and balance </button>
                        </a>
                        @can('transaction_approve')
                        <a href="{{route('all.viewAllPendingTransaction')}}">
                            <button type="button" class="btn btn-primary"> View all Pending transaction </button>
                        </a>
                        @endcan

                        <hr>
                        
                        @can('transaction_approve')
                        <a href="{{route('store.user')}}">
                            <button type="button" class="btn btn-primary"> User create </button>
                        </a>
                        @endcan
                     

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
