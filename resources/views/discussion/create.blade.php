@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::open(array('url' => route('discussion.store') , 'class' => 'form')) !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label('title', '标题') !!}
                        {!! Form::text('title' , old('title') , ['class' => 'form-control']) !!}
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        {!! Form::label('content', '内容') !!}
                        {!! Form::textarea('content' , old('content') , ['class' => 'form-control']) !!}
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        {!! Form::submit('发表帖子' , ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
