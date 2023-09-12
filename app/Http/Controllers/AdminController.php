<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificacionCorreo;
use App\Models\Invoice;

class AdminController extends Controller
{

    public function showCustomers()
    {
        if (session()->has('user_id')) {
            /*$datos = DB::table('invoices')
                ->join('customers', 'invoices.id_customer', '=', 'customers.id')
                ->select('invoices.id', 'invoices.first_name', 'invoices.second_name', 'invoices.identification', 'customers.email', 'invoices.phone', 'invoices.invoice_number', 'invoices.code', 'invoices.phone', 'invoices.point_sale', 'invoices.image', 'invoices.created_at')
                ->get();
*/
            $datos = Invoice::all();
           // return $datos;
            return view('admon.customers', compact('datos'));
        }
        return view('customers.login');
    }

    public function showCustomersBy(Request $request)
    {
        $filtro = $request->input('filter');
        $datos = DB::table('invoices')
            ->join('customers', 'invoices.id_customer', '=', 'customers.id')
            ->select('invoices.id', 'invoices.first_name', 'invoices.second_name', 'invoices.identification', 'customers.email', 'invoices.phone', 'invoices.invoice_number', 'invoices.code', 'invoices.phone', 'invoices.point_sale', 'invoices.image', 'invoices.created_at')
            ->where('invoices.first_name', 'LIKE', "%$filtro%")
            ->orwhere('invoices.second_name', 'LIKE', "%$filtro%")
            ->orwhere('invoices.identification', 'LIKE', "%$filtro%")
            ->orwhere('customers.email', 'LIKE', "%$filtro%")
            ->orWhere('invoices.phone', 'LIKE', "%$filtro%")
            ->orWhere('invoices.invoice_number', 'LIKE', "%$filtro%")
            ->orWhere('invoices.code', 'LIKE', "%$filtro%")
            ->orWhere('invoices.point_sale', 'LIKE', "%$filtro%")
            ->orwhere('invoices.created_at', 'LIKE', "%$filtro%")
            ->get();
        return view('admon.customers', compact('datos'));
    }

    public function export(Request $request)
    {
        $filtro = $request->input('filtro');
        $datos = DB::table('invoices')
            ->join('customers', 'invoices.id_customer', '=', 'customers.id')
            ->select('invoices.id', 'invoices.first_name', 'invoices.second_name', 'invoices.identification', 'customers.email', 'invoices.phone', 'invoices.invoice_number', 'invoices.code', 'invoices.phone', 'invoices.point_sale', 'invoices.image', 'invoices.created_at')
            ->where('invoices.first_name', 'LIKE', "%$filtro%")
            ->orwhere('invoices.second_name', 'LIKE', "%$filtro%")
            ->orwhere('invoices.identification', 'LIKE', "%$filtro%")
            ->orwhere('customers.email', 'LIKE', "%$filtro%")
            ->orWhere('invoices.phone', 'LIKE', "%$filtro%")
            ->orWhere('invoices.invoice_number', 'LIKE', "%$filtro%")
            ->orWhere('invoices.code', 'LIKE', "%$filtro%")
            ->orWhere('invoices.point_sale', 'LIKE', "%$filtro%")
            ->orWhere('invoices.created_at', 'LIKE', "%$filtro%")
            ->get();
        $rutaImagenes = public_path('images/');
        foreach ($datos as $registro) {
            $registro->image = $rutaImagenes . $registro->image;
        }
        $columnHeaders = [
            'ID', 'Nombres', 'Apellidos', 'Identificacion', 'Email', 'Teléfono', 'Factura', 'Código', 'Punto de venta', 'Imagen', 'Fecha de Registro'
        ];
        return Excel::download(new InvoicesExport($datos, $columnHeaders), 'Clientes.xlsx');
    }

    public function add()
    {
        return view('admon.add');
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $existe = Customer::where('email', 'LIKE', "$email")->first();

        if ($existe) {
            $mensaje = 'El email fue registrado anteriormente.';
            session()->flash('error_message', $mensaje);
            return redirect()->back()
                ->withInput();
        }
        // Crear el usuario en la base de datos
        $customer = new Customer();
        $customer->email = $request->email;
        $codigoVerificacion = mt_rand(100000, 999999);
        $customer->code_mail = "";//$codigoVerificacion;
        $customer->rol = 'admin';
        $customer->save();
        //Mail::to($request->email)->send(new VerificacionCorreo($codigoVerificacion));
        // Redirige al usuario a una página de éxito o muestra un mensaje
        $mensaje = 'Registro guardado.';
        session()->flash('success_message', $mensaje);
        return redirect()->back()
            ->withInput();
    }

    public function showUsers(Request $request)
    {
        $filtro = $request->input('filter');
        $datos = Customer::where('email', 'LIKE', "%$filtro%")
            ->where('rol', 'LIKE', 'admin')
            ->get();
        return view('admon.users', compact('datos'));
    }

    public function showUsersExport(Request $request)
    {
        $filtro = $request->input('filtro');
       
        $datos = Customer::where('email', 'LIKE', "%$filtro%")
            ->where('rol', 'LIKE', 'admin')
            ->where('code_mail', 'LIKE', "%$filtro%")
            ->get();
        $columnHeaders = [
            'ID', 'EMAIL', 'CODIGO', 'FECHA VERIFICACION', 'ROL', 'FECHA CREACION', 'FECHA ACTUALIZACION'
        ];
        return Excel::download(new InvoicesExport($datos, $columnHeaders), 'Usuarios.xlsx');
    }

}
