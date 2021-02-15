@extends('layouts.simple')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2>
                    Hello {{ $user['first_name'] }},
                </h2>
                We are glad you are here! Following are your account details: <br/>
                <h3>Name: </h3><p>{{ $user['first_name'] }} {{$user['last_name'] }}</p>
                <h3>Email: </h3><p>{{ $user['email'] }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

       
       

