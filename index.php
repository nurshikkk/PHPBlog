<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/common/function.php';
include_once 'modules/router/Route.php';
include_once 'modules/router/Router.php';


$router = new Router($_SERVER['REQUEST_URI']);

$router->get('/', 'MainController@mainPage');

$router->get('/login', 'AuthController@loginPage');

$router->post('/login', 'AuthController@loginAction');

$router->get('/register', 'AuthController@registerPage');

$router->post('/register', 'AuthController@registerAction');

$router->get('/article', 'ArticlesController@articlePage');

$router->get('/create_article', 'CreateAController@createAPage');

$router->post('/check_article', 'CheckAController@checkAction');

$router->post('/upload_article', 'UploadAController@uploadAction');

$router->post('/delete_article', 'DeleteAController@deleteAction');

$router->post('/comments', 'CommentsController@commentAction');

$router->get('/profile', 'ProfileController@profilePage');

$router->get('/popular', 'PopularController@popularPage');

$router->post('/rating', 'RatingController@rateAction');

$router->get('/favourite', 'FavouriteController@favouritePage');

$router->post('/create_favourite', 'CreateFController@createFAction');

$router->post('/delete_favourite', 'DeleteFController@deleteFAction');

$router->get('/edit_profile', 'EditController@editPage');

$router->post('/edit_profile', 'EditController@editAction');

$router->post('/change_pass', 'ChangePController@changePAction');

$router->get('/exit', 'ExitController@exitAction');

$router->get('/ban_list', 'BanLController@banPage');

$router->get('/ban', 'BanController@banAction');

$router->get('/unban', 'UnbanController@unbanAction');

$router->get('/articles_list', 'ArticlesLController@articlesLPage');

$router->post('/articles_list', 'ArticlesLController@articlesLAction');

$router->run();
