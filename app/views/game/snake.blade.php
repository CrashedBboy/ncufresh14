@extends('game.layout')

@section('js_css')
	{{ HTML::style('css/game.css') }}
	{{ HTML::style('css/gameSnake.css') }}
	{{ HTML::script('js/game/gameSnake.js') }}
@stop

@section('game_content')
	<div id="cover">
		<div class="title">
			<img src="..\\images\\gameSnake\\title.jpg">
		</div>
		<div class="choice" align="center">
			<div class="Difficult">
				<div id="difficulty1"> <img src="..\\images\\gameSnake\\d1.jpg"> </div>
				<div id="difficulty2"> <img src="..\\images\\gameSnake\\d2.jpg"> </div>
				<div id="difficulty3"> <img src="..\\images\\gameSnake\\d3.jpg"> </div>
			</div>
			<div class="Mode">
				<div id="mode1"> <img src="..\\images\\gameSnake\\m1.jpg"> </div>
				<div id="mode2"> <img src="..\\images\\gameSnake\\m2.jpg"> </div>	
				<div id="mode3"> <img src="..\\images\\gameSnake\\m3.jpg"> </div>
			</div>
		</div>
		<div id="start">
			<img src="..\\images\\gameSnake\\start.jpg">
		</div>
	</div>

	<div id="content">
		<div id="snakeContent">
			<div id="snakehead">
				<img src="..\images\gameSnake\head.jpg" width="30px" height="23px">
			</div>
		</div>
	</div>


@stop