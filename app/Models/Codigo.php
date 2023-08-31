<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Codigo extends Model implements ToModel, WithHeadingRow
{
    use HasFactory;

    public function import(Request $request)
    {
        $archivo = $request->file('archivo');
        
        Excel::import(new CodePromo, $archivo);
        
        return redirect()->back()->with('success', 'Datos importados correctamente.');
    }
}
