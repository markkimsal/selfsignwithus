<?php

class Main_Main 
{
    public function keygenAction($request, $response)
    {
        $bits = $request->cleanString('keygen-bits');
        $type = $request->cleanString('keygen-type');

		if ($type != 'rsa' && $type != 'dsa') {
			$type = 'rsa';
		}

		if ($bits != '2048' && $bits != '1024') {
			$bits = '2048';
		}

		//openssl genpkey -out foo_rsa.key -algorithm RSA -pkeyopt rsa_keygen_bits:2048
		//openssl genpkey -out foo_rsa.key -algorithm DSA -pkeyopt rsa_paramgen_bits:2048
		$keygen  = 'openssl genpkey -algorithm '.strtoupper($type).' -pkeyopt rsa_keygen_bits:'.$bits;
		$output = array();
		$retvar = 0;
		exec( escapeshellcmd($keygen), $output, $retvar);

		$response->retvar = $retvar;

        $response->addTo('keygen', $keygen);
	}

    public function csrAction($request, $response)
    {
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
		if ($domain  = $request->cleanString('csr-dom')) {
			$listDn['CN'] = trim($domain);
		}

		foreach ($listDn as $_k => $_v) {
			$subject .= '/'.$_k.'='. $_v;
		}

		if (strlen($subject)) {
			$subject = ' -subj '.escapeshellarg($subject);
		}

		//openssl req -new -nodes -out test.csr -keyout test.key -batch -subj /C=US/ST=MI/O=selfsignwith.us/CN=www.selfsignwith.us -newkey 'rsa':'2048'

        $keygen  = 'openssl req -new -nodes -out test.csr -keyout test.key';
		$keygen .= $subject;
		$keygen .= ' -newkey ' . escapeshellarg($type) . ':' . escapeshellarg($bits);
		$output = array();
		$retvar = 0;
		//exec($keygen, $output, $retvar);

		$response->retvar = $retvar;

        $response->addTo('keygen', $keygen);    
//        $response->addTo('keygen', $output);
    }
}
