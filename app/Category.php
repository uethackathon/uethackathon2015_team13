<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name", "type_id", "description", "hidden", "readonly"];

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function scopeClassifications($query)
    {
    	return $query->whereHas('type', function($typeQuery) {
	        $typeQuery->where('name', Type::$classificationName);
	    });
    }

}
