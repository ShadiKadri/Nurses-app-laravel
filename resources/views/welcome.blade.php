@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <img class="justify-content-center" src="images/logo.jpg">
        </div>
        <div class="row mb-4 justify-content-center">
            <div class="col-md-8">
                <h1>Book your appointment today!</h1>
                <h4>Use these crediential to test the app:</h4>
                <p>Admin--email: admin@gmail.com, password: password</p>
                <p>Nurse--email: nurse@gmail.com, password: password</p>
                @guest
                    <div class="mt-5">
                        <a href="{{ url('/login') }}"><button class="btn btn-success">Login</button></a>
                    </div>
                @endguest
            </div>
        </div>
    </div>

@endsection
