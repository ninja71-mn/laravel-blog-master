@extends('website.template.master')

@section('content')
    <section class="title-section text-right text-sm-center">
        <h1>MY <span>BLOG</span></h1>
        <span class="title-bg">POSTS</span>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="row">
                <article class="col-12 post">
                    <div class="meta">
                        <span><a href=""><i class="fa fa-user"></i> {{$post->user->name}}</a></span>
                        <span><i class="fa fa-calendar-alt"></i> {{date('M d, Y',strtotime($post->created_at))}}</span>
                       @if(count($post->categories)>0)
                            <span><i class="fa fa-tags"></i>
                                @foreach($post->categories as $category)
                                    <a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a>,
                                @endforeach
                        </span>
                            @endif
                    </div>
                    <h1 class="text-uppercase text-capitalize">
                       {{$post->title}}
                    </h1>
                    @if (isset($post->thumbnail))
                        <img src="{{url($post->thumbnail)}}" class="img-fluid" alt="Blog image">
                    @endif
                    <h3 class="card-subtitle">
                        {!! $post->sub_title  !!}
                    </h3>
                    <div class="post-body">
                        {!! $post->details !!}
                    </div>
                </article>

            </div>
        </div>
    </section>
@endsection

