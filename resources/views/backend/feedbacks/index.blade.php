@extends('backend.layout')

@section('title', isset($title) ? $title : 'Welcome')

@section('body-content')
	@parent
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="container">
					<table class="table table-hover table-condensed table-bordered table-striped">
						<caption>All feedbacks sorted by created time</caption>
						<thead>
							<tr>
								<th>#</th>
								<th width="27%">Title</th>
								<th style="text-align: center">Status</th>
								<th style="text-align: center">Visibility</th>
								<th>Name</th>
								<th>Email</th>
								<th>Probabilities</th>
								<th>Comments</th>						
							</tr>
						</thead>
						<tbody>
						@foreach ($feedbacks as $feedback)
							<tr>
								<td style="text-align: center">{{$feedback->id}}</td>
								<td>
									<a href="{{ route('backend.feedbacks.edit', $feedback->id) }}">{{$feedback->title}}</a>
								</td>
								<td style="text-align: center"> <span class="label label-{{$feedback->status ? $feedback->status->name : ''}}">{{$feedback->status ? $feedback->status->name : ''}}</span></td>
								<td style="text-align: center"> <span class="label label-{{$feedback->visibility ? $feedback->visibility->name : ''}}">{{$feedback->visibility ? $feedback->visibility->name : ''}}</span></td>
								<td >{{$feedback->name}}</td>
								<td >{{$feedback->email}}</td>
								<td>
									@if( count($feedback->probabilities) > 0 )
									@foreach ($feedback->probabilities as $probability)
										<?php
											$percentage = $probability['probability']*100;
										?>
										<div class="progress-bar progress-bar-{{$probability['classification']}}" style="width: {{$percentage}}%">
											{{number_format($percentage, 2)}}%
										</div>
									@endforeach
									@else
									The feedback has not been processed yet
									@endif
								</td>
							</tr>
							<tr>
								<a href="{{ route('backend.feedbacks.comments', $feedback->id) }}" class="btn btn-primary">
									{{ count($feedback->comments) }}
								</a>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
	    </div>
    </div>
@endsection

@section('body-append')
@parent
<script>
	jQuery(document).ready(function($) {
		$('.progress-bar-neutral').addClass('progress-bar-warning');
		$('.progress-bar-positive').addClass('progress-bar-success');
		$('.progress-bar-negative').addClass('progress-bar-danger');
		$('.label-public').addClass('label-info');
		$('.label-private').addClass('label-default');

		$('.label-open').addClass('label-danger');
		$('.label-onhold').addClass('label-warning');
		$('.label-closed').addClass('label-success');
	});
</script>
@endsection