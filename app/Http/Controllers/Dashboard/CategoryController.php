<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\CategoryDepartment;
use App\Models\Department;
use App\Services\Dashboard\CategoriesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(protected CategoriesService $categoriesService)
    {
        //  
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard.categories.index', ['categories' => $this->categoriesService->getCategories()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.categories.create', $this->categoriesService->getDataForCreate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->categoriesService->create($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return to_route('dashboard.categories.index')->with('success', 'add new category successfly');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('dashboard.categories.edit', $this->categoriesService->getDataForUpdate($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $path = $this->categoriesService->update($category, $request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        $this->removeImage($path);
        return to_route('dashboard.categories.index')->with('success', 'updated the category successfly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->categoriesService->delete($category);
        return to_route('dashboard.categories.index')->with('success', 'deleted this category saccessfly and put in trash');
    }
    public function trash(): View
    {
        return view('dashboard.categories.trash', [
            'categories' => $this->categoriesService->getTrashedCategories(),
        ]);
    }
    public function restore(string $id): RedirectResponse
    {
        $this->categoriesService->restore($id);
        return redirect()->route('dashboard.categories.index')->with('success', 'restore this category successfly');
    }
    public function forceDelete(string $id): RedirectResponse
    {

        DB::beginTransaction();
        try {
            $path = $this->categoriesService->forceDelete($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        $this->removeImage($path);
        return redirect()->route('dashboard.categories.index')->with('success', 'deleted this category successfly');
    }
    protected function removeImage(string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
