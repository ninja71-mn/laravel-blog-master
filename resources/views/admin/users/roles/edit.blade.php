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

    <div class="container pt-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title mb-0">Update Role</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['role.update',$role->id], 'method' => 'put']) !!}
                <div class="form-group">
                    <input class="form-control rtl" type="text" placeholder="Role Name" name="name"
                           value="{{$role->name}}" required>
                </div>

                <div class="form-group @if($errors->has('permission_id')) has-error @endif">
                    {!! Form::label('Permission', null, ['class' => 'control-label']) !!}
                    {!! Form::select('permission_id[]',$permissions, null, ['class' => 'form-control '.($errors->has('permission_id')?'is-invalid':''),'id'=>'permission_id','multiple'=>'multiple']) !!}
                    @if($errors->has('permission_id'))
                        <span class="invalid-feedback" role="alert">{!! $errors->first('permission_id') !!}</span>
                    @endif

                </div>

                <div class="form-group">
                    {!! Form::submit('Create', ['class' => 'btn btn-sm btn-primary']) !!}
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
        $(document).ready(function() {
            $('#permission_id').select2({
                placeholder: 'Select an option',
                allowClear: true
            }).val({!! json_encode($role->permissions()->allRelatedIds()) !!}).trigger('change');
        });

    </script>
@endsection
