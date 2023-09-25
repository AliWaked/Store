<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.partials.nav', [
            'links' => $this->getLinks(),
        ]);
    }

    protected function getLinks(): array
    {
        return [
            [
                'icon' => 'fa-solid fa-house',
                'title' => 'Dashboard',
                'route' => 'dashboard.dashboard',
                'active' => 'dashboard.dashboard',
            ],
            [
                'icon' => 'fa fa-building',
                'title' => 'Departments',
                'route' => 'dashboard.departments.index',
                'active' => 'dashboard.departments.*',
            ],
            [
                'icon' => 'fa fa-file-circle-plus',
                'title' => 'Add Departments',
                'route' => 'dashboard.department.add',
                'active' => 'dashboard.department.add',
            ],
            [
                'icon' => 'fa-solid fa-network-wired',
                'title' => 'Categories',
                'route' => 'dashboard.categories.index',
                'active' => 'dashboard.categories.*',
            ],
            [
                'icon' => 'fa-regular fa-square-plus',
                'title' => 'Add Category',
                'route' => 'dashboard.category.create',
                'active' => 'dashboard.category.create',
            ],
            [
                'icon' => 'fa-solid fa-cart-shopping',
                'title' => 'Products',
                'route' => 'dashboard.products.index',
                'active' => 'dashboard.products.*',
            ],
            [
                'icon' => 'fa fa-cart-arrow-down',
                'title' => 'Add Product',
                'route' => 'dashboard.product.create',
                'active' => 'dashboard.product.create',
            ],
            [
                'icon' => 'fa-solid fa-bag-shopping',
                'title' => 'Orders',
                'route' => 'dashboard.orders.index',
                'active' => 'dashboard.orders.*',
            ],
            [
                'icon' => 'fa-solid fa-user',
                'title' => 'Users',
                'route' => 'dashboard.users.view',
                'active' => 'dashboard.users.view',
            ],
        ];
    }
}
