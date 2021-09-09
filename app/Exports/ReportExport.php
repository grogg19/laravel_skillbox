<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    public $data;

    public function __construct($data)
    {
        $this->data = new Collection([$data]);
    }

    public function collection()
    {
        return $this->data;
    }
}
