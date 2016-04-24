<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Employee;
use App\Department;
use Validator,DB;
use Alert;

class EmployeeController extends Controller
{
	/**
	 * Function to list all employees and return view list
	 * @param
	 * @return view list all employees
	 */
    public function index($department_slug = '')
    {  
    	if($department_slug != null ) 
    	{      //Solution 1: using query builder to join 2 tables
                   $department_id = Department::select('id')->where('slug','=',$department_slug)->first(); 
                    $employees = DB::table('employees')
                        ->join('departments','employees.department_id','=','departments.id')
                        ->select('employees.*',DB::raw('departments.name as department_name'))
                        ->where('employees.department_id','=',$department_id->id)
                        ->paginate(10);
                //Solution 2: Eager loading 
            
            // $employees = Department::with('employee')->find($department_id) ;
                        // dd($employees);
    	}else {
    		$employees = Employee::paginate(10);
    	}

        $departments = Department::all();
    	return view('templates.Employees.index',compact('employees','departments'));
    }

    /**
     * Function to get view add an employee
     * @param
     * @return view to add an employee
     */
    public function add()
    {
        $departments = Department::all();
        return view('templates.Employees.add')->with(['departments'=>$departments]);
    }

    /**
     * Function to store data just added to database
     * @param Request to validate data
     */
    public function store()
    {
        //Validate
        $validator =  Validator::make(Request::all(),[
            'name'            => 'required',
            // 'employee_avatar' => 'image',
            'job_title'       => 'required',
            'cell_phone'      => 'required',
            'email'           => 'required|email|unique:employees',
            'address'         => 'required',
            'department'      => 'required'

            ],[
            'name.required'         => 'Name is required field',
            // 'employee_avatar.image' => 'Avatar isn\'t image format',
            'job_title.required'    => 'Job title is required field',
            'cell_phone.required'   => 'Cell phone is required field',
            'email.required'        => 'Email is required field',
            'email.email'           => 'Email is not follow standard',
            'email.unique'          => 'Email was exist',
            'address.required'      => 'Address is required field',
            'department.required'   =>  'Please choose department for this employee'
        ]);
        //check errors
        if($validator->fails()) 
        {
            return back()->withInput()->withErrors($validator);
        }
        $avatar_name = 'default-user.png';
        //Upload avatar image
        if(Request::file('employee_avatar')){
            $avatar_name  = Request::file('employee_avatar')->getClientOriginalName();    
            $des =  base_path().'/public/upload/images/employees/';
            if(isset($avatar_name))
            {
                Request::file('employee_avatar')->move($des,$avatar_name);
            }
        }
        
        Employee::create([
            'name'          => Request::get('name'),
            'avatar'        => $avatar_name,
            'job_title'     => Request::get('job_title'),
            'cell_phone'    => Request::get('cell_phone'),
            'email'         => Request::get('email'),
            'address'       => Request::get('address'),
            'department_id' => Request::get('department')
        ]); 
        Alert::success("Added Employee")->persistent("Close"); 
        return redirect()->route('employees.index')->with(['flash_level'=>'success' , 'flash_message'=>'Success! Added employee !!']); 
    }

    /**
     * Function to get view edit an employee
     * @param   $id : id of employee want edit 
     * @return view to edit 
     */
    public function edit($id)
    {
        $employee    = Employee::findOrFail($id);
        $departments = Department::all();
        return view('templates.Employees.edit',compact('employee','departments'));
    }

