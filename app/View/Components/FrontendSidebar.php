<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class FrontendSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.frontend-sidebar');
    }

    public function minPrice()
    {
        return DB::table('products')->min('price');
    }

    public function maxPrice()
    {   
        return DB::table('products')->max('price');
    }

    public function category()
    {
        return DB::table('categories')->get();
    }

    public function subcategory()
    {
        return DB::table('subcategories')->get();
    }

    public function brands()
    {
        return \App\Product::all()->take(7);
    }
}
