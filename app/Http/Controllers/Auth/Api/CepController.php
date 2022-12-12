<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CepController extends Controller
{
    public function getCep(Request $request)
    {
        $url = sprintf('http://cep.correiocontrol.com.br/%s.json', $request->get('cep'));
        $json = json_decode(file_get_contents($url), true);

        return Response::json($json);
    }
}
