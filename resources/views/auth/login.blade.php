@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Login (Dummy)</button>
                    </form>
                    <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
