<?php
require_once 'core/init.php';

$user = new User();
$user->logout();

Session::flash('home', '<div class=" alert alert-success" role="alert">You have logged out successfully!</div>');					  
Redirect::to('../index.php');