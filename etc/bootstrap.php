<?php
$env = '';
if (array_key_exists('APP_ENV', $_SERVER)) {
	$env = $_SERVER['APP_ENV'];
}
if ($env == '') {
	$env = getenv('APP_ENV');
}
if ($env == '') {
	$env = 'local';
}
_set('env', $env);

_iCanHandle('analyze',   'metrofw/analyzer.php');
_iCanHandle('analyze',   'metrofw/router.php', 3);
_iCanHandle('resources', 'metrofw/output.php');
_iCanHandle('output',    'metrofw/output.php');
//will be removed if output.php doesn't think we need HTML output
_iCanHandle('output',    'metrofw/template.php', 3);
//_iCanHandle('template.main',    'template/rain.php::templateMain', 3);
//_iCanHandle('template.main',    'template/rain.php::template', 3);

_iCanHandle('template.sparkmsg',    'main/usermsg.php::template', 3);

_iCanHandle('exception', 'metrofw/exdump.php::onException');
_iCanHandle('hangup',    'metrofw/output.php');

_didef('request',        'metrofw/request.php');
_didef('response',       'metrofw/response.php');
_didef('router',         'metrofw/router.php');

//_didef('loggerService',  (object)array());

//metrodb
_didef('dataitem', 'metrodb/dataitem.php');
#Metrodb_Connector::setDsn('default', 'mysql://root:mysql@127.0.0.1:3306/metrodb_test');
//end metrodb

//metrou
#_iCanHandle('authenticate', 'metrou/authenticator.php');
#_iCanHandle('authorize',    'metrou/authorizer.php::requireLogin');

//events
#_iCanHandle('access.denied',        'metrou/login.php::accessDenied');
#_iCanHandle('authenticate.success', 'metrou/login.php::authSuccess');
#_iCanHandle('authenticate.failure', 'metrou/login.php::authFailure');

//things
_didef('user',           'metrou/user.php');
#_didef('session',        'metrou/sessiondb.php');
_didef('session',        'metrou/sessionsimple.php');
//end metrou

//_didef('taxcalc',  'utils/taxcaclculatorv1.php');
//_didef('taxcalc',  '\FER\Utils\Taxcalculator');

if ($env == 'production') {
	_set('memcache', '74.207.225.177:11211');
} else {
	$listMemcache = @include('etc/memcache.local.php');
	foreach ($listMemcache as $hostandport) {
		_set('memcache', $hostandport);
	}
}


_set('template_basedir', 'templates/');
_set('template_baseuri', 'templates/');
_set('template_name',    'selfsign01');
_set('site_title',       'Hello Metro');

_set('route_rules',  array() );

_set('route_rules',
	array_merge(array('/:appName'=>array( 'modName'=>'main', 'actName'=>'main' )),
	_get('route_rules')));

_set('route_rules',
	array_merge(array('/:appName/:modName'=>array( 'actName'=>'main' )),
	_get('route_rules')));

_set('route_rules',
	array_merge(array('/:appName/:modName/:actName'=>array(  )),
	_get('route_rules')));

_set('route_rules',
	array_merge(array('/:appName/:modName/:actName/:arg'=>array(  )),
	_get('route_rules')));
