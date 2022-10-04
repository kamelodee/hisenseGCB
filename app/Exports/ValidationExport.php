<?php

namespace App\Exports;

use App\Models\ValidateOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ValidationExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

   

    public function headings():array{
        return[
            'CONTAINER NO.',
            'SIZE',
            'FROM',
            'TO LOC',
            'RATE(GHS)' 
        ];
    } 
    public function array(): array
    {
        return $this->invoices;
    }
   
}
