@extends('frontend.layout')

@section('title', isset($title) ? $title : 'Welcome')

@section('body-content')
	@parent
	<div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </div>
@endsection