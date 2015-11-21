<?php

namespace App;

class Status extends Category
{
    protected $table = "categories";

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function feedbacks()
    {
    	return $this->hasMany(Feedback::class);
    }

    public function scopeActual($query)
    {
    	return $query->whereHas('type', function($typeQuery) {
	        $typeQuery->where('name', Type::$statusName);
	    });
    }

}
