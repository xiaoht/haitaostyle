@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>欢迎来到问答社区!!!
                <a class="btn btn-lg btn-primary pull-right" href="{{route('discussion.create')}}" role="button">发布新的帖子</a>
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="row">

                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" alt="64x64" src="{{$discussion->user->avatar}}" style="width: 64px;height: 64px;"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{route('discussion.show',['id' => $discussion->id])}}">{{$discussion->title}}</a>
                                <div class="media-conversation-meta">
                                    <span class="media-conversation-replies">
                                        <a href="#" >{{count($discussion->comments)}}</a>
                                        回复
                                    </span>
                                </div>
                            </h4>
                            <span class="time_show">{{$discussion->created_at->diffForHumans()}}</span>
                            {{$discussion->user->name}}

                        </div>
                    </div>
                @endforeach
                {{$discussions->links()}}

        </div>
    </div>
@endsection
