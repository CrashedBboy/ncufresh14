<?php

class APICalenderController extends APIController {

	//resource
	public function index(){
		$calenders = Calender::get();
		return Response::json($calenders->toArray());
	}

	public function create(){
		// no need!
		//return View::make('announcement.create');
	}

	public function store(){

	}

	public function show($id){
		$calender = Calender::find($id);
		//TODO 檢查存不存在
		return Response::json($calender->toArray());

	}

	public function edit($id){
		// no need
//		$announcement = Announcement::find($id);
//		//TODO 檢查存不存在
//		$announcement->addViewer();
//		return View::make('announcement.edit', array('announcement' => $announcement));
	}

	public function update($id){
//		$announcement = Announcement::find($id);
//		$rules = array(
//			'title' => 'required|max:30',
//			'content' => 'required',
//			'pinned' => 'required',
//		);
//
//		$validator = Validator::make(Input::all(), $rules);
//		if($validator->fails()){
//			return Response::json($validator);
//		}else{
//			//success! save announcement to database~~
//			$announcement->title = Input::get('title');
//			$announcement->content = Input::get('content');
//			$announcement->pinned = Input::get('pinned');
//			$announcement->save();
//
//			return Response::json($announcement->id);
//		}
	}

	public function destroy($id){
//		Announcement::destroy($id);
//		return Response::json('what?');
	}


}
