<?php

namespace App\Services\Dashboard;

use App\Models\Category;
use App\Models\CategoryDepartment;
use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesService
{
    /**
     * Get All Active Categories
     *
     * @return LengthAwarePaginator
     */
    public function getCategories(): LengthAwarePaginator
    {
        return Category::withCount(['products'])->paginate();
    }

    /**
     * Get Date For Create New Category
     *
     * @return array
     */
    public function getDataForCreate(): array
    {
        return [
            'categories' => Category::whereNull('parent_id')->get(),
            'departments' => Department::pluck('department_name', 'id')->toArray()
        ];
    }

    /**
     * Create New Category
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        $category = Category::create($this->getHandleData($data));
        CategoryDepartment::insert($this->createDepartmentCategory($data, $category));
        return $category;
    }

    /**
     * Get Data For Update Category
     *
     * @param Category $category
     * @return array
     */
    public function getDataForUpdate(Category $category): array
    {
        return [
            'category' => $category,
            'categories' => Category::whereNull('parent_id')->where('id', '<>', $category->id)->get(),
            'departments' => Department::pluck('department_name', 'id')->toArray(),
            'departmentCategory' => $category->departments()->pluck('department_name', 'id')->toArray(),
        ];
    }

    /**
     * Update Category
     *
     * @param Category $category
     * @param array $data
     * @return string
     */
    public function update(Category $category, array $data): string
    {
        $path = $category->category_logo;
        $data = $this->getHandleData($data);
        $category->update($data);
        // dd('hi');
        $category->departments()->sync($data['department']);
        return Arr::exists($data, 'category_logo') ? $path : '';
    }

    /**
     * Delete Category
     *
     * @param Category $category
     * @return boolean
     */
    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    /**
     * Get Trahed Category
     *
     * @return LengthAwarePaginator
     */
    public function getTrashedCategories(): LengthAwarePaginator
    {
        return Category::onlyTrashed()->paginate(2);
    }

    /**
     * Restore Trahed Category
     *
     * @param string $id
     * @return boolean
     */
    public function restore(string $id): bool
    {
        return Category::onlyTrashed()->findOrFail($id)->restore();
    }

    /**
     * Force Delete Cateogry
     *
     * @param string $id
     * @return string
     */
    public function forceDelete(string $id): string
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return $category->category_logo;
    }

    /**
     * Get handle Data For Create Or Update Category
     *
     * @param array $data
     * @return array
     */
    protected function getHandleData(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);
        if (Arr::exists($data, 'category_logo')) {
            $data['category_logo'] = Storage::disk('public')->append('uploads/categories', $data['category_logo']);
        }
        return $data;
    }

    /**
     * Create Department Category
     *
     * @param array $data
     * @param Category $category
     * @return array
     */
    protected function createDepartmentCategory(array $data, Category $category): array
    {
        foreach ($data['department'] as $department) {
            $values[] = [
                'department_id' => $department,
                'category_id' => $category->id,
            ];
        }
        return $values;
    }
}
