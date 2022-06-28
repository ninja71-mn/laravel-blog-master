@extends('website.template.master')
@section('content')
    <section class="title-section text-right text-sm-center">
        <h1>MY <span>BLOG</span></h1>
        <span class="title-bg">POSTS</span>
    </section>
    <section class="categories d-none d-lg-block mb-4">
        <div class="container d-flex flex-column flex-md-row">
            @foreach($categories as $category)
            <a class="py-1 d-none d-md-inline-block" href="{{url('/category/'.$category->slug)}}">{{$category->name}}</a>
            @endforeach
        </div>
    </section>
    <section class="main-content">
        <div class="container">
            <div class="row posts">
                @foreach($posts as $post)
                    <div class="col-12 col-md-6 col-xl-4 mb-30">
                        <article class="post-container">
                            <div class="post-thumb">
                                <a href="{{url('post/'.$post->slug)}}" class="d-block overflow-hidden">
                                    <img src="{{asset($post->thumbnail)}}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="entry-header">
                                    <h2><a href="{{url('post/'.$post->slug)}}">{{Str::limit($post->title,25)}}</a></h2>
                                </div>
                                <div class="entry-content">
                                    <h5>{!!  Str::limit($post->sub_title,100) !!}</h5>
                                    <p>
                                        Posted by <a href="">{{$post->user->name}}</a>
                                        on {{date('M d, Y',strtotime($post->created_at))}}
                                        @if(count($post->categories)>0)
                                             <span class="post-category" >
                                        | Category :
                                                @foreach($post->categories as $category)
                                                <a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a>,
                                                    @endforeach
                                    </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div>
                @endforeach

                <div class="col-12 mt-4 paginate">
                        {{$posts->onEachSide(0)->links()}}
                </div>

            </div>
        </div>
    </section>
@endsection

