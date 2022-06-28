<?php

namespace App\Http\Controllers;


use App\Repositories\CategoriesRepository;
use App\Repositories\GalleriesRepository;
use App\Repositories\PostsRepository;
use App\Repositories\SubCategoriesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    private $subcategoryRepository;
    private $categoryRepository;
    private $galleryRepository;
    private $postRepository;
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostsRepository $postsRepository
     * @param CategoriesRepository $categoriesRepository
     * @param UsersRepository $usersRepository
     * @param GalleriesRepository $galleriesRepository
     * @param SubCategoriesRepository $subCategoriesRepository
     */
    public function __construct(PostsRepository $postsRepository, CategoriesRepository $categoriesRepository, UsersRepository $usersRepository, GalleriesRepository $galleriesRepository,SubCategoriesRepository $subCategoriesRepository)
    {
        $this->middleware(['auth', 'verified']);

        $this->subcategoryRepository = $subCategoriesRepository;
        $this->categoryRepository = $categoriesRepository;
        $this->galleryRepository = $galleriesRepository;
        $this->postRepository = $postsRepository;
        $this->userRepository = $usersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole(Role::all())) {
            $newPost = $this->postRepository->countNew(Session::get('last_login'));
            $AllPost = $this->postRepository->countAll();
            $newCategory = $this->categoryRepository->countNew(Session::get('last_login'));
            $AllCategory = $this->categoryRepository->countAll();
            $newUser = $this->userRepository->countNew(Session::get('last_login'));
            $AllUsers = $this->userRepository->countAll();
            $newImages = $this->galleryRepository->countNew(Session::get('last_login'));
            $AllImages = $this->galleryRepository->countAll();
            $categories = $this->categoryRepository->getByLimit(3);
            $posts = $this->postRepository->getByLimit(3);
            $count = [
                'newPost' => $newPost,
                'allPost' => $AllPost,
                'newCategory' => $newCategory,
                'allCategory' => $AllCategory,
                'newUser' => $newUser,
                'allUser' => $AllUsers,
                'newImage' => $newImages,
                'allImage' => $AllImages,
            ];
            return view('home', compact('count', 'posts', 'categories'));
        } else {
            return redirect()->route('user.dashboard');
        }
    }
}
