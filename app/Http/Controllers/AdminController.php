<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function showCustomers()
    {
        
        $datos = DB::table('invoices')
            ->join('customers', 'invoices.id_customer', '=', 'customers.id')
            ->select('invoices.id', 'invoices.first_name', 'invoices.second_name', 'invoices.identification', 'customers.email', 'invoices.phone', 'invoices.invoice_number', 'invoices.code', 'invoices.phone', 'invoices.point_sale', 'invoices.image')
            ->get();

        return view('admon.customers', compact('datos'));
    }

    public function showCustomersBy(Request $request){
        $filtro = $request->input('filter');

        $datos = DB::table('invoices')
        ->join('customers', 'invoices.id_customer', '=', 'customers.id')
        ->select('invoices.id', 'invoices.first_name', 'invoices.second_name', 'invoices.identification', 'customers.email', 'invoices.phone', 'invoices.invoice_number', 'invoices.code', 'invoices.phone', 'invoices.point_sale', 'invoices.image')
        ->where('invoices.invoice_number', 'LIKE', "%$filtro%")
        ->get();
        return view('admon.customers', compact('datos'));

    }

    
}
