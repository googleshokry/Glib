<?php
/**
 * Created by PhpStorm.
 * User: Senior Eng Shokry Back End Develper
 * Date: 20/06/18
 * Time: 12:07 م
 */


if (!function_exists("translation")) {

    function translation($key)
    {
        if (is_array($key)) {
            $data = [];
            foreach ($key as $k => $v) {
                $data[] = __t('admin.' . $v);
            }
            return $data;
        }
        return __t('admin.' . $key);
    }
}


if (!function_exists("__t")) {

    function __t($key, $replace = [], $locale = null)
    {
        $folderPath_ar = '../resources/lang/ar/admin.php';
        $folderPath_en = '../resources/lang/en/admin.php';
        $arr_en = include($folderPath_en);
        $arr_ar = include($folderPath_ar);

        if (is_array($key)) {
            translation($key);
        } elseif (is_string($key)) {
            if (!array_key_exists(explode('.', $key)[1], $arr_en)) {
                $arr_en[explode('.', $key)[1]] = explode('.', $key)[1];
                $contents = var_export($arr_en, true);
                file_put_contents($folderPath_en, "<?php\n return {$contents};\n ?>");
            }
            if (!array_key_exists(explode('.', $key)[1], $arr_ar)) {
                $arr_ar[explode('.', $key)[1]] = explode('.', $key)[1];
                $contents = var_export($arr_ar, true);
                file_put_contents($folderPath_ar, "<?php\n return {$contents};\n ?>");
            }
            return __('admin.'.$key, $replace = [], $locale = null);
        }
        return 'You Have Error in Translation' . $key;
    }
}




