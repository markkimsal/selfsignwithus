<?php

class Main_Csr
{

	/**
	 * Generate CSR and ICA with saved pkey
	 */
	public function mainAction($request, $response, $session) {
		$key     = 'rootkey';
		$prefix  = $session->sessionId;
		$rootkey    = $this->loadFromCache($key, $prefix);

		//Subject DN
		$subject = '';
		$listDn  = array();
		if ($country  = $request->cleanString('csr-country')) {
			$listDn['C'] = trim($country);
		}

		if ($state  = $request->cleanString('csr-state')) {
			$listDn['ST'] = trim($state);
		}

		if ($org  = $request->cleanString('csr-org')) {
			$listDn['O'] = trim($org);
		}

		//TODO check for http:// and throw an error or strip (the // messed up the DN)
		if ($domain  = $request->cleanString('csr-cn')) {
			$listDn['CN'] = trim($domain);
		}

		foreach ($listDn as $_k => $_v) {
			$subject .= '/'.$_k.'='. $_v;
		}
		//TODO:  no subject submitted? don't bother, can't create cert

/*
		if (strlen($subject)) {
			$subject = ' -subj '.escapeshellarg($subject);
		}
*/
		$rootcert = $this->generateRootCert($subject, $rootkey);
		if ($this->saveToCache($rootcert, 'rootcert', $prefix)) {
			$response->message = 'saved';
			$response->addTo('main',  'You can download your root cert file <a href="'.m_appurl('main/csr/dl').'">here</a>.  This file download will expire in 10 minutes.');
			$response->addUserMessage('You can download your root cert file <a href="'.m_appurl('main/csr/dl').'">here</a>.  This file download will expire in 10 minutes.', 'info');
			$response->redir = m_appurl();
		} else {
			$response->statusCode = 500;
			$response->addTo('main',  'Sorry, an internal error failed to generate your root cert.  Please, try again.');
		}
	}

	/**
	 * Load a file from memcache and stream to user
	 */
	public function dlAction() {
		_iCanOwn('output', 'main/csr.php');
	}

	public function output($response, $session) {
		$key    = 'rootcert';
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
		header('Content-disposition: attachment;filename=selfsignwithus_root_certificate.crt');
		header('Content-type: text/plain');
		echo $x;
	}

	public function saveToCache($string, $key, $prefix)
	{
		$m = new Memcache();
		list($ip, $port) = explode(':', _get('memcache'));
		$m->addServer($ip, $port);
		//expire after 10 min
		return $m->set( implode('.', [$prefix, $key]), $string, MEMCACHE_COMPRESSED, 60*10);
	}


	public function generateRootCert($subject, $signkey) {
		//openssl req -x509 -new -nodes -key selfsignwithus_root_private-4.key -days 365 -subj /C=US/O=unit -out /dev/stdout
        $keygen  = 'openssl req -x509 -new -nodes -key /dev/stdin -days 365 -subj '.escapeshellarg($subject); //.' -out /dev/stdout';
		$output = array();
		$retvar = 0;
		$keygen = 'echo -n '.escapeshellarg($signkey).' | '.$keygen;
		exec($keygen, $output, $retvar);
		return implode("\n", $output);
	}

    /**
     * @return mixed  value or FALSE on error
     */
    public function loadFromCache($key, $prefix) {
		$m      = new Memcache();

		list($ip, $port) = explode(':', _get('memcache'));
		$m->addServer($ip, $port);
		return $m->get( implode('.', [$prefix, $key]));
    }
}
