<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CompanyExport;
use App\Exports\CompanyExportprivate;
use App\Exports\CompanyExportpublic;
use App\Imports\CompanyImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{


    public function exportpublic()
    {
        return Excel::download(new CompanyExportpublic, 'company.xlsx');
    }
    public function exportprivate()
    {
        return Excel::download(new CompanyExportprivate, 'company.xlsx');
    }
    public function export()
    {
        return Excel::download(new CompanyExport, 'company.xlsx');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        return Excel::import(new CompanyImport, $file);
    }
}
