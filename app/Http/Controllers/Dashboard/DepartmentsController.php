<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryDepartment;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DepartmentsController extends Controller
{
    public function index(): View
    {
        $departments = Department::paginate();
        foreach ($departments as $dept) {
            $numberOfProducts = 0;
            $categories = $dept->categories;
            foreach ($categories as $category) {
                $numberOfProducts += $category->count();
            }
            $categoriesProducts[$categories->count()] = $numberOfProducts;
        }
        return view('dashboard.department.index', ['departments' => $departments, 'categoriesProducts' => $categoriesProducts]);
    }
    public function create(): View
    {
        return view('dashboard.department.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate(Department::rules());
        // $path = Storage::disk('public')->append('/uploads/Departments', $request->file('department-logo'));
        // $data = $request->except('department-logo');
        // $data['department-logo'] = $path;
        Department::create($this->uploadImage($request));
        return Redirect::route('dashboard.departments.index')->with('success', 'success to add new department');
    }
    public function delete($id)
    {
        Department::findOrFail($id)->delete();
        return to_route('dashboard.departments.index')->with('delete', 'the department has been deleted and put in the trash');
    }
    public function trash()
    {
        $departments = Department::onlyTrashed()->get();
        return view('dashboard.department.trash', compact('departments'));
    }
    public function restore($department)
    {
        // dd($department);
        Department::onlyTrashed()->findOrFail($department)?->restore();
        return to_route('dashboard.departments.index')->with('success', 'restore the department succesfly');
    }
    public function forceDelete($department)
    {
        $bool = ($department = Department::onlyTrashed()->findOrFail($department))?->forceDelete();
        if ($bool) {
            Storage::disk('public')->delete($department['department-logo']);
        }
        return to_route('dashboard.departments.index')->with('delete', 'the department has been permanently deleted');
    }
    public function edit(Department $department)
    {
        // dd($department, $department->slug);
        return view('dashboard.department.edit', compact('department'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $department = Department::findOrFail($id);
        $request->validate(Department::rules($id));
        $path = $department['department-logo'];
        $department->update($this->uploadImage($request));
        $bool = Storage::disk('public')->delete($path);
        return Redirect::route('dashboard.departments.index')->with('success', 'update the department successfly');
    }
    public function uploadImage(Request $request): array
    {
        $request->merge(['slug' => Str::slug($request['department-name'])]);
        $data = $request->except('department-logo');
        $data['department-logo'] = Storage::disk('public')->append('/uploads/Departments', $request->file('department-logo'));
        return $data;
    }
}
