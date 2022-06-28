@extends('layouts.admin')

@section('content')

    <div class="container pt-3">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title mb-0">Gallery - list</h3>

                <div class="card-tools">
                    <a type="button" class="btn btn-sm btn-primary" href="{{route('galleries.create')}}">
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
                            <th scope="col" width="100">Thumbnail</th>
                            <th scope="col" width="200">URL</th>
                            <th scope="col" width="100">Created By</th>
                            <th scope="col" width="129">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($galleries as $gallery)
                            <tr>
                                <td scope="col" width="100"><img class="attachment-img img-fluid" data-image="{{$gallery->image_url}}" src="{{ asset('storage/galleries/'.$gallery->image_url) }}" alt="Attachment Image"></td>
                                <td scope="col" width="200">{{ asset('storage/galleries/'.$gallery->image_url) }}</td>
                                <td scope="col" width="100">{{$gallery->user->name}}</td>
                                <td scope="col" width="129">
                                    {!! Form::open(['route' => ['galleries.destroy',$gallery->id], 'method' => 'delete', 'style'=>'display:inline']) !!}
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
        <div id="magnifier">
            <div id="lbInner">
                <img class="image" src="" alt="Attachment Image">
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $('.attachment-img').on('click',function () {
            $('.image').attr('src',$(this).attr('src'));
            $('#magnifier').addClass('show');
        });
        $('#magnifier').on('click',function () {
            $('#magnifier').removeClass('show');
        })
    </script>
@stop
