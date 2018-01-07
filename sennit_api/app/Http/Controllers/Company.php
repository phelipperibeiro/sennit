<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Company as Company_Model;

class Company extends Controller
{

    public function search($data)
    {
       

            UtilsConsulta::createQueryDataBase($data);

        return response()->json($data, $response->code);
    }

    public function destroy($id)
    {
        Company_Model::deleteCompanyDataBase($id);

        return response()->json("Company Deletada: $cep");
    }
    
    public function create(Request $request)
    {   
        Company_Model::addCompanyDataBase($request->all());

        return response()->json("Company add");
    }

    public function listAllCompany()
    {
        return response()->json(Company_Model::getCompanyDataBaseAll());
    }

}
