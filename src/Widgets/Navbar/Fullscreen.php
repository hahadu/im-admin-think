<?php

namespace Hahadu\ThinkAdmin\Widgets\Navbar;

use Hahadu\ThinkAdmin\Admin;
use Hahadu\ThinkAdmin\Contract\Renderable;

/**
 * Class FullScreen.
 *
 * @see  https://javascript.ruanyifeng.com/htmlapi/fullscreen.html
 */
class Fullscreen implements Renderable
{
    public function render()
    {
        return Admin::component(admin_view_path('admin.components.fullscreen'));
    }
}
