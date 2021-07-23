<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{

    public function all()
    {
        return Company::all();
    }
}
