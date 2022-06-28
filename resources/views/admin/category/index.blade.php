@extends('layouts.admin')

@section('content')

    <div class="container pt-3">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title mb-0">Category - list</h3>

                <div class="card-tools">
                    <a type="button" class="btn btn-sm btn-primary" href="{{route('categories.create')}}">
                        Add New
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th scope="col" width="60">ID</th>
                            <th scope="col" width="200">Name</th>
                            <th scope="col" width="100">Created By</th>
                            <th scope="col" width="60">AllPosts</th>
                            <th scope="col" width="60">PublishedPosts</th>
                            <th scope="col" width="129">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td scope="col" width="60">{{$category->id}}</td>
                                <td scope="col" width="200">{{$category->name}}</td>
                                <td scope="col" width="100">{{$category->user->name}}</td>
                                <td scope="col" width="60"><a href="{{url('/category/'.$category->slug)}}" target="_blank">{{count($category->posts)}}</a></td>
                                <td scope="col" width="60"><a href="{{url('/category/'.$category->slug)}}" target="_blank">{{count($category->publishedPosts)}}</a></td>
                                <td scope="col" width="129"><a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                {!! Form::open(['route' => ['categories.destroy',$category->id], 'method' => 'delete', 'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
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
    </div>
@endsection
