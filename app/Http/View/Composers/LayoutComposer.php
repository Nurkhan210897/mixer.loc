<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Admin\Category;

class LayoutComposer
{
    public function compose(View $view)
    {
        $data['categories'] = Category::with('subCategories')->get();
        $view->with($data);
    }
}
