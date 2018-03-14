<?php
/**
 * Index file.
 * @author TTT [truongtanthanh.info] <truongtanthanh2012@gmail.com>
 * @copyright 2018 TTT Group.
 * @since 1.0
 */

// Define DIRECTORY_SEPARATOR constant
define('DS', DIRECTORY_SEPARATOR);

// Define root path folder
define('DOCROOT', dirname(__FILE__) . DS);

// Define Config path folder
define('CONFIG_PATH', DOCROOT . 'config' . DS);

// Load constants, config file
require_once CONFIG_PATH . 'Constants.php';

require_once CORE_PATH.'App.php';

session_start();

App::loadDir(LIBS_PATH);

// Load library var dump
if (true === DEBUG)
{
    require_once VENDOR_PATH . 'kint' . DS . 'Kint.class' . PHP_EXT;
    // Enable VSDebug (tracy)
	Debug::enable();
}
$version = SBVersion::create(PHP_VERSION);
$versionCompare = SBVersion::create(5.6);
if ($versionCompare >= $version) {
	echo ('Your php version '.SBVersion::curentVersion().' is old.<br>');
	echo ('We need PHP version >=' . $versionCompare->major().'.'.$versionCompare->minor());
	exit();
}

App::autoload();


?>