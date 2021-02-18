<?php
ini_set('display_errors', 1);
require "../../vendor/autoload.php";
$cookies = new \OOP\Cookies($_COOKIE);

$session = \OOP\Session::getInstance();
$session->start();
$session->setSession($_SESSION);


$request = new \OOP\Request($_GET, $_POST, $_SERVER, $cookies, $session);

var_dump($request->get('index'));

$key = 'index';
$value = "Hello World!";
var_dump($request->query($key, $default = null));
var_dump($request->post($key, $default = null));
var_dump($request->get($key, $default = null));
print("<pre>".print_r($request->all($only = []),true)."</pre>");
print("<pre>".print_r($request->all($only = [$key]),true)."</pre>");
var_dump($request->has($key));
print("<pre>".print_r($request->ip(),true)."</pre>");
print("<pre>".print_r($request->userAgent(),true)."</pre>");
print("<pre>".print_r($request->cookies,true)."</pre>");
print("<pre>".print_r($request->session,true)."</pre>");


echo "----------------------------------------------------------Cookies---------------------------------------------------" . '<br>';
print("<pre>".print_r($cookies->set($key, $value),true)."</pre>");
var_dump($cookies->get($key));
var_dump($cookies->has($key));
print("<pre>".print_r($cookies->all(),true)."</pre>");
var_dump($cookies->remove($key));


echo "----------------------------------------------------------Session---------------------------------------------------" . '<br>';
print("<pre>".print_r($session->all(),true)."</pre>");

print("<pre>".print_r($session->set($key, $value),true)."</pre>");
print("<pre>".print_r($session->set('key', 'value'),true)."</pre>");
var_dump($session->all($only = [$key]));
var_dump($session->get($key, $default = null));
var_dump($session->has($key));
print("<pre>".print_r($session->remove($key),true)."</pre>");
print("<pre>".print_r($session->all(),true)."</pre>");
var_dump($session->clear());
?>

