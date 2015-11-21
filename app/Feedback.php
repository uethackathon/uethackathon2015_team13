<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ["title", "name", "email", "content", "probability", "status_id", "visibility_id"];

    protected $casts = [
        'probabilities' => 'array',
    ];

    public function sentences()
    {
    	return $this->hasMany(Sentence::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsIsPublic()
    {
        return $this->comments()->whereHas('visibility', function($categoryQuery) {
            $categoryQuery->where('name', 'public');
        })->orderBy('created_at', 'desc');
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function visibility()
    {
    	return $this->belongsTo(Visibility::class);
    }

    public function scopeIsPublic($query)
    {
        return $query->whereHas('visibility', function($categoryQuery) {
            $categoryQuery->where('name', 'public');
        });
    }

    public function getNameAttribute($value)
    {
        return $value != null ? $value : 'Ẩn danh';
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value);
    }

    public function getContentAttribute($value)
    {
        return strip_tags($value);
    }

    public function calculateProbabilities()
    {
        $this->load('sentences');
        $sentences = $this->sentences;
        $grouped = $this->sentences->groupBy('classification_id');
        $classifications = Category::classifications()->get()->keyBy('id');
        $percentage = 1;
        $probabilities = $grouped->map(function ($item, $key) use ($sentences, $classifications, &$percentage) {
            $proportion = count($item) / count($sentences);
            $percentage = $percentage-$proportion;
            if ( $percentage <= 0 ) {
                $proportion = $proportion - $percentage;
                $percentage = 1;
            }            
            return [
                "classification" => $classifications->get($key)->name,
                "probability" => $proportion
            ];
        });
        $this->probabilities = $probabilities->values()->toArray();
        $this->save();
    }
}
