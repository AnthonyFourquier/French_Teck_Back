<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyExportpublic implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return   Company::all(['id', 'name', 'address', 'facebook', 'linkedin', 'twitter', 'instagram', 'category', 'association', 'description', 'website', 'mail', 'tel', 'activity']);
    }
}
