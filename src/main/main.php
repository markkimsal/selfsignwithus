<?php

class Main_Main 
{
    public function keygenAction($request, $response)
    {
        $bits = $request->cleanString('keygen-bits');
        $type = $request->cleanString('keygen-type');

        $keygen = 'openssl gen' . $type . ' -out test.key ' . $bits; 
        $response->addTo('keygen', $keygen);    
    }
}
