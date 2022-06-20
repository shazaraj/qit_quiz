<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return [
            '#',
            'UserID',
            'Result',
            'Wrong Answer',
            'Correct Answer',
            'Create At',
            'Update At'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Result::all();
        return collect(Result::all());
    }
}
