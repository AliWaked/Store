<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\Dashboard\DepartmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DepartmentsController extends Controller
{
    public function __construct(protected DepartmentService $departmentService)
    {
        //
    }

    public function index(): View
    {
        return view('dashboard.department.index', $this->departmentService->getDepartments());
    }

    public function create(): View
    {
        return view('dashboard.department.create');
    }

    public function store(DepartmentRequest $request): RedirectResponse
    {
        $this->departmentService->create($request->all());
        return Redirect::route('dashboard.departments.index')->with('success', 'success to add new department');
    }

    public function edit(Department $department): View
    {
        return view('dashboard.department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $this->departmentService->update($department, $request->all());
        return Redirect::route('dashboard.departments.index')->with('success', 'update the department successfly');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $this->departmentService->delete($department);
        return to_route('dashboard.departments.index')->with('delete', 'the department has been deleted and put in the trash');
    }

    public function trash(): View
    {
        return view('dashboard.department.trash', [
            'departments' => $this->departmentService->getTrashDepartment()
        ]);
    }

    public function restore(string $id): RedirectResponse
    {
        $this->departmentService->restore($id);
        return to_route('dashboard.departments.index')->with('success', 'restore the department succesfly');
    }

    public function forceDelete(string $id): RedirectResponse
    {
        $this->departmentService->forceDelete($id);
        return to_route('dashboard.departments.index')->with('delete', 'the department has been permanently deleted');
    }

    public function getCategories(Department $department)
    {
        return $department->categories;
    }
}
