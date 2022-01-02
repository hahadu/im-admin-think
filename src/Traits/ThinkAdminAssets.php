<?php

namespace Hahadu\ThinkAdmin\Traits;
use think\facade\View;
use Hahadu\Collect\Collection;
trait ThinkAdminAssets
{

    /**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $deferredScript = [];

    /**
     * @var array
     */
    public static $style = [];

    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $js = [];

    /**
     * @var array
     */
    public static $html = [];

    /**
     * @var array
     */
    public static $headerJs = [];

    /**
     * @var string
     */
    public static $manifest = THINK_ADMIN_BASE_RESOURCESPATH.'/minify-manifest.json';

    /**
     * @var array
     */
    public static $manifestData = [];

    /**
     * @var array
     */
    public static $min = [
        'js'  => THINK_ADMIN_BASE_RESOURCESPATH.'/think-admin.min.js',
        'css' => THINK_ADMIN_BASE_RESOURCESPATH.'/think-admin.min.css',
    ];


    /**
     * @var array
     */
    public static $baseCss = [
        THINK_ADMIN_BASE_RESOURCESPATH.'/AdminLTE/bootstrap/css/bootstrap.min.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/font-awesome/css/font-awesome.min.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/think-admin/think-admin.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/nprogress/nprogress.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/sweetalert2/dist/sweetalert2.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/nestable/nestable.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/toastr/build/toastr.min.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/bootstrap3-editable/css/bootstrap-editable.css',
        THINK_ADMIN_BASE_RESOURCESPATH.'/google-fonts/fonts.css',
        THINK_ADMIN_BASE_RESOURCESPATH."/AdminLTE/dist/css/adminlte.min.css",
        THINK_ADMIN_BASE_RESOURCESPATH.'/plugins/fontawesome-free/css/all.min.css',
    //    "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        THINK_ADMIN_BASE_RESOURCESPATH."/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
        THINK_ADMIN_BASE_RESOURCESPATH."/plugins/icheck-bootstrap/icheck-bootstrap.min.css",
        THINK_ADMIN_BASE_RESOURCESPATH."/plugins/jqvmap/jqvmap.min.css",
        THINK_ADMIN_BASE_RESOURCESPATH."/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
        THINK_ADMIN_BASE_RESOURCESPATH."/plugins/daterangepicker/daterangepicker.css",
        THINK_ADMIN_BASE_RESOURCESPATH."/plugins/summernote/summernote-bs4.min.css",

    ];

    /**
     * @var array
     */
    public static $baseJs = [
        THINK_ADMIN_BASE_RESOURCESPATH.'/AdminLTE/bootstrap/js/bootstrap.min.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/AdminLTE/dist/js/app.min.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/jquery-pjax/jquery.pjax.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/nprogress/nprogress.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/nestable/jquery.nestable.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/toastr/build/toastr.min.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/bootstrap3-editable/js/bootstrap-editable.min.js',
        THINK_ADMIN_BASE_RESOURCESPATH.'/sweetalert2/dist/sweetalert2.min.js',
        THINK_ADMIN_BASE_RESOURCESPATH . '/think-admin/think-admin.js',
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/jquery-ui/jquery-ui.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/bootstrap/js/bootstrap.bundle.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/chart.js/Chart.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/sparklines/sparkline.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/jqvmap/jquery.vmap.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/jqvmap/maps/jquery.vmap.usa.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/jquery-knob/jquery.knob.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/moment/moment.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/daterangepicker/daterangepicker.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/summernote/summernote-bs4.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/AdminLTE/dist/js/adminlte.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/AdminLTE/dist/js/demo.js",
        THINK_ADMIN_BASE_RESOURCESPATH . "/AdminLTE/dist/js/pages/dashboard.js",

    ];

    /**
     * @var string
     */
    public static $jQuery = THINK_ADMIN_BASE_RESOURCESPATH.'/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js';

    /**
     * @var array
     */
    public static $minifyIgnores = [];

    /**
     * Add css or get all css.
     *
     * @param null $css
     * @param bool $minify
     * @return array|string
     */
    public static function css($css = null, $minify = true)
    {
        static::ignoreMinify($css, $minify);

        if (!is_null($css)) {
            return self::$css = array_merge(self::$css, (array) $css);
        }

        if (!$css = static::getMinifiedCss()) {
            $css = array_merge(static::$css, static::baseCss());
        }

        $css = array_filter(array_unique($css));

        return View::fetch(admin_view_path('admin.partials.css'), compact('css'));
    }

