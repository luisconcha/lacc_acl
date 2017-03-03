<?php
Route::group( [ 'as' => 'laccuser.', 'middleware' => 'auth' ],
  function () {
      Route::group( [ 'prefix' => 'admin' ], function () {
          Route::resource( '/users', 'UserController', [ 'except' => [ 'show' ] ] );
          Route::get( 'users/{id}', [ 'as' => 'users.destroy', 'uses' => 'UserController@destroy' ] );
      } );
  } );
