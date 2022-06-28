@extends('layouts.admin')

@section('content')

    <div class="container pt-3">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title mb-0">Roles</h3>
                @can('create role')
                    <div class="card-tools">
                        <a type="button" class="btn btn-sm btn-primary" href="{{route('role.create')}}">
                            Add New
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($role_permissions as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                @foreach($role['permissions'] as $item)
                                    {{$item->name}} |
                                @endforeach
                            </td>
                            <td width="200">
                                @can('edit role')
                                    <a href="{{route('role.edit',$role->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                @endcan
                                @can('delete role')
                                    @if ($role->id!=1 && $role->name!="مدیر")
                                        {!! Form::open(['route' => ['role.destroy',$role->id], 'method' => 'delete', 'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endcan
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
