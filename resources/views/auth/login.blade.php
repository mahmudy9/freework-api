@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">

                <div class="container">
            
                    @include('errors')
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <small><a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?
                                </a></small><br>
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
