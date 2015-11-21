@extends('frontend.layout')

@section('title', isset($title) ? $title : 'Feedback')

@section('head-append')
	@parent
	<link href="/assets/frontend/css/blog.css" rel="stylesheet">
@endsection
@section('body-content')
	@parent
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 blog-main">
				<div class="blog-post">
					<div class="sidebar-module">
						<div class="progress">
							@foreach ($feedback->probabilities as $probability)
								<?php
									$percentage = $probability['probability']*100;
								?>
								<div class="progress-bar progress-bar-{{$probability['classification']}}" style="width: {{$percentage}}%">
									{{number_format($percentage, 2)}}%
								</div>
							@endforeach
						</div>
					</div>
					<h2 class="blog-post-title">{{$feedback->title}}</h2>
					<p class="blog-post-meta">{{$feedback->created_at->diffForHumans() }} by <a href="mailto:{{$feedback->email or ''}}">{{$feedback->name}}</a> <span class="badge badge-default">{{$feedback->status->name}}</span></p>
					<blockquote>
						<p>{!! nl2br($feedback->content) !!}</p>
					</blockquote>
				</div>
				<div class="sidebar-module">
					<h4>Comments</h4>
					<form action="{{route('comments.store')}}" method="POST" accept-charset="utf-8" class="clearfix">
						<div class="form-group">
							<textarea name="content" class="form-control" rows="3">{{old('content')}}</textarea>
						</div>
						<div class="form-group pull-right">
							{{ csrf_field() }}
							<input type="hidden" name="feedback_id" value="{{$feedback->id}}">
							<button type="submit" class="btn btn-primary btn-sm">Submit</button>
						</div>
					</form>
					<div class="comments">
						@foreach($feedback->commentsIsPublic as $comment)
						<div class="media">
							<div class="media-left">
								<a href="#">
								<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTEyYjhiZDY1ZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MTJiOGJkNjVlIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40NzY1NjI1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading">{{$comment->user->name}}</h4>
								{{$comment->content}}
								<div class="timestamp pull-right">
									<small>{{$comment->created_at->diffForHumans() }}</small>
								</div>
							</div>
						</div>
						@endforeach
					</div>
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
	});
</script>
@endsection