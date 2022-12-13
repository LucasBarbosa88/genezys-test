<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CepController extends Controller
{
    public function getCep(Request $request)
    {
        $cep = preg_replace("/[^0-9]/", "", $request->get('cep'));
        $url = 'http://viacep.com.br/ws/' . $cep . '/json/';
        $json = json_decode(file_get_contents($url), true);
        return $json;
    }
}
