@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form">
                        <h2>Register</h2>
                      <form class="row" method="POST" action="{{ route('register') }}">
                        @csrf
                         <div class="col-md-12">
                            <input class="form-control" type="text" name="name" required placeholder="Name">
                         </div>
                          <div class="col-md-12">
                            <input class="form-control" type="email" name="email" required placeholder="Email">
                          </div>
                          <div class="col-md-12">
                            <input class="form-control" type="password" name="password" required placeholder="Password">
                          </div>
                          <div class="col-md-12">
                             <input class="form-control" type="password" name="password_confirmation" required placeholder="Confirm Password">
                          </div>
                          <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Register</button>
                          </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

