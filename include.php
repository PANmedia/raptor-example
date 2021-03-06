<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

if (is_file(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

define('ROOT', __DIR__ . '/../');
define('BASE_URI', '../../../');
define('RAPTOR_DATA_DIR', __DIR__ . '/data/');
define('RAPTOR_UPLOAD_DIR', __DIR__ . '/data/uploads/');
define('RAPTOR_EXAMPLE_DIR', __DIR__ . '/');
define('RAPTOR_EXAMPLE_URI', BASE_URI . '/raptor-example/');
define('RAPTOR_PARTIALS_DIR', RAPTOR_EXAMPLE_DIR . 'partials/');
define('RAPTOR_PARTIALS_URI', RAPTOR_EXAMPLE_URI . 'partials/');
define('RAPTOR_PACKAGES_URI', BASE_URI . 'packages/');
define('RAPTOR_COMMON_DIR', ROOT . '/raptor-common/');
define('RAPTOR_COMMON_URI', BASE_URI . 'raptor-common/');
define('RAPTOR_EDITOR_DIR', ROOT . '/raptor-editor/');
define('RAPTOR_EDITOR_URI', BASE_URI . 'raptor-editor/');
define('RAPTOR_FILE_MANAGER_DIR', ROOT . '/raptor-file-manager/');
define('RAPTOR_FILE_MANAGER_URI', BASE_URI . 'raptor-file-manager/');
define('RAPTOR_IMAGE_EDITOR_DIR', ROOT . '/raptor-image-editor/');
define('RAPTOR_IMAGE_EDITOR_URI', BASE_URI . 'raptor-image-editor/');
define('RAPTOR_SECTION_DIR', ROOT . '/raptor-section/');
define('RAPTOR_SECTION_URI', BASE_URI . 'raptor-section/');
define('RAPTOR_PREMIUM_DIR', ROOT . '/raptor-premium/');
define('RAPTOR_PREMIUM_URI', BASE_URI . 'raptor-premium/');
define('RAPTOR_DEPENDENCIES_DIR', ROOT . '/raptor-dependencies/');
define('RAPTOR_DEPENDENCIES_URI', BASE_URI . 'raptor-dependencies/');
define('RAPTOR_THEMES_DIR', ROOT . '/raptor-themes/');
define('RAPTOR_THEMES_URI', BASE_URI . 'raptor-themes/');
define('RAPTOR_LOCALES_DIR', ROOT . '/raptor-locales/');
define('RAPTOR_LOCALES_URI', BASE_URI . 'raptor-locales/');

spl_autoload_register(function($class) {
    require_once __DIR__ . '/classes/' . preg_replace('#\\\|_(?!.+\\\)#', '/', $class) . '.php';
});
