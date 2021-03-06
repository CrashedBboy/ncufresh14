@extends('layouts.layout')

@section('js_css')
	{{ HTML::style('css/video.min.css') }}
	{{ HTML::script('js/video.min.js') }}
	{{ HTML::script('js/videoKonami.js') }}
@stop

@section('content')

<div id="frame">
	<div id="videoFrame"></div>
	<div id="videoChoose"></div>
	<div id="introMid"></div>
	<div id="introTop"></div>
	<div id="introTop2"></div>

	<div id="main">
		<iframe id="frame-target" width="750" height="500" src="//www.youtube.com/embed/{{ $video->video_address }}" frameborder="0" allowfullscreen></iframe>
	</div>

	<div id="video_name" style ="width:900px;height:100px;font-size:32px;"><font color="gray">{{$video ->video_name}}</font></div>
	<button id="like" type="button"  style = "background-color: transparent; border: 0;"><div id="like_img"></div><div id="c_huan"><font color='gray'>喜歡</font></div></button>
	<button id="love" type="button"  style = "background-color: transparent; border: 0;"><div id="love_img"></div><div id="chau_c_huan"><font color='gray'>超喜歡</font></div></button>
	<button id="message" style="width:100px;height:30px;background-color: transparent; border: 0;"><div id="pinktriangle"></div></button>

	<!-- 彈出視窗 -->

	<div id="rating"></div>
	<div id="rating2"></div>
	<div id="rating_number1" style="text-align:center ; font-size:27px">{{$getLike}}</div>  <!--rating nuber，先暫訂-->
	<div id="rating_number2" style="text-align:center ; font-size:27px">{{$getLove}}</div>
	<div id="div1" type="submit"  style=" display:none;">

		{{ Form::open(array('route' => 'video.message','id'=>'videoPost')) }}
		{{ Form::textarea('video_text','',array('maxlength'=>400,'id'=>'textarea' )) }}
		{{ Form::submit('送出',array('id'=>'submit')) }}
		{{ Form::close() }}
	</div>

	<div id = "intro">{{nl2br($video->video_introduction)}}</div> <!--video introduction-->
	<button id="pinewave" type="button"  style = "background-color: transparent; border: 0;"></button>


</div> <!--frame div-->
<font id = "shh" color="white">shh...</font>
@foreach( $messages as $message)
<div id="frame2">
	<div id="user_message">
	<div id="messageBGwhite"></div>
	<div id="messageBG"></div>
	<div id="messageBG2"></div>
	<a href="{{ route('user.id', array('id' => $message ->user->id)) }}"><img src="{{ route('personface',array('id' => $message->user_id )) }}" id="portrait"></a>
	<div id= "div_message" style="width:720px; height:170px;">{{ nl2br($message["video_text"]) }}</div>
	<div id ="div_name"><font color = "#7DB7A1">{{{ $message->user->name }}}</font></div>
	</div>
</div>

@endforeach
{{$messages->links();}} 
<div id ="frame3"></div>
@if($errors -> any())
	<script>{{"alert('".$errors -> first()."');"}}</script>
@endif
<iframe id="konami" style="display: none;"width="540" height="360" src="//www.youtube.com/embed/r7Kf6W4LBBk" frameborder="0" allowfullscreen></iframe>
@stop
