@extends('layouts.admin')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-selection__choice__remove {
            margin-right: 3px;
            border-right: 0 !important;
        }

        .select2-selection__choice {
            padding-right: 5px !important;
            padding-left: 5px !important;
            color: black !important;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 42px;
            user-select: none;
            -webkit-user-select: none;
        }

        .form-input {
            width: 250px;
            padding: 20px;
            background: #fff;
            border: 2px dashed #555;
        }

        .form-input input {
            display: none;
        }

        .form-input label {
            display: block;
            width: 100%;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background: #333;
            color: #fff;
            font-size: 15px;
            font-family: "Open Sans", sans-serif;
            text-transform: Uppercase;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
        }

        .form-input img {
            width: 100%;
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')

    <div class="container pt-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title mb-0">Edit Site Details</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['details.update'], 'method' => 'put','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group @if($errors->has('logo')) has-error @endif">
                            <div class="form-input">
                                <label for="file-ip-1">Upload Image</label>
                                <input name="logo" type="file" id="file-ip-1" accept="image/*"
                                       onchange="showPreview(event);" >
                                <div class="preview">
                                    <img id="file-ip-1-preview" src="@if (isset($details->logo))
                                    {{url('storage/logo/'.$details->logo)}}
                                    @endif">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="form-group @if($errors->has('site_name')) has-error @endif">
                            {!! Form::label('Site Name', null, ['class' => 'control-label']) !!}
                            {!! Form::text('site_name', isset($details->site_name)?$details->site_name:null, ['class' => 'form-control rtl '.($errors->has('site_name')?'is-invalid':''),'placeholder'=>'Name']) !!}
                            @if($errors->has('site_name'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('site_name') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('phone1')) has-error @endif">
                            {!! Form::label('Phone 1', null, ['class' => 'control-label']) !!}
                            {!! Form::text('phone1', isset($details->phone1)?$details->phone1:null, ['class' => 'form-control','placeholder'=>'Phone 1']) !!}
                            @if($errors->has('phone1'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('phone1') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('phone2')) has-error @endif">
                            {!! Form::label('Phone 2', null, ['class' => 'control-label']) !!}
                            {!! Form::text('phone2', isset($details->phone2)?$details->phone2:null, ['class' => 'form-control','placeholder'=>'Phone 2']) !!}
                            @if($errors->has('phone2'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('phone2') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('phone3')) has-error @endif">
                            {!! Form::label('Phone 3', null, ['class' => 'control-label']) !!}
                            {!! Form::text('phone3', isset($details->phone3)?$details->phone3:null, ['class' => 'form-control','placeholder'=>'Phone 3']) !!}
                            @if($errors->has('phone3'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('phone3') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('phone4')) has-error @endif">
                            {!! Form::label('Phone 4', null, ['class' => 'control-label']) !!}
                            {!! Form::text('phone4', isset($details->phone4)?$details->phone4:null, ['class' => 'form-control','placeholder'=>'Phone 4']) !!}
                            @if($errors->has('phone4'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('phone4') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('address1')) has-error @endif">
                            {!! Form::label('Address 1', null, ['class' => 'control-label']) !!}
                            {!! Form::text('address1', isset($details->address1)?$details->address1:null, ['class' => 'form-control','placeholder'=>'Address 1']) !!}
                            @if($errors->has('address1'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('address1') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('address2')) has-error @endif">
                            {!! Form::label('Address 2', null, ['class' => 'control-label']) !!}
                            {!! Form::text('address2', isset($details->address2)?$details->addres2:null, ['class' => 'form-control','placeholder'=>'Address 2']) !!}
                            @if($errors->has('address2'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('address2') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('owner')) has-error @endif">
                            {!! Form::label('Owner', null, ['class' => 'control-label']) !!}
                            {!! Form::text('owner', isset($details->owner)?$details->owner:null, ['class' => 'form-control','placeholder'=>'Owner']) !!}
                            @if($errors->has('owner'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('owner') !!}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
