@extends('layouts.layout')

@section('css_js')
	{{ HTML::script('js/admin.js') }}

@stop

@section('content')
	<div id="admin-functions">
		@if(Auth::user()->can('manage_editor'))
			<div class="functions-block">
				<h3>編輯文案</h3>
				<a href="{{ route('SchoolGuide.list') }}"><button id="admin-link">校園導覽文章管理</button></a>

			</div>
		@endif
{{-- manage_link manage_announcement manage_calender --}}
		@if(Auth::user()->can('manage_link'))
		<div class="functions-block">
			<h3>編輯東西</h3>
			<a href="{{ route('admin.announcement.index') }}"><button id="admin-announcement">公告管理</button></a>
			<a href="{{ route('admin.link.index') }}"><button id="admin-link">友站連結管理</button></a>
			<a href="{{ route('admin.calender.index') }}"><button id="admin-link">行事曆管理</button></a>

		</div>
		@endif

		@if(Auth::user()->can('manage_users'))
		<div class="functions-block">
			<h3>危險管理區</h3>
			<a href="{{ route('admin.group') }}"><button id="admin-user">群組管理</button></a>
			<a href="{{ route('admin.users') }}"><button id="admin-user">會員管理</button></a>

		</div>
		@endif


	</div>

@stop