<?php

/**
 * Login Authentication System Controller
 * 
 * This is separate from the user controller because the user controller has 
 * controller-level authentication requirements enabled.
 *
 * @author awilliams
 */
class LoginController extends BaseController {
    public function getLogin()
    {
        return View::make('login');
    }
    
    public function postLogin()
    {
        if(Auth::attempt(array('username'=>Input::get('username'), 
                               'password'=>Input::get('password'))))
        {
            return Redirect::intended('keywords/manage');
        }
        else
        {
            return View::make('login')->with('message', 'Invalid Username/Password Combo');
        }
    }
    
    public function getLogout()
    {
        Auth::logout();
        return Redirect::action('LoginController@getLogin');
    }
    
}
