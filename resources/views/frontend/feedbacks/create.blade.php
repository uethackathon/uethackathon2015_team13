@extends('frontend.layout')

@section('title', isset($title) ? $title : 'Welcome')

@section('body-content')
	@parent
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				Create a feedback
			</div>
			<div class="panel-body">
				{!! Form::open(['url' => route('feedbacks.store'), 'role'  => 'form', 'files' => true, 'class' => 'form-horizontal row-border']) !!}
				@include('frontend.feedbacks._form', ['action' => 'Create a new feedbacks'])       
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('body-append')
@parent
@endsection