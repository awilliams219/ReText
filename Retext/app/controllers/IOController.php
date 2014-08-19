<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IOController
 *
 * @author awilliams
 */
class IOController extends BaseController{
    
    public function smsReceiver()                                                  ## Written for Twilio TWimL api.  
    {                                                                              ##  Makes a POST request to the app, with the SMS message in the 
        if (! Input::has('Body'))                                                  ##  Body field.  We don't need any of the other fields for this
        {                                                                          ##  app.
            return Redirect::to('http://petsafe.net');
        }
        
        $messageBody = Input::get('Body');
        $keywords = Keyword::where('keyword', '=', $messageBody)->take(1)->get();  ## The column is marked 'unique' but it never hurts to be sure.
        
        try {                                                                      ## A Bit Messy, but it works.
            $keyword = $keywords[0];                                               ## Can't array_key_exists on an eloquent collection
            $responseText = $keyword->url;                                         ## So this is my workaround for the keyword-not-found case
        } catch (Exception $ex) {
            $responseText = "Sorry, that is not a known keyword.  Why not check out our store at http://store.petsafe.net";
        }
        
        $response = new Services_Twilio_Twiml();                                   ## Installed via Composer
        $response->sms($responseText);

        return $response;                                                          ## Twilio will take the XML response and automatically 
                                                                                   ## send it to the same user that sent us the text.
        
    }
    
}
