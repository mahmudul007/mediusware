@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>Home</h1>
                    
                    <p> make from when you login as admin </p>
                    <p> you can see all approval of desposit </p>
                    <p>in user mode you can deposit / withdraw/ see your deposit amount</p>
                    <p>username for admin : admin@gmail.com <br>
                    password : password
                    </p>
                    <p>username for user : louie.wuckert@example.org <br>
                    password : password
                    </p>

                    <h3> database i attached on 'database/sql_database' folder</h3>
                    <h6>you can also run it via migrating and seeding permissions and role</h6>
                    <p>if you seed then also create users</p>

                 
                    <div>
                        @auth

                        <a class="btn btn-success" href="{{ route('dashboard') }}">dashboard</a>
                      @endauth
                    </div>

                  
                </div>
            </div>

        </div>
    @endsection
