@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Welcome {{ Auth::user()->name }}</p>
                    <p>Email {{ Auth::user()->email }}</p>
                    <p>Your Address:</p>
                    <p>{{Auth::user()->customer->address}}</p>
                    <p>Phone: {{ Auth::user()->customer->phone }}</p>
                    You are logged in as a user!
                    <br />

                    
                    <a class="btn btn-primary"href="{{ route('user.books.index') }}">View Books </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
