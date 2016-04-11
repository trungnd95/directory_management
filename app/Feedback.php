<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','email','content','reply'
    ];
}
