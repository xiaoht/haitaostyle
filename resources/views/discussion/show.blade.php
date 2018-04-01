@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" alt="64x64" src="{{$discussion->user->avatar ?: '\images\avatars\default.png'}}" style="width: 64px;height: 64px;"/>
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{$discussion->title}}
                        @if (Auth::check() && Auth::user()->can('update', $discussion))
                            <a class="btn btn-lg btn-primary pull-right" href="{{route('discussion.edit' ,['discussion' => $discussion->id])}}" role="button">修改帖子</a>
                        @endif
                    </h4>
                    {{$discussion->user->name}}
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">

                <div class="blog-post">
                    {!! $html !!}
                </div>
                <hr>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64x64" src="{{$comment->user->avatar}}" style="width: 64px;height: 64px;"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {{$comment->user->name}}
                            </h4>
                            {{$comment->content}}
                        </div>
                    </div>
                @endforeach
                @if(Auth::check())
                    {!! Form::open(['url' => route('comment.store') , 'class' => 'form']) !!}
                    {!! Form::hidden('discussion_id' , $discussion->id) !!}
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        {!! Form::textarea('content' , old('content') , ['class' => 'form-control']) !!}
                        @if ($errors->has('content'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div>
                        {!! Form::submit('发表评论' , ['class' => 'btn btn-success pull-right']) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    <a href="{{url('/login')}}" class="btn btn-block btn-success" style="margin-top: 20px">
                        登陆参与评论
                    </a>
                @endif

        </div>
    </div>
@endsection
