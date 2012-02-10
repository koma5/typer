<?php
/*
Plugin Name: typer
Plugin URI: http://5th.li/typer_
Description: this plugin will ask the visitor to type in the URL by himself, if the requested URL is trailed by the character _
Version: 0.1
Author: @koma5
Author URI: http://5th.ch/
*/

define( 'TYPER_PAGE_CHAR', '_' );

// Kick in if the loader does not recognize a valid pattern
yourls_add_action( 'loader_failed', 'koma5_ask_to_type' );

function koma5_ask_to_type($args) 
{
        $request = $args[0];
        $pattern = yourls_make_regexp_pattern( yourls_get_shorturl_charset() );
        if( preg_match( "@^([$pattern]+)".TYPER_PAGE_CHAR."$@", $request, $matches ) ) {
                $keyword   = isset( $matches[1] ) ? $matches[1] : '';
                $keyword = yourls_sanitize_keyword( $keyword );
                if( yourls_is_shorturl( $keyword ) ) {
		        typer_show_page( $keyword );
		        die();
		}
        }
}

function typer_show_page($keyword)
{
       require_once( YOURLS_INC.'/functions-html.php' );

        $url   = yourls_get_keyword_longurl( $keyword );
        $base  = YOURLS_SITE;
        $char  = TYPER_PAGE_CHAR;
        
echo <<<HTML
<!DOCTYPE html>
<html>
  <head>
  
  <meta charset="utf-8">
  <title>type it!</title>
  
  <style type="text/css">
//global reset
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

body
{
	background-color: #BABABA;
	color: #4D4D4D;
	font-family: Verdana;

}

div#blubb
{
	position: fixed;
	top: 120px;
	left: 45px;
	width:500px;
	text-align: left;
}
  
  </style>
  
  <script type="text/javascript">

	//courtesy of BoogieJack.com
	function killCopy(e){
	return false
	}
	function reEnable(){
	return true
	}
	document.onselectstart=new Function ("return false")
	if (window.sidebar){
	document.onmousedown=killCopy
	document.onclick=reEnable
	}

	window.onload = function ()
	{
	window.history.replaceState(null, '.', '.');
	}

  
  </script>
  </head>
  
  <body>
  
    <div id="blubb">
	<h1>$base/$keyword</h1>
    
      <p>dear lazy visitor you landed on a page were you won't be redirected til you type the URL by yourself.
      And Bots won't be able to figure out... at least til now</p>
    
    </div>
    
  </body>
</html>
HTML;


}

?>
