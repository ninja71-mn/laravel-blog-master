<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Repositories\GalleriesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class GalleryController extends Controller
{

    /**
     * @var GalleriesRepository
     */
    private $galleryRepository;

    public function __construct(GalleriesRepository $galleriesRepository)
    {
        $this->middleware(['permission:write post|edit post|delete post|write page|edit page|delete page']);
        $this->galleryRepository=$galleriesRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $galleries = $this->galleryRepository->getAll();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.gallery.create');
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

        $this->validate($request, [
            'image_url' => 'required',
        ], [
            'image_url.required' => 'Select image'
        ]);
        foreach ($request->image_url as $image_url) {
        // Get file name with ext
        $fileNameWithExt = $image_url->getClientOriginalName();

        // Get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // Get just file extension
        $fileExt=$image_url->getClientOriginalExtension();

        // Get file name to store
        $fileNameToStore=$fileName.time().'_'.$fileExt;

        $gallery=new Gallery();
        $gallery->user_id=Auth::id();
        $gallery->image_url=$fileNameToStore;
        $save=$gallery->save();
        if ($save){
            $image_url->storeAs('public/galleries',$fileNameToStore);
        }

    }
        Session::flash('success', 'Images uploaded successfully');
        return redirect()->route('galleries.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Gallery $gallery
     * @return Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Gallery $gallery
     * @return Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Gallery $gallery
     * @return Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gallery $gallery
     * @return Response
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        Storage::delete('public/galleries'.$gallery->image_url);

        //Delete data from table
        $gallery->delete();
        Session::flash('success', 'Image Deleted successfully');
        return redirect()->route('galleries.index');
    }
}
