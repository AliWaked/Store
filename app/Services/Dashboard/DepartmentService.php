<?php

namespace App\Services\Dashboard;

use App\Models\Department;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DepartmentService
{
    /**
     * Get Departments
     *
     * @return array
     */
    public function getDepartments(): array
    {
        $departments = Department::withcount(['categories', 'products'])->paginate();
        return ['departments' => $departments];
    }

    /**
     * Create New Department
     *
     * @param array $data
     * @return Department
     */
    public function create(array $data): Department
    {
        return Department::create($this->uploadImage($data));
    }

    /**
     * Update Department Information
     *
     * @param Department $department
     * @param array $data
     * @return boolean
     */
    public function update(Department $department, array $data): bool
    {
        $path = $department->department_logo;
        $bool = $department->update($this->uploadImage($data));
        !($path && Arr::exists($data, 'department_logo')) ?: Storage::disk('public')->delete($path);
        return $bool;
    }

    /**
     * Delete Department
     *
     * @param Department $department
     * @return boolean
     */
    public function delete(Department $department): bool
    {
        return $department->delete();
    }

    /**
     * Get Trashed Department
     *
     * @return Collection
     */
    public function getTrashDepartment(): Collection
    {
        return Department::withCount(['categories', 'products'])->onlyTrashed()->get();
    }

    /**
     * Restore Trashed Department
     *
     * @param string $id
     * @return boolean
     */
    public function restore(string $id): bool
    {
        return Department::onlyTrashed()->findOrFail($id)->restore();
    }

    /**
     * Force Delete Deparment
     *
     * @param string $id
     * @return boolean
     */
    public function forceDelete(string $id): bool
    {
        $bool = ($department = Department::onlyTrashed()->findOrFail($id))->forceDelete();
        !$bool ?: Storage::disk('public')->delete($department['department_logo']);
        return $bool;
    }

    /**
     * Update Department Image
     *
     * @param array $data
     * @return array
     */
    protected function uploadImage(array $data): array
    {
        $data['slug'] = Str::slug($data['department_name']);
        if (Arr::exists($data, 'department_logo')) {
            $data['department_logo'] = Storage::disk('public')->append('/uploads/Departments', $data['department_logo']);
        }
        return $data;
    }
}
