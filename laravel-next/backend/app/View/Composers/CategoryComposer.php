<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{

    public function compose(View $view)
    {
        $view->with('kategorilerOptions', Category::where('status', 1)->pluck('ad', 'id'));
    }
}
