@extends('layouts.admin')

@section('content')

    <div class="container pt-3">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title mb-0">Post - list</h3>
                @role('writer|admin')
                <div class="card-tools">
                    <a type="button" class="btn btn-sm btn-primary" href="{{route('posts.create')}}">
                        Add New
                    </a>
                </div>
                @endrole
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th scope="col" width="60">ID</th>
                            <th scope="col" width="200">Title</th>
                            <th scope="col" width="200">Created By</th>
                            <th scope="col" width="129">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $post)
                            <tr>
                                <td scope="col" width="60">{{$post->id}}</td>
                                <td scope="col" width="200">{{$post->title}}</td>
                                <td scope="col" width="200">{{$post->user->name}}</td>
                                <td scope="col" width="129">
                                    @if(auth()->user()->can('edit post') || $post->user->id==auth()->user()->id)
                                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        {!! Form::open(['route' => ['posts.destroy',$post->id], 'method' => 'delete', 'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->
        </div>
        <div class="col-12 mt-4">
            <nav aria-label="Page navigation example ">
                {{$posts->links()}}
            </nav>
        </div>
    </div>
@endsection
