<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use Validator;
use App\Department;
class DepartmentController extends Controller
{
    /**
    *	Function to get view list all departments
    *	@param
    **/
    public function index()
    {
    	$departments = Department::paginate('10');
    	return view('templates.Departments.index',compact('departments'));
    }

    /**
    *	Funtion to get view add department
    *	@param
    **/
    public function add() 
    {

    	return view('templates.Departments.add');

    }

    /**
	*	Funtion to store data to databaes
	*	@param
	**/
	public function store()
	{

		$validator = Validator::make(Request::all(),[
    		'name' 			=> 'required|max:30|unique:departments',
    		'office_phone'  => 'required|max:13',
    		'office_code'   => 'required|unique:departments',
    		'manager'		=> 'required',
            'address'       => 'required',
            'email_contact' => 'required'
    	],[
    		'name.required' 		=> 'Please enter name of department',
    		'name.max'				=> 'Name of department is too long',
    		'name.unique'			=> 'This department name was exist',
    		'office_phone.requied'  => 'Please enter department phone',
    		'office_phone.max' 		=> 'Department phone is too long',
    		'office_code.required'  => 'Please enter department address',
            'office_code.unique'    => 'Office code is exist',
    		'manager.required'  	=> 'Please enter department manager',
            'address.required'      => 'Please enter department address',
            'email_contact.required'      => 'Please enter department email to contact',
    	]);
    	if($validator->fails()) {
    		return back()->withInput()->withErrors($validator);
    	}

    	$name         = Request::get('name');
    	$office_phone = Request::get('office_phone');
    	$office_code  = Request::get('office_code');
    	$manager      = Request::get('manager');
        $address      = Request::get('address');
        $email_contact= Request::get('email_contact'); 
    	
    	Department::create([
    		'name' 		   => $name,
            'slug'         => \Illuminate\Support\Str::slug($name),
    		'office_phone' => $office_phone,
    		'office_code'  => $office_code,
    		'manager' 	   => $manager,
            'address'      => $address,
            'email_contact'=> $email_contact,
    	]);

    	return redirect()->route('departments.index')->with(['flash_level'=>'success', 'flash_message'=>'Success !!! Added Department']);
	}

	/**
	*	Funtion to handle ajax edit department. and save data changes to database
	*	@param : id : _id of department edition
	**/
	public function edit($id)
	{
		$validator = Validator::make(Request::all(),[
    		'name' 			=> 'required|max:30',
    		'office_phone'  => 'required|max:13',
    		'office_code'   => 'required',
    		'manager'		=> 'required'
    	],[
    		'name.required' 		=> 'Please enter name of department',
    		'name.max'				=> 'Name of department is too long',
    		'office_phone.requied'  => 'Please enter department phone',
    		'office_phone.max' 		=> 'Department phone is too long',
    		'office_code.required'  => 'Please enter department address',
    		'manager.required'  	=> 'Please enter department manager'
    	]);
    	if($validator->fails()) {
    		return back()->withInput()->withErrors($validator);
    	}

    	$department = Department::findOrFail($id);
    	$name = Request::get('name');
    	$office_phone = Request::get('office_phone');
    	$office_code = Request::get('office_code');
    	$manager = Request::get('manager');
    	$department->update([
    		'name' 		   => $name,
    		'office_phone' => $office_phone,
    		'office_code'  => $office_code,
    		'manager' 	   => $manager,
    	]);
    	$responses = array('id'=>$id, 'name'=> $name, 'office_phone' => $office_phone ,'office_code' => $office_code , 'manager'=> $manager);
    	return  json_encode($responses); 	
	}

	/**
	*	Function to handle ajax delete department
	*	@param : id : _id of department which want to delete
	**/
	public function destroy($id)
	{
        if(Request::ajax())
        {
            $id = Request::get('id');
            $token = Request::get('_token');
            $department = Department::findOrFail($id);
            $department->delete();
            return $id;
        }
	}

	//End of file
}
