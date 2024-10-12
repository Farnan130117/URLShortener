@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="contact">
        <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <div class="contact-form">
                <h2>Login</h2>
            <form class="row"  method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-md-12">
                <input class="form-control" type="email" name="email" required placeholder="Email">
                </div>
                <div class="col-md-12">
                <input class="form-control" type="password" name="password" required placeholder="Password">
                </div>
                <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            </div>
        </div>
    </div>
        </div>
    </section>
@endsection


