<?php

namespace App\Exports;

use App\FangOwner;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\FangOwner as Fang;
class FangOwnerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fang::all();
    }
}
