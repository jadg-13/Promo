<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    //
    public function export(){
        return Excel::download(new InvoicesExport, 'Registros.xlsx');
        }
}