    /**
     * @param null $css
     * @param bool $minify
     *
     * @return array|null
     */
    public static function baseCss($css = null, $minify = true)
    {
        static::ignoreMinify($css, $minify);

        if (!is_null($css)) {
            return static::$baseCss = $css;
        }

        $skin = config('admin.skin', 'skin-blue-light');

        array_unshift(static::$baseCss, THINK_ADMIN_BASE_RESOURCESPATH."/AdminLTE/dist/css/skins/{$skin}.min.css");

        return static::$baseCss;
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     * @param bool $minify
     * @return array|string
     */
    public static function js($js = null, $minify = true)
    {
        static::ignoreMinify($js, $minify);

        if (!is_null($js)) {
            return self::$js = array_merge(self::$js, (array) $js);
        }

        if (!$js = static::getMinifiedJs()) {
            $js = array_merge(static::baseJs(), static::$js);
        }

        $js = array_filter(array_unique($js));

        return View::fetch(admin_view_path('admin.partials.js'), compact('js'));
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     * @return array|string
     */
    public static function headerJs($js = null)
    {
        if (!is_null($js)) {
            return self::$headerJs = array_merge(self::$headerJs, (array) $js);
        }

        return View::fetch(admin_view_path('admin.partials.js'), ['js' => array_unique(static::$headerJs)]);
    }

    /**
     * @param null $js
     * @param bool $minify
     *
     * @return array|null
     */
    public static function baseJs($js = null, $minify = true)
    {
        static::ignoreMinify($js, $minify);

        if (!is_null($js)) {
            return static::$baseJs = $js;
        }

        return static::$baseJs;
    }

    /**
     * @param string $assets
     * @param bool   $ignore
     */
    public static function ignoreMinify($assets, $ignore = true)
    {
        if (!$ignore) {
            static::$minifyIgnores[] = $assets;
        }
    }

    /**
     * @param string $script
     * @param false $deferred
     * @return array|string
     */
    public static function script($script = '', $deferred = false)
    {
        if (!empty($script)) {
            if ($deferred) {
                return self::$deferredScript = array_merge(self::$deferredScript, (array) $script);
            }

            return self::$script = array_merge(self::$script, (array) $script);
        }

        $script = Collection::make(static::$script)
            ->merge(static::$deferredScript)
            ->unique()
            ->map(function ($line) {
                return $line;
                //@see https://stackoverflow.com/questions/19509863/how-to-remove-js-comments-using-php
                $pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
                $line = preg_replace($pattern, '', $line);

                return preg_replace('/\s+/', ' ', $line);
            });

        return View::fetch(admin_view_path('admin.partials.script'), compact('script'));
    }

    /**
     * @param string $style
     *
     * @return array|string
     */
    public static function style($style = '')
    {
        if (!empty($style)) {
            return self::$style = array_merge(self::$style, (array) $style);
        }

        $style = Collection::make(static::$style)
            ->unique()
            ->map(function ($line) {
                return preg_replace('/\s+/', ' ', $line);
            });

        return View::fetch(admin_view_path('admin.partials.style'), compact('style'));
    }

    /**
     * @param string $html
     *
     * @return array|string
     */
    public static function html($html = '')
    {
        if (!empty($html)) {
            return self::$html = array_merge(self::$html, (array) $html);
        }

        return View::fetch(admin_view_path('admin.partials.html'), ['html' => array_unique(self::$html)]);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    protected static function getManifestData($key)
    {
        if (!empty(static::$manifestData)) {
            return static::$manifestData[$key];
        }

        static::$manifestData = json_decode(
            file_get_contents(public_path(static::$manifest)),
            true
        );

        return static::$manifestData[$key];
    }

    /**
     * @return bool|mixed
     */
    protected static function getMinifiedCss()
    {
        if (!config('admin.minify_assets') || !file_exists(public_path(static::$manifest))) {
            return false;
        }

        return static::getManifestData('css');
    }

    /**
     * @return bool|mixed
     */
    protected static function getMinifiedJs()
    {
        if (!config('admin.minify_assets') || !file_exists(public_path(static::$manifest))) {
            return false;
        }

        return static::getManifestData('js');
    }

    /**
     * @return string
     */
    public function jQuery()
    {
        return static::$jQuery;
    }

    /**
     * @param $component
     * @param array $data
     * @return string
     */
    public static function component($component, array $data = []): string
    {
        $string = View::fetch($component, $data);

        $dom = new \DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$string);
        libxml_use_internal_errors(false);

        if ($head = $dom->getElementsByTagName('head')->item(0)) {
            foreach ($head->childNodes as $child) {
                if ($child instanceof \DOMElement) {
                    if ($child->tagName == 'style' && !empty($child->nodeValue)) {
                        static::style($child->nodeValue);
                        continue;
                    }

                    if ($child->tagName == 'link' && $child->hasAttribute('href')) {
                        static::css($child->getAttribute('href'));
                    }

                    if ($child->tagName == 'script') {
                        if ($child->hasAttribute('src')) {
                            static::js($child->getAttribute('src'));
                        } else {
                            static::script(';(function () {'.$child->nodeValue.'})();');
                        }

                        continue;
                    }
                }
            }
        }

        $render = '';

        if ($body = $dom->getElementsByTagName('body')->item(0)) {
            foreach ($body->childNodes as $child) {
                if ($child instanceof \DOMElement) {
                    if ($child->tagName == 'style' && !empty($child->nodeValue)) {
                        static::style($child->nodeValue);
                        continue;
                    }

                    if ($child->tagName == 'script' && !empty($child->nodeValue)) {
                        static::script(';(function () {'.$child->nodeValue.'})();');
                        continue;
                    }

                    if ($child->tagName == 'template') {
                        $html = '';
                        foreach ($child->childNodes as $childNode) {
                            $html .= $child->ownerDocument->saveHTML($childNode);
                        }
                        $html && static::html($html);
                        continue;
                    }
                }

                $render .= $body->ownerDocument->saveHTML($child);
            }
        }

        return trim($render);
    }
}
