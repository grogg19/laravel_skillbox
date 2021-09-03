<?php

namespace App\Services;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class CreateExcelFile
{
    public function create(FromCollection $data, string $prefixFileName = 'excel'): string
    {
        $fileName =  'download/reports' . DIRECTORY_SEPARATOR . $prefixFileName . '_' .Carbon::now()->format('Y_m_d_H_i_s') . '.xls';

        Excel::store($data, $fileName, 'public');

        return $fileName;
    }
}
