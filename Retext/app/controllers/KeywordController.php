<?php

/**
 * Manages Keyword actions for ReText App
 *
 * @author awilliams
 */
class KeywordController extends BaseController{

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        
    }
    
    public function getManage()
    {
        $keywords = Keyword::orderBy('keyword','ASC')->get();
        return View::make('keywords', array('keywords' => $keywords));
        
    }
    
    public function postAdd()
    {
        $newKeyword = Input::get('keyword');
        $url = Input::get('url');
        
        $keyword = new Keyword;
        $keyword->keyword = $newKeyword;
        $keyword->url = $url;
        $keyword->save();
        
        return Redirect::action('KeywordController@getManage');
    }
    
    public function getAdd()
    {
        return Redirect::action('KeywordController@getManage');
    }
    
    public function getDelete()
    {
        return Redirect::action('KeywordController@getManage');
    }
    
    public function postDelete()
    { 
        $id = Input::get('id');
        
        $keyword = Keyword::find($id);
        $keyword->delete();
        
        return Redirect::action('KeywordController@getManage');
    }
    
    public function getRootmenu()
    {
        return Redirect::action('KeywordController@getManage');
    }
    
    public function missingMethod($params = array())
    {
        return Redirect::action('KeywordController@getManage');
    }
            
}
