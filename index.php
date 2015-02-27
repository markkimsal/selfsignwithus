<?php
date_default_timezone_set('UTC');
$metrofw_start = microtime(true);

if (!@include ('local/metrodi/container.php')) {
	header('HTTP/1.1 500 Internal Server Error');
	echo 'System startup failure.  Incomplete dependencies.';
	exit();
}
if (!@include ('local/metrofw/kernel.php')) {
	header('HTTP/1.1 500 Internal Server Error');
	echo 'System startup failure.  Incomplete dependencies.';
	exit();
}

//use different search dirs
// $dirs = array('vendor', 'src', '.');
//$container = Metrodi_Container::getContainer($dirs);

$container = Metrodi_Container::getContainer();
$kernel    = new Metrofw_Kernel($container);
_didef('kernel',    $kernel);
_didef('container', $container);

if(!include('etc/bootstrap.php')) {
	echo "please setup your etc/bootstrap.php file.";
	exit();
}

include ('local/autoload.php');

$kernel->runMaster();

