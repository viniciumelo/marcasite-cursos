<?php

namespace App\Exports;

use App\Models\Aluno;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersFromView implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Aluno::all();
    }
}
