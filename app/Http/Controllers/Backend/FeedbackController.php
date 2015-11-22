<?php

namespace App\Http\Controllers\Backend;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Status;
use App\Visibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Cache::tags(['feedbacks', 'index'])->get('feedbacks.index');
        if ( !$feedbacks ) {
            $feedbacks = Feedback::with('status', 'visibility')->get()->sortBy('created_at');
            Cache::tags(['feedbacks', 'index'])->put('feedbacks.index', $feedbacks, 1);
        }
        
        return view('backend.feedbacks.index', ['feedbacks' => $feedbacks]);
    }

    public function comments($id)
    {
        $feedback = Feedback::find($id);
        $comments = $feedback->comments;
        $visibilities = Visibility::actual()->get()->lists('name', 'id');
        return view('backend.comments.index', [
            'feedback' => $feedback,
            'comments' => $comments,
            'visibilities' => $visibilities,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedback::find($id);
        $visibilities = Visibility::actual()->get()->lists('name', 'id');
        $statuses = Status::actual()->get()->lists('name', 'id');
        return view('backend.feedbacks.edit', [
            "feedback" => $feedback,
            "visibilities" => $visibilities,
            "statuses" => $statuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "visibility_id" => "required|exists:categories,id",
            "status_id" => "required|exists:categories,id"
        ]);
        $data = $request->all();
        unset($data['name'], $data['email'], $data['content'], $data['title']);
        $feedback = Feedback::find($id);
        $feedback->update($data);
        return redirect(route('backend.feedbacks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return $feedback;
    }
}
