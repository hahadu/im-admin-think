<?php

namespace Hahadu\ThinkAdmin;

use Closure;
use Hahadu\Helper\HttpHelper;
use Hahadu\ThinkAdmin\Layout\MessageBag;
use Hahadu\ThinkAdmin\model\Users;
use Hahadu\ThinkAdmin\Traits\ThinkAdminAssets;
use Hahadu\ThinkAdmin\Layout\Content;
use think\facade\Config;
use think\facade\Route;
use think\facade\Session;
use Hahadu\ThinkAdmin\model\AdminNav;
use think\helper\Arr;
use think\Model;
use Hahadu\ThinkAdmin\Widgets\Navbar;
use think\helper\Str;


class Admin
{

    use ThinkAdminAssets;


    /**
     * The think admin version.
     *
     * @var string
     */
    public const VERSION = '2.0.0';

    /**
     * @var Navbar
     */
    protected $navbar;

    /**
     * @var array
     */
    protected $menu = [];

    /**
     * @var string
     */
    public static $metaTitle;

    /**
     * @var string
     */
    public static $favicon;

    /**
     * @var array
     */
    public static $extensions = [];

    /**
     * @var []Closure
     */
    protected static $bootingCallbacks = [];

    /**
     * @var []Closure
     */
    protected static $bootedCallbacks = [];

    /**
     * Returns the long version of think-admin.
     *
     * @return string The long application version
     */
    public static function getLongVersion()
    {
        return sprintf('think-admin <comment>version</comment> <info>%s</info>', self::VERSION);
    }

    public function content(Closure $callable = null)
    {
        return new Content($callable);
    }

    /**
     * Set admin title.
     *
     * @param string $title
     *
     * @return void
     */
    public static function setTitle($title)
    {
        self::$metaTitle = $title;
    }

    /**
     * Get admin title.
     *
     * @return string
     */
    public function title()
    {
        return self::$metaTitle ? self::$metaTitle : config('admin.title');
    }

    /******
     * @return Model
     */
    public function user(){
        return Config::get('login.user_model',Users::class)::findorFail(Session::get('user.id'));
    }
    /**
     * Set navbar.
     *
     * @param Closure|null $builder
     *
     * @return Navbar
     */
    public function navbar(Closure $builder = null)
    {
        if (is_null($builder)) {
            return $this->getNavbar();
        }

        call_user_func($builder, $this->getNavbar());
    }

    /**
     * Get navbar object.
     *
     * @return
     */
    public function getNavbar()
    {
        if (is_null($this->navbar)) {
            $this->navbar = new Navbar();
        }

        return $this->navbar;
    }
    /**
     * Left sider-bar menu.
     *
     * @return array|\Hahadu\DataHandle\Data
     */
    public function menu()
    {
        if (!empty($this->menu)) {
            return $this->menu;
        }

        $menuClass = config('admin.database.menu_model',AdminNav::class);

        /** @var AdminNav $menuModel */
        $menuModel = new $menuClass();

        return $this->menu = $menuModel->getTreeData('level','order_by,id');
    }
    /**
     * @param array $menu
     *
     * @return array
     */
    public function menuLinks($menu = [])
    {
        if (empty($menu)) {
            $menu = $this->menu();
        }

        $links = [];

        foreach ($menu as $item) {
            if (!$item['_child']->isEmpty()) {
                $links = array_merge($links, $this->menuLinks($item['_child']));
            } else {
                $links[] = Arr::only($item, ['name', 'url', 'icon']);
            }
        }

        return $links;
    }

    /**
     * @param null|string $favicon
     *
     * @return string|void
     */
    public function favicon($favicon = null)
    {
        if (is_null($favicon)) {
            return static::$favicon;
        }

        static::$favicon = $favicon;
    }
    /**
     * Register the think-admin builtin routes.
     *
     * @return void
     */
    public function routes()
    {

    }

    /**
     * Extend a extension.
     *
     * @param string $name
     * @param string $class
     *
     * @return void
     */
    public static function extend($name, $class)
    {
        static::$extensions[$name] = $class;
    }

    /**
     * @param callable $callback
     */
    public static function booting(callable $callback)
    {
        static::$bootingCallbacks[] = $callback;
    }

    /**
     * @param callable $callback
     */
    public static function booted(callable $callback)
    {
        static::$bootedCallbacks[] = $callback;
    }

    /******
     * @param $path
     * @return bool
     */
    public function isValidUrl($path){
        return HttpHelper::isValidUrl($path);
    }

    /**
     * Flash a message bag to session.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     */
    public static function admin_info(string $title, string $message = '', string $type = 'info')
    {
        $message = new MessageBag(get_defined_vars());

        session()->flash($type, $message);
    }


}