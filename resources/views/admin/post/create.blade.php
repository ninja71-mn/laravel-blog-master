@extends('layouts.admin')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection__choice__remove{
            margin-right:3px;
            border-right: 0 !important;
        }
        .select2-selection__choice{
            padding-right: 5px !important;
            padding-left: 5px !important;
            color: black !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Post - Create</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'posts.store', 'method' => 'post']) !!}
                        <div class="form-group @if($errors->has('thumbnail')) has-error @endif">
                            {!! Form::label('Thumbnail', null, ['class' => 'control-label']) !!}
                            {!! Form::text('thumbnail', null, ['class' => 'form-control '.($errors->has('thumbnail')?'is-invalid':''),'placeholder'=>'Thumbnail']) !!}
                            @if($errors->has('thumbnail'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('thumbnail') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('title')) has-error @endif">
                            {!! Form::label('Title', null, ['class' => 'control-label']) !!}
                            {!! Form::text('title', null, ['class' => 'form-control '.($errors->has('title')?'is-invalid':''),'placeholder'=>'Title']) !!}
                            @if($errors->has('title'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('title') !!}</span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('sub_title')) has-error @endif">
                            {!! Form::label('Sub Title', null, ['class' => 'control-label']) !!}
                            {!! Form::text('sub_title', null, ['class' => 'form-control '.($errors->has('sub_title')?'is-invalid':''),'placeholder'=>'Sub Title']) !!}
                            @if($errors->has('sub_title'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('sub_title') !!}</span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('details')) has-error @endif">
                            {!! Form::label('Details', null, ['class' => 'control-label']) !!}
                            {!! Form::textarea('details', null, ['class' => 'form-control '.($errors->has('details')?'is-invalid':''),'placeholder'=>'Details']) !!}
                            @if($errors->has('details'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('details') !!}</span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('category_id')) has-error @endif">
                            {!! Form::label('Category', null, ['class' => 'control-label']) !!}
                            {!! Form::select('category_id[]',$categories, null, ['class' => 'form-control '.($errors->has('category_id')?'is-invalid':''),'id'=>'category_id','multiple'=>'multiple']) !!}
                            @if($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('category_id') !!}</span>
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
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('details');
            $('#category_id').select2({
                placeholder: 'Select an option',
                allowClear: true
            });
        });

    </script>
@endsection
