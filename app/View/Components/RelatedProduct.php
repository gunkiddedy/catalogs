<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class RelatedProduct extends Component
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
        return view('components.related-product');
    }

    public function products()
    {
        // return DB::table('view_images')->orderBy('id', 'desc')->limit(4)->get();
        return DB::table('view_images')->inRandomOrder()->limit(4)->get();
    }
}
