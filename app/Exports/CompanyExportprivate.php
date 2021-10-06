<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyExportprivate implements FromCollection
{

    public function collection()
    {
        return   Company::all(['id', 'name', 'fund_raising', 'employees', 'recrutement', 'women', 'ca']);
    }
}
