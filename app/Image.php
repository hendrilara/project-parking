<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table ='image';
    protected $fillable = ['name','picture'];

    protected $hidden = ['created_at', 'updated_at', 'name'];

    public function location()
    {
    	return $this->hasMany('App\Location', 'image_id');
    }
}
