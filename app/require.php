<?php
    //Require libraries from folder libraries
	require_once 'config/config.php';
    require_once 'helpers/common_function.php';
    require_once 'libraries/Router.php';



    define('NOT_VALID_REQUEST', 'Not valid request');
    //Instantiate core class
    $init = new Router();
