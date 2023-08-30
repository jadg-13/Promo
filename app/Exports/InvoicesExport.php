<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    protected $registros;
    protected $headers;

    public function __construct($registros, $headers)
    {
        $this->registros = $registros;
        $this->headers = $headers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->registros, $this->headers);
    }

    public function headings(): array
    {
        return $this->headers;
    }
}
