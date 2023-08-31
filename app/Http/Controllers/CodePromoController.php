<?php

namespace App\Http\Controllers;

use App\Models\CodePromo;
use Illuminate\Http\Request;

class CodePromoController extends Controller
{
    public function index()
    {
        $datos = CodePromo::all();
        return view('codeprom.index', compact('datos'));
    }

    public function add()
    {
        return view('codeprom.add');
    }

    public function store(Request $request)
    {
        $codigo = $request->code;
        $existe = CodePromo::where('code', 'LIKE', "$codigo")->first();
        if (!$existe) {
            $codeprom = new CodePromo();
            $codeprom->code = $codigo;
            $codeprom->save();
            session()->flash('message', 'Código registrado');
            //Quedarse en la misma vista...
            //return view('codeprom.add');
            //Ir al listado
            $datos = CodePromo::all();
            return view('codeprom.index', compact('datos'));
        } else {
            session()->flash('error_message', 'Código existe');
            return view('codeprom.add');
        }
    }

    public function delete($id)
    {
        $existe = CodePromo::where('id', 'LIKE', "$id")->first();
        if ($existe) {
            $existe->delete();
            session()->flash('message', 'Registro eliminado...');
        }
        $datos = CodePromo::all();
        return view('codeprom.index', compact('datos'));
    }

    public function findby(Request $request){   
        $filtro = $request->input('filter');
        $datos = CodePromo::where('code', 'LIKE', "%$filtro%")
        ->orwhere('asset', 'LIKE', "%$filtro%")
        ->orwhere('verified_at', 'LIKE', "%$filtro%")
        ->orwhere('created_at', 'LIKE', "%$filtro%")
        ->get();
        return view('codeprom.index', compact('datos'));
    }
}
