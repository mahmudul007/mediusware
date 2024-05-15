@extends('frontend.layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
              

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Request to Withdraw amount') }}</div>

                    <div class="card-body">
                        <form action="{{ route('withdraw') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div
                                class="form-group
                                {{ $errors->has('amount') ? 'has-error' : '' }}">
                                <label for="amount">ENTER YOUR Withdrwal AMOUNT</label>
                                <input type="number" id="amount" name="amount" class="form-control"
                                    placeholder="Enter amount" value="{{ old('amount') }}">
                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                            </div>
                           



                            <input class="btn btn-success" type="submit">


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
