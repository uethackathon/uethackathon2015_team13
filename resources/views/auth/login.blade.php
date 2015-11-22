@extends('frontend.layout')
@section('head-append')
    @parent
    <style type="text/css" media="screen">
        body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
        }

        .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
        margin-bottom: 10px;
        }
        .form-signin .checkbox {
        font-weight: normal;
        }
        .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
@endsection

@section('body-content')
    {!! Form::open(['url' => route('auth.login'), 'role'  => 'form', 'files' => true, 'class' => 'form-signin']) !!}
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="email" class="sr-only">Email address</label>
    <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox">
    <label>
    <input type="checkbox" name="remember" checked> Remember me
    </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>     
    {!! Form::close() !!}
@endsection