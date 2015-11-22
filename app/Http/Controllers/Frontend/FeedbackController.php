<?php

namespace App\Http\Controllers\Frontend;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Status;
use App\Visibility;
use Illuminate\Http\Request;
use \Cache;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Cache::tags(['feedbacks', 'index', 'isPublic'])->get('feedbacks.index.isPublic');
        if ( !$feedbacks ) {
            $feedbacks = Feedback::with('status')->isPublic()->isProcessed()->get()->sortByDesc(function ($feedback, $key) {
                return $feedback->probabilities[0];
            });
            Cache::tags(['feedbacks', 'index', 'isPublic'])->put('feedbacks.index.isPublic', $feedbacks, 1);
        }
        
        return view('frontend.feedbacks.index', ['feedbacks' => $feedbacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "content" => "required|min:10",
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $data = $request->all();
        $data['visibility_id'] = Visibility::actual()->where('name', 'private')->first()->id;
        $data['status_id'] = Status::actual()->where('name', 'open')->first()->id;
        $feedback = Feedback::create($data);
        return redirect(route('feedbacks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = Cache::tags(['feedbacks', 'show'])->get('feedbacks.show.'.$id);
        if ( !$feedback ) {
            $feedback = Feedback::with('status')->isPublic()->find($id);
            Cache::tags(['feedbacks', 'show'])->put('feedbacks.show.'.$id, $feedback, 1);
        }
        if (!$feedback) return abort(404);
        return view('frontend.feedbacks.show', ['feedback' => $feedback]);
    }

}
