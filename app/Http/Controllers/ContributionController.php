<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;

class ContributionController extends Controller
{
    public function index()
    {
        $contribution = Contribution::all();
        return view('contributions.index',['contributions'=>$contribution]);
        
    }
    

    public function search(Request $request)
    {
        $fechaUsuario = $request->input('fecha'); // Asegúrate de que 'fecha' coincida con el nombre del campo en tu formulario
        $contribution = Contribution::all();
    
        return view('contributions.search', ['fecha' => $fechaUsuario],['contributions'=>$contribution]);
    }

}