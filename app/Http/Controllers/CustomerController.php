<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificacionCorreo;
use App\Models\Customer;
use App\Models\Invoice;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('customers.login');
    }

    public function invalid()
    {
        return view('customers.invalidcustomer');
    }

    public function confirmcode($id)
    {
        $customer = Customer::find($id);

        return view('customers.confirmcode', compact('customer'));
    }


    public function validatecode(Request $request)
    {

        $id = $request->id;
        $code = $request->codigo;
        $dato = Customer::find($id);

        if ($dato && $dato->code_mail == $code) {

            $valor = now();
            $dato->email_verified_at = $valor;
            $dato->save();
            $dato = $dato->id;
            return redirect()->route('customer.invoices', ['id' => $dato]);
        } else {
            return "Error al validar";
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;

        // Buscar al cliente en la base de datos
        $customer = Customer::where('email', $email)->first();

        if ($customer) {
            
            if (!empty($customer->email_verified_at)) {
                // Las credenciales son correctas, puedes realizar las acciones necesarias aquí
                $dato = $customer->id;
                return redirect()->route('customer.invoices', ['id' => $dato]);
            } else {
                $dato = $customer->id;
                return redirect()->route('customer.confirm', ['id' => $dato]);
            }
        } else {
            return redirect()->route('customer.add');
        }
    }

    public function addCustomer()
    {
        return view('customers.register');
    }

    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email|unique:customers'
        ]);


        // Crear el usuario en la base de datos
        $customer = new Customer();
        $customer->email = $request->email;
        $codigoVerificacion = mt_rand(100000, 999999);
        $customer->code_mail = $codigoVerificacion;
        $customer->save();

        Mail::to($request->email)->send(new VerificacionCorreo($codigoVerificacion));

        // Redirige al usuario a una página de éxito o muestra un mensaje
        return redirect()->back()->with('mensaje', 'Se ha enviado un correo de verificación a tu dirección de correo electrónico.');
    }

    public  function view_invoices($id)
    {
        $customer = Customer::find($id);
        $invoices = Invoice::where('id_customer', $id)->get();

        return view('customers.invoices', compact('customer', 'invoices'));
    }

    public function store_invoice(Request $request)
    {

        $existe = Invoice::where('invoice_number', $request->num_fact)->first();
        if ($existe) {
            $mensaje = 'El registro de la factura ya existe';
            session()->flash('Advertencia', $mensaje);
            return redirect()->back()->withErrors(['Advertencia' => $mensaje]);
        }

        $dato = new Invoice();
        $dato->id_customer = $request->customer_id;
        $dato->first_name = $request->firstname;
        $dato->second_name = $request->secondname;
        $dato->identification = $request->identification;
        $dato->phone = $request->phone;
        $dato->invoice_number = $request->num_fact;
        $dato->point_sale = $request->punto_venta;
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $dato->image = $imageName;
        }

        $dato->save();
        $codigo = $request->customer_id;
        return redirect()->route('customer.invoices', ['id' => $codigo]);
    }

    /*
    public function verify(Request $request)
    {
        // Validar el código de validación
        $request->validate([
            'codigo' => 'required',
        ]);

        // Buscar al usuario por el código de validación
        $customer = Customer::where('verification_code', $request->codigo)->first();

        if ($customer) {
            // Marcar al usuario como verificado
            $customer->verified = true;
            $customer->save();

            // Redirigir al usuario a la página de inicio de sesión
            return redirect()->route('login')->with('success', 'La cuenta ha sido verificada. Inicia sesión para continuar.');
        } else {
            // Redirigir de vuelta a la vista de validación con un mensaje de error
            return redirect()->back()->with('error', 'El código de validación no es válido.');
        }
    }*/
}
