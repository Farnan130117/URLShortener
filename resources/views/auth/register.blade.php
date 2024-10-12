@extends('layouts.app')
@section('title', 'Register')
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
                              <input class="form-control" type="password" name="password" id="password" required minlength="8" placeholder="Password (Minimum length 8 character)">
                          </div>
                          <div class="col-md-12">
                              <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm Password" oninput="checkPasswordMatch()">
                              <small id="password-match-message" style="color: red; display: none;">Passwords do not match.</small>
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
    <script>
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const message = document.getElementById('password-match-message');

            if (password === confirmPassword) {
                message.style.display = 'none';
            } else {
                message.style.display = 'block';
            }
        }

        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
@endsection

