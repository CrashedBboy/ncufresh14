@extends('game.layout')

@section('js_css')
	{{ HTML::style('css/game.min.css') }}
	{{ HTML::script('js/game/jQueryRotateCompressed.js') }}
	{{ HTML::script('js/game/game.min.js') }}
	{{ HTML::script('js/game/destiny.min.js') }}
@stop

@section('game_content')
	<div id="gameDestinyContainer">
		<div id="gameDestinyLeft">
			<div id="rotateFoot"></div>
			<div id="rotateTable"></div>
			<div id="rotatePointer"></div>
		</div>
		<div id="gameDestinyRight">
			<div id="startPage">
				<div class="destinyText">遊戲需求:</div>
				<div class="destinyText">消耗電池電量一格</div>
				<div id="destinyImage"></div>
				<div id="destinyStart" action="{{ URL::to('game/destiny/start') }}" endAction="{{ URL::to('game/destiny/end') }}"></div>
			</div>
			<div id="bounsPage">
				<div class="destinyText">恭喜你獲得</div>
				<div id="bonusBoxImage">
					<div id="bonusText">item</div>
				</div>
				<div id="destinyAgain"></div>
			</div>
		</div>
	</div>
@stop

