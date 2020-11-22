<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create','store']);
        $this->middleware('permission:update_categories')->only(['edit','update']);
        $this->middleware('permission:delete_categories')->only(['destroy']);
    }


    public function index(Request $request)
    {
        $categories = Category::whenSearch($request->search)->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }


    public function create(Request $request)
    {
        return view('dashboard.categories.create');
    }


    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->all());

        $request->session()->flash('success', __('site.add_success'));

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }


    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update($request->all());

        $request->session()->flash('success', __('site.update_success'));

        return redirect()->route('categories.index');
    }


    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $request->session()->flash('success', __('site.delete_success'));

        return redirect()->route('categories.index');
    }
}
