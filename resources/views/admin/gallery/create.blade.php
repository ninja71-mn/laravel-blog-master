@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Gallery - Create</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'galleries.store', 'method' => 'post','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group @if ($errors->has('image_url')) has-error @endif">
                            {!! Form::label('image_url', 'Image_url', ['class' => 'control-label','style'=>'display:block;']) !!}
                            {!! Form::file('image_url[]',['multiple'=>'multiple']) !!}
                            @if ($errors->has('image_url')) <span class="invalid-feedback" role="alert">
                              {!! $errors->first('image_url') !!}
                          </span>
                            @endif
                        </div>
                        {!! Form::submit('Create', ['class' => 'btn btn-sm btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection