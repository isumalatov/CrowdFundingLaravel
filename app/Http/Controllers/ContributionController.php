<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function index()
    {
        $contribution = Contribution::paginate(4);
        return view('contributions.index',['contributions'=>$contribution]);
        
    }
    

    public function search(Request $request)
    {
        $precioUsuario = $request->input('precio');
        $proyectoUsuario = $request->input('proyecto');
    
        if ($precioUsuario !== null) {
            $contributions = Contribution::where('amount', $precioUsuario)->get();
        } elseif ($proyectoUsuario !== null) {
            $contributions = Contribution::whereHas('project', function ($query) use ($proyectoUsuario) {
                $query->where('title', 'like', '%' . $proyectoUsuario . '%');
            })->get();
        } else {
            // En caso de que no se haya proporcionado ni precio ni proyecto
            $contributions = Contribution::all();
        }
    
        return view('contributions.search', [
            'contributions' => $contributions,
        ]);
    }

    public function create($project_id)
    {
        return view('contributions.create', [
            'project_id' => $project_id,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Obtener el ID del usuario autenticado
        $user_id = Auth::id();
        //Reemplazo mientras no esta hecho
        //$user_id = 1;

        Contribution::create([
            'user_id' => $user_id,
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'contribution_date' => now(),
        ]);

        return redirect()->route('projects.show', $request->project_id)->with('success', 'Contribución creada exitosamente');
    }

}