<?php

namespace Hahadu\ThinkAdmin\Facades;

use Hahadu\ThinkAdmin\Layout\Content;
use think\Facade;
use think\View;

    /**
     * Class Admin.
     *
     * @method static Content content(\Closure $callable = null)
     * @method static View|void css($css = null)
     * @method static View|void js($js = null)
     * @method static View|void headerJs($js = null)
     * @method static View|void script($script = '')
     * @method static View|void style($style = '')
     * @method static string title()
     * @method static void navbar(\Closure $builder = null)
     * @method static void registerAuthRoutes()
     * @method static void extend($name, $class)
     * @method static void disablePjax()
     * @method static void setTitle($string)
     * @method static void booting(\Closure $builder)
     * @method static void booted(\Closure $builder)
     * @method static void bootstrap()
     * @method static void routes()
     * @method static array menuLinks($menu = [])
     *
     * @see
     */
class Admin extends Facade
{

    protected static function getFacadeClass()
    {
        return \Hahadu\ThinkAdmin\Admin::class;
    }
}

