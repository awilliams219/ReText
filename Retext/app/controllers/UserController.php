<?php
/**
 * Controller for user management functions
 *
 * @author awilliams
 */
class UserController extends BaseController{
    
    public function __construct()
    {
         $this->beforeFilter('csrf', array('on' => 'post'));                         ## Use CSRF protection to prevent request forgeries.
         $this->beforeFilter('auth');
    }
    
    public function getManage()
    {
        $errors = (Session::has('errors') ? Session::get('errors') : array());
        
        $users = User::orderBy('username','ASC')->get();
        return View::make('users', array('users' => $users, 'errors' => $errors));
    }
    
    public function getAdd()
    {
        return Redirect::action('UserController@getManage'); 
    }
    
    public function postAdd()
    {
        $errors = array();
        
        if (Auth::check())
        {
            if (Auth::user()->administrator)
            {
                if (Input::get('password') == Input::get('passwordConfirm'))
                {
                    $newUser = new User;
                    $newUser->username = Input::get('username');
                    $newUser->password = Hash::make(Input::get('password'));
                    $newUser->can_delete = Input::get('can_delete');
                    $newUser->can_add = Input::get('can_add');
                    $newUser->administrator = Input::get('admin');
                    $newUser->save();
                    
                    return Redirect::action('UserController@getManage');
                }
                else
                {
                    $errors[] = "Password and Confirm fields must match.";
                }
            }
            else
            {
                $errors[] = "You are not authorized to add users.";
            }
        }
        else
        {
            $errors[] = "You must be logged in to add users.";
        }
        
        return Redirect::action('UserController@getManage')->with('errors', $errors);
        
    }
    
    public function postDelete()
    {
        $errors = array();
        
        if (Auth::check())
        {
            if (Auth::user()->administrator)
            {
                $id = Input::get('id');

                $user = User::find($id);
                $user->delete();

                return Redirect::action('UserController@getManage');
            }
            else
            {
                $errors[] = "You are not authorized to delete users.";
            }
        }
        else
        {
            $errors[] = "You must be logged in to delete users.";
        }
        
        return Redirect::action('UserController@getManage')->with('errors', $errors);
    }
    
    public function getDelete()
    {
        return Redirect::action('UserController@getManage'); 
    }
    
    public function getRootmenu()
    {
        return Redirect::action('UserController@getManage');
    }
    
}
