<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['name'] === null || $row['name'] === '')
            return;
        else return new Company([

            'name' => $row['name'] ?? '',
            'address' => $row['address'] ?? '',
            'postcode' => $row['postcode'] ?? '',
            'facebook' => $row['facebook'] ?? '',
            'linkedin' => $row['linkedin'] ?? '',
            'twitter' =>  $row['twitter'] ?? '',
            'instagram' => $row['instagram'] ?? '',
            'category' => $row['category'] ?? '',
            'association' => $row['association'] ?? '',
            'description' => $row['description'] ?? '',
            'website' => $row['website'] ?? '',
            'mail' => $row['mail'] ?? '',
            'tel' => $row['tel'] ?? '',
            'activity' => $row['activity'] ?? '',
            'fund_raising' => $row['fund_raising'] ?? '',
            'employees' => $row['employees'] ?? '',
            'recrutement' => $row['recrutement'] ?? '',
            'women' => $row['women']  ?? '',
            'ca' =>  $row['ca']  ?? '',
            /* 'logo'=> $row['logo'], */

        ]);
    }



    /*  public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            company::create([
                'name' => $row[0] || '',
                'address' => $row[1] || '',
                'postcode' => $row[2] || '',
                'facebook' => $row[3] || '',
                'linkedin' => $row[4] || '',
                'twitter' =>  $row[5] || '',
                'instagram' => $row[6] || '',
                'category' => $row[7] || '',
                'association' => $row[8] || '',
                'description' => $row[9] || '',
                'website' => $row[10] || '',
                'mail' => $row[11] || '',
                'tel' => $row[12] || '',
                'activity' => $row[13] || '',
                'fund_raising' => $row[14] || '',
                'employees' => $row[15] || '',
                'recrutement' => $row[16] || '',
                'women' => $row[17]  || '',
                'ca' =>  $row[18]  || '',
                /* 'logo'=> $row['logo'], */
    //         ]);
    //     }
    // }
}
