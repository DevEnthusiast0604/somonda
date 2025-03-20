<?php

namespace App\Exports;

use App\Models\Tariff;
use Maatwebsite\Excel\Concerns\FromCollection;

class TariffcodeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tariff::all();
    }
}
