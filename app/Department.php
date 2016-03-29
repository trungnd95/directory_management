<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','slug', 'office_phone', 'office_code', 'manager','address','email_contact'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
    *	Relation between department and employee
    * 	@param
    **/
    public function employee()
    {
    	return $this->hasMany('App\Employee');
    }
}
