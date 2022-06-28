@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Posts</h3>
                    <h4>All : {{$count['allPost']}}</h4>
                    <h4>New : {{$count['newPost']}}</h4>

                </div>
                <div class="icon">
                    <i class="far fa-file-alt top-20per"></i>
                </div>
                <a href="{{route('posts.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Categories</h3>
                    <h4>All : {{$count['allCategory']}}</h4>
                    <h4>New : {{$count['newCategory']}}</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-tags top-20per"></i>
                </div>
                <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Users</h3>
                    <h4>All : {{$count['allUser']}}</h4>
                    <h4>New : {{$count['newUser']}}</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Galleries</h3>
                    <h4>All : {{$count['allImage']}}</h4>
                    <h4>New : {{$count['newImage']}}</h4>
                </div>
                <div class="icon">
                    <i class="far fa-images"></i>
                </div>
                <a href="{{route('galleries.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="container pt-3">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title mb-0">Latest Categories</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th scope="col" width="60">ID</th>
                            <th scope="col" width="60">Name</th>
                            <th scope="col" width="200">Created By</th>
                            <th scope="col" width="60">AllPosts</th>
                            <th scope="col" width="60">PublishedPosts</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td scope="col" width="60">{{$category->id}}</td>
                                <td scope="col" width="60">{{$category->name}}</td>
                                <td scope="col" width="200">{{$category->user->name}}</td>
                                <td scope="col" width="60"><a href="{{url('/category/'.$category->slug)}}" target="_blank">{{count($category->posts)}}</a></td>
                                <td scope="col" width="60"><a href="{{url('/category/'.$category->slug)}}" target="_blank">{{count($category->publishedPosts)}}</a></td>
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
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title mb-0">Latest Posts</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Subtitle</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>{{$post->sub_title}}</td>
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
