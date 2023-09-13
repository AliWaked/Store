<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CategoryDepartment;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoies = Category::with(['products'])->paginate();
        return view('dashboard.categories.index', ['categories' => $categoies,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', ['categories' => Category::whereNull('parent_id')->get(), 'departments' => $this->getDepartmentsName()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([...Category::rules(), 'category_logo' => 'required|image|dimensions:min_width=100,min_height=100']);
        $data = $this->uploadImage($request);
        DB::beginTransaction();
        try {
            $category = Category::create($data);
            $this->createDepartmentCategory($data, $category);
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
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->where('id', '<>', $category->id)->get();
        $departments = $this->getDepartmentsName();
        foreach ($category->departments()->get() as $dept) {
            $departmentCategory[] = $dept['department-name'];
        }
        return view('dashboard.categories.edit', compact('category', 'categories', 'departments', 'departmentCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([...Category::rules($category->id), 'category_logo' => 'nullable|image|dimensions:min_width=100,min_height=100']);
        $path = $category->category_logo;
        $data = $this->uploadImage($request);
        DB::beginTransaction();
        try {
            $category->update($data);
            CategoryDepartment::where('category_id', $category->id)->delete();
            $this->createDepartmentCategory($data, $category);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        if ($data['category_logo']) {
            Storage::disk('public')->delete($path);
        }
        return to_route('dashboard.categories.index')->with('success', 'updated the category successfly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('dashboard.categories.index')->with('delete', 'deleted this category saccessfly and put in trash');
    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(2);
        return view('dashboard.categories.trash', compact('categories'));
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('dashboard.categories.index')->with('success', 'restore this category successfly');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        DB::beginTransaction();
        try {
            // Product::where('category_id', $category)->forceDelete();
            CategoryDepartment::where('category_id', $category->id)->delete();
            $category->forceDelete();
        } catch (\Exception $e) {
            DB::commit();
            throw $e;
        }
        Storage::disk('public')->delete($category->category_log);
        return redirect()->route('dashboard.categories.index')->with('delete', 'deleted this category successfly');
    }
    public function uploadImage(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);
        $data = $request->except('category_logo');
        if ($request->hasFile('category_logo')) {
            $data['category_logo'] = Storage::disk('public')->append('uploads/categories', $request->category_logo);
        }
        return $data;
    }
    public function getDepartmentsName()
    {
        $departments = Department::all();
        foreach ($departments as $department) {
            $dept[] = $department['department-name'];
        }
        return $dept;
    }
    public function createDepartmentCategory($data, $category)
    {
        foreach ($data['department'] as $department) {
            CategoryDepartment::create([
                'department_id' => Department::where('department-name', $department)->first()->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
