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

        $keygen = 'openssl gen' . escapeshellarg($type) . ' -out test.key ' . escapeshellarg($bits); 
		$output = array();
		$retvar = 0;
		exec($keygen, $output, $retvar);

		$response->retvar = $retvar;

        $response->addTo('keygen', $keygen);    
    }
}
