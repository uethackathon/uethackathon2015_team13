<?php
/**
 * LICENSE
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE Version 2
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-2.0.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@vv0lll.com so we can send you a copy immediately.
 *
 * @license        http://www.gnu.org/licenses/gpl-2.0.txt GNU GENERAL PUBLIC LICENSE Version 2
 * @author        Thanh Dancer - dancer.thanh@gmail.com
 * @since            1.0
 * @version        $Id: index.blade.php  11/22/15 9:42 AM lion $
 */

?>
@extends('backend.layout')

@section('title', isset($title) ? $title : 'Comment of feedback ' . $feedback->title )

@section('body-content')
    @parent
    <style>
        .media:first-child {
            margin-top: 20px;
        }
        .media-body {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 1em;
        }
        .bg-private {
            border-right: 10px solid #ba4b3a;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h2>{{ $feedback->title }}</h2>
                <blockquote>{{ $feedback->content}}</blockquote>
                <hr />
                <div class="sidebar-module">
                    <h4>Comments</h4>
                    <form action="{{route('backend.comments.store')}}" method="POST" accept-charset="utf-8" class="clearfix">
                        <div class="form-group row">
                            <textarea name="content" class="form-control" rows="3">{{old('content')}}</textarea>
                        </div>
                        <div class="col-sm-3 col-sm-offset-9">
                            <div class="input-group">
                                {{ csrf_field() }}

                                {!! Form::select('visibility_id', $visibilities , old('visibility_id'), ['class' => 'form-control']) !!}
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </span>
                                <input type="hidden" name="feedback_id" value="{{$feedback->id}}">
                            </div>
                        </div>
                    </form>
                    <div class="comments">
                        @foreach($feedback->comments as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTEyYjhiZDY1ZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MTJiOGJkNjVlIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40NzY1NjI1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                    </a>
                                </div>
                                <div class="media-body @if($comment->visibility->name == 'private') bg-private @endif ">
                                    <h4 class="media-heading">{{$comment->user->name}}</h4>
                                    {{$comment->content}}
                                    <div class="timestamp pull-right">
                                        @if ($comment->user_id == 1 || $comment->user_id == \Auth::user()->id)
                                        <a href="#" data-id="{{ $comment->id }}" data-trigger="delete">Xóa</a>
                                        @endif
                                        <small>{{$comment->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('body-append')
    @parent
    <script>
        jQuery(document).ready(function($) {
            $('[data-trigger="delete"]').click(function (event) {
                event.preventDefault();
                var comment_id = $(this).data('id');
                if ( confirm("Are you sure to delete this comment?") ) {
                    $.post('/backend/comments/' + comment_id, {_method: 'DELETE'}, function (data) {
                        if ( data.id ) {
                            window.location.replace("{{ route('backend.feedbacks.comments', $feedback->id) }}")
                        }
                    }, 'json');
                }
            });
        });
    </script>
@endsection