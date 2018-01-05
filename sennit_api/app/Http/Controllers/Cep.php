<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Utils\UtilsConsulta;

class Cep extends Controller
{

    public function search($cep)
    {
        $endpoint = "https://viacep.com.br/ws/{$cep}/json/";

        $response = \Unirest\Request::get($endpoint);

        $data = $response->code == 200 ? (array) $response->body : [];
        
        if (!empty($data)) {
            UtilsConsulta::createQueryDataBase($data);
        }

        return response()->json($data, $response->code);
    }

    public function destroy($cep)
    {
        UtilsConsulta::deleteCepDataBase($cep);

        return response()->json("CEP Deletado: $cep");
    }

    public function listAllCep()
    {
        return response()->json(UtilsConsulta::getCepDataBaseAll());
    }

}
