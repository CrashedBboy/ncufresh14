@extends('layouts.layout')

@section('js_css')
	{{ HTML::style('css/index.css') }}
@stop

@section('content')
<div id="contentContainer" class="testR">
	<div id="contentLeft" class="testB">
		<div id="calender" class="testG">calender
		</div>
		<div id="links" class="testY">links
			@foreach($links as $link)
				<div>
					<a href="{{ $link->url }}">{{ $link->display_name }}</a>
				</div>
			@endforeach
		</div>
	</div>
	<div id="contentRight" class="testB">
		<div id="board" class="testG">board
		</div>
		<div id="forum" class="testY">forum
		</div>
		<div id="vedio" class="testR">vedio
		</div>
	</div>
</div>

@stop