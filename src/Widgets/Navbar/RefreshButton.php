<?php

namespace Hahadu\ThinkAdmin\Widgets\Navbar;

use Hahadu\ThinkAdmin\Admin;
use Hahadu\ThinkAdmin\Contract\Renderable;

class RefreshButton implements Renderable
{
    public function render()
    {
        return Admin::component(admin_view_path('admin.components.refresh-btn'));
    }
}
