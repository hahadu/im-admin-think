<?php

use Hahadu\ThinkAdmin\Admin;
use Hahadu\ThinkAdmin\Layout\MessageBag;
use Hahadu\Helper\HttpHelper;
const THINK_ADMIN_BASE_RESOURCESPATH = '/vendor/think-admin';
if (!function_exists('admin_dump')) {

    /**
     * @param $var
     *
     * @return string
     */
    function admin_dump($var)
    {
        ob_start();

        dump(...func_get_args());

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}

if (!function_exists('admin_success')) {

    /**
     * Flash a success message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_success($title, $message = '')
    {
        admin_info($title, $message, 'success');
    }
}

if (!function_exists('admin_error')) {

    /**
     * Flash a error message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_error($title, $message = '')
    {
        admin_info($title, $message, 'error');
    }
}

if (!function_exists('admin_warning')) {

    /**
     * Flash a warning message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function admin_warning(string $title, string $message = '')
    {
        admin_info($title, $message, 'warning');
    }
}

if (!function_exists('admin_info')) {

    /**
     * Flash a message bag to session.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     */
    function admin_info(string $title, string $message = '', string $type = 'info')
    {
        Admin::admin_info($title,$message,$type);
    }
}

if(!function_exists('admin_resources')){
    /**
     * 模板资源路径
     * @param string $path
     * @return string
     */
    function admin_resources(string $path=''): string
    {
        return dirname(__DIR__).DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR. $path;
    }
}

if(!function_exists('admin_view_path')){
    /**
     * 获取admin模板文件路径
     * @param string $path
     * @return string
     */
    function admin_view_path(string $path=''): string
    {

        $str = '';
        foreach (explode('.', $path) as $v){
            $str .= $v.DIRECTORY_SEPARATOR;
        }
        $str = trim($str,'/').'.html';
        return admin_resources('view/'.$str);
    }
}
if (!function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_base_path(string $path = ''): string
    {
        $prefix = '/'.trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix.'/'.$path;
    }
}
if (!function_exists('admin_path')) {

    /**
     * Get admin path.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_path(string $path = ''): string
    {
        return ucfirst(config('admin.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('admin_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed  $parameters
     * @param bool   $secure
     *
     * @return string
     */
    function admin_url(string $path = '', $parameters = [], $secure = null): string
    {
        if (HttpHelper::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: (config('admin.https') || config('admin.secure'));

        return url(admin_base_path($path), $parameters, $secure);
    }
}
if (!function_exists('admin_trans')) {

    /**
     * Translate the given message.
     *
     * @param string|null $name
     * @param array $vars
     * @param string $lang
     * @return string|null
     */
    function admin_trans(string $name = null, array $vars = [], string $lang = ''): ?string
    {
        $line = __($name, $vars, $lang);

        if (!is_string($line)) {
            return $name;
        }

        return $line;
    }
}

if (! function_exists('__')) {
    /**
     * 获取语言变量值
     * @param string|null $name 语言变量名
     * @param array  $vars 动态变量值
     * @param string $lang 语言
     * @return mixed
     */
    function __(string $name = null, array $vars = [], string $lang = '')
    {
        if (is_null($name)) {
            return $name;
        }

        return lang($name, $vars, $lang);
    }
}


