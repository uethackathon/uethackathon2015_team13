@extends('backend.layout')

@section('title', isset($title) ? $title : 'Welcome')

@section('body-content')
	@parent
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit a feedback
			</div>
			<div class="panel-body">
				{!! Form::model($feedback, ['method' => 'PATCH', 'url' => route('backend.feedbacks.update', $feedback->id), 'role'  => 'form', 'class' => 'form-horizontal row-border']) !!}
				@include('backend.feedbacks._form')       
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('body-append')
@parent
<script>
	jQuery(document).ready(function($) {
		$("[data-trigger='delete']").click(function(event) {
			event.preventDefault();
			if ( confirm("Are you sure?") ) {
				$.post('{{ route('backend.feedbacks.destroy', $feedback->id) }}', {_method: 'DELETE'}, function (data) {
					if ( data.id ) {
						window.location.replace("{{ route('backend.feedbacks.index') }}")
					}
				}, 'json');
			}
		});
	});
</script>
@endsection