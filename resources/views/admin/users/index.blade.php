@extends('layouts.admin')

@section('content')

    <div class=" pt-3">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title mb-0">Users</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Last Login</th>
                        <th>Reg Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{url('storage/avatar/'.$user->avatar)}}" alt="Product 1" class="img-circle img-size-50 mr-2">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->last_login_at}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                {!! Form::open(['route' => ['users.destroy',$user->id], 'method' => 'delete', 'style'=>'display:inline']) !!}
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
