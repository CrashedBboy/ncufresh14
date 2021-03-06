@extends('layouts.layout')

@section('js_css')
	{{ HTML::style('css/nculife/nculife_item.min.css') }}
	{{ HTML::script('js/nculife/nculife_item.min.js') }}
@stop

@section('content')
	<div id="all">
		<div id="left">
			<div id="left_top">
			</div>
			<div id="place">
			<?php $i=1 ?>
			@foreach ($nculifes as $nculife)
				<div class="place{{$i}} place" data-id="{{$i++}}" data-num="{{$nculife->id}}">
					{{$nculife->place}}
				</div>
			@endforeach
				<div style="height:18px;">
				</div>
			</div>
			<div id="left_bottom">
			</div>
		</div>
		<div id="right">
			<div id="introduction">
				<div id="introductionbox">
					<div id="introductionbox2">
						{{$nculifes[0]->introduction}}
					</div>
				</div>
			</div>
			<div id="picture">
				<div id="picture_select">
					<?php $i=1 ?>
				@foreach($pictures as $picture)
					<div id="select{{$i}}" class="select" data-id="{{$i++}}" data-num="{{$picture->pictureAdmin->id}}">
					</div>
				@endforeach
				</div>
				<div id="img">
					<img id="1" class="img" src="{{ asset( 'img/uploadImage/' .  $pictures[0]->pictureAdmin->file_name) }}">
				</div>
			</div>
			@if($nculifes[0]->local_id != 0)
				<div id="select">
					<div id="buttom" data-num="{{$nculifes[0]->id}}">
					</div>
				</div>
			@endif
		</div>
	</div>
@stop