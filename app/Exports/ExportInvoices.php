<?php
namespace App\Exports;

use App\Models\ValidateOrder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class InvoiceExport implements FromCollection,WithHeadings
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function headings():array{
        return[
            'NO',
            'CONTAINER NO.',
            'LINE',
            'FROM',
            'TO',
            'RATE(GHS)' 
        ];
    } 
    
    

    public function map($bulk): array
    {
        return [
            $bulk->id,
            $bulk->name,
            $bulk->email,
           
        ];
    }
}