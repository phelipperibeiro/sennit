<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Company as Company_Model;

class Company extends Controller
{

    public function search($id)
    {
        return response()->json(Company_Model::findCompanyDataBase($id));
    }

    public function destroy($id)
    {
        Company_Model::deleteCompanyDataBase($id);

        return response()->json("Company Deletada");
    }

    public function create(Request $request)
    {
        Company_Model::addCompanyDataBase($request->all());

        return response()->json("Company add");
    }

    public function update(Request $request, $id)
    {
        Company_Model::updateCompanyDataBase($request->all(), $id);

        return response()->json("Company atualizada");
    }

    public function listAllCompany()
    {
        return response()->json(Company_Model::getCompanyDataBaseAll());
    }

}
