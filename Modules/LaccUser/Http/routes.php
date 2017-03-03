<?php
Route::group( [ 'as' => 'laccuser.', 'middleware' => 'auth' ],
  function () {
      Route::group( [ 'prefix' => 'admin' ], function () {
          Route::resource( '/users', 'UserController', [ 'except' => [ 'show' ] ] );
          Route::get( 'users/{id}', [ 'as' => 'users.destroy', 'uses' => 'UserController@destroy' ] );

          //Roles
          Route::resource( 'roles', 'Roles\RolesController', [ 'except' => [ 'show', 'destroy' ] ] );
          Route::get( 'roles-delete/{id}', [ 'as' => 'roles.destroy', 'uses' => 'Roles\RolesController@destroy' ] );
          
      } );
  } );
