<?php


class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Auth Controller
	|--------------------------------------------------------------------------
	|
	| Auth controller provide all the method of login/logout
	|
	*/

	/*
	 * Default login
	 * with: email, password
	 */
	public function login(){
		if (Auth::check())
		{
			echo "LOGIN";
		}else{
			echo "NO";
		}
	}

	/*
	 * Login with facebook
	 * Redirect to fb login page.
	 */
	public function loginFB(){
		Facebook\FacebookSession::setDefaultApplication(Config::get('facebook.appId'), Config::get('facebook.secret'));
		$redirectURL = route(Config::get('facebook.callback_route'));
		$loginHelper = new Facebook\FacebookRedirectLoginHelper($redirectURL);
		return Redirect::to($loginHelper->getLoginUrl(array('email')));
	}

	/*
	 * Login with facebook callback
	 * Get the callback data to login or create user.
	 */
	public function loginFBCallback(){
		$code = Input::get('code');
		if (strlen($code) == 0)
			return Redirect::route('error')->with('message', 'There was an error communicating with Facebook');

		Facebook\FacebookSession::setDefaultApplication(Config::get('facebook.appId'), Config::get('facebook.secret'));
		$redirectURL = route(Config::get('facebook.callback_route'));
		$helper = new Facebook\FacebookRedirectLoginHelper($redirectURL);
		$session = NULL;
		try {
			$session = $helper->getSessionFromRedirect();
		} catch(Facebook\FacebookRequestException $ex) {
			// When Facebook returns an error
		} catch(\Exception $ex) {
			// When validation fails or other local issues
		}
		if ($session) {
			// Logged in, get user data
			try {

				$userProfile = (new Facebook\FacebookRequest(
					$session, 'GET', '/me'
				))->execute()->getGraphObject(Facebook\GraphUser::className());

				$uid = $userProfile->getId();

				//Find the uid is in the database or not
				$facebookData = FacebookData::whereUid($uid)->first();

				if(empty($facebookData)){
					//New user to the system, create user!
					$user = new User();
					$user->name = $userProfile->getName();
					$user->nick_name = $userProfile->getName();
					$user->email = $userProfile->getProperty('email');
					$user->password = 'facebook';
					$user->save();

					$facebookData = new FacebookData;
					$facebookData->uid = $uid;
					$facebookData->user_id = $user->id;

					$facebookData->save();

					Auth::login($user);

				}else{
					//Exist user. go Login.
					$user = $facebookData->user;

					Auth::login($user);
				}

			} catch(Facebook\FacebookRequestException $e) {

				echo "Exception occured, code: " . $e->getCode();
				echo " with message: " . $e->getMessage();

			}
			echo "HI";
		}else{
			//Error no facebook session
			return Redirect::route('error')->with('message', 'There was an error communicating with Facebook');
			//echo "ERROR4";
		}
		echo '<a href="/login/FB">login</a>';
	}

	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}

}
