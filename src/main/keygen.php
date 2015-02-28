<?php

class Main_Keygen
{
	/**
	 * Load a file from memcache and stream to user
	 */
    public function dlAction() {
		_iCanOwn('output', 'main/keygen.php');
	}

	public function output($response, $session) {
		$key    = 'rootkey';
		$prefix = $session->sessionId;
		$m      = new Memcache(); 

		list($ip, $port) = explode(':', _get('memcache'));
		$m->addServer($ip, $port);
		$x = $m->get( implode('.', [$prefix, $key]));
		if (!$x) {
			$response->statusCode = 500;
			$response->addTo('main', 'Unable to retrieve your root key.  Perhaps it expired.');
			return;
		}
		header('Content-disposition: attachment;filename=selfsignwithus_root_private.key');
		header('Content-type: text/plain');
		echo $x;
	}
}
