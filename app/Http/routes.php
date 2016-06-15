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
		 * Configuration: When user type every thing to url . 
		 * It'll redirect to homepage 
		 */
		// Route::any('{parameters?}',function(){
		// 	return view('templates.index');
		// })->where('parameters','(.*)');

		/**
		 *	Feed back 
		 */
		Route::get('/feedback',[
			'as'	=> 'guest.feedback',
			'uses'	=> 'FeedbackController@feedback'
		]);
		Route::post('/feedback',[
			'as'	=> 'guest.sendFeedback',
			'uses'	=> 'FeedbackController@sendFeedback'
		]);

		/**
		*	User management. 
		*/

		Route::group(['prefix'=>'administration'],function () {

			//List all administrator of site
			Route::get('/index',[
				'middleware'=>'auth',
				'as' 	=> 'administration.index',
				'uses'  =>  'UserController@index'
			]);

			//Add a administator
			Route::post('/add',[
				'middleware'=>'auth',
				'as'	=> 'administration.add',
				'uses' 	=> 'UserController@add'
			]);

			//Delete a administrator
			Route::get('/delete/{id}',[
				'middleware'=>'auth',
				'as'   => 'administation.destroy',
				'uses' => 'UserController@destroy'
			]);

			//Edit 
			Route::get('/edit/{id}' ,[
				'middleware'=>'auth',
				'as'  	=> 'administration.edit',
				'uses'  => 'UserController@edit',
			]);

			Route::post('/edit/{id}',[
				'middleware'=>'auth',
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

			//Change Password
			Route::get('/{id}/change-password',[
				'middleware'=>'auth',
				'as'    => 'administrator.changePassword.getView',
				'uses'  => 'UserController@viewChangePassword'
				]);

			Route::post('/{id}',[
				'middleware'=>'auth',
				'as'    => 'administrator.changePassword.postData',
				'uses'  => 'UserController@postChangePassword'
				]);

			Route::post('/{id}/check-old-password',[
				'middleware'=>'auth',
				'as'    => 'administrator.changePassword.check',
				'uses'  => 'UserController@checkOldPassword'
				]);		

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

			//Search employee with department
			Route::get('/search/{deparment}/{employee?}',[
				'as'	=> 'employees.getSearch',
				'uses' 	=> 'EmployeeController@getSearch'
			]);
			Route::post('/search',[
				'as' 	=> 'employees.postSearch',
				'uses'	=> 'EmployeeController@postSearch'
			]);

			//Search single employee
			Route::get('/search-ajax/result',[
				'as'	=> 'employees.search.ajax',
				'uses'	=> 'EmployeeController@searchAjax'
			]);
		});//End of route group employees
		
		/**
		 * Feedback process
		 */
		Route::group(['prefix' => 'manage/feedback','middleware'=> 'auth'],function(){
			
			Route::get('/list',[
				'as' 	=> 'feedback.listFeedBack',
				'uses'	=> 'FeedbackController@listFeedback'
			]);

			Route::post('/{id}/update',[
				'as'	=> 'feedback.update',
				'uses'	=> 'FeedbackController@update'
			]);
		});

	});
