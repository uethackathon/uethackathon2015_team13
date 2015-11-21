<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Visibility;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'feedback_id' => 'required|exists:feedbacks,id'
        ]);
        $data = $request->all();
        $data['visibility_id'] = Visibility::actual()->where('name', 'public')->first()->id;
        $comment = Comment::create($data);
        return redirect(route('feedbacks.show', $comment->feedback_id));
    }

}
