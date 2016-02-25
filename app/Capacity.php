<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    protected $table ='capacity';
    protected $fillable = [];

    protected $hidden = ['created_at', 'updated_at', 'name'];

    public function location()
    {
    	return $this->hasMany('App\Location', 'capacity_id');
    }
}


