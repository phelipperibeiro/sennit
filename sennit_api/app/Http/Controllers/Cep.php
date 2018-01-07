<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Cep as Cep_Model;

class Cep extends Controller
{

    public function search($cep)
    {
        $endpoint = "https://viacep.com.br/ws/{$cep}/json/";

        $response = \Unirest\Request::get($endpoint);

        $data = $response->code == 200 ? (array) $response->body : [];
        
        if (!empty($data)) {
            Cep_Model::addCepDataBase($data);
        }

        return response()->json($data, $response->code);
    }

    public function destroy($cep)
    {
        Cep_Model::deleteCepDataBase($cep);

        return response()->json("CEP Deletado: $cep");
    }

    public function listAllCep()
    {
        return response()->json(Cep_Model::getCepDataBaseAll());
    }

}
