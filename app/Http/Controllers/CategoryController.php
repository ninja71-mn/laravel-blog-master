<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoriesRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * @var CategoriesRepository
     */
    private $categoryRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoryRepository = $categoriesRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories=$this->categoryRepository->getAll();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('create category')) {

            return view('admin.category.create');
        }else {
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
        if (auth()->user()->hasPermissionTo('create category')) {

            $this->validate($request,[
            'thumbnail'=>'required',
            'name'=>'required|unique:categories'
        ],[
            'thumbnail.required'=>'Enter thumbnail url',
                'name.required'=>'Enter name',
                'name.unique'=>'Category already exist',
            ]
        );
        $category=new Category();
        $category->thumbnail=$request->thumbnail;
        $category->user_id=Auth::id();
        $category->name=$request->name;
        $category->slug=str_slug($request->name);
        $category->is_published=$request->is_published;
        $category->save();

        Session::flash('success','Category updated successfully');
        return redirect()->route('categories.index');
        }else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        if (auth()->user()->hasPermissionTo('edit category')) {
        return view('admin.category.edit',compact('category'));
        }else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Category $category)
    {
        if (auth()->user()->hasPermissionTo('edit category')) {
        $this->validate($request,[
            'thumbnail'=>'required',
            'name'=>'required|unique:categories,name,'.$category->id,
        ],[
            'thumbnail.required'=>'Enter thumbnail url',
            'name.required'=>'Enter name',
            'name.unique'=>'Category already exist',
        ]);

        $category->thumbnail=$request->thumbnail;
        $category->user_id=Auth::id();
        $category->name=$request->name;
        $category->slug=str_slug($request->name);
        $category->is_published=$request->is_published;
        $category->save();

        Session::flash('success','Category updated successfully');
        return redirect()->route('categories.index');
        }else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        if (auth()->user()->hasPermissionTo('delete category')) {

            $category->delete();
        Session::flash('success','Category deleted successfully');
        return redirect()->route('categories.index');
        }else {
            abort(403, 'دسترسی به این صفحه برای شما محدود شده');
            return redirect('/home');
        }
    }
}
