<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

	

	/**
	*	Routes to controls site
	*/
	Route::group(['middleware' => 'web'], function () {
	    
	    /**
	    *	Authentication : login , logout, reset password
	    */
	    Route::auth();


	   /**
		*	Homepage
		*/
		Route::get('/', function () {
		    return view('templates.index');
		});


		/**
		*	User management. 
		*/

		Route::group(['prefix'=>'administration','middleware'=>'auth'],function () {

			//List all administrator of site
			Route::get('/index',[
				'as' 	=> 'administration.index',
				'uses'  =>  'UserController@index'
			]);

			//Add a administator
			Route::post('/add',[
				'as'	=> 'administration.add',
				'uses' 	=> 'UserController@add'
			]);

			//Delete a administrator
			Route::get('/delete/{id}',[
				'as'   => 'administation.destroy',
				'uses' => 'UserController@destroy'
			]);

			//Edit 
			Route::get('/edit/{id}' ,[
				'as'  	=> 'administration.edit',
				'uses'  => 'UserController@edit',
			]);

			Route::post('/edit/{id}',[
				'as' 	=> 'administation.update',
				'uses'  => 'UserController@update',
			]);

			//Confirmation route and change password
			Route::group(['prefix'=>'register'],function(){
				Route::get('/verify/{confirmation_code}',[
					'as'    => 'administration.getConfirm',
					'uses'  => 'UserController@getConfirm',
				]);
				Route::post('/verify/{confirmation_code}',[
					'as'    => 'administration.postConfirm',
					'uses'  => 'UserController@postConfirm'
				]);

			});			

		});//End of route administrations

		
		/**
		*	Departmenet management. 
		*/
		Route::group(['prefix'=>'departments'], function(){
			//list departments
			Route::get('/index',[
				'as' 	=> 'departments.index',
				'uses'  => 'DepartmentController@index'
			]);

			//add department
			Route::get('/add',[
				'as' 	=> 'departments.add',
				'uses'  => 'DepartmentController@add'
			]);

			Route::post('/add',[
				'as'    => 'departments.store',
				'uses'  => 'DepartmentController@store',
			]);

			//Edit department
			Route::get('/edit/{id}',[
				'as'    => 'departments.edit',
				'uses'  => 'DepartmentController@edit',
			]);

			//Delete department
			Route::get('/delete/{id}',[
				'as'    => 'departments.delete',
				'uses'  => 'DepartmentController@destroy',
			]);

		});//End of route group departments

		/**
		*	Employee management
		*/
		Route::group(['prefix'=> 'employees'] ,function (){
			//List all employees
			Route::get('/index/{department_slug?}',[
				'as' 	=> 'employees.index',
				'uses'  => 'EmployeeController@index'
			]);

			//Add an employee
			Route::get('/add',[
				'as' 	=> 'employees.add',
				'uses'  => 'EmployeeController@add'
			]);
			Route::post('/add',[
				'as' 	=> 'employees.store',
				'uses'  => 'EmployeeController@store'
			]);

			//Edit an employee
			Route::get('/edit/{id}',[
				'as' 	=> 'employees.edit',
				'uses' 	=> 'EmployeeController@edit'
			]);
			Route::post('/edit/{id}',[
				'as'    => 'employees.update',
				'uses' 	=> 'EmployeeController@update'
			]);

			//Delete an employe
			Route::get('/delete/{id}',[
				'as'	=> 'employees.delete',
				'uses' 	=> 'EmployeeController@delete'
			]);

			//View employee profile
			Route::get('/detail/{id}', [
				'as' 	=> 'employees.detail',
				'uses' 	=> 'EmployeeController@detail'
			]);

			//Search employee 
			Route::get('/search/{deparment}/{employee?}',[
				'as'	=> 'employees.getSearch',
				'uses' 	=> 'EmployeeController@getSearch'
			]);
			Route::post('/search',[
				'as' 	=> 'employees.postSearch',
				'uses'	=> 'EmployeeController@postSearch'
			]);
		});//End of route group employees

	});