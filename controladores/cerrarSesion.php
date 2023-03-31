<?php 
session_start();
$url = 'http://'.$_SERVER['HTTP_HOST'].'/';

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
else
{
    session_destroy();
    session_start(); 
}

header('Location: '.$url.'');

