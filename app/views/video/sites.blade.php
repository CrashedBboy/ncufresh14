@extends('layouts.layout')

@section('js_css')
	{{ HTML::style('css/video.css') }}
	{{ HTML::script('js/video.js') }}
@stop

@section('content')


<div id="frame">
<div id="main">
	<iframe width="560" height="315" src="//www.youtube.com/embed/mzX0rhF8buo" frameborder="0" allowfullscreen></iframe>
</div>
<img src="images\youtube縮圖\紀念.jpg" id="attached1" class="ath1">
<img src="images\youtube縮圖\夜空中最亮的星.jpg" id="attached2" class="ath2">
<img src="images\youtube縮圖\山丘.jpg" id="attached3" class="ath3">
<img src="images\youtube縮圖\李白.jpg" id="attached4" class="ath4">

<!---->
<div id="video_name" style ="width:900px;height:100px;font-size:80px;">影片名稱</div>
<button id="like" type="button" style="width:100px;height:30px;"><img src="圖片網址"></button>
<button id="love" type="button" style="width:100px;height:30px;"><img src="圖片網址"></button>
<button id="message" style="width:100px;height:30px;">留言</button>
<div id="div1" type="submit"  style="width:900px; height:150px; display:none;">
	{{ Form::open(array('route' => 'video.message')) }}
	{{ Form::textarea('video_text') }}
	{{ Form::submit('送出') }}
	{{ Form::close() }}
</div>
<!-- 彈出視窗 -->
@foreach( $messages as $message)
	<div id= "div_message" style="width:450px; height:150px;">{{$message["video_text"]}}</div>
@endforeach
</div>
@stop