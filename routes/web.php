<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('', 'UserController@index');
        $router->get('indexByUri', 'UserController@indexByUri');

        $router->get('{id}/address', 'UserController@showUserWithAddress');
        $router->get('{id}/address/posts', 'UserController@showUserWithAddressAndPosts');
       
       
        $router->get('{id}', 'UserController@show');
        $router->delete('{id}', 'UserController@destroy');
        
        $router->put('{id}',  [
            'middleware' => 'password',
            'uses' => 'UserController@update'
        ]);
        
        $router->patch('{id}',  [
            'middleware' => 'password',
            'uses' => 'UserController@update'
        ]);

        $router->post('',  [
            'middleware' => 'password',
            'uses' => 'UserController@store'
        ]);
    });

    $router->group(['prefix' => 'post'], function () use ($router) {
        $router->get('', 'PostController@index');
        $router->get('{id}', 'PostController@show');
        $router->get('{id}/tags', 'PostController@showPostWithTags');
        

        $router->put('{id}', 'PostController@update');
        $router->patch('{id}', 'PostController@update');
        $router->delete('{id}', 'PostController@destroy');
        $router->post('',  'PostController@store');
    });

    $router->group(['prefix' => 'tag'], function () use ($router) {
        $router->get('', 'TagController@index');
        $router->get('{id}', 'TagController@show');
        $router->put('{id}', 'TagController@update');
        $router->patch('{id}', 'TagController@update');
        $router->delete('{id}', 'TagController@destroy');
        $router->post('', 'TagController@store');
    });
});

$router->get('/key', function () {
    $hash = base64_encode(\Illuminate\Support\Str::random(32));
    return substr($hash, 0, 32);
});
