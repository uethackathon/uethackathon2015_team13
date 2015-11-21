@extends('frontend.layout')

@section('title', isset($title) ? $title : 'Welcome')

@section('body-content')
	@parent
	<div class="container">

      <div class="starter-template">
        <h1>Hello, there !</h1>
        <p class="lead">My name is Smɑːrt Fiːdbæk</p>
        <p class="lead">Feel free to leave your feedbacks here !</p>
        <p>
        	<a class="btn btn-success" href="{{route('feedbacks.create')}}" role="button">Create a feedback</a> or <a class="btn btn-info" href="{{route('feedbacks.index')}}" role="button">Read posted feedbacks</a>
        </p>
      </div>

    </div>
@endsection

@section('body-prepend')
	@parent
	<style>
		h1 {
			font-size: 5em;
		}
		p.lead {
			font-size: 2.5em;
		}
	</style>
@endsection