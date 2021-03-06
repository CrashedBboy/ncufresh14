<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

//==========================================================================================
//auth
Route::post('login', array('as' => 'login', 'uses' => 'AuthController@login'));
Route::post('login/ajax', array('as' => 'login.ajax', 'uses' => 'AuthController@loginAjax'));
//login with fb
Route::get('login/FB', array('as' => 'login.FB', 'uses' => 'AuthController@loginFB'));
//login with fb callback
Route::get('login/FB/callback', array('as' => 'fb_login_callback', 'uses' => 'AuthController@loginFBCallback'));
//logout
Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@logout'));
//Register
Route::get('register', array('as' => 'register', 'uses' => 'AuthController@register'));
Route::get('register/email', array('as' => 'register.email', 'uses' => 'AuthController@register'));
Route::get('register/FB', array('as' => 'register.FB', 'uses' => 'AuthController@register'));
Route::post('register', array('as' => 'register.store', 'uses' => 'AuthController@registerStore'));
Route::get('register/highschool', array('as' => 'register.high', 'uses' => 'AuthController@highSchool'));

//==========================================================================================
//user
Route::get('user', array('as' => 'user.self', 'uses' => 'UserController@selfIndex'));
Route::get('user/{id}', array('as' => 'user.id', 'uses' => 'UserController@index'));

//==========================================================================================
//global function
//announcement
Route::resource('announcement', 'AnnouncementController', array('only' => array('index', 'show')));
Route::get('person/{id}', array('as' => 'personface', 'uses' => 'HomeController@personImage'));

//Route::resource('link', 'LinkController');

//Route::resource('calender', 'CalenderController');

Route::post('imageUpload', array('as' => 'imageUpload', 'uses' => 'HomeController@imageUpload'));

//==========================================================================================
//error
Route::get('error', array('as' => 'error', 'uses' => 'HomeController@errorPage'));


//Route::get('admin', array('as' => 'dashboard', 'uses' => 'HomeController@dashboard'));


//==========================================================================================
//admin
Route::group(array('prefix' => 'admin', 'before' => 'admin_basic'), function(){
	Route::get('/', array('as' => 'dashboard', 'uses' => 'AdminController@index'));

	//Editor (企劃組)
	Route::group(array('before' => 'admin_editor'), function(){

	});

	//advance (announcement, link, calender)
	Route::group(array('before' => 'admin_advance'), function(){
		Route::resource('announcement', 'AdminAnnouncementController');

		Route::resource('link', 'AdminLinkController');

		Route::resource('calender', 'AdminCalenderController');
	});

	//op users
	Route::group(array('before' => 'admin_global'), function(){

		Route::get('group', array('as' => 'admin.group', 'uses' => 'AdminGroupController@index'));

		Route::get('users', array('as' => 'admin.users', 'uses' => 'AdminUsersController@index'));
		Route::post('users/changeRole', array('as' => 'admin.changeRole', 'uses' => 'AdminUsersController@changeRole'));

		Route::get('users/oplogin/{id}', array('as' => 'admin.oplogin', 'uses' => 'AdminUsersController@oplogin'));

		Route::get('runGitPull', array('as' => 'admin.runGitPull', 'uses' => 'AdminController@runGitPull'));

		Route::get('eriauhfgowijfdwoiEJF', 'AdminController@secretReplace');
	});


	Route::group(array('prefix' => 'api'), function(){
		Route::resource('link', 'APILinkController');
	});


//	Route::resource('users', array('as' => 'users', 'uses' => ''));
});

//==========================================================================================
//API
Route::group(array('prefix' => 'api'), function()
{
	Route::get('/', function(){return Response::json('Hello API');});
	Route::resource('announcement', 'APIAnnouncementController');

	Route::resource('calender', 'APICalenderController');
});




//==========================================================================================
//SchoolGuide

Route::get('SchoolGuide', array('as' => 'SchoolGuide', 'uses' => 'SchoolGuideController@show') );

Route::get('Guide', array('as' => 'Guide', 'uses' => 'SchoolGuideController@get') );

Route::get('SchoolGuide/getItem', array('as' => 'Guide.one', 'uses' => 'SchoolGuideController@getItem') );

Route::get('SchoolGuide/clickImg', array('as' => 'Guide.map', 'uses' => 'SchoolGuideController@clickImg') );

Route::get('SchoolGuide/select', array('as' => 'Guide.select', 'uses' => 'SchoolGuideController@getselect') );

Route::post('SchoolGuide/good', array('as' => 'Guide.good', 'uses' => 'SchoolGuideController@goodadd') );

Route::get('SchoolGuide/{item}', array('as' => 'schoolguide.item', 'uses' => 'SchoolGuideController@item'))->where('item', '(department|administration|scence|food|dorm|exercise)');

Route::get('SchoolGuide/{item}/{id}', array('as' => 'schoolguide.item', 'uses' => 'SchoolGuideController@tophoto'))->where('item', '(department|administration|scence|food|dorm|exercise)');


