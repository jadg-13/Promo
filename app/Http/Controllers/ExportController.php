<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CodePromo;
use App\Models\Invoice;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new Invoice, 'Registros.xlsx');
    } 
}