    /**
     * Function to save data just edited
     * @param  [type] $id : id of employee want edit, Request to validate data 
     * @return view index list all employee with new data 
     */
    public function update($id)
    {
        $validate = Validator::make(Request::all(),[
            'name'            => 'required',
            // 'employee_avatar' => 'image',
            'job_title'       => 'required',
            'cell_phone'      => 'required',
            'email'           => 'required|email',
            'address'         => 'required',
            'department'      => 'required'
        ],[
            'name.required'         => 'Name is required field',
            // 'employee_avatar.image' => 'Avatar isn\'t image format',
            'job_title.required'    => 'Job title is required field',
            'cell_phone.required'   => 'Cell phone is required field',
            'email.required'        => 'Email is required field',
            'email.email'           => 'Email is not follow standard',
            'address.required'      => 'Address is required field',
            'department.required'   =>  'Please choose department for this employee'
        ]);

        $employee =  Employee::findOrFail($id);
        //if avatar change
        //   if avatar exist => upload new avatar image, delete old avatar image
        //   if avatar is not exist => upload avatar image
        
        
        if(Request::file('employee_avatar'))
        {
            //if avatar change different exist avatar => delete avatar exist
            if($employee->avatar != null) 
            {
                $cur_des =  base_path().'public/upload/images/employees/'.$employee->avatar;
                File::delete($cur_des);     
            }
           
            $new_avatar = Request::file('employee_avatar')->getClientOriginalName();
            //Upload new avatar image
            $des1 = base_path().'/public/upload/images/employees/';
            if(isset($new_avatar))
            {
                Request::file('employee_avatar')->move($des1,$new_avatar);       
            }
        }else 
        {
            $new_avatar = $employee->avatar;
        }
         
        
        $employee->update([
            'name'          => Request::get('name'),
            'avatar'        => $new_avatar,
            'job_title'     => Request::get('job_title'),
            'cell_phone'    => Request::get('cell_phone'),
            'email'         => Request::get('email'),
            'address'       => Request::get('address'),
            'department_id' => Request::get('department')
        ]);

        return redirect()->route('employees.index')->with(['flash_level'=>'success','flash_message'=> 'Success! Edited Employee!!']);
    }

    /**
     * Function to remove data of employee want to delete from database. Using ajax
     * @param  [type] $id: id of employee want to delete
     * @return view index list all employee without this one
     */
    public function delete($id)
    {
        if(Request::ajax())
        {
            $id = Request::get('id');
            $token = Request::get('_token');
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return $id;
        }   
    }

    /**
     * Function to view employee profile
     * @param  $id -  id of employee want to view
     * @return view of employee profile
     */
    public function detail($id)
    {
        $employee = Employee::select('*')->where('id','=',$id)->first();
        $department =  Department::select('name')->where('id','=',$employee->department_id)->first();
        return view('templates.Employees.detail',compact('employee','department'));
    }

    /**
     * Function to show search result
     * @param $employee: key search employee, $department: search employee in this department
     * @return 
     */
    public function getSearch($department,$employee='')
    {   
        //If search have not information => list all employees
        if($employee == '' && $department == 'all')
        {
            return redirect()->route('employees.index');
        }

        //If guest only choose department and key name to search employee is null 
        // ==> list all employees of this department
        if($employee == '' && $department != 'all')
        {
            return redirect()->route('employees.index',[$department]);
        }

        //If guest not choose department and have key to search employee => search all employees 
        //  have name mapping with key name
        if($employee != null && $department == 'all')
        {
            $employees =  Employee::select('*')->where('name' ,'LIKE', '%'.$employee.'%')->get();
            $departments = Department::all();
            return view('templates.Employees.search-result',compact('employees','employee','department','departments'));
        }

        //If fullfil information . Join 2 tables employees and departments and search following key 
        if($employee != null && $department != 'all')
        {
            $departments = Department::all();
            $department_id = Department::select('id')->where('slug','=',$department)->first();
            $employees = DB::table('employees')
                        ->join('departments','employees.department_id','=','departments.id')
                        ->select('employees.*',DB::raw('departments.name as department_name'))
                        ->where('employees.department_id','=',$department_id->id)
                        ->get();
            return view('templates.Employees.search-result',compact('employees','employee','departments','department'));
        }
    }

    /**
     * Function to get information search
     * @return 
     */
    public function postSearch()
    {
        $employee_key = ((Request::get('search-employee')) != null) ? Request::get('search-employee') : '';
        $department_slug = Request::get('search-department');
        return redirect()->route('employees.getSearch',[$department_slug,$employee_key]);
    }

    public function searchAjax()
    {
        if(Request::ajax())
        {
            $key_search = trim(Request::get('key_search'));
            $department_search = Request::get('department_search');

            if($department_search == 'all')
            {
                $results = Employee::select('*')->where('name' ,'LIKE', '%'.$key_search.'%')->get();    
            }   
            else if($key_search == '' && $department_search != 'all')
            {
                $department_id =  Department::select('id')->where('slug','=',$department_search)->first();
                $results = Employee::where('department_id','=',$department_id->id)->get();
            }
            else {
                $department_id =  Department::select('id')->where('slug','=',$department_search)->first();
                $results = Employee::where('department_id','=',$department_id->id)->where('name' ,'LIKE', '%'.$key_search.'%')->get();
            }
            $call_view = view("templates.Employees.ajax-search",['results'=>$results])->render();
            return response()->json($call_view);
        }
    }
}
// End of file