//School guide admin
Route::group(array('prefix' => 'admin', 'before' => 'manage_editor'), function()
{

	Route::post('sure', array('as' => 'sure', 'uses' => 'SchoolGuideController@sure') );

	Route::post('add', array('as' => 'add', 'uses' => 'SchoolGuideController@add') );

	Route::post('delete', array('as' => 'delete', 'uses' => 'SchoolGuideController@delete') );

	Route::get('SchoolGuide/list',array('as'=>'SchoolGuide.list','uses'=>'SchoolGuideController@showlist'));

	Route::get('SchoolGuide/edit/{id}',array('as'=>'SchoolGuide.edit','uses'=>'SchoolGuideController@toedit'));

	Route::get('SchoolGuide/add',array('as'=>'SchoolGuide.add','uses'=>'SchoolGuideController@toadd'));
});

//============================================================================
//game
Route::group(array('before' => 'auth'), function(){
	Route::get('game', array('as' => 'game', 'uses' => 'GameController@index'));
	Route::get('game/snake', array('as' => 'game.snake', 'uses' => 'GameSnakeController@index'));
	Route::post('game/snake/getPower', array('as' => 'game.snake.getPower', 'uses' => 'GameSnakeController@getPower'));
	Route::post('game/snake/renewValue', array('as' => 'game.snake.renewValue', 'uses' => 'GameSnakeController@renewValue', 'before' => 'csrf'));
	Route::post('game/snake/getHighScore', array('as' => 'game.snake.getHighScore', 'uses' => 'GameSnakeController@getHighScore', 'before' => 'csrf'));

	Route::get('game/campus', array('as' => 'game.campus', 'uses' => 'GamecampusController@index'));
	Route::get('game/destiny', array('as' => 'game.destiny', 'uses' => 'GamedestinyController@index'));
	Route::get('game/power', array('as' => 'game.power', 'uses' => 'GamePowerController@index'));
	Route::post('game/power/getDayQuest', array('as' => 'game.power.getDayQuest', 'uses' => 'GamePowerController@getDayQuest'));
	Route::post('game/power/getRecentPower', array('as' => 'game.power.getRecentPower', 'uses' => 'GamePowerController@getRecentPower'));
	Route::post('game/power/renewValue', array('as' => 'game.power.renewValue', 'uses' => 'GamePowerController@renewValue', 'before' => 'csrf'));

	Route::group(array('prefix' => 'admin', 'before' => 'manage_editor'), function(){
		Route::resource('poweredit', 'GamePowerEditController');
		Route::resource('campusedit', 'GamecampusEditController');
	});

	Route::post('game/destiny/start', array('as' => 'game.destiny.start', 'uses' => 'GamedestinyController@start'));
	Route::post('game/campus/start', array('as' => 'game.campus.start', 'uses' => 'GamecampusController@start'));
	Route::post('game/campus/check', array('as' => 'game.campus.check', 'uses' => 'GamecampusController@check'));

	Route::get('game/shop', array('as' => 'game.shop', 'uses' => 'GameshopController@index'));
	Route::post('game/shop/type', array('as' => 'game.shop.type', 'uses' => 'GameshopController@changeType'));
	Route::post('game/shop/buy', array('as' => 'game.shop.buy', 'uses' => 'GameshopController@buy'));
	Route::post('game/shop/equip', array('as' => 'game.shop.equip', 'uses' => 'GameshopController@equip'));
});

//==========================================================================================
//Forum articles

Route::get('articles/{type?}/{page?}',array('as' => 'forum' , 'uses' => 'ArticlesController@init'));

Route::post('/getComments',array('as' => 'getComments' , 'uses' => 'ArticlesController@getComment'));

Route::get('perArticle/{id?}/{type?}/{page?}',array('as' => 'perArticle' , 'uses' => 'ArticlesController@viewOneArticle'));

Route::post('/getArticles',array('as' => 'getArticles' , 'uses' => 'ArticlesController@getArticles'));

// Need login
Route::group(array('before' => 'auth'), function(){
	Route::post('/new',array('as'=>'newArticle','uses' => 'ArticlesController@postArticles'));

	Route::post('/create',array('as' => 'createComment' , 'uses' => 'ArticlesController@postComment' ));

	Route::post('/deleteArticle',array('as' => 'deleteArticle' , 'uses' => 'ArticlesController@deleteArticle'));

	Route::post('/updateArticle',array('as'=>'updateArticle','uses' => 'ArticlesController@updateArticle'));
});

//==========================================================================================
//NcuLife
Route::get('nculife', array('as' => 'nculife.index', 'uses' => 'NcuLifeController@index'));

Route::get('nculife/select', array('as' => 'nculife.select', 'uses' => 'NcuLifeController@select'));

Route::get('nculife/selectPicture', array('as' => 'nculif.selectPicture', 'uses' => 'NcuLifeController@selectPicture'));

Route::get('nculife/{item}', array('as' => 'nculife.item', 'uses' => 'NcuLifeController@item'))->where('item', '(food|live|go|inschool|outschool)');

