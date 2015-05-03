<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/



ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));


App::missing(function($e)
{
    $url = Request::fullUrl();
    Log::warning("404 for URL: $url");
    return Response::make('404 not found', 404);
});

App::error(function(PDOException $e)
{
    Log::error($e);
    $code = $e->getCode();
//var_dump($e,$cod);
    //return $code;
        switch ($code) {
        case 23000:
            return 'Database error! ' .'Code :' . $e->getCode().' Message : Integrity constant violation';

        case '42S22':
            return 'Database error! ' .'Code :' . $e->getCode().' Message : Unknown column';

        case 404:
            return $code;

        case 500:
            return $code;

    }

});

App::error(function(Exception $exception,$code) {

    if($code==404)
    {
        $Newcode = 404;
    }
    else
    {
        $Newcode = $exception->getCode();
    }
     $code = $exception->getCode();
    if($Newcode!=0) {
        switch ($Newcode) {
            case 23000:
                return 'Database error! ' . ' Code :' . $exception->getCode() . ' Message : Integrity constraint violation';

            case '42S22':
                return 'Database error! ' . 'Code :' . $exception->getCode() . ' Message : Unknown column';

            case 404:
                return 'Error ' . 'Code :' . $Newcode . ' Message : Page not found';

            case 500:
                return $code;

        }
    }
    else{
        // var_dump($exception);
//    echo '<pre>';
    echo 'MESSAGE :: ';
        print_r($exception->getMessage());
    echo '<br> CODE ::';
    print_r($exception->getCode());
      //  $code = $exception->getCode();
//    //print_r($code);
//    echo '<br> FILE NAME ::';
//    print_r($exception->getFile());
//
//    echo '<br> LINE NUMBER ::';
//    print_r($exception->getLine());

    }
     die();// if you want than only
});

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
