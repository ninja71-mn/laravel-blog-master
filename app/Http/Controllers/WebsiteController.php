<?php

namespace App\Http\Controllers;

use App\Mail\VisitorContact;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['local']);
    }

    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->where('is_published', '1')->get();
        $posts = Post::orderBy('id','DESC')->where('post_type','post')->where('is_published', '1')->paginate(9);
        return view('website.index',compact('posts','categories'));
    }

    public function post($slug)
    {
        $post=Post::where('slug',$slug)->where('post_type','post')->where('is_published','1')->first();
        if ($post){
            return view('website.post',compact('post'));
        }else{
            return \Response::view('website.errors.404',array(),404);
        }
    }

    public function categories()
    {
        $categories = Category::orderBy('name', 'ASC')->where('is_published', '1')->get();
        if ($categories){
            return view('website.categories',compact('categories'));
        }else{
            return \Response::view('website.errors.404',array(),404);
        }
    }

    public function category($slug)
    {
        $category=Category::where('slug',$slug)->where('is_published','1')->first();
        if ($category){
            $posts=$category->posts()->orderBy('posts.id','DESC')->where('is_published','1')->paginate(9);
            return view('website.category',compact('category','posts'));
        }else{
            return \Response::view('website.errors.404',array(),404);
        }
    }

    public function about()
    {
        return view('website.pages.about');
    }

    public function showContactForm()
    {
        return view('website.pages.contact');
    }

    public function submitContactForm(Request $request)
    {
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message
        ];

        Mail::to('ninja71.mn@gmail.com')->send(new VisitorContact($data));

        Session::flash('success', 'Thank you for your email');
        return redirect()->route('contact.show');
    }
}
