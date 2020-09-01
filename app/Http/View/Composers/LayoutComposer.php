<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Admin\Category;

class LayoutComposer
{
    public function compose(View $view)
    {
        $data['headerCategories'] = Category::with('subCategories')->get();
        $view->with($data);
    }
}
