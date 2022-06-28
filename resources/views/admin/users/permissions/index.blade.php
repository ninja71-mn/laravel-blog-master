@extends('layouts.admin')

@section('content')

    <div class="container pt-3">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title mb-0">Permissions</h3>
                @role('مدیر')
                <div class="card-tools">
                    <a type="button" class="btn btn-sm btn-primary" href="{{route('permission.create')}}">
                        Add New
                    </a>
                </div>
                @endrole
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Permissions</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($role_permissions as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            @foreach($role['roles'] as $item)
                                    {{$item->name}} |
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('permission.edit',$role->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            {!! Form::open(['route' => ['permission.destroy',$role->id], 'method' => 'delete', 'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--<div class="col-12 mt-4">
            <nav aria-label="Page navigation example ">
                {{$posts->links()}}
            </nav>
        </div>--}}
    </div>
@endsection