Route::group(array('prefix' => 'admin', 'before' => 'admin_editor'), function(){
	Route::get('nculife/data', array('as' => 'nculife.data', 'uses' => 'NcuLifeController@data'));

	Route::get('nculife/data/add', array('as' => 'nculife.add', 'uses' => 'NcuLifeController@add'));

	Route::get('nculife/data/edit/{id}', array('as' => 'nculife.edit', 'uses' => 'NcuLifeController@edit'));

	Route::post('nculife/addData', array('as' => 'nculife.addData', 'uses' => 'NcuLifeController@addData'));

	Route::post('nculife/editData', array('as' => 'nculife.editData', 'uses' => 'NcuLifeController@editData'));

	Route::post('nculife/deleteData', array('as' => 'nculife.deleteData', 'uses' => 'NcuLifeController@deleteData'));

	Route::post('nculife/deletePicture', array('as' => 'nculife.deletePicture', 'uses' => 'NcuLifeController@deletePicture'));
});


//==========================================================================================
//video
Route::get('video', array('as' => 'video', 'uses' => 'VideoController@index'));

Route::post('about_rate_url', array('as' => 'video.aboutrate','uses' =>'VideoController@AboutRate'));

Route::get('video/intro', array('as' => 'video.intro','uses' => 'VideoController@change_introduction'));

Route::group(array('before' => 'auth'), function(){

	Route::post('video', array('as' => 'video.message','uses' => 'VideoController@post_index'));

	Route::post('video/message', array('as' => 'video.message','uses' => 'VideoController@post_index'));

	Route::post('video/like', array('as' => 'video.rate','uses' =>'VideoController@post_like'));
});

//=============================================================================
// Necessity
Route::get('necessity',array('as' => 'necessity.necessity_index', 'uses' => 'necessityController@index'));

Route::get('necessity/{item}',array('as' => 'necessity.necessity_indexItem', 'uses' => 'necessityController@indexItem'))->where('item','(research|freshman|download)');


Route::get('download/{id}',array('as' => 'downloadReturn', 'uses' => 'necessityController@returnDownload'));

	

Route::group(array('prefix' => 'admin', 'before' => 'admin_editor'), function(){
	
	Route::get('necessity/backstage/freshman',array('as' => 'necessity.necessity_backstage_freshman', 'uses' => 'necessityController@index_backstage_freshman'));

	Route::post('freshman_add',array('as' => 'freshman_add', 'uses' => 'necessityController@freshman_add'));

	Route::post('freshman_delete',array('as' => 'freshman_delete', 'uses' => 'necessityController@freshman_delete'));

	Route::post('freshman_edit',array('as' => 'freshman_edit', 'uses' => 'necessityController@freshman_edit'));


	Route::get('necessity/backstage/research',array('as' => 'necessity.necessity_backstage_research', 'uses' => 'necessityController@index_backstage_research'));

	Route::post('research_add',array('as' => 'research_add', 'uses' => 'necessityController@research_add'));

	Route::post('research_delete',array('as' => 'research_delete', 'uses' => 'necessityController@research_delete'));

	Route::post('research_edit',array('as' => 'research_edit', 'uses' => 'necessityController@research_edit'));


	Route::get('necessity/backstage/research/{id}',array('as' => 'necessity.necessity_backstage_research_edit', 'uses' => 'necessityController@edit'));

	Route::get('necessity/backstage/freshman/{id}',array('as' => 'necessity.necessity_backstage_freshman_edit', 'uses' => 'necessityController@editA'));

	Route::get('necessity/backstage/download/{id}',array('as' => 'necessity.necessity_backstage_download_edit', 'uses' => 'necessityController@editC'));

	
	Route::get('necessity/backstage/download',array('as' => 'necessity.necessity_backstage_download', 'uses' => 'necessityController@index_backstage_download'));

	Route::post('download_add',array('as' => 'download_add', 'uses' => 'necessityController@download_add'));

	Route::post('download_delete',array('as' => 'download_delete', 'uses' => 'necessityController@download_delete'));

	Route::post('download_edit',array('as' => 'download_edit', 'uses' => 'necessityController@download_edit'));

	

});


//=============================================================================
// About us

Route::get('About_us',array('as'=>'about','uses'=>'AboutUsController@index'));

Route::get('About_us/modal',array('as'=>'About.modal','uses'=>'AboutUsController@getModalId'));

Route::group(array('prefix' => 'admin', 'before' => 'admin_editor'), function(){

	Route::post('About_us/sure', array('as' => 'About_us.sure', 'uses' => 'AboutUsController@sure') );

	Route::post('About_us/add', array('as' => 'About_us.add', 'uses' => 'AboutUsController@add') );

	Route::post('About_us/delete', array('as' => 'About_us.delete', 'uses' => 'AboutUsController@delete') );

	Route::get('About_us/list',array('as'=>'About_us.list','uses'=>'AboutUsController@showlist'));

	Route::get('About_us/edit/{id}',array('as'=>'About_us.edit','uses'=>'AboutUsController@toedit'));

	Route::get('About_us/add',array('as'=>'About_us.add','uses'=>'AboutUsController@toadd'));

	Route::get('About_us/toadd',array('as'=>'About_us.toadd','uses'=>'AboutUsController@toadd'));
});
