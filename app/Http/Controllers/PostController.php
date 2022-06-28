<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoriesRepository;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * @var PostsRepository
     */
    private $postRepository;
    private $categoryRepository;


    public function __construct(PostsRepository $postsRepository,CategoriesRepository $categoriesRepository)
    {
        $this->postRepository = $postsRepository;
        $this->categoryRepository = $categoriesRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (auth()->user()->hasAnyPermission(['edit post', 'delete post'])) {
            $posts = $this->postRepository->getAll();
        } else {
            $posts = $this->postRepository->getByUserId(auth()->user()->id);
        }
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('write post')) {
            $categories = $this->categoryRepository->pluck();
            return view('admin.post.create', compact('categories'));
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('write post')) {
            $this->validate($request, [
                "thumbnail" => 'required',
                "title" => 'required|unique:posts',
                "details" => "required",
                "category_id" => 'required'
            ], [
                    'thumbnail.required' => 'Enter thumbnail url',
                    'title.required' => 'Enter title',
                    'title.unique' => "Title already exist",
                    'details.required' => 'Enter details',
                    'category_id.required' => 'Select categories'
                ]
            );

            $post = new Post();
            $post->user_id = Auth::id();
            $post->thumbnail = $request->thumbnail;
            $post->title = $request->title;
            $post->slug = str_slug($request->title);
            $post->sub_title = $request->sub_title;
            $post->details = $request->details;
            $post->is_published = $request->is_published;
            $post->post_type = 'post';
            $post->save();
            $post->categories()->sync($request->category_id, false);
            Session::flash('success', 'Post created successfully');
            return redirect()->route('posts.index');
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        if (auth()->user()->hasPermissionTo('edit post')) {
            $categories = $this->categoryRepository->pluck();
            return view('admin.post.edit', compact('categories', 'post'));
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->user()->hasPermissionTo('edit post')) {
            $this->validate($request, [
                'thumbnail' => 'required',
                'title' => 'required|unique:posts,title,' . $post->id . ',id',//ignore this id
                'details' => 'required',
                'category_id' => 'required'
            ],
                [
                    'thumbnail.required' => 'Enter thumbnail url',
                    'title.required' => 'Enter title',
                    'title.unique' => "Title already exist",
                    'details.required' => 'Enter details',
                    'category_id.required' => 'Select categories'
                ]);
            $post->user_id = Auth::id();
            $post->thumbnail = $request->thumbnail;
            $post->title = $request->title;
            $post->slug = str_slug($request->title);
            $post->sub_title = $request->sub_title;
            $post->details = $request->details;
            $post->is_published = $request->is_published;
            $post->save();

            $post->categories()->sync($request->category_id);

            Session::flash('success', 'Post updated successfully');
            return redirect()->route('posts.index');
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->hasPermissionTo('delete post')) {
            $post->delete();
            Session::flash('success', 'Post deleted successfully');
            return redirect()->route('posts.index');
        } else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }
}
