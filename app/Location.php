<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $table ='location';
    protected $fillable = ['image_id','name', 'longitude', 'latitude'];
    protected $hidden = ['created_at', 'updated_at','image_id','capacity_id'];
    public function image()
    {
    	return $this->belongsTo('App\Image', 'image_id');
    }

    public function capacity()
    { 
    	return $this->belongsTo('App\Capacity', 'capacity_id'); 
    }
}
