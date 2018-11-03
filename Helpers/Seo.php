<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 03:35 م
 */

if (!function_exists("seoViewer")) {
    /**
     * @return \Glib\SEO\SEOViewer
     */
    function seoViewer()
    {
        return \Glib\SEO\SEOViewer::getInstance();
    }
}