@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Category - Create</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'categories.store', 'method' => 'post']) !!}
                        <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                            {!! Form::label('Thumbnail', null, ['class' => 'control-label']) !!}
                            {!! Form::text('thumbnail', null, ['class' => 'form-control '.($errors->has('thumbnail')?'is-invalid':''),'placeholder'=>'Thumbnail']) !!}
                            @if($errors->has('thumbnail'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! $errors->first('thumbnail') !!}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Name', null, ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name')?'is-invalid':''),'placeholder'=>'Name']) !!}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! $errors->first('name') !!}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('Publish', null, ['class' => 'control-label']) !!}
                            {!! Form::select('is_published', [1=>'Publish',0=>'Draft'] , null , ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Create', ['class' => 'btn btn-sm btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
