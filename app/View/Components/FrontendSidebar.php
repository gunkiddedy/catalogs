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

    // public function minPrice()
    // {
    //     return DB::table('products')->min('price');
    // }

    // public function maxPrice()
    // {   
    //     return DB::table('products')->max('price');
    // }

    function provinsis()
    {
        return \App\Provinsi::all();
    }

    public function kabupatens()
    {
        return \App\Kabupaten::all();
    }

    public function category()
    {
        return \App\Category::all();
    }

    public function subcategory()
    {
        return \App\SubCategory::all();
    }

    public function brands()
    {
        return \App\Product::all();
    }
}
