<?php
defined('BASEPATH') OR exit('No direct script access allowed');







$config['mailfooter'] = '

□terzwebCms<br />
<a href="https://">https://</a><br />

';


/*
|--------------------------------------------------------------------------
| reCAPTCHA keys
|--------------------------------------------------------------------------
| You can get a pair of keys by going here: https://www.google.com/recaptcha/admin
| And registering a new website, choose "reCAPTCHA V2"
|
| 'site_key'
|
|	The site key provided by Google
|
| 'secret_key'
|
|	The secret key provided by Google. Make sure you keep it SECRET.
|
|
*/
$config['re_keys'] = array(
	'site_key' => '',
	'secret_key'	=> ''
);

//BCCメール
$config['bccmail'] = '';