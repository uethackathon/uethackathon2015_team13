<?php

namespace App\Http\Controllers\Backend;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
    	$feedbacks = Cache::tags(['feedbacks', 'index', 'notClosed'])->get('feedbacks.index.notClosed');
        if ( !$feedbacks ) {
            $feedbacks = Feedback::with('status', 'visibility', 'comments')->isNotStatus('closed')->get()->sortByDesc(function ($feedback, $key) {
                return $feedback->probabilities[0];
            });
            Cache::tags(['feedbacks', 'index', 'notClosed'])->put('feedbacks.index.notClosed', $feedbacks, 1);
        }
        
		return view('backend.dashboard', ['feedbacks' => $feedbacks]);
    }

}
