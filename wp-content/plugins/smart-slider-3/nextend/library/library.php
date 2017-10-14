<?php

function n2_exit($exit = false) {
    N2Pluggable::doAction('exit');
    if ($exit) {
        exit;
    }
}

defined("NDS") || define('NDS', DIRECTORY_SEPARATOR);
defined("N2LIBRARY") || define('N2LIBRARY', dirname(__FILE__));
defined('N2LIBRARYASSETS') || define('N2LIBRARYASSETS', realpath(N2LIBRARY . NDS . '../media'));

defined('N2GSAP') || define('N2GSAP', 1);

function n2_floatval($string) {
    return json_encode(floatval($string));
}

require_once N2LIBRARY . NDS . 'loader.php';

N2Loader::import("platform", "platform");
N2Loader::import("nextend");
N2Loader::import("libraries.filesystem.filesystem");
N2Loader::import('libraries.string');

N2Loader::import("libraries.mvc.base");
N2Loader::import('libraries.session.session');
N2Loader::import('libraries.plugin.plugin');
N2Loader::import('libraries.data.data');
N2Loader::import("libraries.router.router");
N2Loader::import('libraries.request');
N2Loader::import('libraries.ajax.ajax');
N2Loader::import("libraries.helpers.system");
N2Loader::import("libraries.mvc.model");
N2Loader::import("libraries.helpers.html");
N2Loader::import('libraries.storage.section');
N2Loader::import('settings');
N2Loader::import('libraries.localization.localization');
N2Loader::import('libraries.translation.translation');
N2Loader::import('libraries.form.form');
N2Loader::import('libraries.form.form');
N2Loader::import('libraries.plugin.plugin');


N2Loader::import('libraries.fonts.renderer');
N2Loader::import('libraries.stylemanager.renderer');

require_once dirname(__FILE__) . '/applications/system/plugins/loadplugin.php';

N2Loader::import("libraryafter", "platform");

if (defined('NEXTEND_CACHE_STORAGE') && isset($_GET['nextendcache']) && !empty($_GET['g']) && !empty($_GET['k'])) {
    N2Loader::importAll('libraries.cache');

    $sectionStorage = N2Cache::getStorage('database');
    $data           = $sectionStorage->get($_GET['g'], $_GET['k'], 'web');
    if (empty($data)) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }

    if (substr($_GET['k'], -4, 4) == '.css') {
        header("Content-type: text/css", true);
    } else if (substr($_GET['k'], -3, 3) == '.js') {
        header("Content-Type: application/javascript", true);
    }

    echo $data;
    exit;
}