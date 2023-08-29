<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificacionCorreo;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\CodePromo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    //
    public function index()
    {


        if (session()->has('user_id')) {
            $id = Session::get('user_id');
            $this->view_invoices($id);
            $customer = Customer::find($id);
            $invoices = Invoice::where('id_customer', $id)->get();
            return view('customers.invoices', compact('customer', 'invoices'));
        } else {
            return view('customers.login');
        }
        //return view('customers.login');
    }


    public function logout()
    {
        Auth::logout();
        $expiresAt = now()->addMinutes(0);
        Session::put('user_id', null);
        Session::put('expires_at', $expiresAt);
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
        $customer = Customer::find($id);


        if ($customer->code_mail == $code) {
            $valor = now();

            $customer->code_mail = $code;
            $customer->email_verified_at = $valor;
            $customer->save();
            $id = $customer->id;

            $expiresAt = now()->addMinutes(120);
            Session::put('user_id', $id);
            Session::put('expires_at', $expiresAt);


            return redirect()->route('customer.invoices', ['id' => $id]);
        } else {
            session()->flash('error_message', 'Error al validar: El código ingresado no existe o ya fue registrado');
            return redirect()->back();
            
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;

        // Buscar al cliente en la base de datos
        $customer = Customer::where('email', $email)->first();

        if ($customer) {
            $codigoVerificacion = mt_rand(100000, 999999);
            $customer->code_mail = $codigoVerificacion;
            $customer->save();

            Mail::to($request->email)->send(new VerificacionCorreo($codigoVerificacion));


            $dato = $customer->id;
            return redirect()->route('customer.confirm', ['id' => $dato]);
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
        return view('customers.login');
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
            session()->flash('error_message', $mensaje);
            return redirect()->back()
            ->withInput();
            
        }

        $code = $request->codigo_fact;
        $promo = CodePromo::where('code', $code)->first();
        if ($promo && $promo->asset == true) {
            $valor = now();
            $promo->verified_at = $valor;
            $promo->asset = false;
            $promo->save();
        } else {
            session()->flash('error_message', 'El código proporcionado es invalido');
            return redirect()->back()
            ->withInput();
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
        session()->flash('message', 'Factura registrada');
        return redirect()->route('customer.invoices', ['id' => $codigo])->withInput();
    }
}
