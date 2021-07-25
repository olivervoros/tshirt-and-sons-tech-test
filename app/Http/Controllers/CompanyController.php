<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{

    public function all():JsonResponse
    {
        return response()->json(Company::all());
    }
}
