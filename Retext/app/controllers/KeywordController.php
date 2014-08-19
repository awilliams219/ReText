<?php

/**
 * Manages Keyword actions for ReText App
 *
 * @author awilliams
 */
class KeywordController extends BaseController{

    public function __construct()                                               
    {
        $this->beforeFilter('csrf', array('on' => 'post'));                         ## Use CSRF protection to prevent request forgeries.
        $this->beforeFilter('auth');
    }
    
    public function getManage()
    {
        $errors = (Session::has('errors') ? Session::get('errors') : array());
        
        $keywords = Keyword::orderBy('keyword','ASC')->get();
        return View::make('keywords', array('keywords' => $keywords, 'errors' => $errors ));
        
    }
    
    public function postAdd()
    {
        $errors = array();
        
        if (Auth::check())
        {
            if (Auth::user()->can_add)
            {

                $newKeyword = Input::get('keyword');
                $url = Input::get('url');

                $keyword = new Keyword;
                $keyword->keyword = strtolower($newKeyword);                                ## Make it case-insensitive.  Also strtolower the Twilio requests.
                $keyword->url = $url;                                           
                $keyword->save();

                return Redirect::action('KeywordController@getManage');
            }
            else 
            {
                $errors[] = "You are not authorized to add keywords.";
            }
        }
        else 
        {
            $errors[] = "You must be logged in to add keywords.";
        }
        
        return Redirect::action('KeywordController@getManage')->with('errors', $errors);
                
    }
    
    public function getAdd()                                                        ## Ignore events triggered by GET verb.  Just redirect them.
    {
        return Redirect::action('KeywordController@getManage');
    }
    
    public function getDelete()                                                     ## Ignore events triggered by GET verb.  Just redirect them.
    {
        return Redirect::action('KeywordController@getManage');
    }
    
    public function postDelete()
    { 
        $errors = array();
        
        if (Auth::check())
        {
            if (Auth::user()->can_delete)
            {

                $id = Input::get('id');

                $keyword = Keyword::find($id);
                $keyword->delete();                                                 ## Delete confirmation is handled by JavaScript.  At this point,
                                                                                    ## we're sure we want to delete.
                return Redirect::action('KeywordController@getManage');
            }
            else 
            {
                $errors[] = "You are not authorized to delete keywords.";
            }
        }
        else 
        {
            $errors[] = "You must be logged in to delete keywords.";
        }
        
        return Redirect::action('KeywordController@getManage')->with('errors', $errors);
    }
    
    public function getRootmenu()                                                   ## Placeholder for forward compatibility.  Does nothing now, 
    {                                                                               ## but we might want to put in a landing page later for some reason.
        return Redirect::action('KeywordController@getManage');
    }
    
    public function missingMethod($params = array())
    {
        return Redirect::action('KeywordController@getManage');
    }
            
}
