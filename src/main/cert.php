<?php

/**
 * Create device certs and csrs
 */
class Main_Cert
{

	public $ftok = -1;
	public $sem  = NULL;

	/**
	 * Generate CSR and ICA with saved pkey
	 */
	public function mainAction($request, $response, $session) {
		$key      = 'rootkey';
		$prefix   = $session->sessionId;
		$rootkey  = $this->loadFromCache($key, $prefix);
		$rootcert = $this->loadFromCache('rootcert', $prefix);

		//Subject DN
		$subject = '';
		$listDn  = array();
/*
		if ($country  = $request->cleanString('csr-country')) {
			$listDn['C'] = trim($country);
		}

		if ($state  = $request->cleanString('csr-state')) {
			$listDn['ST'] = trim($state);
		}
*/

		if ($org  = $request->cleanString('cert-org')) {
			$listDn['O'] = trim($org);
		}

		//TODO check for http:// and throw an error or strip (the // messed up the DN)
		if ($domain  = $request->cleanString('cert-dom')) {
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
		try {
			$devicecsr  = $this->makeDeviceCsr($subject, $rootkey);
			$devicecert = $this->signDeviceCert($devicecsr, $rootkey, $rootcert);
		} catch (Exception $e) {
			$this->releaseLock();
		}
		if ($this->saveToCache($devicecert, 'devicecert', $prefix)) {
			$response->message = 'saved';
			$response->addTo('main',  'You can download your SSL cert file <a href="'.m_appurl('main/cert/dl').'">here</a>.  This file download will expire in 10 minutes.');
		} else {
			$response->statusCode = 500;
			$response->addTo('main',  'Sorry, an internal error failed to generate your SSL cert.  Please, try again.');
		}
	}

	public function makeDeviceCsr($subject, $rootkey) {
		//openssl req -new -key selfsignwithus_root_private-4.key -nodes -subj '/CN=www.example.com' -out selfsignwithus_root_device_csr.pem
		$command = 'openssl req -new -key /dev/stdin -nodes -subj '.escapeshellarg($subject).' -out /dev/stdout';
		$output = array();
		exec('echo '.escapeshellarg($rootkey).' | '.$command, $output);
		return implode("\n", $output);
	}


	/**
	 * @throws Exception cannot fork bg tasks
	 */
	public function signDeviceCert($csr, $rootkey, $rootcert) {
		if (!strlen($rootkey)) {
			die('no root key');
			return '';
		}
		if (!strlen($rootcert)) {
			die('no root cert');
			return '';
		}
		if (!strlen($csr)) {
			die('no csr');
			return '';
		}

		$this->createFifos();
		$this->blockForLock();

		$output = array();
		$command  = 'openssl x509 -req -CA var/openssl.cert -CAkey var/openssl.key -CAcreateserial -days 730 ';

/*
		echo('echo '.escapeshellarg($rootcert) .' > var/openssl.cert 2>&1 &');
//		echo('echo '.escapeshellarg($rootcert) .' > var/openssl.cert 2>&1 &');
		exec('echo '.escapeshellarg($rootcert) .' > var/openssl.cert 2>&1 &');
//		echo('echo '.escapeshellarg($rootkey) .' > var/openssl.key 2>&1 &');
		exec('echo '.escapeshellarg($rootkey) .' > var/openssl.key 2>&1 &');

//		echo( 'echo '.escapeshellarg($csr).' | '.$command);
		exec( 'echo '.escapeshellarg($csr).' | '.$command, $output);
*/

		$command = './bin/sign_device_cert.php';
		$retval  = 0;
		exec( 'echo '.escapeshellarg($csr."\n".$rootkey."\n".$rootcert."\n").' | '.$command, $output, $retval);
		//echo( 'echo '.escapeshellarg($csr."\n".$rootkey."\n".$rootcert).' | '.$command);
		$this->releaseLock();
		return implode("\n", $output);
	}

	public function createFifos() {
		if (!file_exists('var/openssl.cert')) {
			exec('mkfifo var/openssl.cert');
		}
		if (!file_exists('var/openssl.key')) {
			exec('mkfifo var/openssl.key');
		}

	}

	/**
	 * Acquire a semaphore lock
	 * @throws Exception
	 */
	public function blockForLock() {
		$this->ftok = ftok(__FILE__, 'O');
		$this->sem = sem_get($this->ftok, 1);
		if (!sem_acquire($this->sem)) {
			throw new Exception ('Unable to acquire lock');
		}
	}


	public function releaseLock() {
		if ($this->sem !== NULL)  {
			sem_release($this->sem);
		}
	}

	/**
	 * Load a file from memcache and stream to user
	 */
    public function dlAction() {
		_iCanOwn('output', 'main/cert.php');
	}

	public function output($response, $session) {
		$key    = 'devicecert';
		$prefix = $session->sessionId;
		$m      = new Memcache();

		list($ip, $port) = explode(':', _get('memcache'));
		$m->addServer($ip, $port);
		$x = $m->get( implode('.', [$prefix, $key]));
		if (!$x) {
			$response->statusCode = 500;
			$response->addTo('main', 'Unable to retrieve your device SSL cert.  Perhaps it expired.');
			return;
		}
		header('Content-disposition: attachment;filename=selfsignwithus_device_SSL_certificate.crt');
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
