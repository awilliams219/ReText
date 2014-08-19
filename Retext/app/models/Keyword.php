<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Keyword Class
 *
 * Database table model for keyword/url relationships
 * 
 * @author awilliams
 * 
 */
class Keyword extends Eloquent {
    
    protected $fillable = array('keyword', 'url');
}
