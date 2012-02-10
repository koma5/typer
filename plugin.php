<?php
/*
Plugin Name: typer
Plugin URI: http://5th.li/typer_
Description: this plugin will ask the visitor to type in the URL by himself, if the requested URL is trailed by the character _
Version: 0.1
Author: @koma5
Author URI: http://5th.ch/
*/



//yourls_add_action('pre_redirect', 'askToType');
yourls_add_filter('site_url', 'askToType');

function askToType($args) 
{
    $url = $args[0];
    $code = $args[1];
    
    $lastChar = substr($url, 0, strlen($url)-1);
    
    if ($lastChar == '_')
    {
        die();
    
    
    }
    
    
    //echo $url . $code;
    //die();
}

?>