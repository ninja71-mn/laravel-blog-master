@extends('website.template.master')
@section('content')
    <section class="title-section text-right text-sm-center">
        <h1>MY <span>BLOG</span></h1>
        <span class="title-bg">CATEGORIES</span>
    </section>

    <section class="main-content categories">
        <div class="container">
            <div class="container d-flex flex-column flex-md-row">
                @foreach($categories as $category)
                    <a class="py-1 d-inline-block" href="{{url('/category/'.$category->slug)}}">{{$category->name}}</a>
                @endforeach
            </div>
        </div>
    </section>

@endsection

