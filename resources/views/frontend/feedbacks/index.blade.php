@extends('frontend.layout')

@section('title', isset($title) ? $title : 'Welcome')

@section('body-content')
	@parent
	<div class="container">
		<div class="pull-right">
			<div class="btn-group" role="group" aria-label="...">
				<a href="{{route('feedbacks.create')}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus"></span> New feedback</a>
				{{-- <button type="button" class="btn btn-info btn-sm">Middle</button>
				<button type="button" class="btn btn-info btn-sm">Right</button> --}}
			</div>
		</div>
	</div>
	<div class="container">
		<table class="table table-hover table-condensed">
			<caption>All public feedbacks</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Title</th>
					<th width="30%">Probabilities</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($feedbacks as $feedback)
				<tr>
					<td>{{$feedback->id}}</td>
					<td>{{$feedback->name}}</td>
					<td>
						<a href="{{ route('feedbacks.show', $feedback->id) }}">{{$feedback->title}}</a>
					</td>
					<td>
						<div class="progress">
							@if( count($feedback->probabilities) > 0 )
							@foreach ($feedback->probabilities as $probability)
								<?php
									$percentage = $probability['probability']*100;
								?>
								<div class="progress-bar progress-bar-{{$probability['classification']}}" style="width: {{$percentage}}%">
									{{number_format($percentage, 2)}}%
								</div>
							@endforeach
							@endif
						</div>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('body-append')
@parent
<script>
	jQuery(document).ready(function($) {
		$('.progress-bar-neutral').addClass('progress-bar-warning');
		$('.progress-bar-positive').addClass('progress-bar-success');
		$('.progress-bar-negative').addClass('progress-bar-danger');
	});
</script>
@endsection