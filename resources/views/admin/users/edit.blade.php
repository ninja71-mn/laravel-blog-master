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
            width:250px;
            padding:20px;
            background:#fff;
            border:2px dashed #555;
        }
        .form-input input {
            display:none;
        }
        .form-input label {
            display:block;
            width:100%;
            height:50px;
            line-height:50px;
            text-align:center;
            background:#333;
            color:#fff;
            font-size:15px;
            font-family:"Open Sans",sans-serif;
            text-transform:Uppercase;
            font-weight:600;
            border-radius:10px;
            cursor:pointer;
        }

        .form-input img {
            width:100%;
            margin-top:10px;
        }
    </style>
@endsection
@section('content')

    <div class="container pt-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title mb-0">Edit User -> {{$user->name}}</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['users.update',$user->id], 'method' => 'put','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group @if($errors->has('avatar')) has-error @endif">
                            <div class="form-input">
                                <label for="file-ip-1">Upload Image</label>
                                <input name="avatar" type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" value="{{$user->avatar}}">
                                <div class="preview">
                                    <img id="file-ip-1-preview" src="{{url('storage/avatar/'.$user->avatar)}}">
                                </div>
                            </div>
                        </div></div>
                    <div class="col-12 col-md-8">
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Name', null, ['class' => 'control-label']) !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control rtl '.($errors->has('name')?'is-invalid':''),'placeholder'=>'Name']) !!}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('name') !!}</span>
                            @endif
                        </div>
                        <div class="form-group @if($errors->has('phone')) has-error @endif">
                            {!! Form::label('Phone', null, ['class' => 'control-label']) !!}
                            {!! Form::text('phone', $user->phone, ['class' => 'form-control '.($errors->has('phone')?'is-invalid':''),'placeholder'=>'Phone']) !!}
                            @if($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('phone') !!}</span>
                            @endif
                        </div>

                        <div class="form-group @if($errors->has('email')) has-error @endif">
                            {!! Form::label('Email', null, ['class' => 'control-label']) !!}
                            @if(auth()->user()->can('set admin') )
                                {!! Form::email('email', $user->email, ['class' => 'form-control '.($errors->has('email')?'is-invalid':'')]) !!}
                            @else
                                {!! Form::email('email', $user->email, ['class' => 'form-control','disabled'=>'disabled']) !!}

                            @endif
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">{!! $errors->first('email') !!}</span>
                            @endif
                        </div>

                        @if(auth()->user()->can('set admin') )

                            <div class="form-group @if($errors->has('role_id')) has-error @endif">
                                {!! Form::label('Role', null, ['class' => 'control-label']) !!}
                                {!! Form::select('role_id',$roles, null, ['class' => 'form-control '.($errors->has('role_id')?'is-invalid':''),'id'=>'role_id']) !!}
                                @if($errors->has('role_id'))
                                    <span class="invalid-feedback" role="alert">{!! $errors->first('role_id') !!}</span>
                                @endif

                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-sm btn-primary']) !!}
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
        $(document).ready(function () {
            $('#role_id').select2({
                placeholder: 'Select an option',
                allowClear: true
            }).val({!! json_encode($user->roles()->allRelatedIds()) !!}).trigger('change');
        });
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection

