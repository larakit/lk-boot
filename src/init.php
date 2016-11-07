<?php
use Larakit\Boot;

/*################################################################################
  providers
################################################################################*/
Boot::register_provider(\Larakit\LarakitBootServiceProvider::class);

if(!function_exists('lk_snake')) {
    function lk_snake($value, $delimiter = '_') {
        /**
         *
         * Переопределяем функцию snake из Illuminate\Support\Str для нормальной компиляции bootstrap/cache/compiled.php
         * (это необходимо для того, чтобы класс Str не загружался до подключения скомпилированного файла)
         *
         * @param string $value
         * @param string $delimiter
         *
         * @return string
         */
        if(!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', $value);

            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value));
        }

        return $value;
    }
}

if(!function_exists('lk_studly')) {
    function lk_studly($value) {
        /**
         *
         * Переопределяем функцию snake из Illuminate\Support\Str для нормальной компиляции bootstrap/cache/compiled.php
         * (это необходимо для того, чтобы класс Str не загружался до подключения скомпилированного файла)
         *
         * @param string $value
         *
         * @return string
         */
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}
if(!function_exists('rglob')) {
    function rglob($pattern = '*', $flags = 0, $path = false) {
        if(!$path) {
            $path = dirname($pattern) . DIRECTORY_SEPARATOR;
        }
        $pattern = basename($pattern);
        $paths   = glob($path . '*', GLOB_MARK | GLOB_ONLYDIR | GLOB_NOSORT);
        $files   = glob($path . $pattern, $flags);
        foreach($paths as $path) {
            $files = array_merge($files, rglob($pattern, $flags, $path));
        }

        $files = array_map(function ($v) {
            return str_replace('\\', '/', $v);
        }, $files);

        return $files;
    }
}

if (!function_exists('larasafepath')) {
    function larasafepath($path) {
        $path = str_replace(['\\', '/'], '/', $path);
        $base_path = str_replace(['\\', '/'], '/', base_path());
        $path = str_replace($base_path, '', $path);
        return $path;
    }
}