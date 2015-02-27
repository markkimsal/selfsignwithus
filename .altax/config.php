<?php
// Autoloading for plugin command classes.
if (is_file(__DIR__ . '/vendor/autoload.php')) require_once __DIR__ . '/vendor/autoload.php';

// ***************************************************************
// Server definition.
// ***************************************************************
//
// Examples:
//
//   Server::node("web1.example.com", array("web", "production"));
//   Server::node("web2.example.com", array("web", "production"));
//   Server::node("db1.example.com",  array("db", "production"));
//   Server::node("dev1.example.com", "development");
//

// ***************************************************************
// Task definition.
// ***************************************************************
//
// Examples:
//
//   Task::register('hello', function($task){
//
//       $task->writeln("Hello world!");
//
//   });
//
$rev = '0.0.1';

$stage = 'production';
        Server::node("igotaprinter", array(
            'roles'=>array("$stage.web", "$stage.db"),
            "host" => "igotaprinter.org",
            "username" => "deployer",
            "port" => 22,
        ));

Task::register("$stage:deploy", function($task) use($stage, $rev) {
	// Execute parallel processes for each nodes.
	$task->exec(function($process) use ($stage, $rev){

			$vhost    = 'selfsignwith.us';
			$node     = $process->getNode();
			$nodeName = $node->getName();
			$nodeHost = $node->getHost();

			$tarName = "crm_metro-".$rev.".tar.gz";
			$tarTarget = "/tmp/".$tarName;

			$process->runLocally("tar -czf $tarName --exclude=\"artifacts\" --exclude=\".altax/*\" --exclude=\".git\" --exclude=\"node_modules\" --exclude=\"templates/selfsign01/components/\" --exclude=\".gitignore\" src/ etc/ templates/ var/ index.php composer.json composer.lock local");

			$process->runLocally("scp $tarName $nodeHost:$tarTarget");
			$process->run("mkdir -p /var/www/vhosts/$vhost/httpdocs/");
			$process->run("tar -zxf $tarTarget -C /var/www/vhosts/$vhost/httpdocs/");
//			$process->run("chmod go+rx /var/www/vhosts/$vhost/httpdocs/");
//			$process->run("chmod go+r /var/www/vhosts/$vhost/httpdocs/* -R");

			//nginx
/*
			$sitesAvailable = '/etc/nginx/sites-available';
			$sitesEnabled   = '/etc/nginx/sites-enabled';
			$process->run("rm -Rf /etc/nginx/sites-enabled/$vhost*.conf");
*/
/*
			$process->run("cp $sitesAvailable/fireworks.template /etc/nginx/sites-available/fireworks.$rev");
			$process->run("sed -ie \"s/REVISION/$rev/g\" $sitesAvailable/fireworks.$rev");
			$process->run("sed -ie \"s/APP_STAGE/$stage/g\" $sitesAvailable/fireworks.$rev");
			$process->run("ln -sf $sitesAvailable/fireworks.$rev $sitesEnabled/fireworks.$rev");
			$process->run("nginx -s reload");
*/
	}, array("$stage.web"));

});
