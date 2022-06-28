@extends('layouts.admin')

@section('content')

    <div class="container pt-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title mb-0">Create Role</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'role.store', 'method' => 'post']) !!}
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Role Name" name="name" required>
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
