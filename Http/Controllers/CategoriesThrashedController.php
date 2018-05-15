<?php

namespace CodeEduBook\Http\Controllers;

use App\Http\Controllers\Controller;
use CodeEduBook\Models\Category;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class BooksController
 * @package App\Http\Controllers
 */
class CategoriesThrashedController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * BooksController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->repository->onlyTrashed()->paginate(10);
        return view('codeedubook::thrashed.categories.index', compact('categories', 'search'));
    }

    public function show($id)
    {
        $this->repository->onlyTrashed();
        $category = $this->repository->find($id);

        return view('codeedubook::thrashed.categories.show', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('thrashed.books.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso');

        return redirect()->to($url);
    }
}
