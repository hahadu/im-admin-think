<?php

namespace Hahadu\ThinkAdmin;

use Closure;
use Hahadu\ThinkAdmin\model\Users;
use Hahadu\ThinkAdmin\Traits\ThinkAdminAssets;
use Hahadu\ThinkAdmin\Layout\Content;
use think\facade\Route;
use think\facade\Session;

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

    public function user(){
        return Users::findorFail(Session::get('user.id'));
    }
    /**
     * Get navbar object.
     *
     * @return
     */
    public function getNavbar()
    {
        if (is_null($this->navbar)) {
            $this->navbar = null;
        }

        return $this->navbar;
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

}